<template>
    <div>
        <v-card v-if="blog.id">
            <v-img
            :src="blog.image"
            class="white--text"
            height="200px"
            >
                <v-card-title
                class="fill-height align-end"
                v-text="blog.title"
                ></v-card-title>
            </v-img>

            <v-card-text>
                <v-simple-table dense>
                    <tbody>
                        <tr>
                            <td>Judul </td>
                            <td>{{ blog.title }}</td>
                        </tr>
                        
                        <tr>
                            <td>Tgl Terbit</td>
                            <td>{{ blog.created_at | formatDate}}</td>
                        </tr>
                        
                    </tbody>
                </v-simple-table>
                Isi berita: <br>
                {{ blog.description }}
            </v-card-text>
            <v-card-actions>
                <v-btn block color="buttongreen white--text">
                    <v-icon>mdi-share</v-icon> &nbsp;
                    Share
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
export default {
    data: () => ({
        blog : {},
    }),
    created(){
        this.go()
    },
    methods: {
        go(){
            let { id } = this.$route.params
            let url = '/api/blog/' + id
            axios.get(url)
            .then((response) => {
                let { data } = response.data
                this.blog = data.blog
            })
            .catch((error) => {
                let { responses } = error 
                console.log(responses)
            })
        },  
    }
}
</script>