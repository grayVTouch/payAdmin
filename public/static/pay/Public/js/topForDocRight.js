(function(){
    'use strict';

    topContext.vue.topForDocRight = new Vue({
        el: '#pub-top' ,
        data: {
            dom: {},
        } ,

        mounted () {
            this.dom.function   = $(this.$refs['pub-function']);
            this.dom.container  = $(this.$refs['container']);
        } ,

        methods: {
            // 用户：鼠标进入
            mouseEnterForUser () {
                this.dom.function.removeClass('hide');
                this.dom.function.data('status' , 'show');
                this.dom.function.stop(true , false);
                this.dom.function.animate({
                    opacity: 1 ,
                    bottom: 0
                } , topContext.duration);
            } ,

            // 用户：鼠标退出
            mouseLeaveForUser () {
                this.dom.function.data('status' , 'hide');
                this.dom.function.stop(true , false);
                this.dom.function.animate({
                    opacity: 0 ,
                    bottom: '-10px'
                } , topContext.duration , () => {
                    if (this.dom.function.data('status') == 'hide') {
                        this.dom.function.addClass('hide');
                    }
                });
            } ,

            // 注销
            loginOut () {
                topContext.ins.load.show();
                $.post({
                    url: genUrl('User' , 'loginOut') ,
                    success (data) {
                        topContext.ins.load.hide();
                        if (data.code != '000') {
                            layer.alert(data.msg);
                            return ;
                        }
                        window.history.go(0);
                    }
                });
            }
        } ,

        watch: {

        }
    });
})();