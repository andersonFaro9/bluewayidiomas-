<template>
  <div class="DashboardIndex">
    <div class="flex row bg-primary text-white shadow-2 rounded-borders q-pa-md">
      <div class="col-6-sm q-pa-sm">
        <small class="text-weight-medium mono-font text-subtitle1">
          {{ greetings }}, <strong>{{ name }}!!</strong>
        </small>
      </div>
      <q-space />
      <div class="col-6-sm q-pa-sm text-right">
        <small class="text-weight-thin mono-font">{{ $t('app.version.label') }}: {{ version }}</small>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
import $store from 'src/modules/General/version'
import allowed from 'src/modules/Auth/helper/allowed'
// noinspection ES6CheckImport
import { date } from 'quasar'

export default {
  /**
   */
  name: 'DashboardIndex',
  /**
   */
  data: () => ({
    shortcuts: [
      {
        label: 'Ocorrências',
        path: '/dashboard/support/incident'
      },
      {
        label: 'Ordens de Serviço',
        path: '/dashboard/support/order'
      }
    ]
  }),
  /**
   */
  computed: {
    /**
     * @returns {Object}
     */
    user () {
      return this.$store.getters['auth/getUser']
    },
    /**
     * @returns {string}
     */
    name () {
      return this.$util.get(this.$store.getters['auth/getUser'], 'name')
    },

    /**
     * @returns {string}
     */
    last () {
      const last = this.$util.get(this.$store.getters['auth/getUser'], 'last_login')
      const week = date.formatDate(last, 'dddd')
      const day = date.formatDate(last, 'DD/MM/YYYY')
      const hour = date.formatDate(last, 'HH:mm')
      return `${week}, ${day} às ${hour}`
    },
    /**
     * @returns {string}
     */

    greetings () {
      const hour = (new Date()).getHours()
      if (hour >= 0 && hour <= 12) {
        return this.$lang('app.greetings.morning')
      }
      if (hour > 12 && hour <= 18) {
        return this.$lang('app.greetings.afternoon')
      }
      return this.$lang('app.greetings.night')
    },
    /**
     * @returns {string}
     */
    version () {
      if (this.$dev) {
        return 'develop'
      }
      return $store.state.version || 'unknown'
    },
    /**
     * @returns {Array}
     */
    shortcutsAvailable () {
      return this.shortcuts.filter((shortcut) => allowed(shortcut.path))
    }
  },
  /**
   */
  methods: {
    openShortcut (shortcut) {
      if (!shortcut.path) {
        return
      }
      this.$browse(shortcut.path)
    }
  }
}
</script>

<style lang="stylus">
.DashboardIndex
  min-height calc(100vh - 130px)

  .DashboardIndex__card
    cursor pointer
    min-height 100%
    flex 1
    display flex
    flex-direction column
    justify-content center

    &.bg-white:hover
      background-color #f0f0f0 !important

  .DashboardIndex__docs
    position relative
    display flex
    align-items center
    justify-content center
    background #183055
    padding 69px 15px 50px 0
    min-height 200px

  .DashboardIndex__source
    position relative
    display grid
    background-color #24292E
    padding 30px 20px 15px 20px
    grid-template-columns repeat(100, 1fr)
    background-size 210px
    background-repeat no-repeat
    background-position right -20px
    min-height 200px

    > .DashboardIndex__source__logo
      grid-column auto / span 30
      grid-row auto / span 4
      display flex
      align-items center
      justify-content center

      > a > svg
        fill #fff

    > .DashboardIndex__source__shield
      grid-column auto / span 70
      text-align right
      padding 5px 0

  .DashboardIndex__label
    position absolute
    top 10px
    left 10px
    font-size 10px

</style>
