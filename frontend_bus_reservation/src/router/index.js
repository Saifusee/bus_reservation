import Vue from 'vue'
import VueRouter from 'vue-router'
// import store from './../store';

//Importing Main Index Page Component
import indexPageBase from './../components/indexPageBase'
import indexPage from './../components/indexPage'

//Importing Public Page Component
import publicPage from './../components/publicPage'
import loginPage from './../components/publicPage/loginPage'
import registrationPage from './../components/publicPage/registrationPage'
import checkEmailVerification from './../components/publicPage/checkEmailVerification'
import confirmEmailVerification from './../components/publicPage/confirmEmailVerification'
import resendEmailVerification from './../components/publicPage/resendEmailVerification'


//Importing Dashboard Components
import dashboard from './../components/dashboard/dashboard'

//Importing Ticket Components
import createTicket from './../components/tickets/createTicket'
import editTicket from './../components/tickets/editTicket'
import allTicket from './../components/tickets/allTicket'

//Importing Partner Travels Components
import createPartnerTravels from './../components/partnerTravels/createPartnerTravels'
import editPartnerTravels from './../components/partnerTravels/editPartnerTravels'
import allPartnerTravels from './../components/partnerTravels/allPartnerTravels'

//Importing Pickup Point Components
import createPickupPoint from './../components/pickupPoint/createPickupPoint'
import editPickupPoint from './../components/pickupPoint/editPickupPoint'
import allPickupPoint from './../components/pickupPoint/allPickupPoint'


//Importing Miscellaneous Components
import notFound404 from './../components/miscComponent/notFound404'



Vue.use(VueRouter)

const routes = [

  //Main Index Page Component Route
  { path: '/', component: indexPageBase,
    children:
    [
      { path: '/', component: indexPage, 
        children:
        [
          //Dashboard Components Routes
          { path: '/', name: 'dashboard', component: dashboard },
        
          //Ticket Components Routes
          {path: '/create-ticket', name: 'createTicket', component: createTicket},
          {path: '/all-ticket', name: 'allTicket', component: allTicket},
          {path: '/:ticket_id/all-tickets', name: 'editTicket', component: editTicket},
        
          //Partner Travels Components Routes
          {path: '/create-partner-travels',  name: 'createPartnerTravels', component: createPartnerTravels},
          {path: '/all-partner-travels', name: 'allPartnerTravels', component: allPartnerTravels},
          {path: '/:partner_travels_id/all-partner-travels', name: 'editPartnerTravels', component: editPartnerTravels},
        
          //Pickup Point Components Routes
          {path: '/create-pickup-point', name: 'createPickupPoint', component: createPickupPoint},
          {path: '/all-pickup-point', name: 'allPickupPoint', component: allPickupPoint},
          {path: '/:pickup_point_id/all-pickup-point', name: 'editPickupPoint', component: editPickupPoint},
        ] 
      }
    ]   
  },





  //Public Page Component Route
  { path: '/', component: publicPage, children:
    [
      //Login Components Routes
      {path: '/login', name: 'loginPage', component: loginPage},
      
      //Registration Components Routes
      {path: '/registration', name: 'registrationPage', component: registrationPage},

      //Email Verification Components Routes
      {path: '/registration-success', name: 'checkEmailVerification', component: checkEmailVerification},
      {path: '/verify-email/:token/verify/:id', name: 'confirmEmailVerification', component: confirmEmailVerification},
      {path: '/resend-email/:user_id/verification', name: 'resendEmailVerification', component: resendEmailVerification},
    ] 
  },





  //Miscellaneous Components Routes
  {path: '*', name: 'notFound404', component: notFound404},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.VUE_APP_VUE_APP_FRONTEND_DOMAIN_URL,
  routes
})

export default router
