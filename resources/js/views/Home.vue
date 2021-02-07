<template>
    <div>
        <!-- template blogs -->
        <v-container class="ma-0 mt-3 pa-0" grid-list-sm>
            <v-layout wrap>
                <v-carousel cycle hide-delimiters height="250px">
                    <v-carousel-item v-for="(blog,i) in blogs" :key="`blog-`+ blog.id ">
                        <v-img :src="blog.image" class="fill-height">
                            <v-container fill-height fluid pa-0 ma-0>
                                <v-layout fill-height align-end>
                                    <v-flex xs12 mx-2>
                                        <span class="headline white--text" v-text="blog.title"></span>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-img>
                    </v-carousel-item>
                </v-carousel>
            </v-layout>
        </v-container>


        <!-- template Campaign -->
        <v-container class="mt-2 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/campaigns" class="dark--text">
                    Semua Campaign<v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
            <v-layout wrap>
                <v-flex v-for="(campaign, index) in campaigns" :key="`campaign-` + campaign.id" xs6>
                    <campaign-item :campaign="campaign" />
                </v-flex>
            </v-layout>
        </v-container>
        <!-- end -->

    </div>
</template>

<script>
    export default {
        data: () => ({
            campaigns: [],
            blogs: []
        }),
        components: {
            CampaignItem : () => import('../components/CampaignItem')
        },
        created(){
            // get campaign
            axios.get('api/campaign/random/2')
            .then((response) => {
                let { data } = response.data
                this.campaigns = data.campaigns
                // console.log(this.campaigns)
            })
            .catch((error) => {
                let { response } = error
                console.log(responses)
            })

           // get campaign
            axios.get('api/blog/random/2')
            .then((response) => {
                let { data } = response.data
                this.blogs = data.blogs
                // console.log(this.blogs)
            })
            .catch((error) => {
                let { response } = error
                console.log(responses)
            })
        }
    }
</script>
