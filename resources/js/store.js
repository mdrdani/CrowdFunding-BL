import Vue from 'vue'
import Vuex from 'vuex'
import transaction from './stores/transaction'
import alert from './stores/alert'
import auth from './stores/auth'
import dialog from './stores/dialog'
import VuexPersist from 'vuex-persist'
import moment from 'moment'

const vuexPersist = new VuexPersist({
    key :  'sanbercode',
    storage : sessionStorage
})

Vue.use(Vuex)
Vue.filter('formatDate', function(value) {
    if(value) {
        return moment(String(value)).locale("id").format('LL')
    }
})

export default new Vuex.Store({
    plugins : [vuexPersist.plugin],
    modules: {
        transaction,
        alert,
        auth,
        dialog
    }
})