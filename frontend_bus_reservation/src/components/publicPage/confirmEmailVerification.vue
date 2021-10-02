<template>
         <main>
       <v-container fluid fill-height >
          <v-layout flex align-center justify-center>
            <v-flex xs16 sm8 elevation-6>
              <v-toolbar class="pt-5 blue darken-4">
                <marquee direction="left"><h3 class="white--text">{{heading}}</h3></marquee>
              </v-toolbar>
                <v-alert
                :color="alertColorValue"
                dark
                >
                <span style="text-align: center;"><h3>{{alertTextValue}}</h3></span>
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
                      <h2 v-if="mssgBool">{{mssgTxt}}</h2><hr><br>
                      <v-btn @click="moveToRegistrationPage" :class=" 'indigo darken-1 white--text'">GO TO REGISTRATION PAGE</v-btn>
                      <v-btn @click="moveToLoginPage" :class=" 'red darken-2 white--text'">GO TO LOGIN PAGE</v-btn>
                      <v-btn v-if="wentWrong" @click="resendEmail" :class=" 'indigo darken-1 white--text'">Resend E-Mail</v-btn>
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

        created () {
            this.axios.get(`${this.id}/user/${this.token}`)
            .then ( () => {
                this.alertColorValue = 'green lighten-1'
                this.alertTextValue = 'E-MAIL VERIFICATION SUCCESSFUL'
            })
            .catch( () => {
                this.alertColorValue = 'red lighten-1'
                this.alertTextValue = 'E-MAIL VERIFICATION FAILED'  
                this.wentWrong = true          
            })
        },

        data () {
          return {
            heading: process.env.VUE_APP_SITE_HEADING,
            frontendUrl: process.env.VUE_APP_FRONTEND_DOMAIN_URL,
            id: this.$route.params.id,
            token: this.$route.params.token,
            alertColorValue: 'purple lighten-1',
            alertTextValue: "E-Mail VERIFICATION IN PROGRESS",
            wentWrong: false,
            loading: false,
            mssgBool: false,
            mssgTxt: '',
        }
    },

    methods: {
        moveToLoginPage () {
            this.$router.replace({name: 'loginPage'})
        },
        moveToRegistrationPage () {
            this.$router.replace({name: 'registrationPage'})
        },
        resendEmail () {
          this.loading = true
          this.mssgBool = false
          let id = window.location.getItem('c') //Getting User Id
          this.axios.get(`${id}/user/resend-email`)
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