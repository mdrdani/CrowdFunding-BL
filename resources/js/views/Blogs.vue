<template>
    <div>
       <v-container class="ma-0 pa-0" grid-list-sm>
           <v-subheader>
               All Blogs
           </v-subheader>
           <v-layout wrap>
               <v-flex v-for="(blog) in blogs" :key="`blog-` + blog.id" xs6>
                   <blog-item :blog="blog" />
               </v-flex>
           </v-layout>
           <v-pagination
           v-model="page"
           @input="go"
           :length="lengthPage"
           :total-visible="6"
           ></v-pagination>
       </v-container>
    </div>
</template>

<script>
    export default {
        data: () => ({
           blogs: [],
           page : 0,
           lengthPage : 0
        }),
         components: {
            BlogItem : () => import('../components/BlogItem')
        },
        created(){
            this.go()
        },
        methods: {
            go() {
                let url = 'api/blog?page=' + this.page
                axios.get(url)
                .then((response) => {
                    let { data } = response.data

                    this.blogs = data.blog.data
                    this.page = data.blog.current_page
                    this.lengthPage = data.blog.last_page
                })
                .catch((error) => {
                    let { responses } = error
                    console.log(responses)
                })
            }
        }
    }
</script>
