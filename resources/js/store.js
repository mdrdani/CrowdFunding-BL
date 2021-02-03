import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './stores/transaction'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        transaction
    }
})