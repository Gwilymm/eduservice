import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:5173/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/ld+json',
  },
  // Désactiver la redirection automatique
  maxRedirects: 0,
});

// Intercepteur pour ajouter le token d'authentification
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  // Forcer l'utilisation de HTTP
  if (config.url && config.url.startsWith('https://')) {
    config.url = config.url.replace('https://', 'http://');
  }
  return config;
});

// Intercepteur pour gérer les erreurs
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

export default api; 