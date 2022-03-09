<template>
    <div class="container">
        <h1 class="mt-3 my-3"> {{ post.title }}</h1>
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