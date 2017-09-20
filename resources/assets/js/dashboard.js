'use strict'

import 'sass/app'

import Vue from 'vue'
import Axios from 'axios'
import router from 'js/router'
import Dashboard from 'vue/Dashboard'

Vue.prototype.http = Axios

new Vue({
  router,
  render:  h => h(Dashboard)
}).$mount('#dashboard')
