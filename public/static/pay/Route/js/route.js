(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dom: {} ,
            form: {
                id: null ,
                name: '' ,
                en: '' ,
                module: '' ,
                controller: '' ,
                action: '' ,
                is_menu: 'n' ,
                enable: 'y' ,
                ico_for_font: '' ,
                pid: '' ,
                weight: 0
            } ,
            // 错误信息
            error: {} ,
            // 动作类型
            type: '' ,
            ins: {
                // 上传基本数据
                // 上传大图标（非必须）
                // 上传小图标（非必须）
            } ,
            isRunning: false ,
            //回调函数
            callback: {
                // 大图图片上传回调函数
                big: null ,
                // 小图图片上传回调函数
                small: null
            }
        } ,

        mounted () {
            this.dom.form = $(this.$refs.form);
            this.dom.icoForBig = $(this.$refs.icoForBig);
            this.dom.icoForSmall = $(this.$refs.icoForSmall);
            this.form.id = this.dom.form.data('id');
            this.type = this.dom.form.data('type');

            this.init();
        } ,

        methods: {
            // 获取数据
            init () {
                let self = this;
                this.ins.big = new UploadImage(this.dom.icoForBig.get(0) , {
                    pluginUrl: topContext.path.pluginUrl + 'UploadImage/' ,
                    mode: 'override' ,
                    url:  genUrl('Image' , 'single') ,
                    field: 'image' ,
                    success (json) {
                        let data = JSON.parse(json);
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        data = data.data;
                        if (G.isFunction(self.callback.big)) {
                            self.callback.big(data);
                        }
                    }
                });
                this.ins.small = new UploadImage(this.dom.icoForSmall.get(0) , {
                    pluginUrl: topContext.path.pluginUrl + 'UploadImage/' ,
                    mode: 'override' ,
                    url:  genUrl('Image' , 'single') ,
                    field: 'image' ,
                    success (json) {
                        let data = JSON.parse(json);
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        data = data.data;
                        if (G.isFunction(self.callback.small)) {
                            self.callback.small(data);
                        }
                    }
                });
                // 获取数据
                this.getData();
            } ,

            // 更新路由图片
            updateIco (type , image , fn) {
                let self = this;
                $.post({
                    url: genUrl('Route' , 'saveImage') ,
                    data: {
                        id: this.form.id ,
                        type ,
                        image
                    } ,
                    success (data) {
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        if (G.isFunction(fn)) {
                            fn();
                        }
                    }
                });
            } ,

            getData () {
                if (this.type != 'edit') {
                    return ;
                }
                let self = this;
                $.post({
                    url: this.genUrl('Route' , 'get' , {id: this.form.id}) ,
                    success (data) {
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        self.form = data.data;
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

            // 数据提交
            submit (e) {
                // 上传基本数据
                e.preventDefault();
                if (this.isRunning) {
                    return ;
                }
                let res = this.check();
                if (!res.status) {
                    this.error[res.field] = res.msg;
                    vScroll(res.field);
                    return ;
                }
                this.isRunning = true;
                topContext.ins.load.show();
                let self = this;
                new Promise((resolve , reject) => {
                    $.post({
                        url: this.genUrl('Route' , this.type , {id: this.form.id}) ,
                        data: this.form ,
                        success (data) {
                            self.isRunning = false;
                            if (data.code != '000') {
                                topContext.ins.load.hide();
                                if (data.code == '001') {
                                    self.error = data.data;
                                    vScroll(firstKey(data.data));
                                    return ;
                                }
                                if (data.code == '002') {
                                    self.layerFail(data.msg);
                                    return ;
                                }
                            }
                            self.form.id = data.data;
                            resolve();
                        }
                    });
                }).then(() => {
                    // 上传大图
                    return new Promise((resolve , reject) => {
                        if (this.ins.big.empty()) {
                            resolve();
                            return ;
                        }
                        // 更新大图
                        this.callback.big = (data) => {
                            this.updateIco('big' , data.url , resolve);
                        };
                        this.ins.big.upload();
                    });
                }).then(() => {
                    // 小图处理
                    return new Promise((resolve , reject) => {
                        if (this.ins.small.empty()) {
                            resolve();
                            return ;
                        }
                        // 更新大图
                        this.callback.small = (data) => {
                            this.updateIco('small' , data.url , resolve);
                        };
                        this.ins.small.upload();
                    });
                }).then(() => {
                    topContext.ins.load.hide();
                    // 操作结束
                    this.layerSucc('操作成功' , {
                        btn: ['路由列表' , '继续操作'] ,
                        btn1 () {
                            window.location.href = genUrl('Route' , 'listView');
                        } ,
                        btn2 () {
                            layer.closeAll();
                        }
                    });
                });
            } ,
        } ,

        watch: {

        }
    });
})();