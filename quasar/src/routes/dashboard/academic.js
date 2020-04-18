import * as activity from 'src/domains/Academic/Activity/settings'
import * as grade from 'src/domains/Academic/Grade/settings'
import * as registration from 'src/domains/Academic/Registration/settings'

/**
 * @param {AppRouter} $router
 */
export default ($router) => {
  $router.resource(activity)
  $router.resource(grade)
  $router.resource(registration)
}
