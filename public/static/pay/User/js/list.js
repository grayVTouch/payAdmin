(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dataUrl: genUrl('User' , 'list') ,
            delUrl: genUrl('User' , 'del') ,
            // 过滤表单
            form: {
                id: '' ,
                name: '' ,
                code: '' ,
                order: ''
            } ,
            // 数组排序
            order: [
                {
                    name: 'id' ,
                    order: {
                        'uid|asc': '升序' ,
                        'uid|desc': '降序' ,
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
            this.initData();
        } ,

        methods: {

        } ,

        watch: {

        }
    });
})();