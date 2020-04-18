import Rest from 'src/app/Services/Rest'
import { resource } from '../settings'

/**
 * @type {RegistrationService}
 */
export default class RegistrationService extends Rest {
  /**
   * @type {String}
   */
  resource = resource
}
