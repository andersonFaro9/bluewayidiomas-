import Schema from 'src/app/Agnostic/Schema'

import Service from './GradeService'
import { domain, path } from '../settings'

/**
 * @type {GradeSchema}
 */
export default class GradeSchema extends Schema {
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
    this.addField('name')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldFormAutofocus()
      .validationRequired()

    this.addField('shift')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsSelect()
      .validationRequired()
  }
}
