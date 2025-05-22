<template>
  <div class="page">
    <v-progress-circular v-if="loading" indeterminate />

    <!-- Affichage si user est bien récupéré -->
    <div v-else-if="user">
      <h1 class="text-h4 mb-6">Bienvenue {{ user.firstName }} !</h1>

      <v-card class="mb-6" color="grey-lighten-3">
        <v-card-title class="text-h5 pb-4 text-primary">
          Mes informations personnelles
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <div class="d-flex mb-2">
                <div class="info-label">Prénom :</div>
                <div>{{ user.firstName }}</div>
              </div>
              <div class="d-flex mb-2">
                <div class="info-label">NOM :</div>
                <div>{{ user.lastName }}</div>
              </div>
              <div class="d-flex mb-2">
                <div class="info-label">Mail personnel :</div>
                <div>{{ user.email }}</div>
              </div>
              <div class="d-flex mb-2">
                <div class="info-label">Portable :</div>
                <div>{{ user.phoneNumber }}</div>
              </div>
              <div class="d-flex mb-2">
                <div class="info-label">École :</div>
                <div>{{ user.schoolName }}</div>
              </div>
              <div class="d-flex mb-2">
                <div class="info-label">Classe :</div>
                <div>{{ user.section || 'Non définie' }}</div>
              </div>
              <div class="d-flex mb-2">
                <div class="info-label">Mail école :</div>
                <div>{{ user.userIdentifier }}</div>
              </div>
            </v-col>
          </v-row>
          <v-row class="mt-4">
            <v-col cols="12" class="d-flex align-center">
              <v-icon color="red" icon="mdi-file-pdf-box" class="mr-2"></v-icon>
              <a
                :href="fileUrl"
                target="_blank"
                rel="noopener noreferrer"
                class="text-decoration-none mr-2"
                @click.prevent="openPdfInNewTab"
              >
                Autorisation de diffusion d'image
              </a>
              <v-icon color="primary" icon="mdi-chevron-right" class="mr-2"></v-icon>
              <div>{{ user.isAuthorizationAccepted ? 'OUI' : 'NON' }}</div>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>

      <div class="points-section mb-6">
        <div class="d-flex align-center">
          <div class="text-h4 mr-4">{{ user.points || 0 }} points</div>
          <v-icon size="x-large" icon="mdi-chevron-right"></v-icon>
          <v-icon
            size="x-large"
            color="primary"
            icon="mdi-gift"
            class="mx-2"
            @click="goToRewards"
            style="cursor: pointer"
          ></v-icon>
          <div class="text-h5">{{ user.giftPotential }}</div>
        </div>
        <div class="text-body-2 text-grey">
          au {{ formatDate(displayDate) }}<br />
          Pour {{ user.completedMissions?.length || 0 }}
          missions réalisées
        </div>
      </div>

      <div class="ranking-section mb-6">
        <div class="text-h5" v-if="user.rank">
          Classement général : {{ user.rank }} / {{ user.totalParticipants }}
        </div>
        <div v-else>
          <span class="text-h5">Classement général :</span>
          En cours de calcul
        </div>
        <div class="text-body-2 text-grey">
          Les points sont mentionnés à titre indicatif. La vérification des preuves et de la
          conformité des missions se fera à la fin du challenge.
        </div>
      </div>

      <div class="d-flex justify-space-between">
        <v-btn
          color="primary"
          @click="viewMissionDetails"
          :loading="loading"
          class="text-none px-4"
          prepend-icon="mdi-format-list-bulleted"
          style="white-space: pre-line; line-height: 1.2"
        >
          Consulter le détail de mes missions
        </v-btn>
        <v-btn
          color="primary"
          @click="addMission"
          :loading="loading"
          class="text-none px-4"
          prepend-icon="mdi-plus"
        >
          Ajouter une mission
        </v-btn>
      </div>

      <v-snackbar v-model="snackbar.show" :color="snackbar.color" :timeout="3000">
        {{ snackbar.text }}
      </v-snackbar>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { formatDate } from '@/utils/dateUtils'
import { useAuthStore } from '@/stores/auth'
import { getCurrentUser } from '@/api/userService'
import autorisationPdf from '@/assets/autorisation_diffusion.pdf'

const auth = useAuthStore()
const user = ref(null)
const router = useRouter()
const loading = ref(false)
const snackbar = ref({
  show: false,
  text: '',
  color: 'success',
})

async function fetchUser() {
  loading.value = true
  try {
    user.value = await getCurrentUser()
    // snackbar.value = { show: true, text: 'Données chargées', color: 'success' }
  } catch {
    snackbar.value = {
      show: true,
      text: "Erreur de chargement des données de l'utiliateur",
      color: 'error',
    }
  } finally {
    loading.value = false
  }
}

const displayDate = computed(() => {
  return user.value?.updatedPointsDate || new Date()
})

const fileUrl = ref(autorisationPdf)

const openPdfInNewTab = () => {
  window.open(fileUrl.value, '_blank', 'noopener,noreferrer')
}

const viewMissionDetails = async () => {
  try {
    loading.value = true
    await new Promise((resolve) => setTimeout(resolve, 300))
    await router.push('/missions')
  } catch (error) {
    showError('Erreur lors de la navigation vers les missions')
  } finally {
    loading.value = false
  }
}

const addMission = async () => {
  try {
    loading.value = true
    await new Promise((resolve) => setTimeout(resolve, 300))
    await router.push('/missions/add')
  } catch (error) {
    showError("Erreur lors de la navigation vers l'ajout de mission")
  } finally {
    loading.value = false
  }
}

const goToRewards = async () => {
  try {
    loading.value = true
    await new Promise((resolve) => setTimeout(resolve, 300))
    await router.push('/rewards')
  } catch (error) {
    showError('Erreur lors de la navigation vers les récompenses')
  } finally {
    loading.value = false
  }
}

const showError = (message) => {
  snackbar.value = {
    show: true,
    text: message,
    color: 'error',
  }
}

const showSuccess = (message) => {
  snackbar.value = {
    show: true,
    text: message,
    color: 'success',
  }
}

onMounted(async () => {
  await fetchUser()
})
</script>

<style scoped>
.page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 24px;
}

.info-label {
  font-weight: bold;
  min-width: 100px;
  margin-right: 8px;
}

.points-section {
  margin-top: 32px;
}

.ranking-section {
  margin-top: 24px;
}

.v-btn {
  min-width: 200px;
}
</style>
