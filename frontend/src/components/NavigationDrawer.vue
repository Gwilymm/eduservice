<template>
  <v-navigation-drawer permanent width="300">
    <div class="drawer-content pa-6">
      <!-- Logo et titre -->
      <div class="d-flex flex-column align-center mt-8 mb-auto">
        <div class="logo-container">
          <v-img :src="logo" max-width="200" height="140" class="mb-6" contain></v-img>
        </div>
      </div>

      <template v-if="route.path !== '/login' && route.path !== '/register'">
        <div class="d-flex flex-column align-center mb-12">
          <!-- Select année scolaire -->
          <div class="select-container mb-6">
            <v-select
              label="Année scolaire"
              :items="schoolYears"
              variant="outlined"
              density="compact"
              class="select-annee"
              hide-details
            ></v-select>
          </div>

          <!-- Bouton présentation -->
          <div class="d-flex justify-center">
            <v-btn class="presentation-btn" href="#">
              <div class="btn-content">
                <span>Consulter la présentation<br />du Challenge</span>
                <v-icon icon="mdi-chevron-right" size="small"></v-icon>
              </div>
            </v-btn>
          </div>
          <div class="d-flex justify-center mt-4">
            <v-btn class="logout-btn" color="error" @click="handleLogout"> Déconnexion </v-btn>
          </div>
        </div>
      </template>

      <!-- Bouton admin -->
      <template v-else>
        <div class="d-flex justify-center mt-4">
          <v-btn class="admin-btn" color="primary" href="http://localhost/admin/login"> Accès administrateur </v-btn>
        </div>
      </template>

      <!-- Logos partenaires -->
      <div class="d-flex justify-center">
        <v-img :src="aftec" max-width="32" class="mr-2"></v-img>
        <v-img :src="ipac" max-width="32" class="mr-2"></v-img>
        <v-img :src="mbway" max-width="32" class="mr-2"></v-img>
        <v-img :src="win" max-width="32" class="mr-2"></v-img>
        <v-img :src="mds" max-width="32" class="mr-2"></v-img>
        <v-img :src="ihecf" max-width="32" class="mr-2"></v-img>
        <v-img :src="tunon" max-width="32"></v-img>
      </div>
    </div>
  </v-navigation-drawer>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth' // ← import du store

import logo from '@/assets/images/logo_eduservices.png'
import aftec from '@/assets/images/logo_aftec_blanc.png'
import ipac from '@/assets/images/logo_ipac_blanc.png'
import mbway from '@/assets/images/logo_mbway_blanc.png'
import win from '@/assets/images/logo_win_blanc.png'
import mds from '@/assets/images/logo_mds_blanc.png'
import ihecf from '@/assets/images/logo_ihecf_blanc.png'
import tunon from '@/assets/images/logo_tunon_blanc.png'

const route = useRoute()

const schoolYears = ['2025/2026', '2026/2027', '2027/2028']
const auth = useAuthStore()
function handleLogout() {
  auth.logout()
}
</script>

<style scoped>
.drawer-content {
  height: 100%;
  display: flex;
  flex-direction: column;
  background-color: #002b49;
  color: white;
  padding-bottom: 16px;
}

.admin-btn {
  background-color: #4db1e1 !important;
  color: white !important;
  border-radius: 4px !important;
  text-transform: none !important;
  font-size: 13px !important;
  height: auto !important;
  padding: 8px 16px !important;
  margin: 16px 0;
  font-weight: normal !important;
  min-width: 240px !important;
  line-height: 1.2 !important;
}

.year-select {
  :deep(.v-field) {
    background-color: white !important;
    border-radius: 4px;
  }
}

.presentation-btn {
  background-color: #4db1e1 !important;
  color: white !important;
  border-radius: 20px !important;
  text-transform: none !important;
  font-size: 13px !important;
  height: auto !important;
  padding: 8px 16px !important;
  margin: 16px 0;
  font-weight: normal !important;
  min-width: 240px !important;
  line-height: 1.2 !important;
}

.btn-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  width: 100%;
}

:deep(.presentation-btn .v-btn__content) {
  width: 100%;
}

.partners-container {
  margin-bottom: 16px;
}

.white-select {
  background-color: white;
  border-radius: 4px;
}

.select-container {
  width: 80%;
  max-width: 200px;
}

.select-annee {
  width: 100%;
  :deep(.v-field) {
    background: white;
    border-radius: 0;
    min-height: 40px !important;
  }

  :deep(.v-field__outline) {
    border-color: #e0e0e0 !important;
    opacity: 1;
  }

  :deep(.v-field__input) {
    min-height: 40px !important;
    padding-top: 0;
    padding-bottom: 0;
  }

  :deep(.v-field__field) {
    min-height: 40px !important;
  }

  :deep(.v-select__selection) {
    color: black;
  }

  :deep(.v-label) {
    color: black;
    font-size: 14px;
  }
}

.logo-container {
  width: 200px;
  height: 140px;
  display: flex;
  align-items: flex-start;
  justify-content: center;
}
</style>
