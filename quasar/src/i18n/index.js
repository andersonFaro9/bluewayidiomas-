import Vue from 'vue'
import VueI18n from 'vue-i18n'

import ptBr from './pt-br'

Vue.use(VueI18n)

/**
 */
export default new VueI18n({
  locale: String(process.env.VUE_APP_LOCALE),
  fallbackLocale: 'pt-br',
  messages: {
    'pt-br': ptBr
  }
})
