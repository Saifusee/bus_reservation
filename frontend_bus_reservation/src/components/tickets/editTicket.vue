<template>
    <v-card flat>
    <v-alert
      border="top"
      color="green lighten-2"
      dark
    >
      <span style="text-align: center;"><h3>EDIT DETAILS <small>(Pickup Point)</small></h3></span>
    </v-alert>
    <v-alert
      color="red lighten-2"
      dark
    >
      <h4 style="text-align: center;">RC = {{rc}}</h4>
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
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.from_location"
              :rules="rules.name"
              color="blue darken-2"
              label="FROM: "
              counter
              maxlength="30"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.from_location">
              {{submitErrors.from_location[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.to_location"
              :rules="rules.name"
              color="blue darken-2"
              label="TO: "
              counter
              maxlength="30"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.to_location">
              {{submitErrors.to_location[0]}}
            </v-alert>
        </v-col>
        <v-col
            cols="12"
            lg="6"
        >
            <v-menu
            ref="menu1"
            v-model="menu1"
            :close-on-content-click="false"
            transition="scale-transition"
            offset-y
            max-width="290px"
            min-width="auto"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="departure_dateFormatted"
                label="Departure Date"
                hint="DD/MM/YYYY"
                persistent-hint
                prepend-icon="mdi-calendar"
                v-bind="attrs"
                @blur="date = parseDate(departure_dateFormatted)"
                v-on="on"
                :rules="rules.name"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="departure_date"
                no-title
                @input="menu1 = false"
                :min="new Date().toISOString().slice(0, 10)"
            ></v-date-picker>
            </v-menu>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.departure_date">
              {{submitErrors.departure_date[0]}}
            </v-alert>
        </v-col> 
        <v-col
            cols="6"
            sm="3"
        >
            <v-dialog
            ref="dialog1"
            v-model="modal1"
            :return-value.sync="reporting_time"
            persistent
            width="290px"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="reportingTimeToShow"
                label="Reporting Time: "
                prepend-icon="mdi-clock-time-four-outline"
                readonly
                ampm-in-title
                v-bind="attrs"
                v-on="on"
                :rules="rules.name"
                ></v-text-field>
            </template>
            <v-time-picker
                v-if="modal1"
                v-model="reporting_time"
                full-width
            >
                <v-spacer></v-spacer>
                <v-btn
                text
                color="primary"
                @click="modal1 = false"
                >
                Cancel
                </v-btn>
                <v-btn
                text
                color="primary"
                @click="$refs.dialog1.save(reporting_time)"
                >
                OK
                </v-btn>
            </v-time-picker>
            </v-dialog>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.reporting_time">
              {{submitErrors.reporting_time[0]}}
            </v-alert>
        </v-col> 
        <v-col
            cols="6"
            sm="3"
        >
            <v-dialog
            ref="dialog2"
            v-model="modal2"
            :return-value.sync="departure_time"
            persistent
            width="290px"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="departureTimeToShow"
                label="Departure Time: "
                prepend-icon="mdi-clock-time-four-outline"
                readonly
                ampm-in-title
                v-bind="attrs"
                v-on="on"
                :rules="rules.name"
                ></v-text-field>
            </template>
            <v-time-picker
                v-if="modal2"
                v-model="departure_time"
                full-width
            >
                <v-spacer></v-spacer>
                <v-btn
                text
                color="primary"
                @click="modal2 = false"
                >
                Cancel
                </v-btn>
                <v-btn
                text
                color="primary"
                @click="$refs.dialog2.save(departure_time)"
                >
                OK
                </v-btn>
            </v-time-picker>
            </v-dialog>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.departure_time">
              {{submitErrors.departure_time[0]}}
            </v-alert>
        </v-col> 
        <v-col
          cols="12"
        >
          <v-select
            v-model="selectPartnerTravelValue"
            :items="partner_travel"
            item-text="partner_travel_name"
            item-value="id"
            :menu-props="{ maxHeight: '400' }"
            label="Select Partner Travels Agency: "
            hint="Select Travel Agency offering vehicle."
            persistent-hint
            :rules="rules.name"
          ></v-select>
          <v-alert dense text outlined dismissible type="error" v-if="submitErrors.partner_travel_id">
            {{submitErrors.partner_travel_id[0]}}
          </v-alert>
        </v-col>      
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.passenger_name"
              :rules="rules.name"
              color="blue darken-2"
              label="Passenger Name:  "
              counter
              maxlength="255"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.passenger_name">
              {{submitErrors.passenger_name[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.passenger_contact_1"
              :rules="rules.intv"
              color="blue darken-2"
              label="Passenger's Contact - 1:  "
              counter
              maxlength="16"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.passenger_contact_1">
              {{submitErrors.passenger_contact_1[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.passenger_contact_2"
              color="teal"
              counter
              maxlength="16"
            >              
                <template v-slot:label>
                    <div>
                       Passenger's Contact - 2: <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.passenger_contact_2">
              {{submitErrors.passenger_contact_2[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.email"
              :rules="rules.email"
              color="teal"
              counter
              maxlength="255"
            >              
                <template v-slot:label>
                    <div>
                       Passenger's Email: <small>(optional)</small>
                    </div>
                </template>
            </v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.email">
              {{submitErrors.passenger_email[0]}}
            </v-alert>
          </v-col>

          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.sleeper_no"
              color="blue darken-2"
              label="Sleeper No."
              counter
              maxlength="255"
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.sleeper_no">
              {{submitErrors.sleeper_no[0]}}
            </v-alert>
          </v-col>

          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.seat_no"
              color="blue darken-2"
              label="Seat No."
              counter
              maxlength="255"
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.seat_no">
              {{submitErrors.seat_no[0]}}
            </v-alert>
          </v-col>

          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.bus_no"
              :rules="rules.intv"
              color="blue darken-2"
              label="Bus No"
              counter
              maxlength="4"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.bus_no">
              {{submitErrors.bus_no[0]}}
            </v-alert>
          </v-col>

          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.total_seats"
              :rules="rules.intv"
              color="blue darken-2"
              label="Total Seats:  "
              counter
              maxlength="3"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.total_seats">
              {{submitErrors.total_seats[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.amount"
              :rules="rules.intv"
              color="blue darken-2"
              label="Total Amount:  "
              counter
              maxlength="5"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.amount">
              {{submitErrors.amount[0]}}
            </v-alert>
          </v-col>
          <v-col
            cols="12"
            sm="6"
          >
            <v-text-field
              clearable
              v-model="form.advance"
              :rules="rules.intv"
              color="blue darken-2"
              label="Advance Recieved:  "
              counter
              maxlength="5"
              required
            ></v-text-field>
            <v-alert dense text outlined dismissible type="error" v-if="submitErrors.advance">
              {{submitErrors.advance[0]}}
            </v-alert>
          </v-col>
        <v-col
          cols="12"
        >
          <v-select
            v-model="selectPickupPointValue"
            :items="pickup_point_address"
            item-text="pickup_point_address"
            item-value="id"
            :menu-props="{ maxHeight: '400' }"
            label="Select Pickup Point of Vehicle: "
            hint="Select location where Customer had to reach to board on Vehicle."
            persistent-hint
            :rules="rules.name"
          ></v-select>
          <v-alert dense text outlined dismissible type="error" v-if="submitErrors.pickup_point_id">
            {{submitErrors.pickup_point_id[0]}}
          </v-alert>
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
          UPDATE TICKET
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
    mounted() {
      this.axios.get(`${1}/partner-travels`)
      .then(response => {
        let agencies_array = [];
        for(let i=0; i<response.data.length; i++)
        {
          let object = {id: response.data[i].id, partner_travel_name: response.data[i].partner_travel_name};
          agencies_array.push(object);
        }
        this.partner_travel = agencies_array;
      })

      this.axios.get(`${1}/pickup-points`)
      .then(response => {
        let pickup_point_array = [];
        for(let i=0; i<response.data.length; i++)
        {
          let object = {id: response.data[i].id, pickup_point_address: response.data[i].pickup_point_address};
          pickup_point_array.push(object);
        }
        this.pickup_point_address = pickup_point_array;
      })
    },

    created () {
        this.axios.get(`tickets/${this.id}`)
        .then( resp => {
            this.form = resp.data
            this.rc = resp.data.rc
            this.selectPickupPointValue = resp.data.pickup_point_id
            this.selectPartnerTravelValue = resp.data.partner_travel_id
            this.reporting_time = resp.data.reporting_time
            this.departure_time = resp.data.departure_time
            this.departure_date = resp.data.departure_date
        })
    },

    data (vm) {
        
      const defaultForm = Object.freeze({
        from_location: '',
        to_location: '',
        passenger_name: '',
        passenger_contact_1: '',
        passenger_contact_2: '',
        email: '',
        sleeper_no: '',
        seat_no: '',
        bus_no: '',
        total_seats: '',
        advance: '',
        amount: '',
      })

      return {
        form: Object.assign({}, defaultForm),
        rules: {
          name: [val => !!val || 'This field is required'],
          intv: [
            val => !!val || 'This field is required',
            val => /^\+?(0|[1-9]\d*)$/.test(val) || 'Invalid Input',
          ],
        },
        defaultForm,
        submitErrors: "",
        loading: false,
        departure_date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
        departure_dateFormatted: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
        menu1: false,
        reporting_time: null,
        reportingTimeToShow: null,
        departure_time: null,
        departureTimeToShow: null,
        modal1: false,
        modal2: false,
        selectPartnerTravelValue: '',
        partner_travel: [],
        selectPickupPointValue: '',
        pickup_point_address: [],
        rc: '',
        id: this.$route.params.ticket_id,
      }
    },

    computed: {
      formIsValid () {
        return ( 
          this.form.from_location &&
          this.form.to_location &&
          this.form.passenger_name &&
          this.form.passenger_contact_1 &&
          this.form.bus_no &&
          this.form.total_seats &&
          this.reporting_time &&
          this.departure_time &&
          this.departure_date &&
          this.form.total_seats &&
          this.selectPartnerTravelValue &&
          this.selectPickupPointValue &&
          this.form.advance &&
          this.form.amount &&
          (this.form.sleeper_no || this.form.seat_no)
        )
      },
    },

    watch: {
      departure_date () {
        this.departure_dateFormatted = this.formatDate(this.departure_date)
      },
      reporting_time (val) {
        let hours = val.slice(0,2);
        let minutes = val.slice(3);
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours >= 12 ? `0${hours-12}` : hours;
        this.reportingTimeToShow = `${hours}:${minutes} ${ampm}`;
      },
      departure_time (val) {
        let hours = val.slice(0,2);
        let minutes = val.slice(3);
        let ampm = hours >= 12 ? 'P.M.' : 'A.M.';
        hours = hours >= 12 ? `0${hours-12}` : hours;
        this.departureTimeToShow = `${hours}:${minutes} ${ampm}`;
      },
    },

    methods: {

      resetForm () {
        this.form = Object.assign({}, this.defaultForm)
        this.$refs.form.reset()
      },
      submit () {
        this.loading = true;

        let today_date = new Date().toJSON().slice(0,10);
        Object.assign(this.form, {
          user_id: 1,
          from_location: this.form.from_location.toUpperCase(),
          to_location: this.form.to_location.toUpperCase(),
          passenger_name: this.form.passenger_name.toUpperCase(),
          sleeper_no: this.form.sleeper_no.toUpperCase(),
          seat_no: this.form.seat_no.toUpperCase(),
          partner_travel_id: this.selectPartnerTravelValue,
          pickup_point_id: this.selectPickupPointValue,
          email: this.form.email.toLowerCase(),
          booking_date: today_date,
          departure_date: this.departure_date,
          reporting_time: this.reporting_time,
          departure_time: this.departure_time,
        });
          this.axios.post('tickets', this.form)
          .then(() => {
            this.resetForm();
            this.$router.replace({name: 'allTicket'});
          })
          .catch(error => {
            this.submitErrors = error.response.data.errors;
            this.loading = false;
            setTimeout(() => this.submitErrors = "", 30000);
            this.resetForm();
          })
      },
      formatDate (date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${day}/${month}/${year}`
      },
      parseDate (date) {
        if (!date) return null

        const [day, month, year] = date.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },
    },
  }
</script>