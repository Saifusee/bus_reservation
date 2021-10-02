<template>
  <v-app id="inspire">
  
    <datatables-delete-modal></datatables-delete-modal>
    <sideMenu/>
    <mainContent/>
    
  </v-app>
</template>

<script>
import sideMenu from './sideMenu'
import mainContent from './mainContent'
import datatablesDeleteModal from './miscComponent/datatablesDeleteModal.vue'

  export default {
    name: 'indexPage',

    components:
    {
      'sideMenu': sideMenu,
      'mainContent': mainContent,
      'datatablesDeleteModal': datatablesDeleteModal,
    },
  }
</script>