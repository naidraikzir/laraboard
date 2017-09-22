import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const Index = () => import(/* webpackChunkName: 'dashboard' */ 'vue/pages/Index')
const PageA = () => import(/* webpackChunkName: 'page-a' */ 'vue/pages/PageA')
const NotFound = () => import(/* webpackChunkName: 'page-a' */ 'vue/pages/404')

export default new VueRouter({
  linkActiveClass: 'active',
  mode: 'history',
  routes: [
    { path: '/dashboard', name: 'Dashboard', component: Index },
    { path: '/dashboard/page-a', name: 'Page A', component: PageA },
    { path: '/dashboard/404', name: 'Not Found', component: NotFound },
    { path: '/dashboard/*', redirect: { name: 'Not Found' } }
  ]
})
