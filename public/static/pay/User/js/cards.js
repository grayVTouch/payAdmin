(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dataUrl: '' ,
            delUrl: '' ,
            // 过滤表单
            form: {
                id: '' ,
                bank_name: '' ,
                bank_code: '' ,
                order: ''
            } ,
            // 数组排序
            order: [
                {
                    name: 'id' ,
                    order: {
                        'id|asc': '升序' ,
                        'id|desc': '降序' ,
                    }
                } ,
            ] ,
        } ,
        mixins: [
            topContext.mixin.load ,
            topContext.mixin.list.field ,
            topContext.mixin.list.get ,
            topContext.mixin.list.del ,
            topContext.mixin.list.delEvent ,
            topContext.mixin.list.delSelectedEvent ,
            topContext.mixin.list.select ,
            topContext.mixin.list.search ,
            topContext.mixin.list.page ,
        ] ,
        created () {

        } ,
        mounted () {
            this.dataUrl = genUrl(this.$store.state.route.mvc.controller , 'card');
            this.delUrl = genUrl(this.$store.state.route.mvc.controller , 'delCard');
            this.initData();
        } ,

        methods: {

        } ,

        watch: {

        }
    });
})();