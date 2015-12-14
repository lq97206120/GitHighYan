var windowSize=function () {
 var winWidth,winHeight;
 //获取窗口宽度
 if (window.innerWidth)
 winWidth = window.innerWidth;
 else if ((document.body) && (document.body.clientWidth))
 winWidth = document.body.clientWidth;
 //获取窗口高度
 if (window.innerHeight)
 winHeight = window.innerHeight;
 else if ((document.body) && (document.body.clientHeight))
 winHeight = document.body.clientHeight;
 //通过深入Document内部对body进行检测，获取窗口大小
 if (document.documentElement && document.documentElement.clientHeight &&document.documentElement.clientWidth)
 {
 winHeight = document.documentElement.clientHeight;
 winWidth = document.documentElement.clientWidth;
 }
 //返回对象结果
 return {'width':winWidth,'w':winWidth,'height':winHeight,'h':winHeight};
}

//上述代码通过windowSize方法返回当前浏览器一屏窗口的宽度与高度【注意此处一屏的概念】

$(document).ready(function ()  {
 var PageStyle= function () {
 var SysWidht = windowSize().width,wrap=$('.wrap');//此处也可以使用jquery的$(window).width()获取页面宽度
 if(SysWidht<1200) {
 wrap.removeClass('wrapBig').addClass('wrapSmall');
 }else {
 wrap.removeClass('wrapSmall').addClass('wrapBig');
 }
 };
 /*init*/
 PageStyle();
 /*event*/
 $(window).resize(function () {
 PageStyle();
 });
});