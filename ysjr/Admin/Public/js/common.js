/**
 * Created by theme on 2016/4/22.
 */
//本地数据
// function addData(name, data) {
//     window.localStorage[name] = JSON.stringify(data);
// }
// function readData(name) {
//     var data=window.localStorage[name];
//     return JSON.parse(data);
// }
// function  deleteData(name){
//     window.localStorage.removeItem(name);
// }
var carlist=[
    {
        "shopid":2222,
        "num":1
    },
    {
        "shopid":2222,
        "num":1
    },
    {
        "shopid":2222,
        "num":1
    }
];
carlist.push({
    "shopid":2222222222,
    "num":5
});
//对象转字符
//if(readData("carlist")){
//    alert("you");
//    console.log(typeof readData("carlist"));
//    console.log(readData("carlist"))
//}else {
//
//}
//$(document).on("click",function(){
//    alert("删除");
//    deleteData("carlist") ;
//});
//退回按钮
    function back(){
    var x=0;
    $(".text li").click(function(event) {
        x=x+1;
    });
        $("a.back").on("click",function(){
            history.go(-(1+x));
        })
    }
back();
//基础服务器
var server ={
    base:"http://hgqq.v-tuo.cn/",
    img:"http://yiyuangoum.btao.net/statics/uploads/",
    errorimg:"http://hgqq.v-tuo.cn/letgo/img/img-error.png",
    link:"http://hgqq.v-tuo.cn/letgo/",
    sendCode:"http://hgqq.v-tuo.cn/?/mobile/ajax/userMobileregsn/",
    login:"http://hgqq.v-tuo.cn/?/mobile/ajax/userlogin/",
    jiexiao:"http://hgqq.v-tuo.cn/?/mobile/ajax/getLotteryList/",
    slides:"http://hgqq.v-tuo.cn/?/mobile/ajax/slides",
    shoplist:"http://hgqq.v-tuo.cn/?/mobile/mobile/glistajax/",
    list:"http://hgqq.v-tuo.cn/?/mobile/ajax/getcategory",
    detail:"http://hgqq.v-tuo.cn/?/mobile/ajax/getDataserver/",
    checkname:"http://hgqq.v-tuo.cn/?/mobile/ajax/checkname/",
    apply:"http:/hgqq.v-tuo.cn/?/mobile/ajax/userMobilesn/",
    resetpwd:"http://hgqq.v-tuo.cn/?/mobile/ajax/resetpwd/"
};
//图片错误
function imgerror(){
    $("img").error(function(){
        $(this).attr("src",server.errorimg);
    });
}
//地址传参
function getUrlParam(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r!=null) return unescape(r[2]); return null; //返回参数值
}