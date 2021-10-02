<template>
    <v-navigation-drawer
      v-model="drawer"
      app
      bottom  
      src="./../assets/sidemenu_background_image.jpg"
    >
      <v-sheet
        color="grey lighten-4"
        class="pa-4"
      >
        <v-avatar
          class="mb-4"
          color="grey darken-1"
          size="64"
        ></v-avatar>

        <div>john@vuetifyjs.com</div>
      </v-sheet>
      <v-divider></v-divider>

      <!-- Admin Pages List-->
      <v-list dense>
        <v-toolbar
          color="#99e6ff"
          dense
        >
          <v-btn icon>
            <v-icon>mdi-account</v-icon>
          </v-btn>
          <v-toolbar-title>ADMIN PANEL</v-toolbar-title>
        </v-toolbar>
        <v-list-group
            v-for="item in items"
            :key="item.title"
            v-model="item.active"
            :prepend-icon="item.action"
            no-action
        >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item
              v-for="child in item.items"
              :key="child.title"
              v-model="child.active"
              :to="{name: `${child.link_name}`}"
            > 
              <v-list-item-content>
                <v-list-item-title v-text="child.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-list-group>
      </v-list>

      <!-- User Pages List-->
      <v-list dense>
        <v-toolbar
          color="#99e6ff"
          dense
        >
          <v-btn icon>
            <v-icon>mdi-account-tie</v-icon>
          </v-btn>
          <v-toolbar-title>USER PANEL</v-toolbar-title>
        </v-toolbar>
        <v-list-group
            v-for="item in adminItems"
            :key="item.title"
            v-model="item.active"
            :prepend-icon="item.action"
            no-action
        >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item
              v-for="child in item.adminItems"
              :key="child.title"
              v-model="child.active"
              :to="{name: `${child.link_name}`}"
            > 
              <v-list-item-content>
                <v-list-item-title v-text="child.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-list-group>
      </v-list>
    <v-btn block rounded @click="loggedOut">Log Out</v-btn>
    </v-navigation-drawer>
</template>


<script>
import { eventBus } from './../main'

  export default {

    mounted () {

      //Catching event for logging out
      eventBus.$on('event-log-out', () =>
        {
          window.localStorage.removeItem('c')
          window.localStorage.removeItem('token')
          this.resetDeleteModalGlobalMixin(false, "", "", "") //Global Mixin
          this.$router.replace({name: 'loginPage'})
        }
      );

      //Catching event to toggle menu
      eventBus.$on('toggle-sidemenu', () =>
        {
          this.drawer = this.drawer == false ? true : false
        }
      );
    },
    data: () => ({
      drawer: false,

      items: [
        {
          action: 'mdi-monitor-dashboard',
          items: [
            { title: 'Dashboard', link_name: 'dashboard', active: true},
          ],
          title: 'User Dashboard',
        },
        {
          action: 'mdi-ticket',
          items: [
            { title: 'Create Tickets', link_name: 'createTicket', active: false},
            { title: 'All Tickets', link_name: 'allTicket', active: false},
          ],
          title: 'Tickets',
        },
        {
          action: 'mdi-bus',
          items: [
            { title: 'Create Partner Travels', link_name: 'createPartnerTravels', active: false},
            { title: 'All Partner Travels', link_name: 'allPartnerTravels', active: false},
          ],
          title: 'Partner Travels',
        },
        {
          action: 'mdi-bus-stop-covered',
          items: [
            { title: 'Create Pickup Point', link_name: 'createPickupPoint', active: false},
            { title: 'All Pickup Points', link_name: 'allPickupPoint', active: false},
          ],
          title: 'Pickup Point',
        },
      ],

      //Admin Items
      adminItems: [
        {
          action: 'mdi-monitor-dashboard',
          adminItems: [
            { title: 'Dashboard', link_name: 'dashboard', active: true},
          ],
          title: 'User Dashboard',
        },
        {
          action: 'mdi-ticket',
          adminItems: [
            { title: 'Create Tickets', link_name: 'createTicket', active: false},
            { title: 'All Tickets', link_name: 'allTicket', active: false},
          ],
          title: 'Tickets',
        },
        {
          action: 'mdi-bus',
          adminItems: [
            { title: 'Create Partner Travels', link_name: 'createPartnerTravels', active: false},
            { title: 'All Partner Travels', link_name: 'allPartnerTravels', active: false},
          ],
          title: 'Partner Travels',
        },
        {
          action: 'mdi-bus-stop-covered',
          adminItems: [
            { title: 'Create Pickup Point', link_name: 'createPickupPoint', active: false},
            { title: 'All Pickup Points', link_name: 'allPickupPoint', active: false},
          ],
          title: 'Pickup Point',
        },
      ],
    }),

    methods: {
      loggedOut () {
        this.resetDeleteModalGlobalMixin (true, 'Confirm Logging Out?', null, 'log-out')
      }
    }
  }
</script>