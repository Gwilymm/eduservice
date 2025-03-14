<template>
  <v-app>
    <v-navigation-drawer app color="primary" class="w-25">
      <div class="d-flex justify-center mb-8 mt-10">
        <v-img :src="logo" max-width="250"  contain></v-img>
      </div>
      <v-container v-if="showYearSelector">
        <v-select v-model="selectedYear" :item="schoolYears" label="Année scolaire" outlined dense>
        </v-select>
      </v-container>
      <v-spacer></v-spacer>
      <v-container class="d-flex justify-center flex-wrap my-4">
        <v-img></v-img>
        <v-img></v-img>
        <v-img></v-img>
        <v-img></v-img>
        <v-img></v-img>
        <v-img></v-img>
        <v-img></v-img>

      </v-container>
    </v-navigation-drawer>
    <v-main>
      <RouterView />
    </v-main>
  </v-app>
</template>

<script setup>
import logo from '@/assets/images/logo_eduservices.png';
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import { RouterView } from 'vue-router';

const route = useRoute()

const currentYear = new Date().getFullYear();

const schoolYears = [
  `${currentYear - 2} / ${currentYear - 1}`,
  `${currentYear - 1} / ${currentYear}`,
  `${currentYear} / ${currentYear + 1}`,
]

const selectedYear = ref(schoolYears[-1])

const showYearSelector = computed(() => {
  const pagesWithSelector = ['/home', '/missions', '/administration', '/'];
  return pagesWithSelector.includes(route.path);
});

</script>

<style>
@font-face {
  font-family: 'HomemadeApple';
  src: url('@/assets/fonts/HomemadeApple-Regular.woff') format("woff");
}

@font-face {
  font-family: 'NeoSansStd';
  src: url('@/assets/fonts/Neo-Sans-Std-Medium.woff') format("woff");
}

body {
  font-family: NeoSansStd;
}

h1 {
  font-family: HomemadeApple;
}

.navigation-drawer-background {
  background-color: var(--dark-blue);
}
</style>
