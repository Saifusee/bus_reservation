<template>
    <v-navigation-drawer
      v-model="drawer"
      app
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

      <v-list>
        <v-list-item
          v-for="[icon, text, destination] in links"
          :key="destination"
          :to="{name: destination}"
        >
            <v-list-item-icon>
              <v-icon>{{ icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ text }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
</template>

<script>

export default ({
    data: () => ({
      drawer: null,
      links: [
        ['mdi-monitor-dashboard', 'Dashboard', 'dashboard'],
        ['mdi-ticket', 'Create Ticket', 'createTicket'],
        ['mdi-border-all', 'All Tickets', 'allTicket'],
        ['mdi-bus-double-decker', 'Add Partner Travels', 'createPartnerTravels'],
        ['mdi-bus-multiple', 'All Partner Travels', 'allPartnerTravels'],
        ['mdi-bus-stop-covered', 'Add Pickup Point', 'createPickupPoint'],
        ['mdi-bus-stop-uncovered', 'All Pickup Point', 'allPickupPoint'],


      ],
    }),
})
</script>
