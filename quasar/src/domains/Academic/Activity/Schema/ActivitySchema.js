import Schema from 'src/app/Agnostic/Schema'

import Service from './ActivityService'
import { domain, path } from '../settings'

import GradeSchema from 'src/domains/Academic/Grade/Schema/GradeSchema'
import { SCOPES } from 'src/app/Agnostic/enum'

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
      .fieldFormDefaultValue('document')
      .fieldFormWidth(30)
      .validationRequired()

    this.addField('documentType')
      .fieldIsRadio()
      .fieldFormWidth(70)
      .fieldFormHidden()
      .fieldFormDefaultValue('pdf')
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === 'document'
      })

    this.addField('linkType')
      .fieldIsRadio()
      .fieldFormWidth(70)
      .fieldFormHidden()
      .fieldFormDefaultValue('site')
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === 'link'
      })

    this.addField('document')
      .fieldIsFileSync()
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === 'document'
      })

    this.addField('link')
      .fieldIsUrl()
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === 'link'
      })
  }

  /**
   * @param schema
   */
  createdHook (schema = undefined) {
    if ([SCOPES.SCOPE_INDEX, SCOPES.SCOPE_TRASH].includes(this.scope)) {
      return
    }

    const handler = function (type) {
      this.$getField('documentType').$fieldFormHidden(type !== 'document')
      this.$getField('document').$fieldFormHidden(type !== 'document')
      this.$getField('linkType').$fieldFormHidden(type !== 'link')
      this.$getField('link').$fieldFormHidden(type !== 'link')
    }
    this.$watch('record.type', handler, { immediate: true })
  }
}
