import api from './axios';

export const userService = {
  /**
   * Récupère le profil de l'utilisateur connecté
   */
  getProfile: async () => {
    const response = await api.get('/users/me');
    return response.data;
  },

  /**
   * Met à jour le profil de l'utilisateur
   */
  updateProfile: async (userData) => {
    const response = await api.put('/users/me', userData);
    return response.data;
  },

  /**
   * Récupère les missions disponibles
   */
  getMissions: async () => {
    const response = await api.get('/missions');
    return response.data['hydra:member'] || [];
  },

  /**
   * Récupère les soumissions de missions de l'utilisateur
   */
  getMissionSubmissions: async () => {
    const response = await api.get('/mission_submissions');
    return response.data['hydra:member'] || [];
  },

  /**
   * Récupère les statistiques de l'utilisateur
   */
  getStats: async () => {
    const response = await api.get('/users/me/stats');
    return response.data;
  },

  /**
   * Récupère le classement de l'utilisateur
   */
  getRanking: async () => {
    const response = await api.get('/rankings');
    return response.data['hydra:member'] || [];
  },

  /**
   * Soumet une nouvelle mission
   */
  submitMission: async (missionData) => {
    const response = await api.post('/mission_submissions', missionData);
    return response.data;
  },

  /**
   * Télécharge l'autorisation de diffusion d'image
   */
  downloadAuthorization: async () => {
    const response = await api.get('/users/me/authorization', {
      responseType: 'blob'
    });
    return response.data;
  }
}; 