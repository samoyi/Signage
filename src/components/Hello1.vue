<template>
    <div>
        <new-brand v-if="signages"  :signages="signages" :keys="['1']"></new-brand>
    </div>
</template>

<script>
import newBrand from './newBrand.vue';

export default {
    props: ['signages'],
    data(){
        return {
            infos: null,
        }
    },
    components: {
        newBrand,
    },
}
</script>
