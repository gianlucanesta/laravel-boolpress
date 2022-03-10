<template>
    <div class="container">
        <h1 class="mt-3 my-3"> {{ post.title }}</h1>
        <div v-if="post.category">Category: {{ post.category.name }}</div>
        
        <div v-if="post.tags && post.tags.length > 0">
                <router-link 
                    v-for="post in tag.posts" 
                    :key="post.id" 
                    class="list-group-item list-group-item-action" 
                    :to="{ name: 'post-details', params: { slug: post.slug } }"
                >
                    {{ post.title }}
                </router-link>
        </div>
        
        <p> {{ post.content }} </p>
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
            // console.log(this.$route.params.slug)
            this.getPost();
    }
}
</script>