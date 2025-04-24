import { defineStore } from 'pinia';
import Challenge from './Challenge';  // Import du modèle Challenge
import { ref, computed } from 'vue';

export const useChallengeStore = defineStore('challenge', () => {
  const challenges = ref([]); // Liste des challenges
  const selectedChallenge = ref(null); // Challenge sélectionné

  // Charger les challenges (par exemple, après récupération d'une API)
  function loadChallenges(data) {
    challenges.value = data.map(challengeData => new Challenge(
      challengeData.id,
      challengeData.academicYear,
      challengeData.missionEnd,
      challengeData.sponsorshipEnd
    ));
  }

  // Sélectionner un challenge spécifique
  function selectChallenge(challengeId) {
    selectedChallenge.value = challenges.value.find(challenge => challenge.id === challengeId);
  }

  // Ajouter un challenge
  function addChallenge(challengeData) {
    const newChallenge = new Challenge(
      challengeData.id,
      challengeData.academicYear,
      challengeData.missionEnd,
      challengeData.sponsorshipEnd
    );
    challenges.value.push(newChallenge);
  }

  // Retirer un challenge
  function removeChallenge(challengeId) {
    challenges.value = challenges.value.filter(challenge => challenge.id !== challengeId);
  }

  // Ajouter une mission à un challenge
  function addMissionToChallenge(challengeId, mission) {
    const challenge = challenges.value.find(ch => ch.id === challengeId);
    if (challenge) {
      challenge.addMission(mission);
    }
  }

  // Retirer une mission d'un challenge
  function removeMissionFromChallenge(challengeId, missionId) {
    const challenge = challenges.value.find(ch => ch.id === challengeId);
    if (challenge) {
      challenge.removeMission(missionId);
    }
  }

  // Ajouter un classement à un challenge
  function addRankingToChallenge(challengeId, ranking) {
    const challenge = challenges.value.find(ch => ch.id === challengeId);
    if (challenge) {
      challenge.addRanking(ranking);
    }
  }

  // Retirer un classement d'un challenge
  function removeRankingFromChallenge(challengeId, rankingId) {
    const challenge = challenges.value.find(ch => ch.id === challengeId);
    if (challenge) {
      challenge.removeRanking(rankingId);
    }
  }

  // Calculer le nombre de challenges en cours
  const ongoingChallenges = computed(() => {
    return challenges.value.filter(challenge => !challenge.isChallengeFinished());
  });

  return {
    challenges,
    selectedChallenge,
    loadChallenges,
    selectChallenge,
    addChallenge,
    removeChallenge,
    addMissionToChallenge,
    removeMissionFromChallenge,
    addRankingToChallenge,
    removeRankingFromChallenge,
    ongoingChallenges
  };
});
