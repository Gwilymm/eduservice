<template>
  <v-app>
    <v-navigation-drawer app color="primary" width="300" permanent>
      <div class="d-flex flex-column justify-between h-100">
        <div class="d-flex justify-center mb-8 mt-10">
          <v-img :src="logo" max-width="250" contain></v-img>
        </div>
        <v-container v-if="showYearSelector">
          <v-select v-model="selectedYear" :items="schoolYears" label="Année scolaire" outlined dense>
          </v-select>
        </v-container>
        <v-spacer></v-spacer>
        <v-container class="d-flex justify-center flex-wrap my-4">
          <v-img :src="aftec" max-width="40" class="mr-2"></v-img>
          <v-img :src="ipac" max-width="40" class="mr-2"></v-img>
          <v-img :src="mbway" max-width="40" class="mr-2"></v-img>
          <v-img :src="win" max-width="40" class="mr-2"></v-img>
          <v-img :src="mds" max-width="40" class="mr-2"></v-img>
          <v-img :src="ihecf" max-width="40" class="mr-2"></v-img>
          <v-img :src="tunon" max-width="40"></v-img>
        </v-container>
      </div>
    </v-navigation-drawer>

    <v-main class="main-content">
      <v-container fill-height fluid>
        <RouterView />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import logo from '@/assets/images/logo_eduservices.png';
import aftec from '@/assets/images/logo_aftec_blanc.png';
import ipac from '@/assets/images/logo_ipac_blanc.png';
import mbway from '@/assets/images/logo_mbway_blanc.png';
import win from '@/assets/images/logo_win_blanc.png';
import mds from '@/assets/images/logo_mds_blanc.png';
import ihecf from '@/assets/images/logo_ihecf_blanc.png';
import tunon from '@/assets/images/logo_tunon_blanc.png';

import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import { RouterView } from 'vue-router';

const route = useRoute();

const currentYear = new Date().getFullYear();

const schoolYears = [
  `${currentYear - 2} / ${currentYear - 1}`,
  `${currentYear - 1} / ${currentYear}`,
  `${currentYear} / ${currentYear + 1}`,
];

const selectedYear = ref(schoolYears[schoolYears.length - 1]);

const showYearSelector = computed(() => {
  const pagesWithSelector = ['/home', '/missions', '/administration', '/'];
  return pagesWithSelector.includes(route.path);
});
</script>

<style>
.theme--light.v-application {
  background: #FAFAFA;
}
.main-content {
  overflow-y: hidden;
}
</style>
