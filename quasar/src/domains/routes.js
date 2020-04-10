// academic
import grade from 'src/domains/Academic/Grade/routes'
import activity from 'src/domains/Academic/Activity/routes'

// admin
import action from 'src/domains/Admin/Action/routes'
import profile from 'src/domains/Admin/Profile/routes'
import user from 'src/domains/Admin/User/routes'

// home
import home from 'src/domains/Home/Account/routes'

// report
import report from 'src/domains/Report/routes'

/**
 * @param router
 * @returns {RouteConfig[]}
 */
export default (router) => [
  // academic namespace routes
  ...grade(),
  ...activity(),

  // admin namespace routes
  ...action(),
  ...profile(),
  ...user(),

  // home namespace routes
  ...home(),

  // report namespace routes
  ...report(router)
]
