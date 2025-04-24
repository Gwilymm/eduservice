import api from './axios';

/**
 * Service pour gérer les appels API liés aux challenges
 * Généré automatiquement à partir du fichier swagger_docs.json
 * Ressource: challenge
 */

/**
 * Récupère la liste de tous les challenges
 * @param {Object} params - Paramètres de requête (pagination, etc.)
 * @returns {Promise} - Réponse de l'API
 */
export async function getAllChallenges(params = { page: 1 }) {
	try {
		const response = await api.get('/challenges', { params });
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la récupération des challenges:', error);
		throw error;
	}
}

/**
 * Récupère un challenge par son ID
 * @param {string|number} id - ID du challenge à récupérer
 * @returns {Promise} - Réponse de l'API
 */
export async function getChallengeById(id) {
	try {
		const response = await api.get(`/challenges/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la récupération du challenge ${id}:`, error);
		throw error;
	}
}

/**
 * Crée un nouveau challenge
 * @param {Object} payload - Données du challenge à créer
 * @returns {Promise} - Réponse de l'API
 */
export async function createChallenge(payload) {
	try {
		const response = await api.post('/challenges', payload);
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la création du challenge:', error);
		throw error;
	}
}

/**
 * Met à jour un challenge existant
 * @param {string|number} id - ID du challenge à mettre à jour
 * @param {Object} payload - Données à mettre à jour
 * @returns {Promise} - Réponse de l'API
 */
export async function updateChallenge(id, payload) {
	try {
		const response = await api.patch(`/challenges/${id}`, payload);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la mise à jour du challenge ${id}:`, error);
		throw error;
	}
}

/**
 * Supprime un challenge
 * @param {string|number} id - ID du challenge à supprimer
 * @returns {Promise} - Réponse de l'API
 */
export async function deleteChallenge(id) {
	try {
		const response = await api.delete(`/challenges/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la suppression du challenge ${id}:`, error);
		throw error;
	}
}

export default {
	getAllChallenges,
	getChallengeById,
	createChallenge,
	updateChallenge,
	deleteChallenge
};