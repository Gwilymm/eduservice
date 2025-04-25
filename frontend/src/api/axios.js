import axios from 'axios';

/**
 * Configuration du client Axios pour les appels à l'API
 * - baseURL: http://localhost/api (pas de HTTPS, pas de port)
 * - headers: configuration pour API Platform (JSON-LD)
 * - withCredentials: false (pas de cookies/auth pour l'instant)
 */
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost/api',
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