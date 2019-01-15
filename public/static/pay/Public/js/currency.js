// 生成 url 字符串
function genUrl(c , a , param){
    param = G.isUndefined(param) ? {} : param;
    let queryStr = '';
    for (let k in param)
    {
        let v = param[k];
        queryStr += k + '=' + v + '&';
    }
    let lastChar = queryStr.slice(-1);
    queryStr = lastChar == '&' ? queryStr.slice(0 , -1) : queryStr;
    queryStr = queryStr.length == '' ? queryStr : '?' + queryStr;
    let path = '/pay/' + c + '/' + a;
    return path + queryStr;
}

// 生成锚点链接
function toAnchorLink(id){
    let url = window.location.href.split('#')[0] + '#' + id;
    window.location.href = url;
}

// 获取对象的首个属性
function firstKey(obj){
    return Object.keys(obj)[0];
}

// 指定 id 滚动到指定位置
// 注意这是特意为当前项目而写的！
// 如果换过一个容器元素就会出现错误！
// 请仅在当前项目使用
function vScroll (id , fn) {
    let dom = G('#' + id);
    let container = G('#doc-right');
    let val = dom.getDocOffsetVal('top');
    let extra = 50;
    val -= extra;
    container.vScroll(topContext.duration , val , fn);
}

