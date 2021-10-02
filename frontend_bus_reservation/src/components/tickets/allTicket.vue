<template>
  <v-card flat id="card-container">

        <data-tables-headers
          :pageTitle="heading"
          pageSource="allTickets"
        >
        </data-tables-headers>

        <v-data-table
          :headers="headers"
          :items="rows"
          :options.sync="options"
          :loading="loading"
          :page.sync="page"
          :items-per-page="itemsPerPage"
          hide-default-footer
          @page-count="pageCount = $event"
          class="elevation-1"
        >
        
          <template v-slot:[`item.actions`]="{ item }">
            <v-icon
              small
              class="mr-2"
              @click="editItem(item)"
            >
              mdi-pencil
            </v-icon>
            <v-icon
              small
              @click="cancelItem(item)"
            >
              mdi-cancel
            </v-icon>
          </template>
          <template v-slot:[`item.see_details`]="{ item }">
            <v-btn
              small
              color="blue lighten-3"
              @click="deleteItem(item)"
            >
              See Details
            </v-btn>
          </template>
      </v-data-table>
    <div class="text-center pt-2">
      <v-pagination
        v-model="page"
        :length="pageCount"
      ></v-pagination>
    </div>
  </v-card>
</template>
<script>
import { eventBus } from './../../main'
import dataTablesHeaders from '../miscComponent/dataTablesHeaders.vue'

  export default {
    
    components: {
      'dataTablesHeaders': dataTablesHeaders
    },

    mounted() {
      this.initialize();
    },

    created () {
      eventBus.$on('event-cancel-all-tickets', (dataFromEvent) =>
        {
          this.loading = true;
          this.resetDeleteModalGlobalMixin(false, "", "", "") //Global Mixin
          this.axios.get(`tickets/cancel/${dataFromEvent}`)
          .then( () => {
            this.initialize()
          })
        }
      );

      eventBus.$on('allTickets-search', (dataFromEvent) =>
        {
          this.search = dataFromEvent
          this.initialize()
        }
      );


    },

    data () {
      return {
        heading: "ALL TICKETS",
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        search: '',
        totalDataCount: 0,
        options: {},
        loading: false,
        headers: [
          { text: 'RC', align: 'start', value: 'rc' },
          { text: 'Passenger Name', value: 'passenger_name' },
          { text: 'FROM', value: 'from_location' },
          { text: 'TO', value: 'to_location' },
          { text: 'TRAVELS', value: 'partner_travel_name' },            
          { text: 'BOOKING DATE', value: 'booking_date' },
          { text: 'DEPARTURE DATE', value: 'departure_date' },
          { text: 'CANCEL STATUS', value: 'is_cancel', sortable: false},
          { text: 'ACTIONS', value: 'actions', sortable: false},
          { text: '', value: 'see_details', sortable: false},
        ],
        rows: [],
      }
    },

    watch: {
      options: {
        handler () {
          this.initialize()
        },
        deep: true,
      },

      page () {
        this.initialize()
      },
    },
  
  methods: {
      
      editItem (item) {
        this.$router.replace({
          name: `editTicket`,
          params: {ticket_id: item.id},
        })
      },

      cancelItem (item) {
        this.resetDeleteModalGlobalMixin(true, `Confirm Cancel: RC = ${item.rc} ?`, item.id, "cancel-all-tickets") //Global Mixin
      },

      async initialize () {
        this.loading = true;
       await this.axios.get(`${1}/tickets`, 
        {
          params: {
            orderBy: 'id',
            orderType: 'DESC',
            page: this.page,
            itemsPerPage: this.itemsPerPage,
            user_id: 1,
            searchQuery: this.search
          }
        })
        .then(resp => {
            this.rows = resp.data.data;
            this.totalDataCount = resp.data.data_count;
            if (this.rows)
            {
              this.pageCount = Math.ceil(this.totalDataCount / this.itemsPerPage);
            }
            this.loading = false;
        })
      }
    },
  }
</script>
<style scoped>
#card-container {
  width: 100%;
}
</style>