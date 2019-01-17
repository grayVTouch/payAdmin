topContext.mixin = {
    // 内部加载
    load: {
        data () {
            return {
                '$load': null
            };
        } ,
        mounted () {
            // mixin mounted
            console.log('mixin mounted');

            this.$load = new Loading(this.$refs.load_container);
        } ,
    } ,
    /**
     * ********************
     * 通用功能：列表
     * ********************
     */
    list: {
        // 列表：预定义字段
        field: {
            data () {
                return {
                    // 选择的 id 列表
                    idList: [] ,
                    // 条件过滤
                    form: {} ,
                    // 数据 url
                    dataUrl: '' ,
                    // 删除 url
                    delUrl: '' ,
                    // 列表数据
                    data: {
                        total: 0 ,
                        data: []
                    } ,
                    // 排序
                    order: [
                        // 参考以下书写
                        // {
                        //     name: 'id' ,
                        //     order: {
                        //         'id|asc': '升序' ,
                        //         'id|desc': '降序' ,
                        //     }
                        // } ,
                    ]
                };
            } ,
        } ,

        // 列表：全选/单选
        select: {
            methods: {
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
                    $('.tr' , this.$refs.trContainer).each((k , dom) => {
                        this.selectedLine(dom);
                    });
                } ,

                // 反选所有
                unselectedAll () {
                    $('.tr' , this.$refs.trContainer).each((k , dom) => {
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
            }
        } ,
        // 列表：删除当前项
        delEvent: {
            methods: {
                // 删除事件
                delEvent (id) {
                    this.idList = [id];
                    this.del();
                } ,
            }
        } ,
        // 列表：删除选中项
        delSelectedEvent: {
            methods: {
                // 删除选中项
                delSelectedEvent () {
                    this.del();
                } ,
            }
        } ,
        // 列表：删除
        del: {
            methods: {
                // 删除数据
                del () {
                    if (this.idList.length === 0) {
                        layer.alert('请选择要删除的行');
                        return ;
                    }
                    let self = this;
                    topContext.ins.load.show();
                    $.post({
                        url: self.delUrl ,
                        data: {
                            id_list: JSON.stringify(this.idList)
                        } ,
                        success (data) {
                            topContext.ins.load.hide();
                            if (data.code != '000') {
                                layer.alert(data.msg);
                                return ;
                            }
                            self.initData(self.dataUrl);
                        }
                    });
                } ,
            }
        } ,
        // 列表：获取数据
        get: {
            methods: {
                // 获取数据
                initData () {
                    let self = this;
                    this.$load.show();
                    this.idList = [];
                    $.post({
                        url: this.dataUrl ,
                        data: this.form ,
                        success (data) {
                            self.$load.hide();
                            if (data.code != '000') {
                                layer.msg(data.msg);
                                return ;
                            }
                            data = data.data;
                            self.data = data.data;
                            // self.form = data.filter;
                        }
                    });
                } ,
            }
        } ,
        // 列表：搜索
        search: {
            methods: {
                reset () {
                    Object.keys(this.form).forEach(v => {
                        this.form[v] = '';
                    });
                    this.initData();
                } ,
            }
        } ,
        // 列表：分页
        page: {
            methods: {
                // 分页事件
                pageEvent (page) {
                    this.form.page = page;
                    this.initData();
                } ,
            }
        }
    } ,

    /**
     * *********************
     * 通用功能：表单
     * *********************
     */

};