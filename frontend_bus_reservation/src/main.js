import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import mixin from './plugins/mixin'




/////////////////////////////////////////////////////////////////
//////       Vue-Axios          /////////////////////////////////
/////////////////////////////////////////////////////////////////
Vue.use(VueAxios, axios)
{
    //Axios default baseURL
    axios.defaults.baseURL = `${process.env.VUE_APP_BACKEND_DOMAIN_URL}api/`;

//Adding Axios request interceptor which is function call before each and every request of any axios so you can modify request the way you wants.
  Vue.axios.interceptors.request.use( 
    config => 
    {
        //Axios default headers which send with each and every request.
        config.headers['Content-Type'] = 'application/json';
        config.headers['Accept'] = 'application/json'

        //Getting JWT token which after login stored in local storage of browser.
        // let token = window.localStorage.getItem('token')
        let token = window.localStorage.getItem('token')

        if (typeof(token) !== "object" || typeof(token) !== "undefined") //typeof returns "object" for null value
        {
          config.headers['Authorization'] = `Bearer ${token}`
        }
        else
        {
          router.replace({name: 'loginPage'})
        }
        //Must necessary to return the config else the requests not going to execute further.
      return config;
    })

//Adding Axios response interceptor which is function call before each and every response of any axios so you can modify response the way you wants.
  axios.interceptors.response.use( 
    response => 
    { 
      if (response.data.status == "Token is Invalid" || response.data.status == "Token is Expired")
      {
        window.localStorage.removeItem('token')
        window.localStorage.removeItem('c')
        router.replace({name: 'loginPage'})
      }
      return response;
    },
    error =>
    {
      if(error.response.data.message == 'Unauthorized.' || error.response.data.message == 'Unauthenticated.')
      {
        window.localStorage.removeItem('token')
        window.localStorage.removeItem('c')
        router.replace({name: 'loginPage'})
      }
      throw error;
    }
  )
}


///////////////////////////////////////////////////////////////////////
//////       eventBus VUE INSTANCE         ////////////////////////////
///////////////////////////////////////////////////////////////////////
export const eventBus = new Vue();


///////////////////////////////////////////////////////////////////////
//////       MAIN VUE INSTANCE         ////////////////////////////////
///////////////////////////////////////////////////////////////////////
Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  store,
  mixin,
  render: h => h(App)
}).$mount('#app')
