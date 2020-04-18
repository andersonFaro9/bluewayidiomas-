/** @type {string} */
export const path = '/dashboard/academic/activity'

/** @type {string} */
export const domain = 'academic.activity'

/** @type {string} */
export const resource = '/academic/activity'

/**
 * @type {function}
 */
export const table = () => import('src/views/dashboard/academic/activity/ActivityTable.vue')

/**
 * @type {function}
 */
export const form = () => import('src/views/dashboard/academic/activity/ActivityForm.vue')
