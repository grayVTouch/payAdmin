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