<template>
  <v-card id="card-container">

        <data-tables-headers
          :pageTitle="heading"
          pageSource="allPartnerTravels"
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
              @click="deleteItem(item)"
            >
              mdi-delete
            </v-icon>
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

      eventBus.$on('event-delete-all-partner-travels', (dataFromEvent) =>
        {
          this.loading = true;
          this.resetDeleteModalGlobalMixin(false, "", "", "") //Global Mixin
          this.axios.delete(`partner-travels/${dataFromEvent}`)
          .then( () => {
            this.initialize()
          })
        }
      );

      eventBus.$on('allPartnerTravels-search', (dataFromEvent) =>
        {
          this.search = dataFromEvent
          this.initialize()
        }
      );
    },

    data () {
      return {
        heading: "ALL PARTNER TRAVELS",
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        search: '',
        totalDataCount: 0,
        options: {},
        loading: false,
        headers: [
          { text: 'TRAVELS NAME', align: 'start', value: 'partner_travel_name' },
          { text: 'ADDRESS', value: 'address' },
          { text: 'E-mail-1', value: 'email_1' },
          { text: 'CONTACT-1', value: 'contact_1', sortable: false},
          { text: 'CONTACT-2', value: 'contact_2', sortable: false},
          { text: 'CREATED AT', value: 'created_at' },
          { text: 'LAST UPDATED', value: 'updated_at' },
          { text: 'ACTIONS', value: 'actions', sortable: false},

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
          name: `editPartnerTravels`,
          params: {partner_travels_id: item.id},
        })
      },

      deleteItem (item) {
        this.resetDeleteModalGlobalMixin(true, `Confirm Delete: ${item.partner_travel_name} ?`, item.id, "delete-all-partner-travels") //Global Mixin
      },

      async initialize () {
        this.loading = true;
       await this.axios.get(`${1}/partner-travels/tables`, 
        {
          params: {
            orderBy: 'partner_travel_name',
            orderType: 'ASC',
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