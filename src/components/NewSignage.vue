<template>
    <div v-if="signages">
        <h1>添加水牌</h1>
        <form @submit="addSignage">
            <input type="text" v-model.trim="signageInfo.video_url" placeholder="视频链接" required />
            <input type="text" :value="signageInfo.user_key" disabled />
            <input type="number" v-model.number="signageInfo.id" placeholder="设备ID" required />
            <input type="text" v-model.trim="signageInfo.brand" placeholder="品牌名" required />
            <input type="text" v-model.trim="signageInfo.city" placeholder="城市名" required />
            <input type="text" v-model.trim="signageInfo.store" placeholder="店铺名" required />
            <input type="number" v-model="signageInfo.position" placeholder="水牌位置序号" />
            <input type="number" v-model="signageInfo.boxKey_front" placeholder="设备序列号（前）" />
            <input type="number" v-model="signageInfo.boxKey_end" placeholder="设备序列号（后）" />
            <input type="submit" value="添加" />
        </form>
    </div>
</template>

<script>
import AJAX from '../modules/ajax';

export default {
    props: ['signages', 'brands'],
    data(){
        return {
            signageInfo: {
                version_code: 1,
                video_url: null,
                user_key: '正在加载...',
                id: null,
                agent: 0,
                brand: null,
                store: null,
                city: null,
                position: null,
                boxKey_front: null,
                boxKey_end: null,
            }
        }
    },
    methods: {
        // create a random key which is not in current database
        /*
         * @para aSignages:  all existing signages
         */
        createKey(aSignages){
            let sNewKey = randKey(16),
            aKeys = aSignages.map(item=>item.key);
            while( aKeys.includes(sNewKey) ){
                sNewKey = randKey(16);
            }
            return sNewKey;

            function randKey(n){
                const nSafeLen = (Number.MAX_SAFE_INTEGER + '').length - 1;
                function safeStr(){
                    return (''+Math.floor( Math.random() * Math.pow(10, nSafeLen) )).padStart(nSafeLen, '0');
                }

                let sResult = '';
                while(n>nSafeLen){
                    sResult += safeStr();
                    n -= nSafeLen;
                }
                return sResult +  (''+Math.floor( Math.random() * Math.pow(10, n) )).padStart(n, '0');
            }
        },
        addSignage(ev){
            ev.preventDefault(); // prevents submitting
            let sURL = 'http://localhost/gits/Signage/php/ajax.php',
                data = 'act=add&info=' + encodeURIComponent(JSON.stringify(this.signageInfo)),
                fnSuccessCallback = (res)=>{
                    if( res.trim()==='true' ){
                        this.signages.push(this.signageInfo);
                        if(!this.brands.includes(this.signageInfo.brand)){ // new brand
                            this.brands.push(this.signageInfo.brand);
                        }
                        alert('添加成功');
                    }
                    else if(res.trim()==='false'){
                        alert('添加失败。该ID已存在');
                    }
                    else{
                        alert('添加失败。' + res);
                        console.error(res);
                    }
                },
                fnFailCallback = (err)=>{ console.error(err); };
            AJAX.post(sURL, data, fnSuccessCallback, fnFailCallback);
        },
    },
    created() {
        if(this.signages){
            this.signageInfo.user_key = this.createKey(this.signages);
        }
        else{
            let sURL = 'http://localhost/gits/Signage/php/ajax.php?act=signage',
            fnSucc = (res)=>{ this.signageInfo.user_key = this.createKey(JSON.parse(res)); },
            fnFail = (status)=>{ console.log(status); };
            AJAX.get(sURL, fnSucc, fnFail);
        }
    },
}
</script>
