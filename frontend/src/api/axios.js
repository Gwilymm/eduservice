// src/api/axios.js
import axios from 'axios'
import { useAuthStore } from '@/stores/auth'
import router from '@/router'

/**
 * Configuration du client Axios pour les appels à l'API
 * - baseURL: défini par VITE_API_URL ou '/api'
 * - headers: configuration pour API Platform (JSON-LD)
 * - withCredentials: false (pas de cookies/auth)
 */
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || '/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/ld+json',
  },
  withCredentials: false,
  maxRedirects: 0,
})

// Intercepteur pour ajouter le token d'authentification
api.interceptors.request.use((config) => {
  const auth = useAuthStore()
  const token = auth.token

  // N’ajoute le header QUE si :
  // 1) un token existe
  // 2) l'URL de la requête ne contient pas '/login'
  if (token && config.url && !config.url.includes('/login')) {
    config.headers.Authorization = `Bearer ${token}`
  }

  return config
})

// Intercepteur pour gérer les erreurs 401 (Unauthorized)
// Si on reçoit un 401 et qu’on n’est pas déjà sur /login, on purge le token via le store et on redirige
api.interceptors.response.use(
  response => response,
  error => {
    const status = error.response?.status
    const isOnLogin = router.currentRoute.value.name === 'login'

    if (status === 401 && !isOnLogin) {
      const auth = useAuthStore()
      auth.logout()            // vide token & state
      router.push({ name: 'login' })
    }

    return Promise.reject(error)
  }
)

export default api
