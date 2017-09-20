import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const Index = () => import(/* webpackChunkName: 'dashboard' */ 'vue/pages/Index')
const PageA = () => import(/* webpackChunkName: 'page-a' */ 'vue/pages/PageA')

export default new VueRouter({
  linkActiveClass: 'active',
  mode: 'history',
  routes: [
    { path: '/dashboard', name: 'Dashboard', component: Index },
    { path: '/dashboard/page-a', name: 'Page A', component: PageA },
  ]
})
