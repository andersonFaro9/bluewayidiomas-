/**
 * @param {Vue} Vue
 */
export default ({ Vue }) => {
  /**
   */
  Object.defineProperty(Vue.prototype, '$static', {
    get () {
      return (path, external = false) => {
        const separator = String(path).charAt(0) !== '/' ? '/' : ''
        if (external) {
          return process.env.VUE_APP_BASE_URL_STATIC + separator + path
        }
        return process.env.VUE_APP_PUBLIC_PATH + 'statics' + separator + path
      }
    }
  })
}
