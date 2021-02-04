import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './stores/transaction'
import alert from './stores/alert'
import auth from './stores/auth'
import dialog from './stores/dialog'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        transaction,
        alert,
        auth,
        dialog
    }
})