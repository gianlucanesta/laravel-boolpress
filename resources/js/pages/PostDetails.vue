<template>
    <div class="container">
        <h1 class="mt-3 my-3"> {{ post.title }}</h1>
        <div v-if="post.category">Category: {{ post.category.name }}</div>
        
        <div v-if="post.tags && post.tags.length > 0">
            <router-link 
                v-for="tag in post.tags" 
                :key="tag.id" 
                class="badge bg-warning text-dark mx-1 text-capitalize"
                :to="{ name: 'tag-details', params: { slug: tag.slug }}"
                > 
                {{ tag.name }}
            </router-link>
        </div>
        
        <img v-if="post.cover" :src="post.cover" class="card-img-top mt-3" alt="post.title">

        <p class="mt-4">{{ post.content }}</p>
    </div>
</template>

<script>
export default {
    name: 'PostDetails',
    data: function() {
        return {
            post: {},
        };
    },
    methods: {
        getPost() {
             axios.get('/api/posts/' + this.$route.params.slug)
            // axios.get('/api/posts/quis-odit-voluptates-consequatur-est')
            .then((response) => {
                if(response.data.success) {
                    // console.log(response);
                    this.post = response.data.results;
                } else {
                    this.$router.push({ name: 'not-found' });
                }
            });
        }
    },
    created: function() {
            // console.log(this.$route.name)
            // console.log(this.$route.params)
            console.log(this.$route.params.slug)
            this.getPost();
    }
}
</script>