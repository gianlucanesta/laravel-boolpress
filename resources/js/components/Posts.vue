<template>
	<section>
		<div class="container">
			<h1> I nostri post </h1>

			<!-- Post List -->
            <div class="row row-cols-3">
                <!-- Single post card -->
                <div v-for="post in posts" :key="post.id" class="col">
                    <PostCard :postDetails="post"/>
                </div>
                <!-- End Single post card -->
            </div>
			<!--End Post List -->

			<!-- Pagination -->
			<nav class="mt-3">
				<ul class="pagination justify-content-end">
					<!-- Previous link -->
					<li class="page-item" :class="{'disabled': currentPage == 1}">
						<a @click="getPosts(currentPage - 1)" class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
					</li>
					
					<!-- Page links -->					
					<li v-for="n in lastPage" :key="n" class="page-item" aria-current="page" :class="{'active' : currentPage == n}">
						<a @click="getPosts(n)" class="page-link" href="#">{{ n }}</a>
					</li>
									
					<!-- Next link -->
					<li class="page-item" :class="{'disabled': currentPage == lastPage}">
						<a @click="getPosts(currentPage + 1)" class="page-link" href="#">Next</a>
					</li>
				</ul>
			</nav>
			<!-- End Pagination -->
		</div>
	</section>
</template>

<script>
import PostCard from './PostCard.vue';

export default {
	name: 'Posts',
	components: {
		PostCard
	},
	data: function() {
		return {
			posts: [],
			currentPage: 1,
			lastPage: false
		};
	},
	methods: {
		getPosts: function(pageNumber) {
			//faccio la chiamata api per prendere i post
			// console.log('Chiamo l API');

			// axios.get('http://127.0.0.1:8000/api/posts')
			axios.get('/api/posts', {
				params: {
					page: pageNumber
				}
			})
			.then((response) => {
				// console.log(response);
				this.posts = response.data.results.data;
				this.currentPage = response.data.results.current_page;
				this.lastPage = response.data.results.last_page;

			});
		}
	},
	created: function() {
		this.getPosts(1);
	}	
}
</script>