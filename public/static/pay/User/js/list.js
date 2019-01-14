(function(){
    'use strict';

     topContext.vue.btmForDocRight = new Vue({
        el: '#pub-btm' ,
        data: {
            dom: {

            }
        } ,
        created () {

        } ,
        mounted () {
            this.dom.container = $(this.$refs.container);
        } ,

        methods: {

        } ,

        watch: {

        }
    });
})();