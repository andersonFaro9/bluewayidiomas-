import { SCOPES } from 'src/app/Agnostic/enum'
import { REFERENCE } from 'src/settings/profile'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Administração / Profiles'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Profiles'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Trash Profiles',
      crumb: 'Trash'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create Profile',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'Visualizar Profile',
      crumb: 'Visualizar'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit Profile',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Print Profile'
  },
  fields: {
    name: 'Name',
    reference: {
      label: 'Reference',
      options: [
        { value: REFERENCE.REFERENCE_ADMIN, label: 'ADMIN' },
        { value: REFERENCE.REFERENCE_TEACHER, label: 'TEACHER' },
        { value: REFERENCE.REFERENCE_STUDENT, label: 'STUDENT' }
      ]
    },
    actions: 'Actions'
  }
}
