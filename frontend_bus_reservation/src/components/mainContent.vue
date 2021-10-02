<template>
    <v-main>
      <v-app-bar
      color="#80bfff"
      >
      <v-btn @click="toggleSideMenu"><v-icon>mdi-menu</v-icon></v-btn>
        <v-spacer></v-spacer>
        <marquee>
          <v-toolbar-title 
          style="font-weight: 500; font-size: 30px"
          >
            {{heading}}
          </v-toolbar-title>
         </marquee>
      </v-app-bar>

      <v-container
        class="py-8 px-6"
        fluid
      >
        <v-row>
          <router-view></router-view>
        </v-row>
      </v-container>
    </v-main>
</template>

<script>
import { eventBus } from './../main'

export default ({

    data: () => ({
      heading: process.env.VUE_APP_SITE_HEADING,
    }),

    methods: {
      toggleSideMenu () 
      {
        eventBus.$emit('toggle-sidemenu') //Launch an Event to toggle SideMenu
      }
    },
})
</script>