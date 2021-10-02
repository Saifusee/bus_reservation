import Vue from 'vue'
import Vuex from 'vuex'
import vuexDeleteModal from './modules/vuexDeleteModal'


Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    vuexDeleteModal,
  }
});
