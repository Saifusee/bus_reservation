<template>
     <main>
       <v-container fluid fill-height >
          <v-layout flex align-center justify-center>
            <v-flex xs16 sm8 elevation-6>
                <v-alert
                border="bottom"
                color="red darken-4"
                dark
                >
                <span style="text-align: center;"><h3>REGISTRATION PAGE</h3></span>
                </v-alert>
              <v-toolbar class="pt-5 blue darken-4">
                <marquee direction="left"><h3 class="white--text">{{heading}}</h3></marquee>
              </v-toolbar>
              <v-card>
                  <v-progress-linear
                  :active="loading"
                  indeterminate
                  height="10"
                  color="#0000cc"
                  ></v-progress-linear>
                <v-card-text class="pt-4">
                  <div>
                      <v-form v-model="valid">
                        <v-alert dense text outlined dismissible type="error" v-if="submitErrors">
                            <ul>
                              <li v-for="submitError in submitErrors" :key="submitError">
                                {{ submitError[0] }}
                              </li>
                            </ul>                        
                        </v-alert>
                        <v-text-field
                          label="Enter your e-mail address"
                          v-model="email"
                          :rules="emailRules"
                          required
                        ></v-text-field>
                        <v-text-field
                          label="Enter your Name"
                          v-model="name"
                          :rules="nameRules"
                          required
                        ></v-text-field>
                        <v-text-field
                          label="Enter your password"
                          v-model="password"
                          min="8"
                          max="32"
                          counter
                          hint="Password must include an Uppercase, Lowercase, Number and Special Symbol like @.,/?<>*\"
                          :append-icon="e1 ? 'mdi-eye' : 'mdi-eye'"
                          @click:append="() => (e1 = !e1)"
                          :type="e1 ? 'password' : 'text'"
                          :rules="passwordRules"
                          required
                        ><v-icon>mdi-eye</v-icon></v-text-field>
                        <v-text-field
                          label="Confirm your password"
                          v-model="password_confirmation"
                          min="8"
                          max="32"
                          counter
                          hint="Password must include an Uppercase, Lowercase, Number and Special Symbol like @.,/?<>*\"
                          :append-icon="e1 ? 'mdi-eye' : 'mdi-eye'"
                          @click:append="() => (e1 = !e1)"
                          :type="e1 ? 'password' : 'text'"
                          :rules="passwordRules"
                          required
                          @keypress.enter="submit"
                        ><v-icon>mdi-eye</v-icon></v-text-field>
                        <v-layout justify-space-between>
                            <v-btn @click="submit" :class=" { 'green darken-1 white--text' : valid}" :disabled="!valid">Create Account</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn @click="moveToLoginPage" :class=" 'yellow darken-2 white--text'">GO TO LOGIN PAGE</v-btn>
                        </v-layout>
                      </v-form>
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
        data () {
          return {
            heading: process.env.VUE_APP_SITE_HEADING,
            frontendUrl: process.env.VUE_APP_FRONTEND_DOMAIN_URL,
            valid: false,
            e1: true,
            loading: false,
            email: '',
            name: '',
            nameRules: [
              (v) => !!v || 'Name field is required',
            ],
            emailRules: [
              (v) => !!v || 'E-mail is required',
              (v) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            password: '',
            password_confirmation: '',
            passwordRules: [
              (v) => !!v || 'Password is required',
              (v) => /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[\W]).{8,32}$/i.test(v) || 'Password must be valid',
              (v) => v == this.password || 'Password doesn\'t match',
            ],
            submitErrors: '',
          }
        },
        methods: {
         async submit () {
            this.loading = true
            let formdata = {
              'name': this.name.toUpperCase(),
              'email': this.email,
              'password': this.password,
              'password_confirmation': this.password_confirmation
            }
            await this.axios.post('register', formdata)
            .then( response => {
              window.localStorage.setItem('token', response.token)
              window.localStorage.setItem('c', response.id)
              this.loading = false
            this.$router.replace({name: 'checkEmailVerification'});
            })
            .catch( error => {
              this.submitErrors = error.response.data.errors
              this.loading = false
            })
          },
        moveToLoginPage () {
            this.$router.replace({name: 'loginPage'})
        }
        },
}
</script>
<style scoped>

.loginOverlay {
  background:rgba(33,150,243,0.3);
}

.photoCredit{
  position: absolute;
  bottom: 15px;
  right: 15px;
}

</style>