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
            isRunning: false ,
        } ,
        created () {

        } ,
        mounted () {
            // 定义表单
            // layui.define('form' , () => layui.form);
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
                if (this.isRunning) {
                    layer.alert('请求中...，请耐心等待');
                    return ;
                }
                let res = this.check();
                if (!res.status) {
                    layer.alert(res.msg);
                    return ;
                }
                this.isRunning = true;
                // 显示加载信息
                layer.load();
                let self = this;
                $.ajax({
                    url: genUrl('Login' , 'login') ,
                    method: 'post' ,
                    data: this.form ,
                    success (data) {
                        self.isRunning = false;
                        layer.closeAll();
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