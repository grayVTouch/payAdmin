(function(){
    'use strict';

    new Vue({
        el: '#app' ,
        data: {
            form: {
                name: '' ,
                password: '' ,
                remember: ''
            } ,
            remember: false ,
            tip: {
                name: '' ,
                password: ''
            } ,
        } ,
        created () {

        } ,
        mounted () {

        } ,

        methods: {
            check () {
                return {
                    status: true ,
                    msg: ''
                };
            } ,
            submit (e) {
                e.preventDefault();
                let res = this.check();
                if (!res.status) {
                    layer.alert(res.msg);
                    return ;
                }
                // 显示加载信息
                topContext.ins.load.show();
                let self = this;
                $.ajax({
                    url: genUrl('Login' , 'login') ,
                    method: 'post' ,
                    data: this.form ,
                    success (data) {
                        topContext.ins.load.hide();
                        if (data.code == '002') {
                            layer.alert(data.msg);
                            return ;
                        }
                        if (data.code == '001') {
                            self.tip = data.data;
                            return ;
                        }
                        window.history.go(0);
                    }
                });
            } ,

            rememberVal (remember) {
                this.form.remember = this.remember ? 'y' : 'n';
            }
        } ,

        watch: {
            remember (nv , ov) {
                this.rememberVal(nv);
            }
        }
    });
})();