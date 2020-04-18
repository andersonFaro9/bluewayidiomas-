// import { primaryKey } from 'src/settings/schema'

import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Administração / Perfis'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Perfis'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Lixeira dos Perfis',
      crumb: 'Lixeira'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Criar Perfil',
      crumb: 'Criar'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'Visualizar Perfil',
      crumb: 'Visualizar'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Editar Perfil',
      crumb: 'Editar'
    }
  },
  print: {
    title: 'Impressão de Perfil'
  },
  fields: {
    // [primaryKey]: 'Id',
    name: 'Nome',
    reference: {
      label: 'Referência',
      options: [
        { value: 'admin', label: 'ADMIN' },
        { value: 'teacher', label: 'PROFESSOR' },
        { value: 'student', label: 'ALUNO' }
      ]
    },
    price: 'Valor da Mensalidade',
    actions: 'Ações'
  }
}
