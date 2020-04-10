import { crud, group } from 'src/app/Util/routing'
import { domain, path } from './settings'

/**
 * @returns {Array<RouteConfig>}
 */
export default () => {
  // index
  const index = () => import('src/modules/Group.vue')
  // table
  const table = () => import('src/views/dashboard/academic/activity/ActivityTable.vue')
  // form
  const form = () => import('src/views/dashboard/academic/activity/ActivityForm.vue')

  const children = crud(domain, path, table, form)
  const meta = { namespace: domain, scope: 'group' }
  return [
    group(path, index, children, meta)
  ]
}
