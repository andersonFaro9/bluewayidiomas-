// domains/Academic
// import grade from 'src/domains/Academic/Grade/pt-br'
import grade from 'src/domains/Academic/Grade/en-us'
import activity from 'src/domains/Academic/Activity/en-us'
import registration from 'src/domains/Academic/Registration/en-us'

// domains/Admin
import action from 'src/domains/Admin/Action/en-us'
import profile from 'src/domains/Admin/Profile/en-us'
import user from 'src/domains/Admin/User/en-us'

// domains/Help
import home from 'src/domains/Settings/Account/en-us'

// domains/Report
import report from 'src/domains/Report/en-us'
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
