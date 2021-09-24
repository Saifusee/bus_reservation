import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import {ClientTable} from 'vue-tables-2';
import {BootstrapVue} from 'bootstrap-vue'



/////////////////////////////////////////////////////////////////
//////       Vue-Tables-2          /////////////////////////////////
/////////////////////////////////////////////////////////////////
Vue.use(ClientTable, {}, false, 'bootstrap4')
Vue.use(BootstrapVue)


/////////////////////////////////////////////////////////////////
//////       Vue-Axios          /////////////////////////////////
/////////////////////////////////////////////////////////////////
Vue.use(VueAxios, axios)
{
    //Axios default baseURL
    axios.defaults.baseURL = `${process.env.VUE_APP_BACKEND_DOMAIN_URL}api/`;

//Adding Axios request interceptor which is function call before each and every request of any axios so you can modify request the way you wants.
  // axios.interceptors.request.use( 
  //   config => 
  //   {
  //       //Axios default headers which send with each and every request.
  //       config.headers['Content-Type'] = 'application/json';
  //       config.headers['Accept'] = 'application/json'

  //       //Getting JWT token which after login stored in local storage of browser.
  //       let token = window.localStorage.getItem("token");
  //       if(typeof token !== undefined)
  //       {
  //         config.headers['Authorization'] = `Bearer ${token}`;
  //       }
  //       //Must necessary to return the config else the requests not going to execute further.
  //     return config;
  //   })

//Adding Axios response interceptor which is function call before each and every response of any axios so you can modify response the way you wants.
  // axios.interceptors.response.use( 
  //   response => response,
  //   error =>
  //   {
  //     if(error.response.data.message == 'Unauthorized.' || error.response.data.message == 'Unauthenticated.' || typeof(error.response.data.message) === 'undefined')
  //     {
  //       window.localStorage.removeItem('token');
  //       router.push('/login');
  //     }
  //     throw error;
  //   }
  // )
}

///////////////////////////////////////////////////////////////////////
//////       MAIN VUE INSTANCE         ////////////////////////////////
///////////////////////////////////////////////////////////////////////
Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')
