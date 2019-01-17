(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dataUrl: genUrl('Route' , 'list') ,
            delUrl: genUrl('Route' , 'del') ,
            data: {
                total: 0 ,
                data: []
            } ,
            // 过滤表单
            form: {
                id: '' ,
                name: '' ,
                module: '' ,
                controller: '' ,
                action: '' ,
                is_menu: '' ,
                enable: '' ,
                p_id: '' ,
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
            ]
        } ,
        // 混入
        // mixins: Object.assign([] ,[topContext.mixin.load] , Object.values(topContext.mixin.list)) ,
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
        mounted () {
            console.log('app mounted');
            this.initData();

        } ,

        methods: {

        } ,

        watch: {

        }
    });
})();