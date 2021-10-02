<template>
  <v-card flat id="card-container">

        <data-tables-headers
          :pageTitle="heading"
          pageSource="allPickupPoint"
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
      eventBus.$on('event-delete-all-pickup-point', (dataFromEvent) =>
        {
          this.loading = true;
          this.resetDeleteModalGlobalMixin(false, "", "", "") //Global Mixin
          this.axios.delete(`pickup-points/${dataFromEvent}`)
          .then( () => {
            this.initialize()
          })
        }
      );

      eventBus.$on('allPickupPoint-search', (dataFromEvent) =>
        {
          this.search = dataFromEvent
          this.initialize()
        }
      );


    },

    data () {
      return {
        heading: "ALL PICKUP-POINT",
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        search: '',
        totalDataCount: 0,
        options: {},
        loading: false,
        headers: [
          { text: 'Pickup Point Address', align: 'start', value: 'pickup_point_address' },
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
          name: `editPickupPoint`,
          params: {pickup_point_id: item.id},
        })
      },

      deleteItem (item) {
        this.resetDeleteModalGlobalMixin(true, `Confirm Delete: ${item.pickup_point_address} ?`, item.id, "delete-all-pickup-point") //Global Mixin
      },

      async initialize () {
        this.loading = true;
       await this.axios.get(`${1}/pickup-points/tables`, 
        {
          params: {
            orderBy: 'pickup_point_address',
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