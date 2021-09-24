<template>
    <v-card flat id="card-container">
    <v-alert
      border="top"
      color="green lighten-2"
      dark
    >
      <span style="text-align: center;"><h3>CREATE PARTNER TRAVELS</h3></span>
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
            <v-container fluid>
                <v-textarea
                clearable
                 v-model="form.pickup_point_address"
                clear-icon="mdi-close-circle"
                label="Enter Pickup Point Address"
                counter="1000"
                ></v-textarea>
                <v-alert dense text outlined dismissible type="error" v-if="submitErrors.pickup_point_address">
                  {{submitErrors.pickup_point_address[0]}}
                </v-alert>
            </v-container>
      </v-container>

      <v-card-actions>
        <v-btn
          :disabled="!formIsValid"
          text
          color="primary"
          type="submit"
        >
          CREATE
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
    data () {
      const defaultForm = Object.freeze({
        pickup_point_address: '',
      })

      return {
        form: Object.assign({}, defaultForm),
        rules: {
          name: [val => !!val || 'This field is required'],
        },
        defaultForm,
        submitErrors: "",
        loading: false,
      }
    },

    computed: {
      formIsValid () {
        return (
          this.form.pickup_point_address
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
          pickup_point_address: this.form.pickup_point_address.toUpperCase(),
        });
          this.axios.post('pickup-points', this.form)
          .then(() => {
            this.resetForm();
            this.$router.replace({name: 'allPartnerTravels'});
          })
          .catch(error => {
            this.submitErrors = error.response.data.errors;
            this.loading = false;
            setTimeout(() => this.submitErrors = "", 30000);
            this.resetForm();
          })
      },
    },
  }
</script>
<style scoped>
#card-container {
  width: 100%;
}
</style>