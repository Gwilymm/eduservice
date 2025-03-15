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
      path: '/missions',
      name: 'missions',
      component: () => import('@/views/MissionsView.vue')
    },
    {
      path: '/missions/add',
      name: 'add-mission',
      component: () => import('@/views/AddMissionView.vue')
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
    }
  ],
})

export default router
