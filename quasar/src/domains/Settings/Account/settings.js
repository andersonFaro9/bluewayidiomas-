import { SCOPES } from 'src/app/Agnostic/enum.js'

/**
 * @type {string}
 */
export const path = '/dashboard/settings/account'

/**
 * @type {function}
 */
export const component = () => import('src/views/dashboard/home/AccountForm.vue')

/**
 * @type {string}
 */
export const domain = 'settings.account'

/**
 * @type {string}
 */
export const scope = SCOPES.SCOPE_EDIT
