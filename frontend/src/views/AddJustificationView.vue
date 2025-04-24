<template>
    <div class="page">
      <div class="d-flex justify-space-between align-center mb-6">
        <h1 class="text-h4">Justifier vos missions</h1>
        <v-btn color="primary" variant="text" prepend-icon="mdi-arrow-left" @click="router.push('/')">
          Retour à la page principale
        </v-btn>
      </div>
  
      <div class="d-flex justify-space-between content">
        <div>
          <v-list density="compact">
            <v-list-subheader>Missions sélectionnées</v-list-subheader>
  
            <v-list-item
              v-for="(item, i) in missions"
              :key="i"
              :value="item"
              color="primary"
              class="mb-4"
              @click="toggleJustification(i)"
            >
              <template v-slot:prepend>
                <v-icon icon="mdi-circle-small"></v-icon>
              </template>
              <v-list-item-title v-text="item.title" />
            </v-list-item>
          </v-list>
        </div>
  
        <div class="mt-8" style="width: 45%;">
          <div v-if="selectedMission && selectedMission.needJustification">
            <h2 class="text-subtitle-1 mb-2">Justification : {{ selectedMission.title }}</h2>
            <v-textarea
              v-model="selectedMission.justification"
              label="Expliquez votre mission"
              auto-grow
              rows="4"
              outlined
            />
            <v-file-input
              v-model="selectedMission.file"
              label="Joindre un fichier"
              accept=".pdf,.doc,.docx,.jpg,.png"
              prepend-icon="mdi-paperclip"
              outlined
              class="mt-4"
            />
          </div>
        </div>
      </div>
  
      <div class="d-flex justify-end mx-2 mt-4">
        <v-btn
          prepend-icon="mdi-file-document-check-outline"
          color="primary"
          @click="AddJustification"
          :disabled="!areAllRequiredMissionsJustified || isSubmitting"
        >
          Valider
        </v-btn>
      </div>
  
      <v-dialog v-model="showValidationMessage" max-width="500">
        <v-card>
          <v-card-title class="text-h6">Missions en attente de validation</v-card-title>
          <v-card-text>
            Vos justificatifs ont bien été transmis. Un administrateur va maintenant les examiner. Vous serez informé dès que votre mission sera validée.
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn color="primary" text @click="redirectToHome">Fermer</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </template>
  
  <script setup>
  import { useMissionStore } from '@/stores/missionStore';
  import { useRouter } from 'vue-router';
  import { computed, ref } from 'vue';
  
  const router = useRouter();
  const missionStore = useMissionStore();
  const missions = missionStore.selectedMissions;
  
  const activeJustificationIndex = ref(null);
  const isSubmitting = ref(false);
  const showValidationMessage = ref(false);
  
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
    activeJustificationIndex.value !== null
      ? missions[activeJustificationIndex.value]
      : null
  );
  
  const areAllRequiredMissionsJustified = computed(() =>
    missions.every(m => {
      if (!m.needJustification) return true;
      return m.justification && m.justification.trim() !== '';
    })
  );
  
  const AddJustification = async () => {
    if (!areAllRequiredMissionsJustified.value) {
      alert("Merci de compléter toutes les justifications obligatoires avant de valider.");
      return;
    }
  
    isSubmitting.value = true;
  
    try {
      const formData = new FormData();
  
      missions.forEach((mission, index) => {
        formData.append(`missions[${index}][id]`, mission.id);
        formData.append(`missions[${index}][title]`, mission.title);
        if (mission.needJustification) {
          formData.append(`missions[${index}][justification]`, mission.justification);
          if (mission.file) {
            formData.append(`missions[${index}][file]`, mission.file);
          }
        }
      });
  
      // Simule l'envoi au serveur
      await new Promise(resolve => setTimeout(resolve, 1000));
  
      showValidationMessage.value = true;
    } catch (err) {
      alert("Erreur lors de la soumission. Veuillez réessayer.");
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
  </style>
  