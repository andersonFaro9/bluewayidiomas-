import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Atividades'
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
        { value: 'generic', label: 'PDF / DOC' },
        { value: 'video', label: 'Video' },
        { value: 'audio', label: 'Audio' },
        { value: 'link', label: 'Link' },
        { value: 'open', label: 'Questionário Aberto' },
        { value: 'closed', label: 'Questionário Fechado' }
      ]
    },
    description: 'Enunciado',
    document: 'Arquivo'
  }
}
