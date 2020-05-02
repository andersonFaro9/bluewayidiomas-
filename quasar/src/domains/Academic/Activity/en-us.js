import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Academic / Activities'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Activities'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Activities Trash',
      crumb: 'Trash'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Create Activity',
      crumb: 'Create'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'View Activity',
      crumb: 'View'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Edit Activity',
      crumb: 'Edit'
    }
  },
  print: {
    title: 'Print Activity'
  },
  fields: {
    grade: 'Group',
    name: 'Activity Name',
    publishDate: 'Date',
    deliveryDate: 'Delivery Date',
    description: 'Description',
    type: {
      label: 'Type',
      options: [
        { value: 'document', label: 'File' },
        { value: 'link', label: 'Link' }/*,
        { value: 'link', label: 'Questionário' }/*,
        { value: 'open', label: 'Questionário Aberto' },
        { value: 'closed', label: 'Questionário Fechado' } */
      ]
    },
    documentType: {
      label: 'Type file',
      tooltip: '(Word, Excel, PowerPoint)',
      options: [
        { value: 'pdf', label: 'PDF' },
        { value: 'office', label: 'Office' },
        { value: 'image', label: 'Image' },
        { value: 'video', label: 'Video' },
        { value: 'audio', label: 'Audio' }
      ]
    },
    linkType: {
      label: 'Link type',
      tooltip: '',
      options: [
        { value: 'site', label: 'Simple website' },
        { value: 'youtube', label: 'Youtube videos' }
      ]
    },
    document: 'File',
    link: 'Link'
  },
  validations: {
    document: {
      requiredIf: 'Field is required when type is File'
    }
  }
}
