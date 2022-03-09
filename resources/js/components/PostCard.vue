<template>
    <div class="card my-2">
        <div class="card-body">
            <h5 class="card-title">{{ postDetails.title }} </h5>
            <p class="card-text">{{ truncateText(postDetails.content, 50) }}</p>
            <!-- <p class="card-text">{{ postDetails.content }}</p> -->
            <div class="card-body">
                <router-link :to="{ name: 'post-details', params: { slug:postDetails.slug } }">Leggi articolo</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PostCard',
        data: function() {
            return {
                post : {}
            };
        },
        props: {
            postDetails: Object
        },
        methods: {
            truncateText: function(text, maxCharsNumber) {
            //prendo un testo e se è piu lungo di x caratteri lo taglio e ci aggiungo ...
            // console.log(text);

            if(text.length > maxCharsNumber) {
                return text.substr(0, maxCharsNumber) + '...';
            }
                return text;
            }
        }
        
    }
</script>
