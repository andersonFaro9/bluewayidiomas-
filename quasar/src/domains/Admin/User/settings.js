/** @type {string} */
export const path = '/dashboard/admin/user'

/** @type {string} */
export const domain = 'admin.user'

/** @type {string} */
export const resource = '/admin/user'

/**
 * @type {function}
 */
export const table = () => import('src/views/dashboard/admin/user/UserTable.vue')

/**
 * @type {function}
 */
export const form = () => import('src/views/dashboard/admin/user/UserForm.vue')
