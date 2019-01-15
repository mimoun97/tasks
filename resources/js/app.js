import Vue from 'vue'
import Vuetify from 'vuetify'
import TreeView from 'vue-json-tree-view'

import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

import './bootstrap'

import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'
import EditableText from './components/EditableText.vue'
import Tasques from './components/Tasques.vue'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import UserList from './components/UserList.vue'
import UserSelect from './components/UserSelect.vue'
import Tags from './components/Tags.vue'
import Impersonate from './components/Impersonate.vue'
import About from './components/About.vue'
import Contact from './components/Contact.vue'
import TaskList from './components/TaskList.vue'
import TaskCompletedToggle from './components/TaskCompletedToggle.vue'
import UserProfile from './components/UserProfile.vue'

import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'
import permissions from './plugins/permissions'
import GitInfoComponent from './components/git/GitInfoComponent'
import UserSettings from './components/UserSettings'
import Changelog from './components/changelog/ChangelogComponent.vue'

window.Vue = Vue
window.Vuetify = Vuetify

const PRIMARY_COLOR_KEY = 'primary_color_key'

const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#19216C'

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
      darken1: '#2D3A8C',
      darken2: '#35469C',
      darken3: '#4055A8',
      darken4: '#4C63B6'
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
      base: '#BA2525',
      lighten1: '#D64545',
      lighten2: '#E66A6A',
      lighten3: '#F29B9B',
      lighten4: '#FACDCD',
      lighten5: '#FFEEEE',
      darken1: '#A61B1B',
      darken2: '#911111',
      darken3: '#780A0A',
      darken4: '#610404'
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
      base: '#627D98',
      lighten1: '#829AB1',
      lighten2: '#9FB3C8',
      lighten3: '#BCCCDC',
      lighten4: '#D9E2EC',
      lighten5: '#F0F4F8',
      darken1: '#486581',
      darken2: '#334E68',
      darken3: '#243B53',
      darken4: '#102A43'
    }
  }
})


window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)
window.Vue.use(TreeView)

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
window.Vue.component('task-list', TaskList)
window.Vue.component('git-info', GitInfoComponent)
window.Vue.component('task-completed-toggle', TaskCompletedToggle)
window.Vue.component('user-profile', UserProfile)
window.Vue.component('user-settings', UserSettings)
window.Vue.component('changelog', Changelog)


// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)

Vue.config.productionTip = false
