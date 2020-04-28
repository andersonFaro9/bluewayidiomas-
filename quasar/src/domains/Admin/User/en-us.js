import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Admin / Users'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Users'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Trash Users',
      crumb: 'Trash'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create User',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'View User',
      crumb: 'View'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit User',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Print User'
  },
  fields: {
    name: 'Name',
    profile: 'Profile',
    email: 'Email',
    phone: 'Cellphone',
    photo: 'Photo',
    active: {
      label: 'Active',
      inline: 'Allow access'
    },
    password: 'Password',
    confirmPassword: 'Password Confirmation'
  }
}
