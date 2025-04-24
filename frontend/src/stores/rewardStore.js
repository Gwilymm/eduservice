import { defineStore } from 'pinia';
import Reward from './Reward';  // Import du modèle Reward
import { ref, computed } from 'vue';

export const useRewardStore = defineStore('reward', () => {
  const rewards = ref([]); // Liste des récompenses
  const selectedReward = ref(null); // Récompense sélectionnée

  // Charger les récompenses (par exemple, après récupération d'une API)
  function loadRewards(data) {
    rewards.value = data.map(rewardData => new Reward(
      rewardData.id,
      rewardData.minPoints,
      rewardData.title,
      rewardData.description,
      rewardData.isUniqueReward
    ));
  }

  // Sélectionner une récompense spécifique
  function selectReward(rewardId) {
    selectedReward.value = rewards.value.find(reward => reward.id === rewardId);
  }

  // Ajouter une récompense
  function addReward(rewardData) {
    const newReward = new Reward(
      rewardData.id,
      rewardData.minPoints,
      rewardData.title,
      rewardData.description,
      rewardData.isUniqueReward
    );
    rewards.value.push(newReward);
  }

  // Retirer une récompense
  function removeReward(rewardId) {
    rewards.value = rewards.value.filter(reward => reward.id !== rewardId);
  }

  // Vérifier les récompenses éligibles pour un utilisateur (en fonction des points)
  const eligibleRewards = computed(() => {
    return rewards.value.filter(reward => reward.isEligible(1000)); // Exemple: 1000 points de l'utilisateur
  });

  // Récompenses uniques (si applicable)
  const uniqueRewards = computed(() => {
    return rewards.value.filter(reward => reward.isUniqueReward);
  });

  return {
    rewards,
    selectedReward,
    loadRewards,
    selectReward,
    addReward,
    removeReward,
    eligibleRewards,
    uniqueRewards
  };
});
