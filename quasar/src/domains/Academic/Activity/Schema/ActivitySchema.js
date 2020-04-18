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
      .validationRequired()

    this.addField('type')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsRadio()
      .fieldFormDefaultValue('document')
      .fieldFormWidth(30)
      .validationRequired()

    this.addField('documentType')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsRadio()
      .fieldFormWidth(70)
      .fieldFormHidden()
      .fieldFormDefaultValue('pdf')
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === 'document'
      })

    this.addField('name')
      .fieldTableShow()
      .fieldTableWhere()
      .validationRequired()

    this.addField('description')
      .fieldTableShow()
      .fieldTableWhere()
      // .fieldIsWysiwyg()
      .fieldIsText()
      .validationRequired()

    this.addField('document')
      .fieldIsFileSync()
      .validationRequiredWhen(function () {
        return this.$getField('type').$getValue() === 'document'
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
      return this.$getField('documentType').$fieldFormHidden(type !== 'document')
    }
    this.$watch('record.type', handler, { immediate: true })
  }
}
