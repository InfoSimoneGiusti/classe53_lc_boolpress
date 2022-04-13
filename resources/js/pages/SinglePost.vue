<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div v-if="post">
                    <img class="img-fluid" :src="post.cover" :alt="post.title">
                    <h1>{{post.title}}</h1>
                    <h3 v-if="post.category">Categoria: {{post.category.name}}</h3>
                    <p>{{post.content}}</p>
                    <p>Tags:</p>
                    <ul>
                        <li v-for="tag in post.tags" :key="tag.id">
                            {{tag.name}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
export default {
    name: 'SinglePost',

    // vorrei che quando apro questo componente, sia fatta una richiesta axios a una API di Laravel che mi ritorni
    // tutte le informazioni in merito ad un post specifico, identificato dal suo slug

    // di fatto lato laravel la query dovra essere del tipo
    // Select * from posts where slug = :slug

    data() {
        return {
            post: null
        }
    },
    mounted() {
        const slug = this.$route.params.slug;
        axios.get('/api/posts/' + slug).then(response => {
            if (response.data.success == false) {
                this.$router.push({name: 'not-found'}); //faccio redirect dentro alla rotta che mi gestisce la pagina non trovata di router.js
            } else {
                this.post = response.data.result;
            }
        });
    }
}
</script>

<style>

</style>
