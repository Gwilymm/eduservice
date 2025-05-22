<template>
  <div class="page pa-4">
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4 font-weight-bold">Ajouter une mission</h1>
      <v-btn color="primary" variant="text" prepend-icon="mdi-arrow-left" @click="router.push('/')">
        Retour à la page principale
      </v-btn>
    </div>

    <!-- Indicateur de chargement -->
    <div v-if="missionStore.loading" class="text-center py-8">
      <v-progress-circular indeterminate color="primary" size="64" />
      <p class="mt-4">Chargement des missions...</p>
    </div>

    <!-- Message d'erreur -->
    <v-alert v-if="missionStore.error" type="error" class="mb-4" dismissible>
      {{ missionStore.error }}
      <template v-slot:append>
        <v-btn size="small" @click="loadMissions">Réessayer</v-btn>
      </template>
    </v-alert>

    <!-- Liste des missions -->
    <div v-if="!missionStore.loading && !missionStore.error" class="mission-list">
      <div v-if="availableMissions.length === 0" class="text-center py-8">
        <v-icon size="64" color="grey">mdi-clipboard-list-outline</v-icon>
        <p class="mt-4 text-grey">Aucune mission disponible pour le moment</p>
      </div>

      <v-container fluid>
        <v-row dense>
          <v-col cols="12" v-for="mission in availableMissions" :key="mission.id">
            <v-checkbox :model-value="mission.selected" @update:model-value="updateSelection(mission.id, $event)"
              hide-details class="mission-checkbox">
              <template #label>
                <div class="d-flex align-center gap-2">
                  <v-tooltip location="top">
                    <template #activator="{ props }">
                      <span v-bind="props" class="font-weight-medium text-body-1">
                        {{ mission.name }}
                      </span>
                    </template>
                    <span>{{ mission.description }}</span>
                  </v-tooltip>

                  <v-chip size="x-small" color="blue-lighten-4" text-color="blue-darken-4" variant="flat">
                    {{ mission.points }} pts
                  </v-chip>
                </div>
              </template>
            </v-checkbox>

          </v-col>
        </v-row>
      </v-container>
    </div>

    <!-- Bouton de validation -->
    <div v-if="!missionStore.loading" class="d-flex justify-end mt-6">
      <v-btn prepend-icon="mdi-file-document-check-outline" color="primary" size="large" @click="goToJustification"
        :disabled="!isAnyMissionSelected" :loading="submitting">
        Justifier
      </v-btn>
    </div>

    <!-- Message d'information -->
    <v-alert color="warning" class="mt-8" variant="tonal" border="start" density="comfortable" elevation="0">
      <v-icon start color="warning">mdi-alert-circle-outline</v-icon>
      Chaque mission cochée devra être validée selon toutes les conditions avant de pouvoir déposer une preuve.
    </v-alert>
  </div>
</template>



<script setup>
import { computed, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useMissionStore } from '@/stores/missionStore';

const missionStore = useMissionStore();
const router = useRouter();
const submitting = ref(false);

// État local pour gérer les sélections
const missionSelections = ref(new Map());

// Computed pour transformer les missions du store en format utilisable par le template
const availableMissions = computed(() => {
  return missionStore.missions.map(mission => ({
    id: mission.id,
    name: mission.name,
    description: mission.description,
    points: mission.points,
    selected: missionSelections.value.get(mission.id) || false,
    needJustification: true,
  }));
});

// Watcher pour les sélections
const updateSelection = (missionId, selected) => {
  missionSelections.value.set(missionId, selected);
};

// Vérifier si au moins une mission est sélectionnée
const isAnyMissionSelected = computed(() =>
  availableMissions.value.some((mission) => mission.selected)
);

// Fonction pour aller à la page justification
const goToJustification = async () => {
  try {
    submitting.value = true;

    const selectedMissionsList = availableMissions.value.filter(m => m.selected);

    if (selectedMissionsList.length === 0) {
      alert('Veuillez sélectionner au moins une mission');
      return;
    }

    // Sauvegarder les missions sélectionnées dans le store
    missionStore.setSelectedMissions(selectedMissionsList);

    // Navigation vers la page justification
    await router.push('/justifications');
  } catch (error) {
    console.error('Erreur lors de la navigation vers les justifications:', error);
    alert('Erreur lors de la navigation. Veuillez réessayer.');
  } finally {
    submitting.value = false;
  }
};

// Fonction pour charger les missions
const loadMissions = async () => {
  try {
    await missionStore.fetchMissions();
  } catch (error) {
    console.error('Erreur lors du chargement des missions:', error);
  }
};

// Charger les missions au montage du composant
onMounted(async () => {
  // Charger les missions seulement si elles ne sont pas déjà chargées
  if (missionStore.missions.length === 0) {
    await loadMissions();
  }
});

// Watcher pour les changements de sélection
availableMissions.value.forEach(mission => {
  const originalSelected = mission.selected;
  Object.defineProperty(mission, 'selected', {
    get() {
      return missionSelections.value.get(mission.id) || false;
    },
    set(value) {
      updateSelection(mission.id, value);
    }
  });
});

</script>

<style scoped>
.mission-checkbox {
  padding: 8px 12px;
  transition: background-color 0.2s;
  border-radius: 4px;
}

.mission-checkbox:hover {
  background-color: #f9f9f9;
}

.gap-2 {
  gap: 8px;
}
</style>
