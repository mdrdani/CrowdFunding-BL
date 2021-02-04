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
                            <v-img src="https://randomuser.me/api/portraits/men/77.jpg"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title>John Leider</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn rounded color="buttongreen white--text" class="rb-1 mb-1">
                        <v-icon left>mdi-lock</v-icon>
                        Login
                    </v-btn>

                    <v-btn rounded color="buttongreen white--text">
                        <v-icon left>mdi-account</v-icon>
                        Register
                    </v-btn>
                </div>

                <v-divider></v-divider>

                <v-list-item
                v-for="(item,index) in menus"
                :key="'menu'+index"
                :to="item.route"
                >
                <v-list-item-icon>
                    <v-icon left>{{ item.icon}}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
                </v-list-item>
                </v-list>

                <template v-slot:append v-if="!guest">
                    <div class="pa-2">
                            <v-btn block color="buttongreen white--text">
                                <v-icon left>mdi-lock</v-icon>
                                Logout
                            </v-btn>
                    </div>
                </template>

            </v-navigation-drawer>

            <!-- Header -->
            <v-app-bar app color="buttongreen white--text" dark v-if="isHome">
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                
                <v-toolbar-title>Yayasan Peduli Kasih</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-badge light color="pinkk" overlap v-if="transactions>0">
                        <template v-slot:badge>
                            <span>{{ transactions }}</span>
                        </template>
                        <v-icon>mdi-cash-multiple</v-icon>
                    </v-badge>
                    <v-icon v-else>mdi-cash-multiple</v-icon>
                </v-btn>

                <v-text-field
                class="mb-1"
                slot="extension"
                hide-details
                append-icon="mdi-microphone"
                filled
                rounded
                dense
                label="Search"
                prepend-inner-icon="mdi-magnify"
                solo-inverted
                @click="setDialogComponent('search')"
                ></v-text-field>
            </v-app-bar>

            <v-app-bar class="mb-2" app color="buttongreen white--text" dark  v-else>
                <v-btn icon @click.stop="$router.go(-1)">
                    <v-icon>mdi-arrow-left-circle</v-icon>
                </v-btn>
                <!-- pemisah konten -->
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-badge color="pinkk" overlap v-if="transactions>0">
                        <template v-slot:badge>
                            <span>{{ transactions }}</span>
                        </template>
                        <v-icon>mdi-cash-multiple</v-icon>
                    </v-badge>
                    <v-icon v-else>mdi-cash-multiple</v-icon>
                </v-btn>
            </v-app-bar>

            <!-- body -->
            <v-main>

                <!-- Provides the application the proper gutter -->
                <v-container fluid>

                <!-- If using vue-router -->
                <v-slide-y-transition>
                    <router-view></router-view>
                </v-slide-y-transition>
                </v-container>
            </v-main>

            <!-- footer -->
            <v-footer app>
                <v-footer absolute app>
                    <v-card-text class="text-center">
                        &copy; {{ new Date().getFullYear() }} - <strong>Yayasan Peduli Kasih</strong>
                    </v-card-text>
                </v-footer>
            </v-footer>
</v-app>
</template>
<script>
import {mapGetters, mapActions} from 'vuex'
export default {
        name : 'App',
        components : {
            Alert : () => import('./components/Alert'),
            Search : () => import('./components/Search')
        },
        data: () =>  ({
            drawer: false,
            menus: [
                {title: 'Home', icon: 'mdi-home', route: '/'},
                {title: 'Campaigns', icon: 'mdi-hand-heart', route: '/campaigns'},
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
            })
            
        }
}
</script>