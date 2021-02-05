<template>
    <v-card>
        <v-toolbar color="dark--text">
            <v-btn icon @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Login</v-toolbar-title>
            <v-subheader>Sign to Continue </v-subheader>
        </v-toolbar>
        <v-divider></v-divider>

        <v-container fluid>
            <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
                append-icon="mdi-email"
                ></v-text-field>

                <v-text-field
                v-model="password"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="passwordRules"
                :type="showPassword ? 'text' : 'password' "
                label="Password"
                hint="at least 6 characters"
                counter
                @click:append="showPassword = !showPassword"
                ></v-text-field>

                <div class="text-xs-center">
                        <v-btn
                        color="buttongreen  white--text"
                        :disabled="!valid"
                        @click="submit"
                        >Login
                        <v-icon right dark>mdi-lock-open</v-icon>
                        </v-btn>
                </div>
            </v-form>
        </v-container>
    </v-card>
</template>

<script>
import { mapActions } from "vuex"

import { mapGetters } from "vuex"

export default {
    name: 'login',
    data () {
        return {
            valid: true,
            email: 'example@example.com',
            emailRules : [
                v => !!v || 'Email is Required',
                v => /([a-zA-Z0-9_]{1,})(@)([a-zA-Z0-9_]{2,}).([a-zA-Z0-9_]{2,})+/.test(v) || 'Email must be valid'
            ],
            showPassword : false,
            password : '',
            passwordRules: [
                v => !!v || 'Password Required',
                v => (v && v.length >=6) || 'Min 6 characters',
            ],
        }
    },
    computed: {
        ...mapGetters({
            user : 'auth/user',
        }),
    },
    methods: {
        ...mapActions({
            setAlert : 'alert/set',
            setAuth : 'auth/set',
        }),
        submit() {
            if(this.$refs.form.validate()) {
                let formData = {
                    'email' : this.email,
                    'password' : this.password
                }
                axios.post('/api/auth/login', formData)
                .then((response) => {
                    let { data } = response.data
                    // console.log(data)
                    this.setAuth(data)
                    if(this.user.user.id.length>0){
                        this.setAlert({
                            status : true,
                            color : 'success',
                            text : 'Login Success'
                        })
                        this.close()
                    }else{
                        this.setAlert({
                            status : true,
                            color : 'error',
                            text : 'Login Failed'
                        })
                    }
                })
                .catch((error) => {
                    let responses = error.response

                    this.setAlert({
                        status : true,
                        text : responses.data.error,
                        color : 'error'
                    })
                })
            }
        },
        close() {
            this.$emit('closed', false)
        }
    },
}
</script>