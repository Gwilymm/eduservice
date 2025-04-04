<template>
  <div class="page">
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4">Ajouter une mission</h1>
      <v-btn
        color="primary"
        variant="text"
        prepend-icon="mdi-arrow-left"
        @click="router.push('/')"
      >
        Retour à la page principale
      </v-btn>
    </div>

    <div class="mission-list">
      <v-checkbox
        v-for="mission in availableMissions"
        :key="mission.id"
        v-model="mission.selected"
        :label="mission.title"
        color="primary"
        class="mission-checkbox mb-4"
        hide-details
      ></v-checkbox>
    </div>

    <v-alert
      color="warning"
      class="mt-8"
      variant="tonal"
      border="start"
      density="comfortable"
    >
      Selon la case cochée, pour chaque mission, l'étape d'après est la validation des différentes conditions de validité qu'ils doivent TOUTES cocher avant d'accéder à l'étape suivante, à savoir le dépôt de la preuve si nécessaire (joindre un fichier). À l'étape d'après, message attente de validation doit s'afficher.
    </v-alert>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const availableMissions = ref([
  {
    id: 1,
    title: 'Communiquer sur les RS',
    selected: false
  },
  {
    id: 2,
    title: 'Poster des avis',
    selected: false
  },
  {
    id: 3,
    title: 'Participer à des TikTok',
    selected: false
  },
  {
    id: 4,
    title: 'Livrer votre témoignage',
    selected: false
  },
  {
    id: 5,
    title: 'Participer à un shooting photos',
    selected: false
  },
  {
    id: 6,
    title: 'Intervenir dans votre ancien établissement',
    selected: false
  },
  {
    id: 7,
    title: 'Participer à des événements',
    selected: false
  },
  {
    id: 8,
    title: 'Parrainer des futurs étudiants',
    selected: false
  },
  {
    id: 9,
    title: 'Autre mission',
    selected: false
  }
]);

</script>

<style scoped>
.page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 24px;
}

.mission-list {
  max-width: 800px;
}

.mission-checkbox {
  background-color: #f5f5f5;
  border-radius: 4px;
  padding: 8px 16px;
}

.mission-checkbox:hover {
  background-color: #e0e0e0;
}

:deep(.v-checkbox .v-label) {
  font-size: 1.1rem;
  opacity: 1;
}

:deep(.v-checkbox .v-selection-control) {
  min-height: 40px;
}
</style> 