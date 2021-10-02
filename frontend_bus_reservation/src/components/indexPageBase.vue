<template>
    <router-view></router-view>
</template>
<script>
import Vue from 'vue'
// import router from '../router'

export default {

    // Authentication Guard which ensure only verifed customer can login
    beforeRouteEnter (to, from , next) {
          let email_verified = null
          let data_user_id = ''
          Vue.axios.get('user')
          .then ( (response) => {
            if (typeof(response.data.user) != 'undefined')
            {
              email_verified = response.data.user.email_verified
              data_user_id = response.data.user.id
            }
            if ( email_verified == 1)
            {
              next()
            }
            else if ( email_verified == 0 )
            {
              next({name: 'resendEmailVerification', params: {user_id: data_user_id}})
            }
          })
    }

}
</script>