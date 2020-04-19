import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Acadêmico / Matrículas'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Matrículas'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Lixeira das Matrículas',
      crumb: 'Lixeira'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Criar Matrícula',
      crumb: 'Criar'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'Visualizar Matrícula',
      crumb: 'Visualizar'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Editar Matrícula',
      crumb: 'Editar'
    }
  },
  print: {
    title: 'Impressão de Matrícula'
  },
  fields: {
    grade: {
      label: 'Curso'
    },
    student: {
      label: 'Aluno'
    },
    date: {
      label: 'Data'
    }
  }
}
