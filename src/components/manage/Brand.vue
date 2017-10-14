<template>
    <div>
        <h2>品牌目录</h2>
        <ul v-if="brands">
            <li v-for="brand in brands">
                <router-link :brands="brands" :to="'/brand/'+brand">
                    {{brand}}
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['brands'],
}
</script>

<style scoped>
h2 {
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
