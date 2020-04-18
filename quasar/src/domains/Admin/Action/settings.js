/** @type {string} */
export const path = '/dashboard/admin/action'

/** @type {string} */
export const domain = 'admin.action'

/** @type {string} */
export const resource = '/admin/action'

/**
 * @type {function}
 */
export const table = () => import('src/views/dashboard/admin/action/ActionTable.vue')

/**
 * @type {function}
 */
export const form = () => import('src/views/dashboard/admin/action/ActionForm.vue')
