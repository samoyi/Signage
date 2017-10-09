<template>
    <div id="app">
        <header>
            <h1>水牌管理</h1>
        </header>
        <main>
            <nav class="nav">
                <ul>
                    <li @click="getInfo">info</li>
                </ul>
            </nav>
            <div class="content">{{content}}</div>
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

        }
    },
    methods: {
        getInfo(){
            axios.get('http://localhost/gits/Signage/php/ajax.php?act=info&brand=ankela')
                .then(response=>{
                    this.content = JSON.parse(response.data.trim()); // TODO why leading spaces
                    // console.log(this.content);
                })
                .catch(error=>{
                    console.error(error);
                })
        }
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
