// 全局作用域
window.topContext = {
    // vue 实例
    vue: {
        docLeft: null ,
        topForDocRight: null ,
        btmForDocRight: null
    } ,
    dom: {
        win: $(window) ,
        doc: $(document.documentElement) ,
        body: $(document.body)
    } ,
    duration: 300 ,
    ins: {
        // 全局实例
        load: new Loading($('#pub-load-container').get(0))
    }
};