import Vue from 'vue'
import Vuetify from 'vuetify'
import TreeView from 'vue-json-tree-view'
import VueTimeago from 'vue-timeago'

import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'typeface-roboto/index.css'
import 'typeface-montserrat/index.css'
import './bootstrap'

import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'
import EditableText from './components/EditableText.vue'

import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList.vue'
import UserSelect from './components/UserSelect.vue'
import Tags from './components/tags/Tags.vue'
import Impersonate from './components/Impersonate.vue'
import About from './components/About.vue'
import Contact from './components/Contact.vue'
import Tasques from './components/tasques/Tasques.vue'
import UserProfile from './components/UserProfile.vue'

import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'
import permissions from './plugins/permissions'
import GitInfoComponent from './components/git/GitInfoComponent'
import UserSettings from './components/UserSettings'
import Changelog from './components/changelog/ChangelogComponent.vue'
import ServiceWorker from './components/ServiceWorker.vue'
import Notifications from './components/notifications/Notifications'
import Navigation from './components/Navigation'
import NavigationRight from './components/NavigationRight'
import NotificationsWidget from './components/notifications/NotificationsWidget'
import ShareFab from './components/ui/ShareFab'
import EmptyState from './components/ui/EmptyState'
import FooterApp from './components/ui/FooterApp'
import Carrusel from './components/ui/Carrusel'

//progress bar
import VueProgressBar from 'vue-progressbar'

//device features geo, vibration, orientation..
import TheDeviceFeatures from './components/device/TheDeviceFeatures'
//task link show
import TaskCard from './components/tasques/TaskCard'
// parallax webp
import VParallaxWebp from './components/ui/VParallaxWebp.vue'
//clock
import Clock from './components/clock/Clock.vue'
//newsletters
import Newsletters from './components/newsletters/Newsletters.vue'
import NewsLetterSubscriptionCard from './components/newsletters/NewsLetterSubscriptionCard'
//chat
import Chat from './components/chat/Chat.vue'
//game
import GamePad from './components/game/GamePad.vue'
//multimedia
import Multimedia from './components/multimedia/Multimedia.vue'
//user
import Users from './components/users/Users.vue'

window.Vue = Vue
window.Vuetify = Vuetify

const PRIMARY_COLOR_KEY = 'primary_color_key'
const SECONDARY_COLOR_KEY = 'secondary_color_key'

const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#4C63B6'
const secondaryColor = window.localStorage.getItem(SECONDARY_COLOR_KEY) || '#2CB1BC'

if (!window.localStorage.getItem(PRIMARY_COLOR_KEY)) window.localStorage.setItem(PRIMARY_COLOR_KEY, primaryColor)
if (!window.localStorage.getItem(SECONDARY_COLOR_KEY)) window.localStorage.setItem(SECONDARY_COLOR_KEY, secondaryColor)

window.Vue.use(VueTimeago, {
  locale: 'ca', // Default locale
  locales: {
    'ca': require('date-fns/locale/ca')
  }
})

window.Vue.use(window.Vuetify, {
  theme: {
    //Palette 10
    primary: {
      base: primaryColor,
      lighten1: '#647ACB',
      lighten2: '#7B93DB',
      lighten3: '#98AEEB',
      lighten4: '#BED0F7',
      lighten5: '#E0E8F9',
      darken1: '#4C63B6',
      darken2: '#4055A8',
      darken3: '#35469C',
      darken4: '#2D3A8C'
    },
    secondary: {
      base: '#2CB1BC',
      lighten1: '#38BEC9',
      lighten2: '#54D1DB',
      lighten3: '#87EAF2',
      lighten4: '#BEF8FD',
      lighten5: '#E0FCFF',
      darken1: '#14919B',
      darken2: '#0E7C86',
      darken3: '#0A6C74',
      darken4: '#044E54'
    },
    accent: {
      base: '#F0B429',
      lighten1: '#F7C948',
      lighten2: '#FADB5F',
      lighten3: '#FCE588',
      lighten4: '#FFF3C4',
      lighten5: '#FFFBEA',
      darken1: '#DE911D',
      darken2: '#CB6E17',
      darken3: '#B44D12',
      darken4: '#8D2B0B'
    },
    error: {
      base: '#E12D39',
      lighten1: '#EF4E4E',
      lighten2: '#F86A6A',
      lighten3: '#FF9B9B',
      lighten4: '#FFBDBD',
      lighten5: '#FFE3E3',
      darken1: '#CF1124',
      darken2: '#AB091E',
      darken3: '#8A041A',
      darken4: '#610316'
    },
    // Taken from palete 3
    success: {
      base: '#27AB83',
      lighten1: '#3EBD93',
      lighten2: '#65D6AD',
      lighten3: '#8EEDC7',
      lighten4: '#C6F7E2',
      lighten5: '#EFFCF6',
      darken1: '#199473',
      darken2: '#147D64',
      darken3: '#0C6B58',
      darken4: '#014D40'
    },
    grey: {
      base: '#1F2933',
      lighten1: '#7B8794',
      lighten2: '#9AA5B1',
      lighten3: '#CBD2D9',
      lighten4: '#E4E7EB',
      lighten5: '#F5F7FA',
      darken1: '#323F4B',
      darken2: '#3E4C59',
      darken3: '#52606D',
      darken4: '#616E7C'
    },
    info: {
      base: '#2BB0ED',
      lighten1: '#40C3F7',
      lighten2: '#5ED0FA',
      lighten3: '#81DEFD',
      lighten4: '#B3ECFF',
      lighten5: '#E3F8FF',
      darken1: '#1992D4',
      darken2: '#127FBF',
      darken3: '#0B69A3',
      darken4: '#035388'
    },
    warning: {
      base: '#F0B429',
      lighten1: '#F7C948',
      lighten2: '#FADB5F',
      lighten3: '#FCE588',
      lighten4: '#FFF3C4',
      lighten5: '#FFFBEA',
      darken1: '#DE911D',
      darken2: '#CB6E17',
      darken3: '#B44D12',
      darken4: '#8D2B0B'
    }
  }
})


window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)
window.Vue.use(TreeView)
//progressbar
const progress_options = {
  color: '#1992d4',
  failedColor: '#CF1124',
  thickness: '5pt',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}
Vue.use(VueProgressBar, progress_options)

window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('editable-text', EditableText)
window.Vue.component('tasques', Tasques)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)
window.Vue.component('tags', Tags)
window.Vue.component('impersonate', Impersonate)
window.Vue.component('about', About)
window.Vue.component('contact', Contact)
window.Vue.component('git-info', GitInfoComponent)
window.Vue.component('user-profile', UserProfile)
window.Vue.component('user-settings', UserSettings)
window.Vue.component('changelog', Changelog)
window.Vue.component('service-worker', ServiceWorker)

//Navigation
window.Vue.component('navigation', Navigation)
//Navigation Right
window.Vue.component('navigation-right', NavigationRight)
// Notifications
window.Vue.component('notifications', Notifications)
window.Vue.component('notifications-widget', NotificationsWidget)
//Share Fab
window.Vue.component('share-fab', ShareFab)
//empty state
window.Vue.component('empty-state', EmptyState)
//footer
window.Vue.component('footer-app', FooterApp)
//carrusel captures
window.Vue.component('carrusel', Carrusel)
//devices section
window.Vue.component('the-device-features', TheDeviceFeatures)
// task link tasca
window.Vue.component('task-card', TaskCard);
//parallax webp
window.Vue.component('v-parallax-webp', VParallaxWebp)
// clock
window.Vue.component('clock', Clock)
//newsletters
window.Vue.component('newsletter-subscription-card', NewsLetterSubscriptionCard)
window.Vue.component('newsletters', Newsletters)
//chat
window.Vue.component('chat', Chat)
//game
window.Vue.component('game-pad', GamePad)
//multimedia
window.Vue.component('multimedia', Multimedia)
//users
window.Vue.component('users', Users)

// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)

Vue.config.productionTip = false

if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/service-worker.js');
}