import api from './axios';

/**
 * Service pour gérer les appels API liés aux classements (rankings)
 * Généré automatiquement à partir du fichier swagger_docs.json
 * Ressource: Ranking
 */

/**
 * Récupère la liste de tous les classements
 * @param {Object} params - Paramètres de requête (pagination, etc.)
 * @returns {Promise} - Réponse de l'API
 */
export async function getAllRankings(params = { page: 1 }) {
	try {
		const response = await api.get('/rankings', { params });
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la récupération des classements:', error);
		throw error;
	}
}

/**
 * Récupère un classement par son ID
 * @param {string|number} id - ID du classement à récupérer
 * @returns {Promise} - Réponse de l'API
 */
export async function getRankingById(id) {
	try {
		const response = await api.get(`/rankings/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la récupération du classement ${id}:`, error);
		throw error;
	}
}

/**
 * Crée un nouveau classement
 * @param {Object} payload - Données du classement à créer
 * @returns {Promise} - Réponse de l'API
 */
export async function createRanking(payload) {
	try {
		const response = await api.post('/rankings', payload);
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la création du classement:', error);
		throw error;
	}
}

/**
 * Met à jour un classement existant
 * @param {string|number} id - ID du classement à mettre à jour
 * @param {Object} payload - Données à mettre à jour
 * @returns {Promise} - Réponse de l'API
 */
export async function updateRanking(id, payload) {
	try {
		const response = await api.patch(`/rankings/${id}`, payload);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la mise à jour du classement ${id}:`, error);
		throw error;
	}
}

/**
 * Supprime un classement
 * @param {string|number} id - ID du classement à supprimer
 * @returns {Promise} - Réponse de l'API
 */
export async function deleteRanking(id) {
	try {
		const response = await api.delete(`/rankings/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la suppression du classement ${id}:`, error);
		throw error;
	}
}

export default {
	getAllRankings,
	getRankingById,
	createRanking,
	updateRanking,
	deleteRanking
};