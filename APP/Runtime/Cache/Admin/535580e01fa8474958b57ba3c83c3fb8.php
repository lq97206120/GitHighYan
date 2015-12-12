<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
  <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/base.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/index.css"/>
     <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/>
     <style type="text/css">
	.normaltab{color:#1F3A87 ;}
    .hovertab{ background-color:#420202;font-weight:bold;}
    .hovertab a{color:#FFFFFF}
	.dis{display:block;}
    .undis{display:none;}
	</style>
    <script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script>
     <script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
</head>
<body>
	 <!-- 头部开始 -->
    <div class="header">
      <div id="logo" class="fn-left">
        <h1 class="logo">后台管理系统</h1>
        <span class="slogan">v1.0</span>
      </div>
	  
	   <ul class="headermenu">
	       <li id="z_1" class="home"><a href="<?php echo U('Admin/Msg/msg');?>" target="opt">公告管理</a></li>  
         <li id="z_2" class="home"><a href="<?php echo U('Admin/Show/user');?>" target="opt">成员管理</a></li>        
	       <li id="z_3" class="home"><a href="<?php echo U('Admin/Paper/paper');?>" target="opt">论文管理</a></li>
	       <li id="z_4" class="home"><a href="<?php echo U('Admin/Project/project');?>" target="opt">项目管理</a></li>
          <li id="z_5" class="home"><a href="<?php echo U('Admin/Facility/facility');?>" target="opt">设备管理</a></li>
			<!--  <li id="z_5" class="home"><a href="<?php echo U('Admin/Index/changepwd',array('userid'=>$_SESSION['uid']));?>" target="opt">修改密码</a></li> -->
	       <li id="z_6" class="home"><a href="javascript:void(0)" target="opt" onclick="changepwd();">修改密码</a></li>
	       <li id="z_7" class="home"><a href="javascript:void(0)" target="opt" onclick="help();">查看帮助</a></li>
	
	         
	    </ul>
      <div class="head-right">
        <div class="userinfo user-name"><span><i class="icon-sort"></i>管理员&nbsp;<?php echo $_SESSION['uname'] ?></span>
          <div class="userpanel">
          <ul>
            <li>
            <!--  <a href="<?php echo U('Admin/Index/changeadmin',array('userid'=>$_SESSION['uid']));?>" target="opt" ><i class="icon icon-user"></i>信息设置</a> -->
            <a href="javascript:void(0)" target="opt"  onclick="changeadmin();"><i class="icon icon-user"></i>信息设置</a>
             <a href="javascript:void(0)" target="opt" onclick="changepwd();"><i class="icon icon-key"></i>修改密码</a>
             <a href="<?php echo U('Admin/Index/logout');?>"><i class="icon icon-cog"></i>退出登录</a>
            </li>
          </ul>
        </div>
        </div>
        <div class="userinfo update-cate">
          <a href="<?php echo U('Admin/Index/index','','');?>" style="margin-right:10px;"><span><i class="icon-repeat"></i>后台首页</span></a>
          <a href="<?php echo U('Index/Index/index','','');?>"><span><i class="icon-home"></i>网站首页</span></a>
        </div>
      </div>

	<!-- 头部js开始 -->
      <script type="text/javascript">
      $('.user-name').click(function(){
          $(this).children('.userpanel').slideDown();
      });
      $('.user-name').hover(function(){
      },function(){
        $(this).children('.userpanel').slideUp();
      });
        $('.headermenu li:not(.home) a').click(function() {
          var menuid=$(this).attr('menuid');
          $('.headermenu li').removeClass('active');
          $(this).parent().addClass('active');
         
        });
      </script>
     <!--  头部js结束 -->
    </div>
   <!--  头部结束 -->

    <div id="content">
    <!--  左部开始 -->
      <div id="menu">
	  
	  <div id="dis">
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td height="55" background="__PUBLIC__/images/nav01.gif">
				<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="25%" rowspan="2"><img src="__PUBLIC__/images/ico02.gif" width="35" height="35" onclick="" /></td>
					<td width="75%" height="22" class="left-font01"><font color="#0088cc">您好,<?php echo $_SESSION['uname'] ?></font></td>
				  </tr>
				  <tr>
					<td height="22" class="left-font01"><a href="<?php echo U('Admin/Index/logout');?>"><font color="#0088cc">[&nbsp;退出&nbsp;]</font></a></td>
				  </tr>
				</table>
			</td>
		  </tr>
		</table>
		  <ul class="left-menu">
		 <li>
            <span id="span"><a href="#"><i class="icon-chevron-right"></i>&nbsp;&nbsp;公告信息中心</a></span>
            <ul class="son">
           		<li><a href="<?php echo U('Admin/Msg/msg');?>" target="opt"><i class="icon-fixed-width icon-pencil"></i>&nbsp;&nbsp;公告管理</a></li>
             </ul>
          </li>
		
          <li>
            <span><a href="#"><i class="icon-chevron-right"></i>&nbsp;&nbsp;成员信息中心</a></span>
            <ul class="son">
              <li><a href="<?php echo U('Admin/Show/user');?>" target="opt"><i class="icon-fixed-width icon-pencil"></i>&nbsp;&nbsp;成员管理</a></li>
            </ul>
          </li>
          <li>
            <span><a href="#"><i class="icon-chevron-right"></i>&nbsp;&nbsp;论文信息中心</a></span>
            <ul class="son">
              <li><a href="<?php echo U('Admin/Paper/paper');?>" target="opt"><i class="icon-fixed-width icon-pencil"></i>&nbsp;&nbsp;论文管理</a></li>
            </ul>
          </li>
          <li>
            <span><a href="#"><i class="icon-chevron-right"></i>&nbsp;&nbsp;项目信息中心</a></span>
            <ul class="son">
              <li><a href="<?php echo U('Admin/Project/project');?>" target="opt"><i class="icon-fixed-width icon-pencil"></i>&nbsp;&nbsp;项目管理</a></li>
            </ul>
          </li>
           <li>
            <span><a href="#"><i class="icon-chevron-right"></i>&nbsp;&nbsp;设备信息中心</a></span>
            <ul class="son">
              <li><a href="<?php echo U('Admin/Facility/facility');?>" target="opt"><i class="icon-fixed-width icon-pencil"></i>&nbsp;&nbsp;设备管理</a></li>
            </ul>
          </li>
          <li>
            <span><a href="#"><i class="icon-chevron-right"></i>&nbsp;&nbsp;系统信息管理</a></span>
            <ul class="son">
              <li><a href="javascript:void(0)" target="opt"  onclick="changeadmin();"><i class="icon-fixed-width icon-cogs"></i>&nbsp;&nbsp;管理员信息设置</a></li>
             <li><a href="javascript:void(0)" target="opt" onclick="changepwd();"><i class="icon-fixed-width icon-cogs"></i>&nbsp;&nbsp;管理员密码修改</a></li>
             <li><a href="javascript:void(0)" target="opt"  onclick="help();"><i class="icon-fixed-width icon-book"></i>&nbsp;&nbsp;系统帮助</a></li>
            </ul>
          </li>
        </ul>
		</div>
		
        <ul id="shortcut-ico" class="fn-hide">
          <li><a href="<?php echo U('Admin/Msg/msg');?>" target="opt" title="公告管理"><i class="icon icon-pencil"></i></a></li>
          <li><a href="<?php echo U('Admin/Show/user');?>" target="opt" title="成员管理"><i class="icon icon-pencil"></i></a></li>
          <li><a href="<?php echo U('Admin/Paper/paper');?>" target="opt" title="论文管理"><i class="icon icon-pencil"></i></a></li>
          <li><a href="<?php echo U('Admin/Project/project');?>" target="opt" title="项目管理"><i class="icon icon-pencil"></i></a></li>
          <li><a href="<?php echo U('Admin/Facility/facility');?>" target="opt" title="设备管理"><i class="icon icon-pencil"></i></a></li>
        </ul>
        <div class="close-left" title="点击显示快捷菜单"></div>
      </div>
      <!--  左部结束 -->

      <!--  右部开始 -->
      <div id="opt">
        <iframe name="opt" src="<?php echo U('Admin/Index/home');?>" frameborder="0"></iframe>
      </div>
      <!--  右部结束 -->    
      
    </div>  
    
	<!-- 左部js开始 -->
      <script type="text/javascript">
      var changepwdUrl = "<?php echo U('Admin/Index/changepwd',array('userid'=>$_SESSION['uid']),'');?>";
      var changeadminUrl = "<?php echo U('Admin/Index/changeadmin',array('userid'=>$_SESSION['uid']));?>";
       var helpUrl = "<?php echo U('Admin/Index/help','','');?>";
      
      function changepwd(){
    	  $.layer({
    		    type : 1,
    		    title : '修改密码',
    		    page : {url : changepwdUrl},
    		    area : ['500px' , '300px'],
    		    offset : ['100px','']
    		});
      }
      
      function changeadmin(){   	      	
        	  $.layer({
        		    type : 1,
        		    title : '管理员信息设置',
        		    page : {url : changeadminUrl},
        		    area : ['500px' , '530px'],
        		    offset : ['60px','']
        		});
      }

      function help(){             
            $.layer({
                type : 2,
                title : '查看帮助',
                iframe : {src : helpUrl},
                area : ['500px' , '500px'],
                offset : ['60px','']
            });
      }
      
      
      window.onload=function(){(window.onresize=function(){
          //获取可见宽度
          var _document_width=document.documentElement.clientWidth,
          //获取可见高度
          _document_height=document.documentElement.clientHeight,
          _menu_width=$('#menu').outerWidth(),
          _bottom_height=_document_height-60;
          document.getElementById('menu').style.height=_bottom_height+'px';
          document.getElementById('opt').style.width=_document_width-_menu_width+'px';
          document.getElementById('opt').style.height=_bottom_height+'px';
      })()};
      $('.close-left').toggle(function(){
        
        left_w = $('#menu') . outerWidth();
        var right_w = $('#opt') . outerWidth() + left_w-30-7;
        $('.left-menu').fadeOut();
        $('#menu').animate({width:"30px"},function(){
            $('#shortcut-ico').show();
        });
        $('#opt').animate({"width":right_w+"px"});
        $(this).addClass('enable-left').attr("title","点击显示菜单列表")
      },function(){
        var right_w = $('#opt') . width() - left_w+30;
        $('#shortcut-ico').fadeOut(function(){
            $('.left-menu').fadeIn();
          }
        );
        $('#menu').animate({"width":left_w-7+"px"});
        $('#opt').animate({"width":right_w+"px"});
        $(this).removeClass('enable-left').attr("title","点击显示快捷菜单")
      });
      $('#menu span').live("click",function() {
        if($(this).next('ul:visible').length==0){
          $('#menu .son').slideUp();
          $(this).next().slideDown();
        }else{
          $(this).next().slideUp();
        }
        return false;
      });
      $('#menu .son a').hover(function(){
        $(this).addClass('son-hover');
      },function(){
        $(this).removeClass('son-hover');
      });
      </script>
    <!--   左部分js结束 -->
</body>
</html>