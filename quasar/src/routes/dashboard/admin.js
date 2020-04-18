import * as action from 'src/domains/Admin/Action/settings'
import * as profile from 'src/domains/Admin/Profile/settings'
import * as user from 'src/domains/Admin/User/settings'

/**
 * @param {AppRouter} $router
 */
export default ($router) => {
  $router.resource(action)
  $router.resource(profile)
  $router.resource(user)
}
