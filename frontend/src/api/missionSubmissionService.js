import api from './axios';

/**
 * Service pour gérer les appels API liés aux soumissions de missions
 * Généré automatiquement à partir du fichier swagger_docs.json
 * Ressource: MissionSubmission
 */

/**
 * Récupère la liste de toutes les soumissions de missions
 * @param {Object} params - Paramètres de requête (pagination, etc.)
 * @returns {Promise} - Réponse de l'API
 */
export async function getAllMissionSubmissions(params = { page: 1 }) {
	try {
		const response = await api.get('/mission_submissions', { params });
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la récupération des soumissions de missions:', error);
		throw error;
	}
}

/**
 * Récupère une soumission de mission par son ID
 * @param {string|number} id - ID de la soumission de mission à récupérer
 * @returns {Promise} - Réponse de l'API
 */
export async function getMissionSubmissionById(id) {
	try {
		const response = await api.get(`/mission_submissions/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la récupération de la soumission de mission ${id}:`, error);
		throw error;
	}
}

/**
 * Crée une nouvelle soumission de mission
 * @param {Object} payload - Données de la soumission de mission à créer
 * @returns {Promise} - Réponse de l'API
 */
export async function createMissionSubmission(payload) {
	try {
		const response = await api.post('/mission_submissions', payload);
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la création de la soumission de mission:', error);
		throw error;
	}
}

/**
 * Met à jour une soumission de mission existante
 * @param {string|number} id - ID de la soumission de mission à mettre à jour
 * @param {Object} payload - Données à mettre à jour
 * @returns {Promise} - Réponse de l'API
 */
export async function updateMissionSubmission(id, payload) {
	try {
		const response = await api.patch(`/mission_submissions/${id}`, payload);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la mise à jour de la soumission de mission ${id}:`, error);
		throw error;
	}
}

/**
 * Supprime une soumission de mission
 * @param {string|number} id - ID de la soumission de mission à supprimer
 * @returns {Promise} - Réponse de l'API
 */
export async function deleteMissionSubmission(id) {
	try {
		const response = await api.delete(`/mission_submissions/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la suppression de la soumission de mission ${id}:`, error);
		throw error;
	}
}

export default {
	getAllMissionSubmissions,
	getMissionSubmissionById,
	createMissionSubmission,
	updateMissionSubmission,
	deleteMissionSubmission
};