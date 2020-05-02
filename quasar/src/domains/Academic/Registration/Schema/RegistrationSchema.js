import Schema from 'src/app/Agnostic/Schema'

import Service from './RegistrationService'
import { domain, path } from '../settings'

import GradeSchema from 'src/domains/Academic/Grade/Schema/GradeSchema'
import UserSchema from 'src/domains/Admin/User/Schema/UserSchema'
import { today } from 'src/app/Util/date'
import { $store } from 'src/store'
import { SCOPES } from 'src/app/Agnostic/enum'
import { gradeFormat, gradeLevelFormat } from 'src/domains/Academic/Registration/helpers'

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
      .fieldTableOrder(2)
      .fieldIsSelectRemote({ ...GradeSchema.build().provideRemote(), format: gradeFormat })
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('student')
      .fieldTableShow()
      .fieldTableWhere()
      .fieldTableOrder(1)
      .fieldIsSelectRemote(UserSchema.build().provideRemote())
      .fieldFormWidth(50)
      .validationRequired()

    this.addField('grade.level')
      .fieldTableShow()
      .fieldTableFormat(gradeLevelFormat)
      .fieldFormHidden()
      .fieldFormWidth(50)
      .fieldConfigure(function (field) {
        if (this.scope === SCOPES.SCOPE_VIEW) {
          field.$layout.formHidden = false
        }
        return field
      })

    this.addField('grade.shift')
      .fieldTableShow()
      .fieldFormHidden()
      .fieldFormWidth(50)
      .fieldConfigure(function (field) {
        if (this.scope === SCOPES.SCOPE_VIEW) {
          field.$layout.formHidden = false
        }
        return field
      })

    this.addField('date')
      .fieldTableWhere()
      .fieldIsDate()
      .fieldFormWidth(30)
      .fieldFormDefaultValue(today())
      .validationRequired()

    this.addAvoid('grade.shift')
    this.addAvoid('grade.level')

    if ($store.getters['auth/isUserAdmin']) {
      return
    }
    this.removeActions(['add', 'create', 'edit', 'update', 'destroy'])
  }
}
