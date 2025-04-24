import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import path from 'node:path'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      // meta: {
      //   title: "Login",
      //   icon: "",
      // }
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
    {
      path:'/register',
      name: 'register',
      meta: {
        title: "Register",
        icon: "",
      },
      component: () => import('../views/RegisterView.vue'),
    },
    {
      path:'/login',
      name: 'login',
      meta: {
        title: "Login",
        icon: "",
      },
      component: () => import('../views/LoginView.vue'),
    }
  ],
})

export default router
