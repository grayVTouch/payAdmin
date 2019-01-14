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

            }
        }
    });

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
            layerFail () {
                return layer.alert(2 , {
                    icon: 2
                });
            }
        }
    });
})();