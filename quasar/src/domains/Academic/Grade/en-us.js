import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Academic / Groups'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Groups'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Groups Trash',
      crumb: 'Trash'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create Group',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'View Group',
      crumb: 'View'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit Group',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Printed Class'
  },
  fields: {
    name: {
      label: 'Group Name',
      placeholder: 'Ex.: BWP1'
    },
    level: {
      label: 'Level',
      placeholder: 'Select the level',
      options: [
        { value: 'basic', label: '-' },
        { value: 'intermediate', label: '-' },
        { value: 'advanced', label: '-' },
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
      label: 'Time',
      placeholder: 'Ex.: Monday, at 8am'
    }
  }
}
