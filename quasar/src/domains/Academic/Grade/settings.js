/** @type {string} */
export const path = '/dashboard/academic/grade'

/** @type {string} */
export const domain = 'academic.grade'

/** @type {string} */
export const resource = '/academic/grade'

/**
 * @type {function}
 */
export const table = () => import('src/views/dashboard/academic/grade/GradeTable.vue')

/**
 * @type {function}
 */
export const form = () => import('src/views/dashboard/academic/grade/GradeForm.vue')
