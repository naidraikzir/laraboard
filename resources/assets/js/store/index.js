import Vue from 'vue';
import Vuex from 'vuex';
import actions from './actions';
import mutations from './mutations';
import getters from './getters';

Vue.use(Vuex);

const state = {
  example: false,
};

export default new Vuex.Store({
  state,
  actions,
  mutations,
  getters,
});
