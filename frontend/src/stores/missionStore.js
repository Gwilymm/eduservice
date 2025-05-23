import { defineStore } from 'pinia';
import Mission from '@/models/Mission';
import { getAllMissions, getCurrentChallengeMissions } from '@/api/missionService';
import { ref, computed } from 'vue';

export const useMissionStore = defineStore('mission', () => {
  const missions = ref([]); // Liste des missions disponibles
  const selectedMission = ref(null); // Mission sélectionnée
  const selectedMissions = ref([]); // Missions sélectionnées multiples
  const loading = ref(false);
  const error = ref(null);

  // Récupérer toutes les missions depuis l'API
  async function fetchMissions(params = { page: 1 }) {
    loading.value = true;
    error.value = null;

    try {
      const response = await getCurrentChallengeMissions();
      const missionsData = response.data || response;
      missions.value = missionsData.member.map(missionData => new Mission(
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

      return missions.value;
    } catch (err) {
      error.value = err.message || 'Erreur lors de la récupération des missions';
      console.error('Erreur lors de la récupération des missions:', err);
      throw err;
    } finally {
      loading.value = false;
    }
  }

  // Charger les missions (pour compatibilité avec l'ancien code)
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

  // Définir les missions sélectionnées (avec transformation pour la page justification)
  function setSelectedMissions(selectedMissionsList) {
    selectedMissions.value = selectedMissionsList.map(mission => ({
      ...mission,
      title: mission.name, // Compatibilité avec la page justification
      justification: '',
      file: null
    }));
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

  // Réinitialiser les missions sélectionnées
  function clearSelectedMissions() {
    selectedMissions.value = [];
  }

  return {
    missions,
    selectedMission,
    selectedMissions,
    loading,
    error,
    fetchMissions,
    loadMissions,
    selectMission,
    setSelectedMissions,
    clearSelectedMissions,
    addMission,
    removeMission,
    addMissionSubmission,
    removeMissionSubmission,
    repeatableMissions
  };
});