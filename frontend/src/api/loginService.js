import api from './axios';

/**
 * Service pour gérer l'authentification des utilisateurs
 * Généré automatiquement à partir du fichier swagger_docs.json
 * Ressource: Login Check
 */

/**
 * Connecte un utilisateur et récupère un token JWT
 * @param {Object} credentials - Identifiants de l'utilisateur
 * @param {string} credentials.email - Email de l'utilisateur
 * @param {string} credentials.password - Mot de passe de l'utilisateur
 * @returns {Promise} - Réponse de l'API contenant le token
 */
export async function login(credentials) {
	try {
		const response = await api.post('/login', credentials);
		return response.data;
	} catch (error) {
		console.error('Erreur lors de la connexion:', error);
		throw error;
	}
}

export default {
	login
};