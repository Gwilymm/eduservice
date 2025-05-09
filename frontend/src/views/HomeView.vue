<template>
  <div class="page">
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
              <div class="info-label">Mail :</div>
              <div>{{ user.email }}</div>
            </div>
            <div class="d-flex mb-2">
              <div class="info-label">Portable :</div>
              <div>{{ user.phoneNumber }}</div>
            </div>
            <div class="d-flex mb-2">
              <div class="info-label">École :</div>
              <div>{{ user.shcoolName }}</div>
            </div>
            <div class="d-flex mb-2">
              <div class="info-label">Classe :</div>
              <div>{{ user.class }}</div>
            </div>
            <div class="d-flex mb-2">
              <div class="info-label">Mail :</div>
              <div>{{ user.schoolMail }}</div>
            </div>
          </v-col>
        </v-row>
        <v-row class="mt-4">
          <v-col cols="12" class="d-flex align-center">
            <v-icon color="red" icon="mdi-file-pdf-box" class="mr-2"></v-icon>
            <a
              :href="fileUrl"
              download
              class="text-decoration-none mr-2"
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
        <div class="text-h4 mr-4">{{ user.points }} points</div>
        <v-icon size="x-large" icon="mdi-chevron-right"></v-icon>
        <v-icon size="x-large" color="primary" icon="mdi-gift" class="mx-2"></v-icon>
        <div class="text-h5">{{ user.giftPotential }}</div>
      </div>
      <div class="text-body-2 text-grey">
        au {{ formatDate(user.updatedPointsDate) }}<br>
        Pour {{ user.completedMissions.length }} missions réalisées
      </div>
    </div>

    <div class="ranking-section mb-6">
      <div class="text-h5">Classement général : {{ user.rank }} / {{ user.totalParticipants }}</div>
      <div class="text-body-2 text-grey">
        Les points sont mentionnés à titre indicatif. La vérification des preuves et de la conformité des missions se fera à la fin du challenge.
      </div>
    </div>

    <div class="d-flex justify-space-between">
      <v-btn 
        color="primary" 
        @click="viewMissionDetails"
        :loading="loading"
        class="text-none px-4"
        prepend-icon="mdi-format-list-bulleted"
      >
        Consulter le détail<br>de mes missions
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

    <v-snackbar
      v-model="snackbar.show"
      :color="snackbar.color"
      :timeout="3000"
    >
      {{ snackbar.text }}
    </v-snackbar>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { formatDate } from '@/utils/dateUtils';

const router = useRouter();
const loading = ref(false);
const snackbar = ref({
  show: false,
  text: '',
  color: 'success'
});

// Données en dur pour l'utilisateur
const user = ref({
  firstName: 'Lucas',
  lastName: 'MARTIN',
  email: 'lucas.martin@gmail.com',
  phoneNumber: '07 08 09 10 11',
  shcoolName: 'MyDigtialSchool',
  class: 'DAD 2',
  schoolMail: 'lucas.martin@my-digital-school.org',
  isAuthorizationAccepted: true,
  points: 268,
  updatedPointsDate: '2024-01-10',
  completedMissions: [
    { id: 1, title: 'Mission 1', isCompleted: true },
    { id: 2, title: 'Mission 2', isCompleted: true },
    { id: 3, title: 'Mission 3', isCompleted: true },
    { id: 4, title: 'Mission 4', isCompleted: true }
  ],
  giftPotential: 'Séjour à Disneyland',
  rank: 2,
  totalParticipants: 9
});

const fileUrl = ref('https://example.com/autorisation_diffusion.pdf');

const fetchUserData = async () => {
  try {
    loading.value = true;
    await new Promise(resolve => setTimeout(resolve, 500));
    showSuccess('Données chargées avec succès');
  } catch (error) {
    showError('Erreur lors de la récupération des données utilisateur');
  } finally {
    loading.value = false;
  }
};

const downloadAuthorization = async () => {
  try {
    loading.value = true;
    await new Promise(resolve => setTimeout(resolve, 300));
    showSuccess('Autorisation téléchargée avec succès');
  } catch (error) {
    showError('Erreur lors du téléchargement de l\'autorisation');
  } finally {
    loading.value = false;
  }
};

const viewMissionDetails = async () => {
  try {
    loading.value = true;
    await new Promise(resolve => setTimeout(resolve, 300));
    await router.push('/missions');
  } catch (error) {
    showError('Erreur lors de la navigation vers les missions');
  } finally {
    loading.value = false;
  }
};

const addMission = async () => {
  try {
    loading.value = true;
    await new Promise(resolve => setTimeout(resolve, 300));
    await router.push('/missions/add');
  } catch (error) {
    showError('Erreur lors de la navigation vers l\'ajout de mission');
  } finally {
    loading.value = false;
  }
};

const showError = (message) => {
  snackbar.value = {
    show: true,
    text: message,
    color: 'error'
  };
};

const showSuccess = (message) => {
  snackbar.value = {
    show: true,
    text: message,
    color: 'success'
  };
};

onMounted(async () => {
  await fetchUserData();
  await downloadAuthorization();
});
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
