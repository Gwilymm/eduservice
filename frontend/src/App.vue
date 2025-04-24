<template>
  <v-app>
    <NavigationDrawer />
    
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script setup>
import NavigationDrawer from '@/components/NavigationDrawer.vue';
</script>

<style>
.v-application {
  background-color: #f5f5f5;
}
</style>
