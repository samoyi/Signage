<template>
    <div class="post" v-if="info">
        <h1 class="post__title">{{ $route.params.id }} * {{amount}}</h1>
        <table cellSpacing=0>
            <tr>
                <th>版本号</th>
                <th>视频地址</th>
                <th>用户KEY</th>
                <th>设备ID</th>
                <th>门店城市</th>
                <th>门店名称</th>
                <th>水牌位置</th>
                <th>设备码（前）</th>
                <th>设备码（后）</th>
                <th>修改时间</th>
            </tr>
            <tr v-for="signage in info">
                <td>{{signage.version_code}}</td>
                <td>{{signage.video_url}}</td>
                <td>{{signage.user_key}}</td>
                <td>{{signage.id}}</td>
                <td>{{signage.city}}</td>
                <td>{{signage.store}}</td>
                <td>{{signage.position}}</td>
                <td>{{signage.boxKey_front}}</td>
                <td>{{signage.boxKey_end}}</td>
                <td>{{signage.modifyTime}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],
    data(){
        return {
            info: null,
            amount: null,
        }
    },
    methods: {
        getInfo(){
            axios.get('http://localhost/gits/Signage/php/ajax.php', {
                    params: { act: 'info' }
                })
                .then(response=>{
                    console.log(this.id);
                    console.log(response.data);
                    this.info = response.data[this.id]; // TODO why leading spaces
                    this.amount = response.data[this.id].length; // TODO why leading spaces
                })
                .catch(error=>{
                    console.error(error);
                })
        }
    },
    created() {
        this.getInfo();
    },
}
</script>

<style scoped>
td{
    border: 1px solid;
    padding: 8px 16px;
}
</style>
