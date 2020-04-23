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
        { value: 'basic', label: 'BÁSICO' },
        { value: 'intermediate', label: 'INTERMEDIÁRIO' },
        { value: 'advanced', label: 'AVANÇADO' }
      ]
    },
    class: {
      label: 'Turma',
      placeholder: 'Selecione a Turma',
      options: [
        { value: 'a', label: 'A' },
        { value: 'b', label: 'B' },
        { value: 'c', label: 'C' },
        { value: 'd', label: 'D' },
        { value: 'e', label: 'E' },
        { value: 'f', label: 'F' }
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
