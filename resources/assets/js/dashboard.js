'use strict'

import 'sass/app'

import Vue from 'vue'
import axios from 'js/axios-instance'
import router from 'js/router'
import Dashboard from 'vue/Dashboard'

Vue.prototype.http = axios

new Vue({
  router,
  render:  h => h(Dashboard)
}).$mount('#dashboard')
