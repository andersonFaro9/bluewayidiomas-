import { group, redirect, route } from 'src/app/Util/routing'

import { index, layout, notFound } from './components'
import { updateTransition } from './middleware'

// routes
import routes from 'src/domains/routes'

/**
 * @var {string}
 */
export const dashboard = '/dashboard/home'

/**
 * @param {AppRouter} router
 */
export default (router) => {
  //
  const children = [
    redirect('', dashboard),
    route(dashboard, index, 'dashboard'),

    // routes
    ...routes(router)
  ]

  router.addRoutes([group('/dashboard', layout, children)])

  // update the transition of dashboard
  router.beforeEach(updateTransition)

  if (process.env.MODE !== 'ssr') {
    router.addRoutes([route('*', notFound)])
  }
}
