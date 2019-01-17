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
                        'id|asc': '升序' ,
                        'id|desc': '降序' ,
                    }
                } ,
                {
                    name: '权重' ,
                    order: {
                        'weight|asc': '升序' ,
                        'weight|desc': '降序' ,
                    }
                } ,
                {
                    name: '创建时间' ,
                    order: {
                        'create_time|asc': '升序' ,
                        'create_time|desc': '降序' ,
                    }
                }
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