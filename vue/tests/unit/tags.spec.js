/* eslint-disable no-unused-expressions */
import { expect } from 'chai'
import { shallowMount, mount, Wrapper, createLocalVue } from '@vue/test-utils'
import Tags from '../../../resources/js/components/Tasks'
import moxios from 'moxios'
import TestHelpers from './helpers.js'
import Vuetify from 'vuetify'
import Vue from 'vue'

// create an extended `Vue` constructor
const localVue = createLocalVue()

// install plugins as normal
localVue.use(Vuetify)
//Vue.use(Vuetify)
localVue.config.silent = true

describe('Tags.vue', () => {
  beforeEach(() => {
    // Assign test helpers methods to wrapper
    Object.assign(Wrapper.prototype, TestHelpers)
    moxios.install(global.axios)
  })

  afterEach(function () {
    moxios.uninstall(global.axios)
  })

  // Checks component's initial state
  it.only('check_default_state', () => {
    const wrapper = mount(Tags)
    expect(wrapper.vm.$data.newTask).equals('')
    expect(wrapper.vm.$data.filter).equals('all')
    expect(wrapper.vm.$data.dataTags).to.have.lengthOf(0)
    expect(wrapper.props().tasks).to.have.lengthOf(0)
  })
})
