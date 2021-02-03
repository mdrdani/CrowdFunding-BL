import Vue from 'vue'
import router from './router.js'
import App from './App.vue'
import store from'./store.js'
import vuetify from './plugins/vuetify.js'
import './bootstrap.js'

const app = new Vue({
    el : '#app',
    router,
    store,
    vuetify,
    components: {
        App
    }
})
