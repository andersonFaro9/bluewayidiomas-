import Schema from 'src/app/Agnostic/Schema'

import Service from './RegistrationService'
import { domain, path } from '../settings'

import GradeSchema from 'src/domains/Academic/Grade/Schema/GradeSchema'
import UserSchema from 'src/domains/Admin/User/Schema/UserSchema'
import { today } from 'src/app/Util/date'
import { $store } from 'src/store'

/**
 * @type {RegistrationSchema}
 */
export default class RegistrationSchema extends Schema {
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

    this.addField('student')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsSelectRemote(UserSchema.build().provideRemote())
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('date')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldIsDate()
      .fieldFormWidth(30)
      .fieldFormDefaultValue(today())
      .validationRequired()

    if ($store.getters['auth/isUserAdmin']) {
      return
    }
    this.removeActions(['add', 'create', 'edit', 'update', 'destroy'])
  }
}
