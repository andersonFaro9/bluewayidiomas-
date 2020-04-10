import Schema from 'src/app/Agnostic/Schema'

import Service from './ActivityService'
import { domain, path } from '../settings'

import GradeSchema from 'src/domains/Academic/Grade/Schema/GradeSchema'

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

    this.addField('name')
      .fieldTableShow()
      .fieldTableWhere()
      .validationRequired()

    this.addField('type')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsRadio([
        { value: 'a', label: 'PDF / DOC' },
        { value: 'b', label: 'Video' },
        { value: 'c', label: 'Audio' },
        { value: 'd', label: 'Link' },
        { value: 'e', label: 'Questionário Aberto' },
        { value: 'f', label: 'Questionário Fechado' }
      ])
      .fieldFormDefaultValue('a')
      .validationRequired()

    this.addField('description')
      .fieldTableShow()
      .fieldTableWhere()
      // .fieldIsWysiwyg()
      .fieldIsText()
      .validationRequired()

    this.addField('document')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsFile()
      .validationRequired()
  }
}
