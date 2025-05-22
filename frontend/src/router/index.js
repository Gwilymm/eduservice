import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/auth'
import path from 'node:path'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }
      // meta: {
      //   title: "Login",
      //   icon: "",
      // }
    },
    {
      path: '/missions',
      name: 'missions',
      component: () => import('@/views/MissionsView.vue'),
      meta: { requiresAuth: true }
    },
    {
      path: '/missions/add',
      name: 'add-mission',
      component: () => import('@/views/AddMissionView.vue'),
      meta: { requiresAuth: true }

    },
    {
      path: '/justifications',
      name: 'justifications',
      component: () => import('@/views/AddJustificationView.vue'),
      meta: { requiresAuth: true }
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
      meta: { requiresAuth: true }

    },
    {
      path: '/register',
      name: 'register',
      meta: {
        title: "Register",
        icon: "",
      },
      component: () => import('../views/RegisterView.vue'),
      meta: { requiresAuth: false }
    },
    {
      path: '/login',
      name: 'login',
      meta: {
        title: "Login",
        icon: "",
      },
      component: () => import('../views/LoginView.vue'),
      meta: { requiresAuth: false }
    },
    {
      path:'/rewards',
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
