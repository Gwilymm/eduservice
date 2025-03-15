<template>
  <div class="page">
    <v-card variant="tonal">
      <v-card-title>
        Mes informations personnelles
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12" sm="6">
            <div><strong>Prénom:</strong>{{ user.firstName }}</div>
            <div><strong>Nom:</strong>{{ user.lastName }}</div>
            <div><strong>Mail:</strong>{{ user.email }}</div>
            <div><strong>Portable:</strong>{{ user.phone }}</div>
          </v-col>
          <v-col cols="12" sm="6">
            <div><strong>Ecole:</strong>{{ user.school }}</div>
            <div><strong>Classe:</strong>{{ user.class }}</div>
            <div><strong>Mail école:</strong>{{ user.schoolMail }}</div>
          </v-col>
        </v-row>
        <v-row class="mt-4">
          <v-col cols="auto">
            <v-icon color="red" icon="mdi-file-pdf-box"></v-icon>
          </v-col>
          <v-col cols="auto">
            <a
              :href="fileUrl"
              download
              class="text-decoration-none"
              target="_blank"
            >
              Autorisation de diffusion d'image
          </a>
          </v-col>

          <v-col cols="auto">
            <v-icon color="primary" icon="mdi-chevron-right"></v-icon>
          </v-col>

          <v-col>
            <div>{{ user.isAuthorizationAccepted ? 'Oui' : 'Non' }}</div>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>

    <v-card class="mt-4">
      <v-card-title>
        Statistiques
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12" sm="6">
            <div><strong>Points:</strong>{{ user.points }}</div>
            <div><strong>Date du dernier ajout de points:</strong>{{ user.updatedPointsDate }}</div>
            <div><strong>Missions réalisées:</strong>{{ user.completedMissions.lenght }}</div>
            <div>{{ user.giftPotential }}</div>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>

    <div class="mt-4 w-100 d-flex justify-space-around">
      <v-btn color="primary" @click="viewMissionDetails" class="w-40">Consulter le détail de mes missions</v-btn>
      <v-btn color="primary" @click="addMission" class="w-40">Ajouter une mission</v-btn>
    </div>
  </div>
</template>
<script setup>
import { ref } from 'vue';

const user = ref({
  firstName: 'John',
  lastName: 'Doe',
  email: 'john.doe@example.com',
  phone: '0123456789',
  school: 'École de la ville',
  class: '5e',
  mais: 'M1',
  isAuthorizationAccepted: true,
  points: 100,
  updatedPointsDate: '2025-03-10',
  completedMissions: 5,
  giftPotential: 'Carte cadeau de 20€',
  rank: 2,
  totalParticipants: 9,
});

const fileUrl = new URL('@/assets/autorisation_diffusion.pdf', import.meta.url).href;

const viewMissionDetails = () => {
  console.log('Consulter mes missions');
};

const addMission = () => {
  console.log('Ajouter une mission');
};
</script>

<style scoped>
.v-card {
  margin-bottom: 20px;
}
</style>
