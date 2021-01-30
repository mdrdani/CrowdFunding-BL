<template>
   <v-app>
            <v-navigation-drawer app>
                Sidebar
            </v-navigation-drawer>

            <v-app-bar app>
                Navbar
            </v-app-bar>

            <!-- Sizes your content based upon application components -->
            <v-main>

                <!-- Provides the application the proper gutter -->
                <v-container fluid>

                <!-- If using vue-router -->
                <router-view></router-view>
                </v-container>
            </v-main>

            <v-footer app>
                © 2021 CrowdFunding • All rights reserved • Love from Lampung
            </v-footer>
</v-app>
</template>
<script>
export default {
    created() {
        console.log('component mounted')
    }
}
</script>