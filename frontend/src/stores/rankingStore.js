import { defineStore } from 'pinia';
import Ranking from './Ranking'; // Import du modèle Ranking
import { ref, computed } from 'vue';

export const useRankingStore = defineStore('ranking', () => {
  const rankings = ref([]); // Liste des classements
  const selectedChallengeRankings = ref([]); // Classements pour un challenge sélectionné
  const selectedAmbassadorRanking = ref(null); // Classement d'un ambassadeur spécifique

  // Fonction pour charger les classements
  function loadRankings(data) {
    rankings.value = data.map(rankingData => new Ranking(
      rankingData.id,
      rankingData.ambassador,  // L'instance de User pour l'ambassadeur
      rankingData.challenge    // L'instance de Challenge pour le challenge
    ));
  }

  // Sélectionner les classements d'un challenge spécifique
  function selectChallengeRankings(challengeId) {
    selectedChallengeRankings.value = rankings.value.filter(ranking => ranking.challenge.id === challengeId);
  }

  // Sélectionner le classement d'un ambassadeur spécifique
  function selectAmbassadorRanking(ambassadorId) {
    selectedAmbassadorRanking.value = rankings.value.find(ranking => ranking.ambassador.id === ambassadorId);
  }

  // Ajouter un classement pour un ambassadeur et un challenge
  function addRanking(ambassador, challenge) {
    const newRanking = new Ranking(null, ambassador, challenge);  // L'ID pourrait être généré ou défini par une API
    rankings.value.push(newRanking);
  }

  // Mettre à jour un classement pour un ambassadeur et un challenge
  function updateRanking(ambassador, challenge) {
    const ranking = rankings.value.find(r => r.ambassador.id === ambassador.id && r.challenge.id === challenge.id);
    if (ranking) {
      ranking.updateRanking(ambassador, challenge);
    }
  }

  return {
    rankings,
    selectedChallengeRankings,
    selectedAmbassadorRanking,
    loadRankings,
    selectChallengeRankings,
    selectAmbassadorRanking,
    addRanking,
    updateRanking
  };
});
