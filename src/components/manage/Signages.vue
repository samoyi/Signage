<template>
    <div class="post" v-if="infos">
        <h1 class="post__title">{{ $route.params.id }} * {{this.infos[this.id].length}}个</h1>
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
                <th>编辑</th>
            </tr>
            <!-- In modification mode, converts to input type -->
            <tr v-for="(signage,index) in this.infos[this.id]">
                <td v-if="editIndex===index"><input v-model="signage.version_code" type="number" min="1" step="1" :value="signage.version_code" /></td>
                <td v-else>{{signage.version_code}}</td>
                <td v-if="editIndex===index"><input v-model="signage.video_url" type="text" :value="signage.video_url" /></td>
                <td v-else>{{signage.video_url}}</td>
                <td>{{signage.user_key}}</td>
                <td v-if="editIndex===index"><input v-model="signage.id" type="number" :value="signage.id" /></td>
                <td v-else>{{signage.id}}</td>
                <td v-if="editIndex===index"><input v-model="signage.city" type="text" :value="signage.city" /></td>
                <td v-else>{{signage.city}}</td>
                <td v-if="editIndex===index"><input v-model="signage.store" type="text" :value="signage.store" /></td>
                <td v-else>{{signage.store}}</td>
                <td v-if="editIndex===index"><input v-model="signage.position" type="number" min="1" step="1" :value="signage.position" /></td>
                <td v-else>{{signage.position}}</td>
                <td v-if="editIndex===index"><input v-model="signage.boxKey_front" type="text" :value="signage.boxKey_front" /></td>
                <td v-else>{{signage.boxKey_front}}</td>
                <td v-if="editIndex===index"><input v-model="signage.boxKey_end" type="text" :value="signage.boxKey_end" /></td>
                <td v-else>{{signage.boxKey_end}}</td>
                <td>{{signage.modifyTime}}</td>
                <td>
                    <input v-show="editIndex!==index" @click="modify(index)" type="button" value="修改" />
                    <input v-show="editIndex===index" @click="submitModification(index)" type="button" value="提交修改" />
                    <input v-show="editIndex===index" @click="exitModification(index)" type="button" value="放弃修改" />
                    <input v-show="editIndex!==index" @click="remove(index)" type="button" value="删除" />
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
import AJAX from '../../modules/ajax';

export default {
    props: ['id', 'signages', 'brands'],
    data(){
        return {
            infos: null,
            editIndex: null,
            unmodified: null, // 放弃修改时还原
        };
    },
    methods: {
        classifyByBrand(aSignages){
            let oInfo = {};
            aSignages.forEach((item)=>{
                if( item.brand in oInfo ){
                    oInfo[item.brand].push(item);
                }
                else{
                    oInfo[item.brand] = [item];
                }
            });
            this.infos = oInfo;
        },
        modify(index){
            this.editIndex = index;
            this.unmodified = JSON.parse(JSON.stringify(this.infos[this.id][index]));
        },
        submitModification(index){
            this.editIndex = null;

            let sURL = 'http://localhost/gits/Signage/php/ajax.php',
                data = 'act=modify&info=' + JSON.stringify(this.infos[this.id][index]),
                fnSuccessCallback = (res)=>{
                    if( res.trim()==='true' ){
                        console.log('修改成功');
                    }
                    else{
                        console.error(res);
                    }
                },
                fnFailCallback = (err)=>{ console.error(err); };
            AJAX.post(sURL, data, fnSuccessCallback, fnFailCallback);
        },
        exitModification(index){
            this.editIndex = null;
            this.infos[this.id][index] = this.unmodified;
        },
        remove(index){
            let oSignage = this.infos[this.id][index],
                url = oSignage['video_url'],
                tableID = oSignage['table_id'],
                sVideo = oSignage['video_url'].slice( url.lastIndexOf('/')+1 );
            if( window.confirm('删除 ' + oSignage['store'] + ' 店的 ' + sVideo + ' ？') ){
                let sURL = 'http://localhost/gits/Signage/php/ajax.php',
                    data = 'act=remove&user_key=' + oSignage['user_key'],
                    fnSuccessCallback = (res)=>{
                        if( res.trim()==='true' ){
                            this.infos[this.id].splice(index, 1);
                            let nIndexInAll =  this.signages.findIndex(function(item){
                                return item.table_id === tableID
                            })
                            this.signages.splice(nIndexInAll, 1);
                            alert('删除成功');
                        }
                        else{
                            alert('删除失败');
                            console.error(res);
                        }
                    },
                    fnFailCallback = (err)=>{ console.error(err); };
                AJAX.post(sURL, data, fnSuccessCallback, fnFailCallback);
            }
        },
    },
    watch: { // after ajax finished
        signages(data){
            this.classifyByBrand(data);
        },
    },
    created() { // ajax has finished before created
        if(this.signages){ // gets signages from App.vue, not the Brand.vue
            this.classifyByBrand(this.signages);
        }
    },
}
</script>

<style scoped>
td{
    border: 1px solid;
    padding: 8px 16px;
}
</style>
