<template>
   <v-app>
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
                            <v-btn block color="white--text">
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
                    <v-badge light color="pinkk" overlap>
                        <template v-slot:badge>
                            <span>3</span>
                        </template>
                        <v-icon>mdi-cash-multiple</v-icon>
                    </v-badge>
                </v-btn>

                <v-text-field
                class="mb-1"
                slot="extension"
                hide-details
                append-icon="mdi-microphone"
                filled
                rounded
                dense
                label="Cari"
                prepend-inner-icon="mdi-magnify"
                solo-inverted
                ></v-text-field>
            </v-app-bar>

            <v-app-bar app color="buttongreen white--text" dark  v-else>
                <v-btn icon @click.stop="$router.go(-1)">
                    <v-icon>mdi-arrow-left-circle</v-icon>
                </v-btn>
                <!-- pemisah konten -->
                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-badge color="pinkk" overlap>
                        <template v-slot:badge>
                            <span>3</span>
                        </template>
                        <v-icon>mdi-cash-multiple</v-icon>
                    </v-badge>
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
export default {
        name : 'App',
        data: () =>  ({
            drawer: false,
            menus: [
                {title: 'Home', icon: 'mdi-home', route: '/'},
                {title: 'Campaigns', icon: 'mdi-hand-heart', route: '/campaigns'},
            ],
            guest: true,
        }),
        computed: {
            isHome() {
                return (this.$route.path === '/' || this.$route.path === '/home')
            }
        }
}
</script>