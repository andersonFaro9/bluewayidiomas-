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
      .fieldFormWidth(50)

    this.getField('email')
      .fieldFormWidth(50)

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
      debugger
      this.$store.dispatch('auth/setNameUser', this.$getField('name').$getValue())
      this.$store.dispatch('auth/setUserEmail', this.$getField('email').$getValue())
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
