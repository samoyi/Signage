<!--
    root component
    loads and manages common data
    origin of routing path
-->

<template>
    <div id="app">
        <!-- TODO-1 -->
        <router-view :id="$route.params.id" :signages="signages" :brands="brands" @deleteBrand="deleteBrand"></router-view>
    </div>
</template>

<script>
import AJAX from './modules/ajax';

export default {
    // name: 'app', // TODO-2 What's the name attribute? Generated in webpack-simple
    data () {
        return {
            brands: null,
            signages: null,
        }
    },
    methods: {
        getSignages(){
            let sURL = 'http://localhost/gits/Signage/php/ajax.php?act=signage',
            fnSucc = (res)=>{ this.signages = JSON.parse(res); },
            fnFail = (status)=>{ console.log(status); };
            AJAX.get(sURL, fnSucc, fnFail);
        },
        getBrands(){
            let sURL = 'http://localhost/gits/Signage/php/ajax.php?act=brands',
            fnSucc = (res)=>{ this.brands = JSON.parse(res); },
            fnFail = (status)=>{ console.error(status); };
            AJAX.get(sURL, fnSucc, fnFail);
        },
        deleteBrand(sBrand){
            let index = this.brands.indexOf(sBrand);
            this.brands.splice(index, 1);
        },
    },
    created() {
        this.getBrands();
        this.getSignages();
    },
}
</script>

<style>
#app {
    text-align: center;
    margin-top: 60px;
}
</style>
