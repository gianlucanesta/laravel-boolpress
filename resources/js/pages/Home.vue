<template>
    <section>
        <div class="container">
            <h1>Ciao sono la HomePage</h1>

            <Newsletter />
        </div>
    </section>
</template>

<script>
import Newsletter from '../components/Newsletter.vue';

export default {
    name: 'Home',
    components: {
        Newsletter
    }
}
</script>