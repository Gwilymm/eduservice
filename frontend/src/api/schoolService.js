import api from './axios';

/**
 * Service pour gérer les opérations liées aux écoles
 * Généré automatiquement à partir du fichier swagger_docs.json
 * Ressource: School
 */

/**
 * Récupère la liste de toutes les écoles
 * @param {Object} params - Paramètres de requête (pagination, etc.)
 * @returns {Promise} - Réponse de l'API
 */
export async function getAllSchools(params = { page: 1 }) {
	try {
		const response = await api.get('/schools', { params });

		let schools = [];

		if (response.data && response.data[ 'hydra:member' ]) {
			// Format API Platform avec hydra
			schools = response.data[ 'hydra:member' ];
		} else if (response.data && response.data.member) {
			// Format alternatif avec clé member directe
			schools = response.data.member;
		} else if (response.data && Array.isArray(response.data)) {
			// Format JSON array standard
			schools = response.data;
		} else {
			return [];
		}

		return schools;
	} catch (error) {
		console.error('Erreur lors de la récupération des écoles:', error);
		throw error;
	}
}

/**
 * Récupère une école par son ID
 * @param {string|number} id - ID de l'école à récupérer
 * @returns {Promise} - Réponse de l'API
 */
export async function getSchoolById(id) {
	try {
		const response = await api.get(`/schools/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la récupération de l'école ${id}:`, error);
		throw error;
	}
}

/**
 * Crée une nouvelle école
 * @param {Object} payload - Données de l'école à créer
 * @param {string} payload.name - Nom de l'école
 * @returns {Promise} - Réponse de l'API
 */
export async function createSchool(payload) {
	try {
		const response = await api.post('/schools', payload);
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la création de l\'école:', error);
		throw error;
	}
}

/**
 * Met à jour une école existante
 * @param {string|number} id - ID de l'école à mettre à jour
 * @param {Object} payload - Données à mettre à jour
 * @returns {Promise} - Réponse de l'API
 */
export async function updateSchool(id, payload) {
	try {
		const response = await api.patch(`/schools/${id}`, payload);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la mise à jour de l'école ${id}:`, error);
		throw error;
	}
}

/**
 * Supprime une école
 * @param {string|number} id - ID de l'école à supprimer
 * @returns {Promise} - Réponse de l'API
 */
export async function deleteSchool(id) {
	try {
		const response = await api.delete(`/schools/${id}`);
		return response.data;
	} catch (error) {
		console.error(`Erreur lors de la suppression de l'école ${id}:`, error);
		throw error;
	}
}

/**
 * Récupère uniquement les noms des écoles
 * @returns {Promise<Array<string>>} Liste des noms d'écoles
 */
export async function getSchoolNames() {
	try {
		const schools = await getAllSchools();
		return schools.map(school => school.name);
	} catch (error) {
		console.error('Erreur lors de la récupération des noms d\'écoles:', error);
		return [];
	}
}

export default {
	getAllSchools,
	getSchoolById,
	createSchool,
	updateSchool,
	deleteSchool,
	getSchoolNames
};