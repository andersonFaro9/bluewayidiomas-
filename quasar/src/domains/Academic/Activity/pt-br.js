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
    name: 'Nome',
    grade: 'Curso'
  }
}
