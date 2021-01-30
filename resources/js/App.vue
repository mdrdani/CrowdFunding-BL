<template>
    <div class="wrapper">
        <router-link to="/home">Home</router-link>
        <router-link to="/donations">Donations</router-link>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
        <!-- <app-footer/> -->
    </div>
</template>
<script>
export default {
    created() {
        console.log('component mounted')
    }
}
</script>