import Rest from 'src/app/Services/Rest'
import { resource } from '../settings'

/**
 * @type {ActivityService}
 */
export default class ActivityService extends Rest {
  /**
   * @type {String}
   */
  resource = resource
}
