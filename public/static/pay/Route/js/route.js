(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dom: {} ,
            form: {
                id: null ,
                name: '' ,
                code: '' ,
                weight: 0
            } ,
            // 错误信息
            error: {

            } ,
            type: '' ,
        } ,
        created () {
            this.initData();
        } ,

        mounted () {
            this.dom.form = $(this.$refs.form);
            this.form.id = this.dom.form.data('id');
            this.type = this.dom.form.data('type');

            this.initData();
        } ,

        methods: {
            // 获取数据
            initData () {
                if (this.type != 'edit') {
                    return ;
                }
                let self = this;
                $.post({
                    url: this.genUrl('Role' , 'role' , {id: this.form.id}) ,
                    success (data) {
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        let res = data.data;
                        self.form.name = res.name;
                        self.form.code = res.code;
                        self.form.weight = res.weight;
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
                let res = this.check();
                if (!res.status) {
                    this.error[res.field] = res.msg;
                    toAnchorLink(res.field);
                    return ;
                }
                topContext.ins.load.show();
                let self = this;
                $.post({
                    url: this.genUrl('Role' , this.type , {id: this.form.id}) ,
                    data: this.form ,
                    success (data) {
                        topContext.ins.load.hide();
                        if (data.code == '001') {
                            self.error = data.data;
                            toAnchorLink(firstKey(data.data));
                            return ;
                        }
                        if (data.code == '002') {
                            self.layerFail(data.msg);
                            return ;
                        }
                        self.layerSucc(data.msg , {
                            btn: ['角色列表' , '继续操作'] ,
                            btn1 () {
                                window.location.href = genUrl('Role' , 'listView');
                            } ,
                            btn2 () {
                                layer.closeAll();
                            }
                        });
                    }
                });
            }
        } ,

        watch: {

        }
    });
})();