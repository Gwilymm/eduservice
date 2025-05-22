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