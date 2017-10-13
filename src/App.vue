<template>
    <div id="app">
        <!-- <header>
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
                <router-link to="/brand/">
                    水牌管理管理
                </router-link>
                <router-link to="/add/">
                    新加品牌
                </router-link>
            </nav> -->
            <!-- <div class="content"> -->
                <router-view :id="$route.params.id" :signages="signages" :brands="posts"></router-view>
            <!-- </div> -->
        <!-- </main> -->
    </div>
</template>

<script>
import AJAX from './modules/ajax';

export default {
    // name: 'app', // TODO What's the name attribute?
    data () {
        return {
            content: '',
            infos: null,
            posts: null,
            signages: null,
        }
    },
    methods: {
        getInfo(){
            let sURL = 'http://localhost/gits/Signage/php/ajax.php?act=signage',
            fnSucc = (res)=>{ this.signages = JSON.parse(res); },
            fnFail = (status)=>{ console.log(status); };
            AJAX.get(sURL, fnSucc, fnFail);
        },
        getBrands(){
            let sURL = 'http://localhost/gits/Signage/php/ajax.php?act=brands',
            fnSucc = (res)=>{ this.posts = JSON.parse(res); },
            fnFail = (status)=>{ console.error(status); };
            AJAX.get(sURL, fnSucc, fnFail);
        },
        addToData(){
            alert(2222);
        }
    },
    created() {
        this.getBrands();
        this.getInfo();
        console.warn('app无论如何都会加载为什么');
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
</style>
