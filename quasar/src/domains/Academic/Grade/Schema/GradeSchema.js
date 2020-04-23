import Schema from 'src/app/Agnostic/Schema'

import Service from './GradeService'
import { domain, path } from '../settings'
import UserSchema from 'src/domains/Admin/User/Schema/UserSchema'

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
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('teacher')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsSelectRemote(UserSchema.build().provideRemote())
      .fieldFormWidth(50)

    this.addField('level')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsSelect()
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('class')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsSelect()
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('shift')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsInputPlan()
      .validationRequired()
  }
}
