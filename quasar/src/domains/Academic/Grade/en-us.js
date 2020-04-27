import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Academic / Class'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Class'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Class Trash',
      crumb: 'Trash'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create Class',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'See Class',
      crumb: 'To see'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit Class',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Printed activity'
  },
  fields: {
    name: {
      label: 'Module',
      placeholder: 'Ex.: BWP1'
    },
    level: {
      label: 'Level',
      placeholder: 'Select the level',
      options: [
        { value: 'kids01', label: 'Kids 01' },
        { value: 'kids02', label: 'Kids 02' },
        { value: 'kids03', label: 'Kids 03' },
        { value: 'kids04', label: 'Kids 04' },
        { value: 'kids05', label: 'Kids 05' },
        { value: 'teeans01', label: 'Teens 01' },
        { value: 'teeans02', label: 'Teens 02' },
        { value: 'teeans03', label: 'Teens 03' },
        { value: 'specialclass', label: 'Special Class' }
      ]
    },

    teacher: {
      label: 'Teacher',
      placeholder: 'Select The Teacher'
    },
    shift: {
      label: 'Time / Day',
      placeholder: 'Ex.: Monday, at 8am'
    }
  }
}
