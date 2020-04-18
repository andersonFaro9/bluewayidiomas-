import { openURL } from 'quasar'

/**
 * @type {boolean}
 */
export const DEFAULT_REMEMBER = false

/**
 * @param {string} path
 * @param {*} model
 */
export function downloadFile (path, model = null) {
  if (typeof path !== 'string') {
    return
  }
  const baseURL = process.env.VUE_APP_BASE_URL_STATIC

  openURL(`${baseURL}/${path}?download=true`)
}
