import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {}

export default new Vuetify({
    theme: {
        themes: {
            light: {
                buttongreen : '#2C6D6A'
            }
        }
    }
})