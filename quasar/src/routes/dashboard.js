import { updateTransition } from 'src/modules/Dashboard/router/middleware'

// routes
import { index, layout } from 'src/modules/Dashboard/components'
import admin from 'src/routes/dashboard/admin'
import academic from 'src/routes/dashboard/academic'

import * as account from 'src/domains/Settings/Account/settings'

/**
 * @type {string}
 */
export const root = '/dashboard'

/**
 * @var {string}
 */
export const dashboard = '/dashboard/home'

/**
 * @param {AppRouter} $router
 */
export default ($router) => {
  $router.group(root, layout, (group) => {
    group.redirect('', dashboard)
    group.route(dashboard, index, { name: 'dashboard' })

    admin($router)
    academic($router)

    group.route(account.path, account.component, { prefix: account.domain, scope: account.scope })
  })

  // update the transition of dashboard
  $router.beforeEach(updateTransition)
}
