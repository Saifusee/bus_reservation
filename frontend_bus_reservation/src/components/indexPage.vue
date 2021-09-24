<template>
  <v-app id="inspire">


    <sideMenu/>
    <mainContent/>
    
  </v-app>
</template>

<script>
import sideMenu from './sideMenu'
import mainContent from './mainContent'

  export default {
    name: 'indexPage',
    
    components:
    {
      'sideMenu': sideMenu,
      'mainContent': mainContent,
    },

    mounted() 
    {
      document.title = process.env.VUE_APP_SITE_HEADING;
    },
  }
</script>