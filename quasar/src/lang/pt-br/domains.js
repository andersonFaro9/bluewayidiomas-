// domains/Academic
import grade from 'src/domains/Academic/Grade/pt-br'
import activity from 'src/domains/Academic/Activity/pt-br'
import registration from 'src/domains/Academic/Registration/pt-br'

// domains/Admin
import action from 'src/domains/Admin/Action/pt-br'
import profile from 'src/domains/Admin/Profile/pt-br'
import user from 'src/domains/Admin/User/pt-br'

// domains/Help
import home from 'src/domains/Settings/Account/pt-br.js'

// domains/Report
import report from 'src/domains/Report/pt-br'

/**
 */
export default {
  home,
  academic: {
    activity, grade, registration
  },
  admin: {
    action, profile, user
  },
  report
}
