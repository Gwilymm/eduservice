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

    <!-- Snackbar d'erreur -->
    <v-snackbar v-model="errorSnackbar" color="error" timeout="6000" top>
      {{ missionStore.error }}
      <template #action>
        <v-btn text @click="loadMissions">Réessayer</v-btn>
      </template>
    </v-snackbar>

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
                  <span v-if="mission.description" class="font-weight-medium text-body-1">
                    <v-tooltip location="right">
                      <template #activator="{ props }">
                        <span v-bind="props">{{ mission.name }}</span>
                      </template>
                      <span class="tooltip-description">{{ mission.description }}</span>
                    </v-tooltip>
                  </span>
                  <span v-else class="font-weight-medium text-body-1">
                    {{ mission.name }}
                  </span>

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
    <v-container class="mt-4">
      <v-alert type="info" variant="outlined" border="start" color="blue" density="comfortable"
        icon="mdi-information-outline">
        Chaque mission cochée devra être validée selon toutes les conditions avant de pouvoir déposer une preuve.
      </v-alert>
    </v-container>
    <!-- Bouton de validation -->
    <div v-if="!missionStore.loading" class="d-flex justify-end mt-6">
      <v-btn prepend-icon="mdi-file-document-check-outline" color="primary" size="large" @click="goToJustification"
        :disabled="!isAnyMissionSelected" :loading="submitting">
        Justifier
      </v-btn>
    </div>


  </div>
</template>

<script setup>
import { computed, ref, onMounted, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useMissionStore } from '@/stores/missionStore';

const missionStore = useMissionStore();
const router = useRouter();
const submitting = ref(false);

// Etats pour snackbars
const errorSnackbar = ref(false);
const infoSnackbar = ref(false);

// Afficher snackbar erreur quand il y a une erreur dans le store
watch(() => missionStore.error, (newError) => {
  if (newError) {
    errorSnackbar.value = true;
  }
});


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
  if (missionStore.missions.length === 0) {
    await loadMissions();
  }
});

// Watcher pour les changements de sélection
availableMissions.value.forEach(mission => {
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

.tooltip-description {
  max-width: 50vw;
  display: inline-block;
  white-space: normal;
  word-break: break-word;
}
</style>
