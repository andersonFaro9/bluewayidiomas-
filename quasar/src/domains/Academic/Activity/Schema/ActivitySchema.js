import Schema from 'src/app/Agnostic/Schema'

import Service from './ActivityService'
import { domain, path } from '../settings'

import GradeSchema from 'src/domains/Academic/Grade/Schema/GradeSchema'
import { SCOPES } from 'src/app/Agnostic/enum'
import { $store } from 'src/store'
import { REFERENCE } from 'src/settings/profile'
import { DOCUMENT_ACCEPT, DOCUMENT_TYPE, LINK_TYPE, TYPE } from 'src/domains/Academic/Activity/enum'

/**
 * @type {ActivitySchema}
 */
export default class ActivitySchema extends Schema {
  /**
   * @type {string}
   */
  static domain = domain

  /**
   * @type {string}
   */
  static path = path

  /**
   * @type {Http}
   */
  service = Service

  /**
   */
  construct () {
    this.addField('grade')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsSelectRemote(GradeSchema.build().provideRemote())
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('name')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('description')
      // .fieldIsWysiwyg()
      .fieldIsText()
      .validationRequired()

    this.addField('type')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsRadio()
      .fieldFormDefaultValue(TYPE.TYPE_DOCUMENT)
      .fieldFormWidth(30)
      .validationRequired()

    this.addField('documentType')
      .fieldIsRadio()
      .fieldFormWidth(70)
      .fieldFormHidden()
      .fieldFormDefaultValue(DOCUMENT_TYPE.DOCUMENT_TYPE_PDF)
      .fieldWatch(function (documentType) {
        return this.$getField('document').$setAttr('accept', DOCUMENT_ACCEPT[documentType])
      })
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === TYPE.TYPE_DOCUMENT
      })

    this.addField('linkType')
      .fieldIsRadio()
      .fieldFormWidth(70)
      .fieldFormHidden()
      .fieldFormDefaultValue(LINK_TYPE.LINK_TYPE_SITE)
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === TYPE.TYPE_LINK
      })

    this.addField('document')
      .fieldIsFileSync()
      .fieldAppendAttrs({
        accept: DOCUMENT_ACCEPT[DOCUMENT_TYPE.DOCUMENT_TYPE_PDF]
      })
      .validationMaxFileSize(500 * 1024)
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === TYPE.TYPE_DOCUMENT
      })

    this.addField('link')
      .fieldIsUrl()
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === TYPE.TYPE_LINK
      })

    if ($store.getters['auth/getUserProfileReference'] !== REFERENCE.REFERENCE_STUDENT) {
      return
    }
    this.removeActions(['add', 'create', 'edit', 'update', 'destroy'])
  }

  /**
   * @param schema
   */
  createdHook (schema = undefined) {
    if ([SCOPES.SCOPE_INDEX, SCOPES.SCOPE_TRASH].includes(this.scope)) {
      return
    }

    const handler = function (type) {
      this.$getField('documentType').$fieldFormHidden(type !== TYPE.TYPE_DOCUMENT)
      this.$getField('document').$fieldFormHidden(type !== TYPE.TYPE_DOCUMENT)
      this.$getField('linkType').$fieldFormHidden(type !== TYPE.TYPE_LINK)
      this.$getField('link').$fieldFormHidden(type !== TYPE.TYPE_LINK)
    }
    this.$watch('record.type', handler, { immediate: true })
  }
}
