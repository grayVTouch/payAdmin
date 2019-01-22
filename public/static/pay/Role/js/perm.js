(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            tree: [
                // 单个
                // {
                //     title: '顶级项' ,
                //     expand: true ,
                //     selected: false ,
                //     checked: true ,
                //     children: [
                //         {
                //             title: 'PHP 工程师' ,
                //             expand: true ,
                //             selected: false ,
                //             children: [
                //                 {
                //                     title: '高级工程师' ,
                //                     disabled: true
                //                 } ,
                //                 {
                //                     title: '中级工程师' ,
                //                 } ,
                //                 {
                //                     title: '初级工程师' ,
                //                 } ,
                //             ]
                //         }
                //     ]
                // }
            ] ,
            // 是否批量授权
            relation: true ,
            // 授权的角色权限
            routes: [] ,
            // 属性菜单是否展开还是收缩
            expand: true ,
            route: null ,
            perm: null ,
            isRunning: false ,
            count: 0 ,
            form: {
                id: null ,
                route: null
            } ,
            dom: {}
        } ,
        created () {

        } ,

        mounted () {
            this.dom.form = $(this.$refs.form);
            this.form.id = this.dom.form.data('id');
            this.initData();
        } ,

        methods: {
            // 获取数据
            initData () {
                let self = this;
                $.post({
                    url: genUrl('Role' , 'perm' , {id: this.form.id}) ,
                    // 获取数据后，设置上去
                    success (data) {
                        if (data.code != '000') {
                            return ;
                        }
                        data = data.data;
                        self.route = data.route;
                        self.perm = data.perm;
                        self.genTree(self.route , self.tree);
                    }
                });
            } ,

            // 检查是否具备该权限
            existsRoute (id) {
                for (let i = 0; i < this.perm.length; ++i)
                {
                    let cur = this.perm[i];
                    if (cur.route_id == id) {
                        // 具备权限
                        return true;
                    }
                }
                return false;
            } ,

            // 生成数行结构（渲染出树状图）
            genTree (list , tree) {
                if (this.count++ > 1000) {
                    console.log('死循环');
                    return ;
                }
                for (let i = 0; i < list.length; ++i)
                {
                    let cur = list[i];
                    let checked = this.existsRoute(cur.id);
                    // console.log(cur.name , cur.id , cur.link , checked);
                    let disabled = !(cur.enable == 'y');
                    let unit = {
                        id: cur.id ,
                        title: cur.name ,
                        expand: this.expand ,
                        selected: false ,
                        checked ,
                        disabled ,
                        children: []
                    };
                    if (unit.checked) {
                        // 授权的路由
                        this.routes.push(unit.id);
                    }
                    tree.push(unit);
                    this.genTree(cur.children , unit.children);
                }
            } ,

            // 选中值
            selectItemForTree (nodes , cur) {
                // 不响应项选择
                cur.expand = !cur.expand;
                cur.selected = false;
                if (cur.children.length > 0) {
                    return ;
                }
                cur.checked = !cur.checked;
                this.checkboxEvent(cur.id , cur.checked);
            } ,

            // 选中复选框
            selectCheckboxForTree (nodes , cur) {
                this.checkboxEvent(cur.id , cur.checked);
                // console.log(nodes);
            } ,

            // 复选框状态变化事件
            checkboxEvent (id , checked) {
                if (checked) {
                    this.authorize(id , 'add');
                } else {
                    this.authorize(id , 'del');
                }
            } ,

            // 授权
            authorize (id , action) {
                let range = ['add' , 'del'];
                if (range.indexOf(action) == -1) {
                    throw new Error('不支持的操作类型');
                }
                if (action == 'add') {
                    // 添加
                    if (this.routes.indexOf(id) != -1) {
                        return;
                    }
                    this.routes.push(id);
                    return ;
                }
                // 删除
                this.routes.splice(this.routes.indexOf(id) , 1);
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
                e.preventDefault();
                console.log('数据提交');
                let res = this.check();
                if (this.isRunning) {
                    return ;
                }
                if (!res.status) {
                    this.error[res.field] = res.msg;
                    vScroll(res.field);
                    return ;
                }
                this.form.route= JSON.stringify(this.routes);
                topContext.ins.load.show();
                let self = this;
                $.post({
                    url: this.genUrl('Role' , 'authorize') ,
                    data: this.form ,
                    success (data) {
                        self.isRunning = false;
                        topContext.ins.load.hide();
                        if (data.code != '000') {
                            self.layerFail(data.msg);
                            return ;
                        }
                        self.layerSucc(data.msg , {
                            btn: ['返回上一页' , '继续操作'] ,
                            btn1 () {
                                window.history.go(-1);
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