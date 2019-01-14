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
            toLink (id) {
                return toLink(id);
            }
        }
    });
})();