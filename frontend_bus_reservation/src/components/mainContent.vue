<template>
    <v-main>
      <v-app-bar
      color="#80bfff"
      >
        <v-spacer></v-spacer>
        <v-toolbar-title 
        style="font-weight: 500; font-size: 30px"
        >
          {{heading}}
        </v-toolbar-title>
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

export default ({
    data: () => ({
      heading: process.env.VUE_APP_SITE_HEADING,
    }),
})
</script>