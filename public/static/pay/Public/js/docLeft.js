(function(){
    'use strict';

    topContext.vue.docLeft = new Vue({
        el: '#doc-left' ,
        data: {
            dom: {

            } ,
            menu: [] ,
            activeName: '' ,
            openName: [] ,
            val: {
                countForRoute: 0
            }
        } ,
        created () {
            $.post(genUrl('Role' , 'perms') , (data) => {
                if (data.code != '000') {
                    layer.msg(data.msg);
                    return ;
                }
                this.menu = data.data;
                this.initMenu();
            });
        } ,

        mounted () {
            this.dom.container = $(this.$refs.container);
        } ,

        methods: {
            linkTo (id) {
                let route = this.findRoute('id' , id , this.menu);
                if (route.link == '') {
                    return ;
                }
                window.location.href = route.link;
            } ,
            // 初始化菜单
            initMenu () {
                // 页面解析
                let path = window.location.pathname;
                let route = this.findRoute('link' , path , this.menu);
                if (route === false) {
                    throw new Error('未找到当前路径对应的路由：' + path);
                }
                this.openName = [route.p_id];
                this.activeName = route.id;
                this.$nextTick(() => {
                    this.$refs.menu.updateOpened();
                    this.$refs.menu.updateActiveName();
                })
            } ,
            // 找到路由
            findRoute (key , value , list) {
                if (this.val.countForRoute++ > 100) {
                    // 防止死循环代码
                    throw new Error('死循环');
                }
                let res = false;
                for (let i = 0; i < list.length; ++i)
                {
                    let cur = list[i];
                    if (cur[key] == value) {
                        res = cur;
                        break;
                    }
                    if (res = this.findRoute(key , value, cur.children)) {
                        break;
                    }
                }
                return res;
            }
        } ,

        watch: {

        }
    });
})();