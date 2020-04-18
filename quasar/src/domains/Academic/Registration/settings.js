/** @type {string} */
export const path = '/dashboard/academic/registration'

/** @type {string} */
export const domain = 'academic.registration'

/** @type {string} */
export const resource = '/academic/registration'

/**
 * @type {function}
 */
export const table = () => import('src/views/dashboard/academic/registration/RegistrationTable.vue')

/**
 * @type {function}
 */
export const form = () => import('src/views/dashboard/academic/registration/RegistrationForm.vue')
