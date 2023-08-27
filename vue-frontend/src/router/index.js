import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/pages/:slug',
      name: 'pages',
      component: () => import('../views/SinglePageView.vue')
    }
  ]
})

export default router
