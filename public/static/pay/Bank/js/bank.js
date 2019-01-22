(function(){
    'use strict';

    topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dataUrl: '' ,
            saveUrl: '' ,
            form: {
                id: null ,
                bank_name: '' ,
                bank_code: '' ,
                color: '' ,
            } ,
            // 错误信息
            error: {

            } ,
            ins: {

            } ,
            callback: {
                logo: null
            } ,
            type: '' ,
            isRunning: false
        } ,
        mixins: [
            topContext.mixin.form.field ,
            topContext.mixin.form.get ,
            topContext.mixin.form.init ,
        ] ,
        mounted () {
            let self = this;
            this.dataUrl = genUrl(this.$store.state.route.mvc.controller , 'get' , {id: this.form.id});
            this.saveUrl = genUrl(this.$store.state.route.mvc.controller , this.type , {id: this.form.id});

            // 大图
            this.ins.image = new UploadImage(this.$refs.image , {
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
                    if (G.isFunction(self.callback.logo)) {
                        self.callback.logo(data);
                    }
                }
            });

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
            // 上传图片
            saveImage (resolve) {
                if (this.ins.image.empty()) {
                    resolve();
                    return ;
                }
                this.callback.logo = resolve;
                this.ins.image.upload();
            } ,
            // 更新图片
            updateImage (image , resolve) {
                $.post({
                    url: genUrl(this.$store.state.route.mvc.controller , 'saveImage') ,
                    data: {
                        id: this.form.id ,
                        image
                    } ,
                    success (data) {
                        if (data.code != '000') {
                            layer.msg(data.msg , {
                                time: topContext.short ,
                                end () {
                                    resolve(data);
                                }
                            });
                            return ;
                        }
                        resolve(data);
                    }
                });
            } ,
            submit () {
                if (this.isRunning) {
                    return ;
                }
                let res = this.check();
                if (!res.status) {
                    this.error[res.field] = res.msg;
                    vScroll(res.field);
                    return ;
                }
                topContext.ins.load.show();
                this.isRunning = false;
                let self = this;
                new Promise((resolve , reject) => {
                    // 保存基本数据
                    $.post({
                        url: this.saveUrl ,
                        data: this.form ,
                        success (data) {
                            if (data.code != '000') {
                                topContext.ins.load.hide();
                                self.isRunning = false;
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
                    // 保存图片
                    return new Promise((resolve) => {
                        this.saveImage(resolve);
                    });
                }).then((data) => {
                    // 更新图片
                    return new Promise((resolve) => {
                        if (G.isUndefined(data)) {
                            resolve();
                            return ;
                        }
                        this.updateImage(data.url , resolve);
                    });
                }).then((data) => {
                    topContext.ins.load.hide();
                    self.isRunning = false;
                    // 提示成功
                    this.layerSucc('操作成功' , {
                        btn: ['银行列表' , '继续操作'] ,
                        btn1 () {
                            window.location.href = genUrl(self.$store.state.route.mvc.controller , 'listView');
                        } ,
                        btn2 () {
                            layer.closeAll();
                        }
                    });
                });
            }
        } ,

        watch: {

        }
    });
})();