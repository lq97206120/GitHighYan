var windowSize=function () {
 var winWidth,winHeight;
 //��ȡ���ڿ��
 if (window.innerWidth)
 winWidth = window.innerWidth;
 else if ((document.body) && (document.body.clientWidth))
 winWidth = document.body.clientWidth;
 //��ȡ���ڸ߶�
 if (window.innerHeight)
 winHeight = window.innerHeight;
 else if ((document.body) && (document.body.clientHeight))
 winHeight = document.body.clientHeight;
 //ͨ������Document�ڲ���body���м�⣬��ȡ���ڴ�С
 if (document.documentElement && document.documentElement.clientHeight &&document.documentElement.clientWidth)
 {
 winHeight = document.documentElement.clientHeight;
 winWidth = document.documentElement.clientWidth;
 }
 //���ض�����
 return {'width':winWidth,'w':winWidth,'height':winHeight,'h':winHeight};
}

//��������ͨ��windowSize�������ص�ǰ�����һ�����ڵĿ����߶ȡ�ע��˴�һ���ĸ��

$(document).ready(function ()  {
 var PageStyle= function () {
 var SysWidht = windowSize().width,wrap=$('.wrap');//�˴�Ҳ����ʹ��jquery��$(window).width()��ȡҳ����
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