(function(){
    'use strict';

    // store 对象
    let store = new Vuex.Store({
        state: {
            // 当前位置
            pos: {
                all: [] ,
                top: {} ,
                sec: {} ,
                cur: {}

            } ,
            topContext ,
            // 上传文件的名称
            image: 'image' ,
            route: {
                // 完整 url
                url: '' ,
                // host
                host: '' ,
                // 端口
                port: '' ,
                // 网络路径
                path: '' ,
                // 查询字符串
                search: '' ,
                // hash
                hash: '' ,
                // 查询字符串
                query: {} ,
                // mvc
                mvc: {
                    module: '' ,
                    controller: '' ,
                    action: ''
                }
            } ,
            // 当前登录用户信息
            user: {}
        }
    });

    (function(){
        // 查询字符串解析
        store.state.route.url = window.location.href;
        store.state.route.host = window.location.host;
        store.state.route.port = window.location.port;
        store.state.route.path = window.location.pathname;
        store.state.route.search = window.location.search;
        store.state.route.hash = window.location.hash;
        store.state.route.query = G.queryString();
        let mvc = store.state.route.path.substr(1).split('/');
        store.state.route.mvc = {
            module: mvc[0] ,
            controller: mvc[1] ,
            action: mvc[2]
        };
    })();

    // 全局混入对象
    Vue.mixin({
        store ,
        methods: {
            // 生成 url
            genUrl () {
                return genUrl.apply(this , arguments);
            } ,

            // 跳转到给定链接
            toAnchorLink (id) {
                return toAnchorLink(id);
            } ,

            // 返回针对某个值得类名！！
            errorClass (val) {
                return G.isValid(val) ? 'error' : '';
            } ,

            // 提示操作成功
            layerSucc (msg , option) {
                option = G.isObject(option) ? option : {};
                option.icon = 1;
                return layer.alert(msg , option);
            } ,

            // 提示操作失败
            layerFail (msg) {
                return layer.alert(msg , {
                    icon: 2
                });
            } ,

            // url 解析
            getRoute () {

            } ,
        }
    });
})();