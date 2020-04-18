/** @type {string} */
export const path = '/dashboard/admin/profile'

/** @type {string} */
export const domain = 'admin.profile'

/** @type {string} */
export const resource = '/admin/profile'

/**
 * @type {function}
 */
export const table = () => import('src/views/dashboard/admin/profile/ProfileTable.vue')

/**
 * @type {function}
 */
export const form = () => import('src/views/dashboard/admin/profile/ProfileForm.vue')
