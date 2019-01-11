(function(){
    'use strict';

    new Vue({
        el: '#doc-right' ,
        data: {
            dom: {},
            isRunning: false ,
        } ,

        mounted () {
            this.dom.function = $(this.$refs['pub-function']);
            this.dom.top = $(this.$refs['pub-top']);
            this.dom.btm = $(this.$refs['pub-btm']);

            // 设置高度
            this.setBtmH();
            win.on('resize' , this.setBtmH.bind(this));
        } ,

        methods: {
            // 设置 btm 的高度
            setBtmH () {
                let minH = 500;
                let maxH = document.documentElement.clientHeight;
                let topH = this.dom.top.height();
                let btmH = Math.max(minH , maxH - topH);
                this.dom.btm.css({
                    height: btmH + 'px'
                });
            } ,

            // 用户：鼠标进入
            mouseEnterForUser () {
                this.dom.function.removeClass('hide');
                this.dom.function.data('status' , 'show');
                this.dom.function.animate({
                    opacity: 1 ,
                    bottom: 0
                } , duration);
            } ,

            // 用户：鼠标退出
            mouseLeaveForUser () {
                this.dom.function.data('status' , 'hide');
                this.dom.function.animate({
                    opacity: 0 ,
                    bottom: '-10px'
                } , duration , () => {
                    if (this.dom.function.data('status') == 'hide') {
                        this.dom.function.addClass('hide');
                    }
                });
            } ,

            // 注销
            loginOut () {
                if (this.isRunning) {
                    layer.alert('请求中...，请耐心等待');
                    return ;
                }
                let self = true;
                this.isRunning = true;
                layer.load();
                $.post({
                    url: genUrl('User' , 'loginOut') ,
                    success (data) {
                        layer.closeAll();
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