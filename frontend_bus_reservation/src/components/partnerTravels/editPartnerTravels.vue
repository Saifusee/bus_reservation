<template>
    <v-card flat>
    <v-alert
      border="top"
      color="green lighten-2"
      dark
    >
      <span style="text-align: center;"><h3>EDIT DETAILS <small>(Partner Travels)</small></h3></span>
    </v-alert>
      <v-progress-linear
        :active=loading
        indeterminate
        height="10"
        color="#0000cc"
      ></v-progress-linear>
    <v-form
      ref="form"
      @submit.prevent="submit"
    >
      <v-container fluid>
        <v-row>
          <v-col
            cols="12"
          >
            <v-text-field
              clearable
              v-model="form.partner_travel_name"
              :rules="rules.name"
              color="purple darken-2"
              label="Travel Partner Agency Name"
              counter="50"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.partner_travel_name">
              {{submitErrors.partner_travel_name[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
          >
            <v-text-field
              clearable
              v-model="form.address"
              :rules="rules.name"
              color="purple darken-2"
              label="Address of Travel Partner Agency"
              counter="255"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.address">
              {{submitErrors.address[0]}}
            </v-alert>
          </v-col>
            <v-container fluid>
                <v-textarea
                clearable
                 v-model="form.description"
                clear-icon="mdi-close-circle"
                label="Description of Travel Agency"
                counter="1000"
                ></v-textarea>
                <v-alert dense text outlined dismissible type="error" v-if="submitErrors.description">
                  {{submitErrors.description[0]}}
                </v-alert>
            </v-container>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.email_1"
              :rules="[rules.name[0], rules.email[0]]"
              color="blue darken-2"
              label="E-mail Address - 1"
              counter
              maxlength="50"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.email_1">
              {{submitErrors.email_1[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.email_2"
              :rules="rules.email"
              color="blue darken-2"
              label="E-Mail Address - 2"
              counter
              maxlength="50"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.email_2">
              {{submitErrors.email_2[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_1"
              :rules="rules.name"
              color="blue darken-2"
              label="Contact Number - 1"
              counter
              maxlength="35"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.contact_1">
              {{submitErrors.contact_1[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_2"
              :rules="rules.name"
              color="blue darken-2"
              label="Contact Number - 2"
              counter
              maxlength="35"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.contact_2">
              {{submitErrors.contact_2[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_3"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 3 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_4"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 4 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_5"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 5 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_6"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 6 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_7"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 7 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_8"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 8 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_9"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 9 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.contact_10"
              color="teal"
              counter
              maxlength="35"
            >              
                <template v-slot:label>
                    <div>
                        Contact Number - 10 <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn
          :disabled="!formIsValid"
          text
          color="primary"
          type="submit"
        >
          UPDATE
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn
          text
          @click="resetForm"
        >
          CANCEL
        </v-btn>
      </v-card-actions>
      <v-progress-linear
        :active=loading
        indeterminate
        height="10"
        color="#0000cc"
      ></v-progress-linear>
    </v-form>

  </v-card>
</template>

<script>
  export default {

    created () {
        this.axios.get(`partner-travels/${this.id}`)
        .then( resp => {
            this.form = resp.data
        })
    },

    data () {
      const defaultForm = Object.freeze({
        partner_travel_name: '',
        address: '',
        description: '',
        email_1: '',
        email_2: '',
        contact_1: '',
        contact_2: '',
        contact_3: '',
        contact_4: '',
        contact_5: '',
        contact_6: '',
        contact_7: '',
        contact_8: '',
        contact_9: '',
        contact_10: '',
      })

      return {
        form: Object.assign({}, defaultForm),
        rules: {
          name: [val => !!val || 'This field is required'],
          email: [val => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(val) || 'Invalid E-mail format',],
        },
        defaultForm,
        submitErrors: "",
        loading: false,
        id: this.$route.params.partner_travels_id
      }
    },

    computed: {
      formIsValid () {
        return (
          this.form.partner_travel_name &&
          this.form.address &&
          this.form.email_1 &&
          this.form.email_2 &&
          this.form.contact_1 &&
          this.form.contact_2 
        )
      },
    },

    methods: {
      resetForm () {
        this.form = Object.assign({}, this.defaultForm)
        this.$refs.form.reset()
      },
      submit () {
        this.loading = true;
        Object.assign(this.form, {
          user_id: 1,
          email_1: this.form.email_1.toLowerCase(),
          email_2: this.form.email_2.toLowerCase()
        });
          this.axios.put(`partner-travels/${this.id}`, this.form)
          .then(() => {
            this.resetForm();
            this.$router.replace({name: 'allPartnerTravels'});
          })
          .catch(error => {
            this.submitErrors = error.response.data.errors;
            this.loading = false;
            setTimeout(() => this.submitErrors = "", 30000);
          })
      },
    },
  }
</script>