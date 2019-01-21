(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dataUrl: '' ,
            saveUrl: '' ,
            next: {
                url: '' ,
                text: '' ,
            } ,

            form: {
                id: null ,
                bank_name: '' ,
                bank_code: '' ,
                card_no: '' ,
                user_name: '' ,
                isdelete: 0
            } ,
            // 错误信息
            error: {

            } ,
            code: []
        } ,
        mixins: [
            topContext.mixin.form.field ,
            topContext.mixin.form.get ,
            topContext.mixin.form.init ,
            topContext.mixin.form.submit ,
        ] ,
        created () {
            this.getCode();
        } ,
        mounted () {
            this.next.url = genUrl(this.$store.state.route.mvc.controller , 'listView');
            this.next.text = '银行卡列表';
            this.dataUrl = genUrl(this.$store.state.route.mvc.controller , 'get' , {id: this.form.id});
            this.saveUrl = genUrl(this.$store.state.route.mvc.controller , this.type , {id: this.form.id});
            // 初始化数据
            this.initData();
        } ,
        methods: {
            // 获取银行卡列表
            getCode () {
                let self = this;
                $.post({
                    url: genUrl('Bank' , 'all') ,
                    success (data) {
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        self.code = data.data;
                    }
                });
            } ,

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