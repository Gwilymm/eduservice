<template>
  <div class="page">
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4">Ajouter une mission</h1>
      <v-btn color="primary" variant="text" prepend-icon="mdi-arrow-left" @click="router.push('/')">
        Retour à la page principale
      </v-btn>
    </div>

    <div class="content">
      <v-checkbox v-for="mission in availableMissions" :key="mission.id" v-model="mission.selected"
        :label="mission.title" class="mission-checkbox mb-4" hide-details></v-checkbox>
    </div>
    <div class="d-flex justify-end mx-2">
      <v-btn prepend-icon="mdi-file-document-check-outline" color="primary" @click="AddJustification"
        :disabled="!isAnyMissionSelected">Justifier</v-btn>
    </div>

    <v-alert color="warning" class="mt-8" variant="tonal" border="start" density="comfortable">
      Selon la case cochée, pour chaque mission, l'étape d'après est la validation des différentes conditions de
      validité qu'ils doivent TOUTES cocher avant d'accéder à l'étape suivante, à savoir le dépôt de la preuve si
      nécessaire (joindre un fichier). À l'étape d'après, message attente de validation doit s'afficher.
    </v-alert>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useMissionStore } from '@/stores/missionStore';

const missionStore = useMissionStore();
const router = useRouter();

const availableMissions = ref([
  {
    id: 1,
    title: 'Communiquer sur les RS',
    selected: false,
    needJustification: true,
  },
  {
    id: 2,
    title: 'Poster des avis',
    selected: false,
    needJustification:false,
  },
  {
    id: 3,
    title: 'Participer à des TikTok',
    selected: false,
    needJustification:true,
  },
  {
    id: 4,
    title: 'Livrer votre témoignage',
    selected: false,
    needJustification: false,
  },
  {
    id: 5,
    title: 'Participer à un shooting photos',
    selected: false,
    needJustification:false,
  },
  {
    id: 6,
    title: 'Intervenir dans votre ancien établissement',
    selected: false,
    needJustification:true,
  },
  {
    id: 7,
    title: 'Participer à des événements',
    selected: false,
    needJustification:false,
  },
  {
    id: 8,
    title: 'Parrainer des futurs étudiants',
    selected: false,
    needJustification:false,
  },
  {
    id: 9,
    title: 'Autre mission',
    selected: false,
    needJustification:true,
  }
]);
const loading = ref(false);


const isAnyMissionSelected = computed(() =>
  availableMissions.value.some((mission) => mission.selected)
);

const AddJustification = async () => {
  try {
    loading.value = true;

    const selected = availableMissions.value.filter(m => m.selected);
    missionStore.setSelectedMissions(selected);

    await new Promise(resolve => setTimeout(resolve, 300));
    await router.push('/justifications');
  } catch (error) {
    showError('Erreur lors de la navigation vers les missions');
  } finally {
    loading.value = false;
  }
};

</script>

<style scoped>
</style>