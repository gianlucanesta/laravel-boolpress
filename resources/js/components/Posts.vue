<template>
	<section>
		<div class="container">
			<h1> I nostri post </h1>

            <div class="row row-cols-3">
                <!-- Single post card -->
                <div v-for="post in posts" :key="post.id" class="col">
                    <div class="card my-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ post.title }} </h5>
                            <p class="card-text">{{ truncateText(post.content, 50) }}</p>
                            <!-- <p class="card-text">{{ post.content }}</p> -->
                        </div>
                    </div>
                </div>
                <!-- End Single post card -->
            </div>
		</div>
	</section>
</template>

<script>
	export default {
		name: 'Posts',
		data: function() {
			return {
				posts: []
			};
		},
		methods: {
			getPosts: function() {
				//faccio la chiamata api per prendere i post
				// console.log('devo chiamare l api');

                // axios.get('http://127.0.0.1:8000/api/posts')
				axios.get('/api/posts')
				.then((response) => {
				// console.log(response);
                    this.posts = response.data.results;
				});
			},
            truncateText: function(text, maxCharsNumber) {
        	//prendo un testo e se è piu lungo di x caratteri lo taglio e ci aggiungo ...
        	// console.log('text');

        	if(text.length > maxCharsNumber) {
        		return text.substr(0, maxCharsNumber) + '...';
        	}
        	return text;
            }
        },
        created: function() {
            this.getPosts();
        }	
    }
</script>