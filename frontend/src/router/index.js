import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        requiresAuth: true,
        title: "Accueil - Eduservices"
      }
    },
    {
      path: '/missions',
      name: 'missions',
      component: () => import('@/views/MissionsView.vue'),
      meta: {
        requiresAuth: true,
        title: "Mes missions - Eduservices"
      }
    },
    {
      path: '/missions/add',
      name: 'add-mission',
      component: () => import('@/views/AddMissionView.vue'),
      meta: {
        requiresAuth: true,
        title: "Ajouter une mission - Eduservices"
      }

    },
    {
      path: '/justifications',
      name: 'justifications',
      component: () => import('@/views/AddJustificationView.vue'),
      meta: {
        requiresAuth: true,
        title: "Justifications - Eduservices"
      }
    },
    {
      path: '/register',
      name: 'register',
      meta: {
        requiresAuth: false,
        title: "S'inscrire - Eduservices",
        icon: "",
      },
      component: () => import('../views/RegisterView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      meta: {
        requiresAuth: false,
        title: "Se connecter - Eduservices",
        icon: "",
      },
      component: () => import('../views/LoginView.vue'),
      meta: { requiresAuth: false }
    },
    {
      path: '/rewards',
      name: 'cadeaux',
      meta: {
        title: "Cadeaux",
        icon: "",
        requiresAuth: true
      },
      component: () => import('../views/RewardView.vue'),
    }
  ],
})

router.beforeEach((to, from, next) => {
  const auth = useAuthStore()
  const logged = auth.isLogged
  const defaultTitle = 'Challenge Ambassadeur - Eduservices'
  document.title = to.meta.title || defaultTitle

  // Routes protégées
  if (to.meta.requiresAuth && !logged) {
    return next({
      name: 'login',
      query: { redirect: to.fullPath }
    })
  }
  // Empêcher l’accès au login/register si déjà connecté
  if ((to.name === 'login' || to.name === 'register') && logged) {
    return next({ name: 'home' })
  }
  next()
})



export default router
