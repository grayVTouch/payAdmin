(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dataUrl: '' ,
            saveUrl: '' ,
            next: {
                url: genUrl('Role' , 'listView') ,
                text: '角色列表' ,
            } ,

            form: {
                id: null ,
                name: '' ,
                code: '' ,
                weight: 0
            } ,
            // 错误信息
            error: {

            } ,
        } ,
        mixins: [
            topContext.mixin.form.field ,
            topContext.mixin.form.get ,
            topContext.mixin.form.init ,
            topContext.mixin.form.submit ,
        ] ,
        mounted () {

            this.dataUrl = genUrl(this.$store.state.route.mvc.controller , 'get' , {id: this.form.id});
            this.saveUrl = this.genUrl(this.$store.state.route.mvc.controller , this.type , {id: this.form.id});
            // 初始化数据
            this.initData();
        } ,
        methods: {
            check () {
                return {
                    status: true ,
                    field: '' ,
                    msg: ''
                };
            } ,
        } ,

        watch: {

        }
    });
})();