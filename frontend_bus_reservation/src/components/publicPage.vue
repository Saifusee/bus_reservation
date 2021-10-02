<template>
   <v-app id="app" :style="{backgroundImage:`url(${require('./../assets/public_page_background_image.jpg')})`}">
        <router-view></router-view>
   </v-app>
</template>
<script>
export default {

}
</script>
<style scoped>
#app {
  background-size: cover;
  overflow:hidden;
}


</style>