import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Acadêmico / Cursos'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Cursos'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Lixeira das Cursos',
      crumb: 'Lixeira'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Criar Curso',
      crumb: 'Criar'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'Visualizar Curso',
      crumb: 'Visualizar'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Editar Curso',
      crumb: 'Editar'
    }
  },
  print: {
    title: 'Impressão de Curso'
  },
  fields: {
    name: 'Nome',
    shift: {
      label: 'Turno',
      options: [
        { value: 'morning', label: 'MANHÃ' },
        { value: 'afternoon', label: 'TARDE' },
        { value: 'night', label: 'NOITE' }
      ]
    }
  }
}
