import { defineStore } from 'pinia';
import Mission from '@/models/Mission';  // Import du modèle Mission
import { ref, computed } from 'vue';

export const useMissionStore = defineStore('mission', () => {
  const missions = ref([]); // Liste des missions
  const selectedMission = ref(null); // Mission sélectionnée

  // Charger les missions (par exemple, après récupération d'une API)
  function loadMissions(data) {
    missions.value = data.map(missionData => new Mission(
      missionData.id,
      missionData.name,
      missionData.description,
      missionData.points,
      missionData.challenge,
      missionData.admin,
      missionData.repeatable,
      missionData.maxRepetitions,
      missionData.status
    ));
  }

  // Sélectionner une mission spécifique
  function selectMission(missionId) {
    selectedMission.value = missions.value.find(mission => mission.id === missionId);
  }

  // Ajouter une mission
  function addMission(missionData) {
    const newMission = new Mission(
      missionData.id,
      missionData.name,
      missionData.description,
      missionData.points,
      missionData.challenge,
      missionData.admin,
      missionData.repeatable,
      missionData.maxRepetitions,
      missionData.status
    );
    missions.value.push(newMission);
  }

  // Retirer une mission
  function removeMission(missionId) {
    missions.value = missions.value.filter(mission => mission.id !== missionId);
  }

  // Ajouter une soumission à une mission
  function addMissionSubmission(missionId, submission) {
    const mission = missions.value.find(m => m.id === missionId);
    if (mission) {
      mission.addMissionSubmission(submission);
    }
  }

  // Retirer une soumission d'une mission
  function removeMissionSubmission(missionId, submissionId) {
    const mission = missions.value.find(m => m.id === missionId);
    if (mission) {
      mission.removeMissionSubmission(submissionId);
    }
  }

  // Calculer les missions qui sont répétables
  const repeatableMissions = computed(() => {
    return missions.value.filter(mission => mission.isRepeatable());
  });

  return {
    missions,
    selectedMission,
    loadMissions,
    selectMission,
    addMission,
    removeMission,
    addMissionSubmission,
    removeMissionSubmission,
    repeatableMissions
  };
});
