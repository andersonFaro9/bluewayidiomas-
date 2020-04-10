import Rest from 'src/app/Services/Rest'
import { resource } from '../settings'

/**
 * @type {GradeService}
 */
export default class GradeService extends Rest {
  /**
   * @type {String}
   */
  resource = resource
}
