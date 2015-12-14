<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Insert title here</title>
<link rel="stylesheet" href="__PUBLIC__/Css/common.css"/>
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#menuIcon,nav ul li").click(function() {
			if ($("#menuIcon").is(":visible")) { 
					$("nav ul").toggle(300);
			};
		});
		$(window).resize(function() {
		    if (!$("nav ul").is(":visible")) {
		        $('nav ul').attr('style', function(i, style){
		            return style.replace(/display[^;]+;?/g, '');
		        });
		    };
		});
	})
</script>

</head>
<body>
	<div id="main">
		<div class="title">
			<img src="__PUBLIC__/Images/top.gif"/>
		</div>
		<nav>
			<a href="#" id="menuIcon">Ξ</a><!#表示浏览器不会跳转，仍然停留在该页面>
			<ul>
				<li>
					<a href="<?php echo U(GROUP_NAME.'/Index/index');?>">首页</a>
				</li>
				<li>
				    <a href="<?php echo U(GROUP_NAME.'/Index/jiehunji');?>">结婚季</a>
				</li>
				<li>
					<a href="<?php echo U(GROUP_NAME.'/Index/youxiuanli');?>">优秀案例</a>
				</li>
				<li>
					<a href="<?php echo U(GROUP_NAME.'/Index/chanpinxilie');?>">产品系列</a>
				</li>
				<li>
					<a href="<?php echo U(GROUP_NAME.'/Index/gongyizhanshi');?>">工艺展示</a>
				</li>
				<li>
					<a href="<?php echo U(GROUP_NAME.'/Index/contactUs');?>">联系我们</a>
				</li>
			</ul>
		</nav>
		<div class="content">
			<img src="__PUBLIC__/Images/homepage.gif">
		</div>
		<footer>
			<img src="__PUBLIC__/Images/bottomNew.gif">
		</footer>
	</div>

</body>
</html>