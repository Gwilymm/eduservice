import api from './axios';

/**
 * Récupère la liste de toutes les récompenses
 * @returns {Promise<Array>} - Liste des récompenses
 */
export async function getAllRewards() {
  try {
    const response = await api.get('/rewards');
    return response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération des récompenses :', error);
    throw error;
  }
}

/**
 * Récupère la meilleure récompense disponible selon le nombre de points utilisateur
 * @param {number} userPoints - Nombre de points de l'utilisateur
 * @returns {Promise<Object|null>} - La récompense correspondante ou null si aucune
 */
export async function getRewardForPoints(userPoints) {
  try {
    const rewards = await getAllRewards();
    // Filtrer et trier les récompenses selon les points
    const availableRewards = rewards.member
      .filter(reward => reward.minPoints <= userPoints)
      .sort((a, b) => b.points - a.points); // Tri décroissant

    return availableRewards.length > 0 ? availableRewards[0] : null;
  } catch (error) {
    console.error('Erreur lors de la recherche de la récompense :', error);
    throw error;
  }
}