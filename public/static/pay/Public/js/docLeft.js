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
            // 获取功能
            this.getMenu();
        } ,

        mounted () {
            this.dom.container = $(this.$refs.container);
        } ,

        methods: {
            // 获取菜单
            getMenu () {
                $.post(genUrl('Role' , 'menu') , (data) => {
                    if (data.code != '000') {
                        layer.msg(data.msg);
                        return ;
                    }
                    this.menu = data.data;
                    this.getPos();
                });
            } ,

            // 获取当前位置
            getPos () {
                $.post(genUrl('Misc' , 'pos') , (data) => {
                    if (data.code != '000') {
                        layer.msg(data.msg);
                        return ;
                    }
                    this.$store.state.pos = data.data;
                    this.initMenu();
                });
            } ,
            linkTo (id) {
                let route = this.findRoute('id' , id , this.menu);
                if (route.link == '') {
                    return ;
                }
                window.location.href = route.link;
            } ,

            // 初始化菜单
            initMenu () {
                this.openName = [this.$store.state.pos.top.id];
                this.activeName = this.$store.state.pos.sec.id;
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