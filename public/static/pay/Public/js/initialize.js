(function(){
    'use strict';

    // 检查 vue 是否全部实例化
    (function(){
        let initialize = false;
        let timer = null;
        let loop = function(){
            window.clearTimeout(timer);
            for (let k in topContext.vue)
            {
                let cur = topContext.vue[k];
                if (!(cur instanceof Vue)) {
                    timer = window.setTimeout(loop , 1000);
                    return ;
                }
            }
            // 初始化
            setH();
        };
        let setH = function(){
            return ;
            let doc             = topContext.dom.doc.get(0);
            let docLeft         = topContext.vue.docLeft.dom.container;
            let topForDocRight  = topContext.vue.topForDocRight.dom.container;
            let btmForDocRight  = topContext.vue.btmForDocRight.dom.container;

            // debugger

            let minH = 300;
            let maxH = doc.clientHeight;
            let docLeftH = docLeft.height();
            let topForDocRightH = topForDocRight.height();
            let btmHForDocRight = maxH - topForDocRightH;

            btmHForDocRight = Math.max(minH , btmHForDocRight);

            // docLeftH = Math.max(minH , docLeftH);

            console.log(btmHForDocRight);
            
            btmForDocRight.css({
                minHeight: btmHForDocRight + 'px'
            });
        };

        topContext.dom.win.on('resize' , function(){
            if (initialize) {
                setH();
            }
        });

        loop();
    })();


})();