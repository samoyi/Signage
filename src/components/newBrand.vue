<template>
    <div>
        <input type="text" v-model="" placeholder="视频链接" />
        <input type="text" v-model="" disabled />
        <input type="text" v-model="" placeholder="设备ID" />
        <input type="text" v-model="" placeholder="品牌拼音名" />
        <input type="text" v-model="" placeholder="城市拼音名" />
        <input type="text" v-model="" placeholder="店铺拼音名" />
        <input type="text" v-model="" placeholder="水牌位置序号" />
        <input type="text" v-model="" placeholder="设备序列号（前）" />
        <input type="text" v-model="" placeholder="设备序列号（后）" />
    </div>
</template>

<script>

export default {

    data(){
        return {
            version_code: 1,
            video_url: null,
            user_key: Math.random(),
            id: null,
            agent: 0,
            brand: null,
            store: null,
            city: null,
            position: null,
            boxKey_front: null,
            boxKey_end: null,
        }
    },
}
</script>
