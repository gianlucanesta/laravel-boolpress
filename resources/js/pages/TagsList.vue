<template>
    <section>
        <div class="container">
            <h1 class="mt-3 mb-5">Lista Tags</h1>

            <ul class="list-group">
                <li v-for="tag in tags" :key="tag.id" class="list-group-item d-flex justify-content-between align-items-center">
                    <router-link :to="{ name: 'tag-details', params: { slug: tag.slug } }">{{ tag.name }}</router-link>
                    <span class="badge bg-primary text-light rounded-pill">{{ tag.related_posts_number }}</span>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
export default {
    name: 'TagsList',
    data: function() {
        return {
            tags: []
        };
    },
    methods: {
        getTags: function() {
            axios.get('/api/tags')
            .then((response) => {
                // console.log(response)
                this.tags = response.data.results;
            });
        }
    },
    created: function() {
        this.getTags();
    }
}
</script>