<template>
    <div id="app">
        <header>
            <h1>水牌管理</h1>
        </header>
        <main>
            <nav class="nav">
                <router-link
                    v-for="post in posts"
                    active-class="is-active"
                    class="link"
                    key="post.title"
                    :to="'/post/'+post">
                    {{post}}
                </router-link>
            </nav>
            <div class="content">
                <router-view :id="$route.params.id"></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios';
// :to="{ name: '/post/'+post, params: { id: post } }">
export default {
    name: 'app',
    data () {
        return {
            content: '',
            posts: null,
        }
    },
    methods: {
        getBrands(){
            axios.get('http://localhost/gits/Signage/php/ajax.php', {
                    params: {
                        act: 'brands',
                    }
                })
                .then(response=>{
                    console.log(response)
                    this.posts = response.data.map((item)=>item.toLowerCase()).sort(); // TODO why leading spaces
                })
                .catch(error=>{
                    console.error(error);
                })
        }
    },
    created() {
        this.getBrands();
    },
}
</script>

<style lang="scss">
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}

.nav{
    a{
        text-decoration: none;
        color: black;
        margin-left: 2em;
    }
}
h1, h2 {
    font-weight: normal;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: inline-block;
    margin: 0 10px;
}


























</style>
