import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AddEstudiante from '../views/AddEstudiante.vue'
import UpdateEstudiante from '../views/UpdateEstudiante.vue'
import DetailEstudiante from '../views/DetailEstudiante.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/addEstudiante',
    name: 'AddE',
    component: AddEstudiante
  },
  {
    path: '/updateEstudiante/:id',
    name: 'UpdateE',
    component: UpdateEstudiante
  },
  {
    path: '/detailEstudiante/:id',
    name: 'DetailsE',
    component: DetailEstudiante
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
