<template>
  <div class="container">
    <div class="row">
      <div class="col-4" v-for="post in posts" :key="post.id">
        <div class="card" style="width: 18rem">
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">
              {{ post.content }}
            </p>
            <a href="#" class="card-link">Leggi articolo</a>
          </div>
        </div>
      </div>
    </div>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item" :class="currentPage === 1?'disabled':''" ><button class="page-link" @click="getPost(currentPage - 1)">Previous</button></li>
        <li class="page-item" :class="currentPage === lastPage ?'disabled':''"><button class="page-link" @click="getPost(currentPage + 1)">Next</button></li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Main",
  data() {
    return {
      posts: [],
      currentPage: 0,
      lastPage: null
    };
  },
  methods: {
    getPost(apiPage) {
      axios.get("/api/posts",
        {
            params: {
                page: apiPage
            }
        }
      ).then((response) => {
        this.posts = response.data.results.data;
        this.currentPage = response.data.results.current_page;
        this.lastPage = response.data.results.last_page;
      });
    },
  },
  mounted() {
    this.getPost(this.currentPage);
  },
};
</script>

<style>
</style>
