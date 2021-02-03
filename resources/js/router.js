import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router ({
    mode: 'history',
    routes: [
    {
        path: '/',
        name: 'home',
        alias: '/home',
        component: () => import ('./views/Home.vue')
    },
    {
        path: '/donations',
        name: 'donations',
        component: () => import ('./views/Donations.vue')
    },
    {
        path: '/campaigns',
        name: 'campaigns',
        component: () => import ('./views/Campaigns.vue')
    },
    {
        path: '/campaign/:id',
        name: 'campaign',
        component: () => import ('./views/Campaign.vue')
    },
    {
        path: '*',
        redirect: '/'
    }
    ]
});

export default router