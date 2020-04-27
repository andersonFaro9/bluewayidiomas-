import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Academic / Enrollment'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Enrollment'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Trash Enrollment',
      crumb: 'Trash'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create Enrollment',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'See Enrollment',
      crumb: 'See'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit Enrollment',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Printed Enrollment'
  },
  fields: {
    grade: {
      label: 'Module'
    },
    student: {
      label: 'Name'
    },
    date: {
      label: 'Date'
    }
  }
}
