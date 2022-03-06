<template>
    <div>
      <!-- <Posts /> -->
      <Header />
      <main>
        <router-view></router-view>
      </main>
    </div> 
</template>


<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';

// import Posts from '../components/Posts.vue';
import Header from '../components/Header.vue';

export default {
    name: 'App',
    components: {
        // Posts
        Header
    }
   
}
</script>

