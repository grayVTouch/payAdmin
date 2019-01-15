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
            // 操作进度
            step: {
                base: false ,
                big: false ,
                small: false
            },
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
                    pluginUrl: '/plugin/UploadImage/' ,
                    mode: 'override' ,
                    url:  genUrl('Image' , 'single') ,
                    field: 'image' ,
                    success (json) {
                        let data = JSON.parse(json);
                        if (data.code != '000') {
                            self.step.big = true;
                            self.layerFail(data.msg);
                            return ;
                        }
                        data = data.data;
                        // 更新路由图片
                        self.updateIco(data.url , 'big');
                    }
                });
                this.ins.small = new UploadImage(this.dom.icoForSmall.get(0) , {
                    pluginUrl: '/plugin/UploadImage/' ,
                    mode: 'override' ,
                    url:  genUrl('Image' , 'single') ,
                    field: 'image' ,
                    success (json) {
                        let data = JSON.parse(json);
                        if (data.code != '000') {
                            self.step.small = true;
                            self.layerFail(data.msg);
                            return ;
                        }
                        data = data.data;
                        // 更新路由图片
                        self.updateIco(data.url , 'small');
                    }
                });
                // 获取数据
                this.getData();
            } ,

            uploadTest () {
                this.ins.big.upload();
            } ,

            // 保存路由图片
            saveIco (type) {
                if (type == 'big') {
                    if (this.ins.big.empty()) {
                        this.step.big = true;
                        return ;
                    }
                    this.ins.big.upload();
                } else {
                    if (this.ins.small.empty()) {
                        this.step.small = true;
                        return ;
                    }
                    this.ins.small.upload();
                }
            } ,

            // 更新路由图片
            updateIco (image,  type) {
                let self = this;
                $.post({
                    url: genUrl('Route' , 'saveImage') ,
                    data: {
                        id: this.form.id ,
                        type ,
                        image
                    } ,
                    success (data) {
                        self.step[type] = true;
                        if (data.status != '000') {
                            layer.msg(data.msg);
                            return ;
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

            test (val) {
                console.log('test');
                return G.isUndefined(val) || val == '' ? '' : 'error';
            } ,

            // 数据提交
            submit (e) {
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
                $.post({
                    url: this.genUrl('Route' , this.type , {id: this.form.id}) ,
                    data: this.form ,
                    success (data) {
                        self.step.base = true;
                        self.isRunning = false;
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

                        // 保存图片
                        self.saveIco('big');
                        self.saveIco('small');
                        // 轮询操作
                        G.loop.register(() => {
                            return Object.keys(self.step).every(v => {
                                return self.step[v] == true;
                            });
                        } , () => {
                            // 步骤重置
                            Object.keys(self.step).every(v => {
                                self.step[v] = false;
                            });
                            self.layerSucc(data.msg , {
                                btn: ['角色列表' , '继续操作'] ,
                                btn1 () {
                                    window.location.href = genUrl('Route' , 'listView');
                                } ,
                                btn2 () {
                                    layer.closeAll();
                                }
                            });
                        }).loop();
                    }
                });
            } ,
        } ,

        watch: {

        }
    });
})();