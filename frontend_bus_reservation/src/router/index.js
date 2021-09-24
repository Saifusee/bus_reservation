import Vue from 'vue'
import VueRouter from 'vue-router'
import dashboard from './../components/subComponents/dashboard'
import createTicket from './../components/subComponents/createTicket'
import allTicket from './../components/subComponents/allTicket'
import createPickupPoint from './../components/subComponents/createPickupPoint'
import allPickupPoint from './../components/subComponents/allPickupPoint'
import createPartnerTravels from './../components/subComponents/createPartnerTravels'
import editPartnerTravels from './../components/subComponents/editPartnerTravels'
import allPartnerTravels from './../components/subComponents/allPartnerTravels'


Vue.use(VueRouter)

const routes = [
  { path: '/', name: 'dashboard', component: dashboard },
  {path: '/create-ticket', name: 'createTicket', component: createTicket},
  {path: '/all-ticket', name: 'allTicket', component: allTicket},
  {path: '/create-partner-travels',  name: 'createPartnerTravels', component: createPartnerTravels},
  {path: '/all-partner-travels', name: 'allPartnerTravels', component: allPartnerTravels},
  {path: '/:partner_travels_id/all-partner-travels', name: 'editPartnerTravels', component: editPartnerTravels},
  {path: '/create-pickup-point', name: 'createPickupPoint', component: createPickupPoint},
  {path: '/all-pickup-point', name: 'allPickupPoint', component: allPickupPoint},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.VUE_APP_VUE_APP_FRONTEND_DOMAIN_URL,
  routes
})

export default router
