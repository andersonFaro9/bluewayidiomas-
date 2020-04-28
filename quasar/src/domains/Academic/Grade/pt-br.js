import { SCOPES } from 'src/app/Agnostic/enum'

/**
 */
export default {
  routes: {
    group: {
      crumb: 'Acadêmico / Turmas'
    },
    [SCOPES.SCOPE_INDEX]: {
      title: 'Turmas'
    },
    [SCOPES.SCOPE_TRASH]: {
      title: 'Lixeira das Turmas',
      crumb: 'Lixeira'
    },
    [SCOPES.SCOPE_ADD]: {
      title: 'Criar Turma',
      crumb: 'Criar'
    },
    [SCOPES.SCOPE_VIEW]: {
      title: 'Visualizar Turma',
      crumb: 'Visualizar'
    },
    [SCOPES.SCOPE_EDIT]: {
      title: 'Editar Turma',
      crumb: 'Editar'
    }
  },
  print: {
    title: 'Impressão de Turma'
  },
  fields: {
    name: {
      label: 'Nome',
      placeholder: 'Ex.: BWP1'
    },
    level: {
      label: 'Módulo',
      placeholder: 'Selecione o Módulo',
      options: [
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
      label: 'Professor',
      placeholder: 'Selecione o Professor'
    },
    shift: {
      label: 'Horário / Dia',
      placeholder: 'Ex.: segunda e terça às 8h'
    }
  }
}
