(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dom: {} ,
            idList: [] ,
            data: {
                total: 0 ,

                data: []
            } ,
            page: 1
        } ,
        computed: {

        } ,

        created () {
            this.initData();
        } ,

        mounted () {

        } ,

        methods: {
            // 获取数据
            initData () {
                let self = this;
                topContext.ins.load.show();
                $.post({
                    url: genUrl('Route' , 'list') ,
                    success (data) {
                        topContext.ins.load.hide();
                        if (data.code != '000') {
                            layer.msg(data.msg);
                            return ;
                        }
                        self.data = data.data;
                        self.$nextTick(() => {
                            self.dom.trs = $('.tr' , self.$refs.tbody);
                        });
                    }
                });
            } ,

            // 选中所有
            selectedAllEvent (e) {
                let tar     = e.currentTarget;
                let checked = tar.checked;
                if (checked) {
                    this.selectedAll();
                } else {
                    this.unselectedAll();
                }
            } ,

            // 选中单条
            selectedLineEvent (e) {
                let tar = $(e.currentTarget);
                if (tar.hasClass('focus')) {
                    this.unselectedLine(tar.get(0));
                } else {
                    this.selectedLine(tar.get(0));
                }
            } ,

            // 选中所有
            selectedAll () {
                this.dom.trs.each((k , dom) => {
                    this.selectedLine(dom);
                });
            } ,

            // 反选所有
            unselectedAll () {
                this.dom.trs.each((k , dom) => {
                    this.unselectedLine(dom);
                });
            } ,

            // 单行选中
            selectedLine (tr) {
                tr = $(tr);
                let id = tr.data('id');
                tr.addClass('focus');
                $('.c-box' , tr.get(0)).get(0).checked = true;
                this.addId(id);
            } ,

            // 单行反选
            unselectedLine (tr) {
                tr = $(tr);
                let id = tr.data('id');
                tr.removeClass('focus');
                $('.c-box' , tr.get(0)).get(0).checked = false;
                this.delId(id);
            } ,

            // 添加 id
            addId (id) {
                let exists = false;
                for (let i = 0; i < this.idList.length; ++i)
                {
                    let cur = this.idList[i];
                    if (cur == id) {
                        exists = true;
                        break;
                    }
                }
                if (!exists) {
                    this.idList.push(id);
                }
            } ,

            // 删除 id
            delId (id) {
                for (let i = 0; i < this.idList.length; ++i)
                {
                    let cur = this.idList[i];
                    if (cur == id) {
                        this.idList.splice(i , 1);
                        i--;
                    }
                }
            } ,

            // 删除事件
            delEvent (id) {
                this.del([id]);
            } ,

            // 删除选中项
            delSelectedEvent () {
                this.del(this.idList);
            } ,

            // 分页事件
            pageEvent (page) {
                this.page = page;
                this.initData();
            } ,


            // 删除数据
            del (idList) {
                if (idList.length === 0) {
                    layer.alert('请选择要删除的行');
                    return ;
                }
                let self = this;
                topContext.ins.load.show();
                $.post({
                    url: genUrl('Role' , 'del') ,
                    data: {
                        id_list: JSON.stringify(idList)
                    } ,
                    success (data) {
                        topContext.ins.load.hide();
                        if (data.code != '000') {
                            layer.alert(data.msg);
                            return ;
                        }
                        self.initData();
                    }
                });
            } ,

        } ,

        watch: {

        }
    });
})();