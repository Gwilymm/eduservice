import api from './axios';

/**
 * Service pour gérer les appels API liés aux utilisateurs
 * Génère automatiquement à partir du fichier swagger_docs.json
 * Ressource: users
 */

/**
 * Récupère la liste de tous les utilisateurs
 * @param {Object} params - Paramètres de requête (pagination, etc.)
 * @returns {Promise} - Réponse de l'API
 */
export async function getAllUsers(params = { page: 1 }) {
  try {
    const response = await api.get('/users', { params });
    return response.data;
  } catch (error) {
    console.error('Erreur lors de la récupération des utilisateurs:', error);
    throw error;
  }
}

/**
 * Récupère un utilisateur par son ID
 * @param {string|number} id - ID de l'utilisateur à récupérer
 * @returns {Promise} - Réponse de l'API
 */
export async function getUserById(id) {
  try {
    const response = await api.get(`/users/${id}`);
    return response.data;
  } catch (error) {
    console.error(`Erreur lors de la récupération de l'utilisateur ${id}:`, error);
    throw error;
  }
}

/**
 * Crée un nouvel utilisateur (inscription)
 * @param {Object} payload - Données de l'utilisateur à créer
 * @returns {Promise} - Réponse de l'API
 */
export async function createUser(payload) {
  try {
    const response = await api.post('/register', payload);
    return response.data;
  } catch (error) {
    console.error('Erreur lors de la création de l\'utilisateur:', error);
    throw error;
  }
}

/**
 * Met à jour un utilisateur existant
 * @param {string|number} id - ID de l'utilisateur à mettre à jour
 * @param {Object} payload - Données à mettre à jour
 * @returns {Promise} - Réponse de l'API
 */
export async function updateUser(id, payload) {
  try {
    const response = await api.patch(`/users/${id}`, payload);
    return response.data;
  } catch (error) {
    console.error(`Erreur lors de la mise à jour de l'utilisateur ${id}:`, error);
    throw error;
  }
}

/**
 * Supprime un utilisateur
 * @param {string|number} id - ID de l'utilisateur à supprimer
 * @returns {Promise} - Réponse de l'API
 */
export async function deleteUser(id) {
  try {
    const response = await api.delete(`/users/${id}`);
    return response.data;
  } catch (error) {
    console.error(`Erreur lors de la suppression de l'utilisateur ${id}:`, error);
    throw error;
  }
}

/**
 * Authentifie un utilisateur et récupère un token JWT
 * @param {Object} credentials - Identifiants (email, password)
 * @returns {Promise} - Réponse de l'API avec le token JWT
 */
export async function loginUser(credentials) {
  try {
    const response = await api.post('/login', credentials);
    return response.data;
  } catch (error) {
    console.error('Erreur lors de l\'authentification:', error);
    throw error;
  }
}

export default {
  getAllUsers,
  getUserById,
  createUser,
  updateUser,
  deleteUser,
  loginUser
};