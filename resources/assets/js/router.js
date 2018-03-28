import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const Index = () => import(/* webpackChunkName: 'dashboard-index' */ 'vue/pages/Index');
const Components = () => import(/* webpackChunkName: 'components' */ 'vue/pages/Components');
const NotFound = () => import(/* webpackChunkName: 'page-a' */ 'vue/pages/404');

export default new VueRouter({
  linkActiveClass: 'active',
  mode: 'history',
  base: '/dashboard/',
  routes: [
    { path: '', name: 'Laraboard', component: Index },
    { path: '/components', name: 'Components', component: Components },
    { path: '/404', name: 'Not Found', component: NotFound },
    { path: '/*', redirect: { name: 'Not Found' } },
  ],
});
