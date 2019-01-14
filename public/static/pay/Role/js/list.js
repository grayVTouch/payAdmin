(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dom: {} ,
            selectedAll: false ,
            idList: [] ,
            test: {

            }
        } ,
        computed: {
            
        } ,
        created () {

        } ,

        mounted () {
            this.dom.container = $(this.$refs.container);
        } ,

        methods: {
            del () {

            } ,

            // 选中所有
            selectAll () {

            } ,

            // 选中单条
            select (res) {

            } ,
        } ,

        watch: {

        }
    });
})();