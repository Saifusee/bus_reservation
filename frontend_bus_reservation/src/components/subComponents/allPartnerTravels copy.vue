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
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
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
      :page.sync="page"
      :items-per-page="itemsPerPage"
      class="elevation-1"
      :search="search"
      @page-count="pageCount = $event"
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
        search: '',
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
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
        this.axios.delete(`partner-travels/${this.dataID}`)
        .then( () => {
          this.dataID = null
          this.$router.go()
        })
      },

      modalCancel () {
        this.dataID = null
        this.dialogDelete = false
      },

      initialize () {
        this.axios.get(`${1}/partner-travels`)
        .then(resp => {
            this.rows = resp.data;
        })
      }
  },
  }
</script>
