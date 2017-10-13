<template>
    <div>
        <header>
            <h1>水牌</h1>
        </header>
        <main>
            <nav class="nav">
                <router-link to="/brand/">
                    水牌管理
                </router-link>
                <router-link to="/new/">
                    新加品牌
                </router-link>
            </nav>
        </main>
    </div>
</template>

<script>

export default {
}

</script>

<style lang="scss">


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

</style>
