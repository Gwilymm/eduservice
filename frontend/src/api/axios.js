import axios from 'axios';

/**
 * Configuration du client Axios pour les appels à l'API
 * - baseURL: http://localhost/api (pas de HTTPS, pas de port)
 * - headers: configuration pour API Platform (JSON-LD)
 * - withCredentials: false (pas de cookies/auth pour l'instant)
 */
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || '/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/ld+json',
  },
  withCredentials: false,
  maxRedirects: 0,
});

// Intercepteur pour ajouter le token d'authentification (si besoin plus tard)
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Intercepteur pour gérer les erreurs 401 (non autorisé)
// Redirige vers la page de login si l'utilisateur n'est pas authentifié
// et que la page actuelle n'est pas la page de login
api.interceptors.response.use(
  response => response,
  error => {
    if (error.response?.status === 401 && window.location.pathname !== '/login') {
      localStorage.removeItem('token');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

export default api;