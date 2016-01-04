<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Insert title here</title>
<link rel="stylesheet" href="__PUBLIC__/Css/common.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/contactUs.css" />

<!-- <link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.min.css" />

<script type="text/javascript" src="__PUBLIC__/Js/bootstrap.min.js"></script>

<script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script> -->

 <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
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
<script type="text/javascript"
		src="http://webapi.amap.com/maps?v=1.3&key=0479b3237f84e6d4c0fdea00dea00deab60e">
	</script>

</head>
<body data-spy="scroll" data-target="#myScrollspy">
<div id="main">
<div class="title"><img src="__PUBLIC__/Images/top.gif" /></div>
<nav style="position:relative;z-index:10"> <a href="#" id="menuIcon">Ξ</a><!#表示浏览器不会跳转，仍然停留在该页面>
<ul>
	<li><a href="<?php echo U(GROUP_NAME.'/Index/index');?>">首页</a></li>
	<li><a href="<?php echo U(GROUP_NAME.'/Index/jiehunji');?>">结婚季</a></li>
	<li><a href="<?php echo U(GROUP_NAME.'/Index/youxiuanli');?>">优秀案例</a></li>
	<li><a href="<?php echo U(GROUP_NAME.'/Index/chanpinxilie');?>">产品系列</a></li>
	<li><a href="<?php echo U(GROUP_NAME.'/Index/gongyizhanshi');?>">工艺展示</a></li>
	<li><a href="<?php echo U(GROUP_NAME.'/Index/contactUs');?>">联系我们</a></li>
</ul>
</nav>
<!-- 附加导航 -->

<div class="content" style="position:relative;z-index:1">
<div class="row">
 <div class="col-xs-2" id="myScrollspy">
            <ul class="nav nav-tabs nav-stacked"  data-spy="affix"  data-offset-top="125">
                <li class="active"><a href="#section-1"  style="font-size:2.5vmin">上海衡山店</a></li>
                <li><a href="#section-2"  style="font-size:2.5vmin">上海虹井店</a></li>
                <li><a href="#section-3"  style="font-size:2.5vmin">上海静安店</a></li>
                <li><a href="#section-4"  style="font-size:2.5vmin">苏州店</a></li>
                <li><a href="#section-5"  style="font-size:2.5vmin">珠海店</a></li>
            </ul>
        </div><!-- myScrollspy的div --> 
<div class="col-xs-10"> 
<div  style="width:80%">
	<div id="section-1" style="font-size:3vmin">上海衡山店</div>

<div><img src="__PUBLIC__/Images/hengshan_SH.gif"></div>
	<div class="panel-group" id="accordion">
 <div class="panel panel-default">
    <div class="panel-heading">
        <a  id="hs" data-toggle="collapse" data-parent="#accordion" 
          href="#collapseOne">
          点击查看地图
        </a>
 
 </div>
    <div id="collapseOne" class="panel-collapse collapse" >
      <div class="panel-body" id="container">
     					<!-- zoom 地图显示的缩放级别 center 地图中心点坐标值-->
	 		<script type="text/javascript">
	 	
					var map=new AMap.Map('container',{
						resizeEnable:true,
						zoom:15,
						center:[121.443161,31.200919]
					});
			
					  var marker=new AMap.Marker(
							  {
									position:[121.443161,31.200919]
								  });
					  marker.setMap(map);
					  marker.on('click',function(e){
						  infowindow.open(map,e.target.getPosition());
						  });
		
		  var infowindow=new AMap.InfoWindow({
										content:'<div class="info-title">海彦衡山路店</div><div class="info-content">'+'<img src="__PUBLIC__/Images/logo.gif">'+'<p>上海衡山路534号衡山宾馆1楼</p><p>衡山店-地铁1号线 衡山路站(2号出口)--地铁19号线  上海图书馆站(3号出口)</p><p>联系电话:021-64377226</p>'+
								                '<p><a target="_blank" href = "">海彦链接</a></p></div>',
											size:new AMap.Size(300,200),
											
											});
									
			infowindow.open(map,[121.443161,31.200919]);

			</script>
      </div>

      </div>
    </div>
  </div>
  


	
	

	<div id="section-2" style="font-size:3vmin">上海虹井店</div> <div><img src="__PUBLIC__/Images/hongjing_SH.gif"></div>

	<div id="section-3" style="font-size:3vmin">上海静安店</div> <div><img src="__PUBLIC__/Images/jingan_SH.gif"></div>
	<div id="section-4" style="font-size:3vmin">苏州店</div> 
	<div>
	
<img src="__PUBLIC__/Images/suzhou_SZ.jpg">
<img src="__PUBLIC__/Images/suzhou_SZ2.jpg">

	
	</div>
	
	<div id="section-5" style="font-size:3vmin">珠海店</div> 
	<div>

	<img src="__PUBLIC__/Images/zhuhai_ZH.jpg">
	<img src="__PUBLIC__/Images/zhuhai_ZH2.jpg">

	</div>
	</div>
	</div><!-- end  <div class="col-xs-10"> -->
	</div><!-- end row -->
	<div><img src="__PUBLIC__/Images/logo_bottom.gif"></div>
</div>
<footer> <img src="__PUBLIC__/Images/bottomNew.gif"> </footer></div>

</body>
</html>