<template>
    <section>
        <div class="container">
            <!-- <h1>Ciao sono il Blog</h1> -->
            <Posts />
            <Newsletter />
        </div>
    </section>
</template>


<script>
import Posts from '../components/Posts.vue';
import Newsletter from '../components/Newsletter.vue';

export default {
    name: 'Blog',
    components: {
        Posts,
        Newsletter
    }
}
</script>