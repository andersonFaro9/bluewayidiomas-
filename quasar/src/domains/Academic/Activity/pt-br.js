import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Acadêmico / Atividades'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Atividades'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Lixeira das Atividades',
      crumb: 'Lixeira'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Criar Atividade',
      crumb: 'Criar'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'Visualizar Atividade',
      crumb: 'Visualizar'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Editar Atividade',
      crumb: 'Editar'
    }
  },
  print: {
    title: 'Impressão de Atividade'
  },
  fields: {
    grade: 'Curso',
    name: 'Nome',
    type: {
      label: 'Tipo',
      options: [
        { value: 'document', label: 'Arquivo' },
        { value: 'link', label: 'Link' }/*,
        { value: 'link', label: 'Questionário' }/*,
        { value: 'open', label: 'Questionário Aberto' },
        { value: 'closed', label: 'Questionário Fechado' } */
      ]
    },
    documentType: {
      label: 'Tipo',
      tooltip: '(Word, Excel, PowerPoint)',
      options: [
        { value: 'pdf', label: 'PDF' },
        { value: 'office', label: 'Office' },
        { value: 'image', label: 'Image' },
        { value: 'video', label: 'Video' },
        { value: 'audio', label: 'Audio' }
      ]
    },
    description: 'Enunciado',
    document: 'Arquivo'
  }
}
