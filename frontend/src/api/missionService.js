import api from './axios';

/**
 * Service pour gérer les appels API liés aux missions
 * Généré automatiquement à partir du fichier swagger_docs.json
 * Ressource: mission
 */

/**
 * Récupère la liste de toutes les missions
 * @param {Object} params - Paramètres de requête (pagination, etc.)
 * @returns {Promise} - Réponse de l'API
 */
export async function getAllMissions(params = { page: 1 }) {
	try {
		const response = await api.get('/missions', { params });
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la récupération des missions:', error);
		throw error;
	}
}



/**
 * Récupère une mission par son ID
 * @param {string|number} id - ID de la mission à récupérer
 * @returns {Promise} - Réponse de l'API
 */
export async function getMissionById(id) {
	try {
		const response = await api.get(`/missions/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la récupération de la mission ${id}:`, error);
		throw error;
	}
}

/**
 * Crée une nouvelle mission
 * @param {Object} payload - Données de la mission à créer
 * @returns {Promise} - Réponse de l'API
 */
export async function createMission(payload) {
	try {
		const response = await api.post('/missions', payload);
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la création de la mission:', error);
		throw error;
	}
}

/**
 * Met à jour une mission existante
 * @param {string|number} id - ID de la mission à mettre à jour
 * @param {Object} payload - Données à mettre à jour
 * @returns {Promise} - Réponse de l'API
 */
export async function updateMission(id, payload) {
	try {
		const response = await api.patch(`/missions/${id}`, payload);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la mise à jour de la mission ${id}:`, error);
		throw error;
	}
}

/**
 * Supprime une mission
 * @param {string|number} id - ID de la mission à supprimer
 * @returns {Promise} - Réponse de l'API
 */
export async function deleteMission(id) {
	try {
		const response = await api.delete(`/missions/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la suppression de la mission ${id}:`, error);
		throw error;
	}
}

/**
 * Récupère les missions du challenge en cours (ex: 2024/2025)
 * @returns {Promise} - Réponse de l'API
 */
export async function getCurrentChallengeMissions() {
	try {
		// 1. Récupérer le challenge en cours (ex: missionEnd > now)
		const challenges = await api.get('/challenges');
		const now = new Date();
		const currentChallenge = challenges.data['member']
			.find(c => {
				const end = new Date(c.missionEnd);
				return end > now;
			});
		if (!currentChallenge) throw new Error('Aucun challenge en cours trouvé');
		// 2. Récupérer les missions de ce challenge
		const missions = await api.get(`/missions?challenge=${currentChallenge['@id']}`);
		return missions.data;
	} catch (error) {
		console.error('Erreur lors de la récupération des missions du challenge en cours:', error);
		throw error;
	}
}

export default {
	getAllMissions,
	getMissionById,
	createMission,
	updateMission,
	deleteMission,
	getCurrentChallengeMissions
};