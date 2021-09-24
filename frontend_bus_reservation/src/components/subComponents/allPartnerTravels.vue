<template>
  <v-card>
    <v-card-title>
      <v-alert
        border="top"
        color="#ff4da6"
        dark
        
      >
        <h3>ALL PARTNER TRAVELS</h3>
      </v-alert>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        label="Search"
        single-line
        hide-details
        @keypress.enter="searchQueryRequest"
      ></v-text-field>      
    <v-btn
      class="mx-2"
      fab
      dark
      small
      color="indigo"
      @click="searchQueryRequest"
    >
      <v-icon dark>
        mdi-magnify
      </v-icon>
    </v-btn>
    </v-card-title>
          <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="modalCancel">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="modalConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
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
  export default {

    mounted() {
      this.initialize();
    },

    data () {
      return {
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
          { text: 'CONTACT-1', value: 'contact_1' },
          { text: 'CONTACT-2', value: 'contact_2' },
          { text: 'CREATED AT', value: 'created_at' },
          { text: 'LAST UPDATED', value: 'updated_at' },
          { text: 'ACTIONS', value: 'actions' },

        ],
        rows: [],
        dialog: false,
        dialogDelete: false,
        dataID: null,  //Modal for which Data's ID
      }
    },

    watch: {
      options: {
        handler () {
          this.initialize()
        },
        deep: true,
      },
      search (value) {
        if (value == '')
        {
          this.initialize()
        }
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
        this.dataID = item.id
        this.dialogDelete = true
      },

      modalConfirm () {
        this.dialogDelete = false
        this.loading = true;
        this.axios.delete(`partner-travels/${this.dataID}`)
        .then( () => {
          this.dataID = null
          this.initialize()
        })
      },

      modalCancel () {
        this.dataID = null
        this.dialogDelete = false
      },

      searchQueryRequest () {
        this.initialize();
      },

      async initialize () {
        this.loading = true;
       await this.axios.get(`${1}/partner-travels`, 
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
            this.pageCount = Math.ceil(this.totalDataCount / this.itemsPerPage);
            this.loading = false;
        })
      }
    },
  }
</script>
