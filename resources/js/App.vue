<template>
   <v-app>
       <alert></alert>

       <keep-alive>
           <v-dialog v-model="dialog" fullscreen hide-overlay persistent transition="dialog-bottom-transition">
               <component :is="currentComponent" @closed="setDialogStatus"></component>
           </v-dialog>
       </keep-alive>

       <!-- sidebar -->
            <v-navigation-drawer app 
            v-model="drawer"
            >
                <v-list>
                    <v-list-item v-if="!guest">
                        <v-list-item-avatar>
                            <v-img :src="user.user.photo_profile"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title>{{ user.user.name}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn rounded color="buttongreen white--text" @click="setDialogComponent('login')">
                        <v-icon left>mdi-lock</v-icon>
                        Login
                    </v-btn>

                    <v-btn rounded color="buttongreen white--text">
                        <v-icon left>mdi-account</v-icon>
                        Register
                    </v-btn>
                </div>

                <v-divider></v-divider>

                
                </v-list>

                <template v-slot:append v-if="!guest">
                    <div class="pa-2">
                            <v-btn block color="buttongreen white--text" @click="logout">
                                <v-icon left>mdi-lock</v-icon>
                                Logout
                            </v-btn>
                    </div>
                </template>

            </v-navigation-drawer>

            <!-- Header -->
            <v-app-bar 
            app
            color="buttongreen white--text" 
            dark 
            src="https://picsum.photos/1920/1080?random"
            v-if="isHome">
            <template v-slot:img="{ props }">
                <v-img
                v-bind="props"
                gradient="to top right, rgba(19,84,122,.5), rgba(128,208,199,.8)"
                ></v-img>
            </template>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                
                <v-toolbar-title>Yayasan Peduli Kasih</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-badge light color="pinkk" overlap v-if="transactions>0">
                        <template v-slot:badge>
                            <span>{{ transactions }}</span>
                        </template>
                        <v-icon>mdi-heart</v-icon>
                    </v-badge>
                    <v-icon v-else>mdi-heart</v-icon>
                </v-btn>
                <v-btn icon>
                    <v-icon @click="setDialogComponent('search')">mdi-magnify</v-icon>
                </v-btn>
            </v-app-bar>

            <v-app-bar 
            class="mb-2" 
            app 
            color="buttongreen white--text" 
            dark
            src="https://picsum.photos/1920/1080?random"  
            v-else>
            <template v-slot:img="{ props }">
                <v-img
                v-bind="props"
                gradient="to top right, rgba(19,84,122,.5), rgba(128,208,199,.8)"
                ></v-img>
            </template>
                <v-btn icon @click.stop="$router.go(-1)">
                    <v-icon>mdi-arrow-left-circle</v-icon>
                </v-btn>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-badge color="pinkk" overlap v-if="transactions>0">
                        <template v-slot:badge>
                            <span>{{ transactions }}</span>
                        </template>
                        <v-icon>mdi-heart</v-icon>
                    </v-badge>
                    <v-icon v-else>mdi-heart</v-icon>
                </v-btn>
            </v-app-bar>

            <!-- body -->
            <v-main>
                <v-container fluid>
                    <v-slide-y-transition>
                            <router-view></router-view>
                        </v-slide-y-transition>
                    </v-container>
            </v-main>

            <!-- Bottom Navigation-->
            <v-bottom-navigation >
                <v-btn 
                 v-for="(item,index) in menus"
                :key="'menu'+index"
                :to="item.route"
                value="recent">
                    <v-icon>{{ item.icon}}</v-icon>
                    <span>{{ item.title }}</span>
                </v-btn>
            </v-bottom-navigation>
            
</v-app>
</template>
<script>
import {mapGetters, mapActions} from 'vuex'
export default {
        name : 'App',
        components : {
            Alert : () => import('./components/Alert'),
            Search : () => import('./components/Search'),
            Login : () => import('./components/Login')
        },
        data: () =>  ({
            drawer: false,
            menus: [
                {title: 'Home', icon: 'mdi-home', route: '/'},
                {title: 'Campaigns', icon: 'mdi-hand-heart', route: '/campaigns'},
                {title: 'Blogs', icon:'mdi-book-open',route:'/blog'}
            ],
            
        }),
        computed: {
            isHome() {
                return (this.$route.path === '/' || this.$route.path === '/home')
            },
            ...mapGetters({
                transactions : 'transaction/transactions',
                guest : 'auth/guest',
                user : 'auth/user',
                dialogStatus : 'dialog/status',
                currentComponent : 'dialog/component',
            }),
            dialog: {
                get() {
                    return this.dialogStatus
                },
                set (value) {
                    this.setDialogStatus(value)
                }
            }
        },
        methods: {
            ...mapActions({
                setDialogStatus : 'dialog/setStatus',
                setDialogComponent : 'dialog/setComponent',
                setAuth : 'auth/set',
                setAlert : 'alert/set',
                checkToken : 'auth/checkToken'
            }),
            logout() {
                let config = {
                    headers : {
                        'Authorization' : 'Bearer' + this.user.token,
                    },
                }
                axios.get('/api/auth/logout', {}. config)
                .then((response) => {
                    this.setAuth({})
                    this.setAlert({
                        status : true,
                        color : 'success',
                        text : 'Logout Successfully'
                    })
                })
                .catch((error) => {
                    let { data } = error.response
                    this.setAlert({
                        status : true,
                        color : 'error',
                        text : data.message
                    })
                })
            }
        },
        mounted() {
            if(this.user) {
                this.checkToken(this.user)
            }
        }
}
</script>