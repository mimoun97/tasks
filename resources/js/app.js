import Vue from 'vue'
import Vuetify from 'vuetify'

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

import snackbar from './plugins/snackbar'
import permissions from './plugins/permissions'
import GitInfoComponent from './components/git/GitInfoComponent'

window.Vue = Vue
window.Vue.use(Vuetify)
window.Vue.use(permissions)
window.Vue.use(snackbar)

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


// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)

Vue.config.productionTip = false
