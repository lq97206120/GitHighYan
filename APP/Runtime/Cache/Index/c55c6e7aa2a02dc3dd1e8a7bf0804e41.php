<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>主页</title>
<link rel="stylesheet" href="__PUBLIC__/css/common.css"/>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script language="JavaScript" src="__PUBLIC__/js/adapt_screen.js"></script>
<script type="text/javascript">
 function setWindowSize(){ //iframe自动本窗口高度
 try{
  var thiswin = window.parent.document.getElementById(window.name);
  if(window.document.body.scrollWidth-thiswin.offsetWidth>6){
   document.body.style.overflowX="auto";
   thiswin.height=window.document.body.scrollHeight+20;
   thiswin.width=window.document.body.scrollWidth+20;
  }else{
   document.body.style.overflowX="hidden";
   thiswin.height=window.document.body.scrollHeight;
   thiswin.width=window.document.body.scrollWidth
  }
 }catch(e){ } 
 }
</script>
</head>

<body onLoad="setWindowSize()">
<img src="__ROOT__/Public/images/homepage.gif">
</body>
</html>