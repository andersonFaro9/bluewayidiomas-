<template>
  <div
    class="AuthIndex flex row items-center justify-center"
    :class="{ started }"

  >

    <q-card class="AuthIndex__card">
      <q-card-section class="text-center">
        <div>
            <img
            alt="logo"
            class="AuthIndex__logo"
            :src="$static('/logo-horizontal.png')" >

        </div>
      </q-card-section>

      <q-separator />

      <q-card-section>
        <form @submit.prevent="attempt">
          <div class="row">
            <div  class="col-12 q-pa-sm" >

              <q-input
                :label="$lang('auth.signIn.username')"
                type="email"
                outlined
                v-model="record.login">
                <template v-slot:prepend>
                  <q-icon name="mail" />
                </template>

              </q-input>

            </div>

            <div class="col-12 q-pa-sm q-pb-md">
              <q-input
                :label="$lang('auth.signIn.password')"
                :type=" isPassword ? 'password' : 'text'"
                outlined

                v-model="record.password"
              >
                <template v-slot:prepend>
                  <q-icon :name="record.password ? 'vpn_key' : 'lock'" />
                </template>
                <template v-slot:append>
                  <q-icon
                    :name="isPassword ? 'visibility_off' : 'visibility'"
                    class="cursor-pointer"
                    @click="isPassword = !isPassword"
                  />
                </template>
              </q-input>
            </div>
          </div>
          <hr>
          <div class="q-pa-sm" >
            <q-btn
              class="AuthIndex__button full-width"

              :label="$lang('auth.signIn.button')"
              type="submit"
              :loading="loading"
            />

             <a class= "link_home" href="#">{{ $t('pages./.home') }}</a>
          </div>
        </form>
      </q-card-section>
    </q-card>
  </div>
</template>

<script type="text/javascript">
import { required } from 'vuelidate/lib/validators'
import AuthAttempt from 'src/modules/Auth/AuthAttempt'
import { dashboard } from 'src/routes/dashboard'
import { me } from 'src/domains/Auth/Service'

export default {
  /**
   */
  name: 'AuthIndex',
  /**
   */
  mixins: [
    AuthAttempt
  ],
  /**
   */
  data: () => ({
    started: false,
    isPassword: true,
    record: {
      login: process.env.VUE_APP_DEFAULT_USERNAME,
      password: process.env.VUE_APP_DEFAULT_PASSWORD
    }
  }),
  /**
   */
  validations () {
    return {
      record: {
        login: { required },
        password: { required }
      }
    }
  },
  /**
   */
  methods: {
    /**
     */
    attempting () {
      this.$q.loading.show()
      return this.$service.login(this.record.login, this.record.password)
    },
    /**
     * @param {Object} response
     */
    attemptSuccess ({ data }) {
      this.$store
        .dispatch('auth/login', data.token)
        .then(this.attemptFetchUser)
        .catch(() => this.$q.loading.hide())
    },
    /**
     */
    attemptError () {
      this.$q.loading.hide()
      this.$message.error(this.$lang('auth.login.error'))
    },
    /**
     */
    attemptFetchUser () {
      me()
        .then(this.attemptSetUser)
        .catch(() => this.$q.loading.hide())
    },
    /**
     * @param {Object} user
     */
    attemptSetUser (user) {
      this.$store.dispatch('auth/updateUser', user)
        .then(this.openDashboard)
    },
    /**
     */
    openDashboard () {
      let target = dashboard
      if (this.$route.query.current) {
        target = this.$route.query.current
      }
      this.$browse(target)
      window.setTimeout(() => this.$q.loading.hide(), 2000)
    }
  },
  /**
   */
  created () {
    if (!this.$store.getters['app/getClipboard']) {
      return
    }

    const credentials = this.$store.getters['app/getClipboard']
    const setCredentials = () => {
      if (credentials.login) {
        this.record.login = credentials.login
      }
      if (credentials.password) {
        this.record.password = credentials.password
      }
    }
    this.$store.dispatch('app/clearClipboard').then(setCredentials)
  },
  mounted () {
    window.setTimeout(() => { this.started = true }, 1000)
  }
}
</script>

<style lang="stylus">
@import '~src/css/quasar.variables.styl'

.AuthIndex
  height 100vh
  overflow-x hidden
  opacity 0.3
  transition opacity 3s
  &.started
    opacity 1
    background-color #013e7b

  .AuthIndex__card
    max-width 100%
    box-shadow 0 4px 6px 1px rgba(0, 0, 0, 0.16), 0 2px 6px 1px rgba(0, 0, 0, 0.16), 0 5px 6px 1px rgba(0, 0, 0, 0.16)

  .AuthIndex__logo
    height 140px
    width 175px

  .link_home

    font-size: 12px;
    display:flex;
    flex-direction: row-reverse;
    padding-top: 8px;
    text-decoration: none;
    color: #0000d9
    font-weight 500
    text-transform: uppercase;
    font-family: Arial, Helvetica, sans-serif;

  .AuthIndex__button
    min-height 42px
    color white
    background-color #0000d9

.q-field__label
  color #c5d2d1
</style>
