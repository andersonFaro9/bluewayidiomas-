// import { primaryKey } from 'src/settings/schema'

import { SCOPES } from 'src/app/Agnostic/enum'
import { REFERENCE } from 'src/settings/profile'

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
        { value: REFERENCE.REFERENCE_ADMIN, label: 'ADMIN' },
        { value: REFERENCE.REFERENCE_TEACHER, label: 'PROFESSOR' },
        { value: REFERENCE.REFERENCE_STUDENT, label: 'ALUNO' }
      ]
    },
    price: 'Valor da Mensalidade',
    actions: 'Ações'
  }
}
