<template>
  <div class="page">
    <!-- Header -->
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4 font-weight-bold">Justifier vos missions</h1>
      <v-btn color="primary" variant="text" prepend-icon="mdi-arrow-left" @click="router.push('/')">
        Retour à l'accueil
      </v-btn>
    </div>

    <v-container fluid>
      <v-row dense>
        <!-- Liste des missions -->
        <v-col cols="12" md="5">
          <v-sheet elevation="2" class="pa-4 rounded-lg" style="min-height: 380px;">
            <h2 class="text-subtitle-1 font-weight-medium mb-4">Missions sélectionnées</h2>
            <v-list nav density="comfortable">
              <v-list-item v-for="(item, i) in missions" :key="i" :active="i === activeJustificationIndex"
                @click="toggleJustification(i)" class="rounded-lg mb-2">
                <template #prepend>
                  <v-icon :color="isJustificationComplete(item) ? 'green' : 'grey'">
                    {{
                      isJustificationComplete(item)
                        ? 'mdi-checkbox-marked-circle'
                        : 'mdi-checkbox-blank-circle-outline'
                    }}
                  </v-icon>
                </template>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
                <v-list-item-subtitle class="text-caption text-grey-darken-1">
                  {{ getJustificationStatus(item) }}
                </v-list-item-subtitle>
              </v-list-item>
            </v-list>
          </v-sheet>
        </v-col>

        <!-- Zone de justification -->
        <v-col cols="12" md="7">
          <v-sheet elevation="2" class="pa-4 rounded-lg" style="min-height: 380px;">
            <div v-if="selectedMission && selectedMission.needJustification">
              <h2 class="text-subtitle-1 font-weight-medium mb-4">
                Justification pour : <span class="text-primary">{{ selectedMission.title }}</span>
              </h2>
              <v-textarea v-model="selectedMission.justification" label="Expliquez votre mission" auto-grow rows="5"
                outlined hide-details />
              <v-file-input v-model="selectedMission.file" label="Joindre un fichier" accept=".pdf,.doc,.docx,.jpg,.png"
                prepend-icon="mdi-paperclip" outlined class="mt-4" hide-details />

              <v-progress-linear v-if="selectedMission.uploading" indeterminate color="primary" class="mt-2 mb-2" />

              <div v-if="selectedMission.file" class="text-caption mt-2">
                Fichier sélectionné : {{ selectedMission.file.name }}
              </div>
            </div>
            <div v-else-if="selectedMission && !selectedMission.needJustification" class="text-grey text-body-2">
              Aucune justification requise pour cette mission.
            </div>
            <div v-else class="text-grey text-body-2">Sélectionnez une mission à justifier.</div>
          </v-sheet>
        </v-col>
      </v-row>

      <!-- Bouton d'envoi -->
      <v-row>
        <v-col cols="12" class="d-flex justify-end">
          <v-btn color="primary" @click="AddJustification" :loading="isSubmitting">
            Envoyer les justifications
          </v-btn>
        </v-col>
      </v-row>
    </v-container>

    <!-- Snackbar - Justifications incomplètes -->
    <v-snackbar v-model="showSnackbar" location="bottom center" color="error" timeout="3000">
      Merci de compléter toutes les justifications obligatoires avant de valider.
    </v-snackbar>

    <!-- Snackbar - Erreur soumission -->
    <v-snackbar v-model="showErrorSnackbar" location="bottom center" color="error" timeout="4000">
      Une erreur est survenue lors de la soumission. Veuillez réessayer.
    </v-snackbar>

    <!-- Validation dialog -->
    <v-dialog v-model="showValidationMessage" max-width="500">
      <v-card>
        <v-card-title class="text-h6">Missions en attente de validation</v-card-title>
        <v-card-text>
          Vos justificatifs ont bien été transmis. Un administrateur les examinera prochainement.
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn color="primary" @click="redirectToHome">Fermer</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup>
import { useMissionStore } from '@/stores/missionStore';
import { useRouter } from 'vue-router';
import { computed, ref } from 'vue';
import { createMissionSubmission, uploadFile } from '@/api/missionSubmissionService';
import { getCurrentUser } from '@/api/userService';

const router = useRouter();
const missionStore = useMissionStore();
const missions = missionStore.selectedMissions;

const activeJustificationIndex = ref(null);
const isSubmitting = ref(false);
const showValidationMessage = ref(false);
const showSnackbar = ref(false);
const showErrorSnackbar = ref(false);

const toggleJustification = (index) => {
  const mission = missions[index];
  if (!mission.needJustification) {
    activeJustificationIndex.value = null;
    return;
  }
  activeJustificationIndex.value =
    activeJustificationIndex.value === index ? null : index;
};

const selectedMission = computed(() =>
  activeJustificationIndex.value !== null ? missions[activeJustificationIndex.value] : null
);

const isJustificationComplete = (mission) => {
  if (!mission.needJustification) return true;
  return (
    (mission.justification && mission.justification.trim() !== '') ||
    mission.file
  );
};

const getJustificationStatus = (mission) => {
  if (!mission.needJustification) return 'Aucune justification requise';
  return isJustificationComplete(mission)
    ? 'Justification ajoutée'
    : 'Justification requise';
};

const areAllRequiredMissionsJustified = computed(() =>
  missions.every((m) => isJustificationComplete(m))
);

const AddJustification = async () => {
  if (!areAllRequiredMissionsJustified.value) {
    showSnackbar.value = true;
    return;
  }

  isSubmitting.value = true;
  showErrorSnackbar.value = false;

  try {
    const nowIso = new Date().toISOString();
    const user = await getCurrentUser();

    for (const mission of missions) {
      if (mission.needJustification) {
        const formData = new FormData();
        formData.append('mission', `/api/missions/${mission.id}`);
        formData.append('ambassador', `/api/users/${user.id}`);
        formData.append('status', 'submitted');
        formData.append('submissionDate', nowIso);

        if (mission.justification) {
          formData.append('justification', mission.justification);
        }

        if (mission.file) {
          try {
            mission.uploading = true;
            const fileUrl = await uploadFile(mission.file);
            formData.append('proofPath', fileUrl);
            mission.uploading = false;
          } catch (uploadErr) {
            mission.uploading = false;
            console.error(uploadErr);
            throw new Error('Erreur lors de l\'upload du fichier pour une mission');
          }
        }

        await createMissionSubmission(formData);
      }
    }

    showValidationMessage.value = true;
  } catch (err) {
    console.error(err);
    showErrorSnackbar.value = true;
  } finally {
    isSubmitting.value = false;
  }
};

const redirectToHome = () => {
  showValidationMessage.value = false;
  router.push('/');
};
</script>

<style scoped>
.page {
  padding: 32px;
  max-width: 1200px;
  margin: auto;
}

.v-sheet {
  background-color: #ffffff;
}

.v-list-item--active {
  background-color: #e3f2fd !important;
}
</style>
