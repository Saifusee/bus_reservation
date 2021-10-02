import Vue from 'vue'
import store from './../store'

export default Vue.mixin({
    data () {
      return {
        loggedInUserIdGlobalMixin: window.localStorage.getItem('c')
      }
    },

    methods: {

      resetDeleteModalGlobalMixin (displayValue, titleValue, dataValue, sourceValue)
      {
        store.dispatch('actionDeleteModalDisplay', displayValue)
        store.dispatch('actionDeleteModalTitle', titleValue)
        store.dispatch('actionDeleteModalData', dataValue)
        store.dispatch('actionDeleteModalSource', sourceValue)
      },
    },
  });

