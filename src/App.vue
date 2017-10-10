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
                    :to="{ name: 'post', params: { id: post } }">
                    {{post}}
                </router-link>
            </nav>
            <div class="content">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios';

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
                    this.posts = response.data; // TODO why leading spaces
                    // console.log(this.content);
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

a {

}


























</style>
