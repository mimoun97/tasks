import Snackbar from './Snackbar'
import EventBus from '../../eventBus'

function Install (Vue, options) {
  Vue.component('snackbar', Snackbar)
  Vue.prototype.$snackbar = {
    showMessage (message) {
      EventBus.$emit('showSnackbarMessage', message)
    },
    showError (error) {
      EventBus.$emit('showSnackbarError', error)
    },
    showInfo (info) {
      EventBus.$emit('showSnackbarInfo', info)
    }
  }
}

if (typeof window !== 'undefined' && window.Vue) {
  window.Vue.use(Install)
}

export default Install
