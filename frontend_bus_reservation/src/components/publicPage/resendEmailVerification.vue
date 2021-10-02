<template>
         <main>
       <v-container fluid fill-height >
          <v-layout flex align-center justify-center>
            <v-flex xs16 sm8 elevation-6>
              <v-toolbar class="pt-5 blue darken-4">
                <marquee direction="left"><h3 class="white--text">{{heading}}</h3></marquee>
              </v-toolbar>
                <v-alert
                color="purple lighten-1"
                dark
                >
                <span style="text-align: center;"><h3>E-MAIL NOT VERIFIED</h3></span>
                </v-alert>
              <v-card>
                  <v-progress-linear
                  :active="loading"
                  indeterminate
                  height="10"
                  color="#0000cc"
                  ></v-progress-linear>
                <v-card-text class="pt-4">
                  <div>
                      <h3>Registered User with this E-Mail = <strong>{{ user_name}}</strong></h3><hr>
                      <h3>Registered E-Mail = <strong>{{user_email}}</strong></h3><hr>
                      <h3>Cannot process further without verified E-Mail..</h3><hr><br>
                      <h2 v-if="mssgBool">{{mssgTxt}}</h2>
                      <br>
                      <v-btn @click="resendEmail" :class=" 'indigo darken-1 white--text'">Resend E-Mail</v-btn>
                      <v-btn @click="moveToLoginPage" :class=" 'red darken-2 white--text'">GO TO LOGIN PAGE</v-btn>
                  </div>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
       </v-container>

     </main>
</template>
<script>
export default {
        created() 
        {
            this.axios.get(`users/${this.user_id}`)
            .then( (response) => {
            this.user_name = response.data.name
            this.user_email = response.data.email
            })

        },

        data () {
          return {
            heading: process.env.VUE_APP_SITE_HEADING,
            frontendUrl: process.env.VUE_APP_FRONTEND_DOMAIN_URL,
            loading: false,
            mssgBool: false,
            mssgTxt: '',
            user_id: this.$route.params.user_id,
            user_name: '',
            user_email: '',
        }
    },

    methods: {
        moveToLoginPage () {
            this.$router.replace({name: 'loginPage'})
        },

        resendEmail () {
          this.loading = true
          this.mssgBool = false
          this.axios.get(`${this.user_id}/user/resend-email`)
          .then ( () => {
              this.loading = false
              this.mssgTxt = "E-MAIL SENT SUCCESSFULLY"
              this.mssgBool = true
          })
          .catch ( () => {
              this.loading = false
              this.mssgTxt = "REQUEST FAILED, SOMETHING WENT WRONG"
              this.mssgBool = true
          })
        }
    }
}
</script>