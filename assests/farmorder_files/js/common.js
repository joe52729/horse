
// 內容頁面欄位置右
// $(window).on("scroll resize",function(){
//     if( $(window).width() > 768 ){
//         var $win = $(window),
//             $ad = $('#li-right'),	
//             _height = $ad.height(),
//             _diffY = 120,	// 距離右及下方邊距
//             _moveSpeed = 200;	// 移動的速度
//             var $this = $(this);
            
//             $ad.stop().animate({
//                 top: $this.scrollTop(),
//             }, _moveSpeed);
//     }else{
//         $("#li-right").removeAttr("style").removeClass("pa_ri0");
//     }
// })
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)
        return unescape(r[2]);
    return null;
}

/*
* url 目标url(http://www.phpernote.com/)
* arg 需要替换的参数名称
* arg_val 替换后的参数的值
* return url 参数替换后的url
*/
function changeURLArg(url, arg, arg_val) {
    var pattern = arg + '=([^&]*)';
    var replaceText = arg + '=' + arg_val;
    if (url.match(pattern)) {
        var tmp = '/(' + arg + '=)([^&]*)/gi';
        tmp = url.replace(eval(tmp), replaceText);
        return tmp;
    } else {
        if (url.match('[\?]')) {
            return url + '&' + replaceText;
        } else {
            return url + '?' + replaceText;
        }
    }
    return url + '\n' + arg + '\n' + arg_val;
}