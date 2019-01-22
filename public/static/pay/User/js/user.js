(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            form: {
                uid: null ,
                phone: '' ,
                username: '' ,
                nick_name: '' ,
                password: '' ,
                enable: 1 ,
                isdelete: 0 ,
                role_id: '' ,
                mno: '' ,
                key: '' ,
            } ,
            // 错误信息
            error: {} ,
            // 动作类型
            type: '' ,
            ins: {} ,
            isRunning: false ,
            //回调函数
            callback: {
                // 头像上传
                image: null ,
            } ,
            dataUrl: '' ,
            saveUrl: '' ,
            role: [] ,
            // 密码
            password: ''
        } ,
        mixins: [
            topContext.mixin.form.field ,
            topContext.mixin.form.init ,
            topContext.mixin.form.get
        ] ,
        created () {
            this.getRole();
        } ,
        mounted () {
            let self = this;
            // 图片
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
                    if (G.isFunction(self.callback.image)) {
                        self.callback.image(data);
                    }
                }
            });
            this.form.uid = this.$store.state.route.query.uid;
            // 获取数据的链接
            this.dataUrl = genUrl(this.$store.state.route.mvc.controller , 'get' , {uid: this.form.uid});
            this.saveUrl = genUrl(this.$store.state.route.mvc.controller , this.type);
            this.initData(() => {
                this.form.password = '';
            });
        } ,

        methods: {
            // 获取角色数据
            getRole () {
                let self = this;
                $.post({
                    url: genUrl('Role' , 'all') ,
                    success (data) {
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        self.role = data.data;
                    }
                });
            } ,

            // 上传图片
            saveImage (resolve) {
                if (this.ins.image.empty()) {
                    resolve();
                    return ;
                }
                this.callback.image = resolve;
                this.ins.image.upload();
            } ,

            // 更新图片
            updateImage (image , resolve) {
                $.post({
                    url: genUrl(this.$store.state.route.mvc.controller , 'saveImage') ,
                    data: {
                        uid: this.form.uid ,
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
            check () {
                return {
                    status: true ,
                    field: '' ,
                    msg: ''
                };
            } ,

            // 数据提交
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
                            self.form.uid = data.data;
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
                        btn: ['用户列表' , '继续操作'] ,
                        btn1 () {
                            window.location.href = genUrl(self.$store.state.route.mvc.controller , 'listView');
                        } ,
                        btn2 () {
                            layer.closeAll();
                        }
                    });
                });
            } ,
        } ,

        watch: {
            password (nv , ov) {
                this.form.password = nv;
            }
        }
    });
})();