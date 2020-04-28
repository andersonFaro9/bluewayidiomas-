import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Admin / Actions'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Actions'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Actions Trash',
      crumb: 'Lixeira'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create Action',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'View Action',
      crumb: 'View'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit Action',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Print Action'
  },
  fields: {
    parent: 'Parent',
    name: 'Name',
    namespace: 'Scope',
    icon: 'Icon',
    path: 'URL',
    assortment: 'Assortment',
    separated: 'Separator'
  }
}
