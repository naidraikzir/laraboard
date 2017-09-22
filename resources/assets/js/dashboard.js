'use strict'

import 'sass/app'

import Vue from 'vue'
import axios from 'js/axios-instance'
import router from 'js/router'
import store from 'js/store'
import Dashboard from 'vue/Dashboard'

Vue.prototype.http = axios

new Vue({
  router,
  store,
  render:  h => h(Dashboard)
}).$mount('#dashboard')
