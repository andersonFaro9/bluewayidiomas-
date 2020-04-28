import UserSchema from 'src/domains/Admin/User/Schema/UserSchema'

/**
 * @class {AccountSchema}
 */
export default class AccountSchema extends UserSchema {
  /**
   * available: ['none', 'index']
   * @type {string}
   */
  afterUpdate = 'none'

  /**
   */
  construct () {
    super.construct()

    // fields

    this.getField('name')
      .fieldFormDisabled()

    this.getField('email')
      .fieldFormDisabled()

    this.getField('profile')
      .fieldFormHidden()
      .validationClear()

    this.getField('active')
      .fieldFormHidden()

    // actions

    this.getAction('home')
      .actionScopes([])

    this.getAction('print')
      .actionScopes([])

    this.getAction('destroy')
      .actionScopes([])

    // hooks

    this.addHook('after:update.click', function () {
      // noinspection JSIgnoredPromiseFromCall
      this.$store.dispatch('auth/setNameUser', this.$getField('name').$getValue())
      this.$store.dispatch('auth/setUserEmail', this.$getField('email').$getValue())
      const fields = ['password', 'confirmPassword']
      fields.forEach((field) => this.$getField(field).$setValue(''))
    })
  }

  // noinspection JSCheckFunctionSignatures
  /**
   */
  createdHook () {
    const user = this.$store.getters['auth/getUser']
    const fields = [this.primaryKey, 'name', 'email']
    fields.forEach((field) => this.$getField(field).$setValue(user[field]))
  }
}
