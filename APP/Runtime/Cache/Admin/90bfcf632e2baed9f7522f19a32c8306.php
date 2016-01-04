<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/bootstrap/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/login.css"/>
<title>海彦后台管理登陆页面</title>
    <script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/user.js"></script>
    <script type="text/javascript">
   			var verifyUrl='<?php echo U("Admin/Login/verify",'','');?>';
   			var loginindexUrl='<?php echo U("Admin/Login/index",'','');?>';
   			var loginloginUrl='<?php echo U("Admin/Login/login",'','');?>';
   			var indexUrl='<?php echo U("Admin/Index/index",'','');?>';
           
    </script>
</head>
<body>
   	<div id="header">
        <div id="login_top">海彦后台管理系统<span id="version">1.0</span></div>
        <div id = "login_welcome"><i class="icon-chevron-left"></i>欢迎使用 </div>
	</div>
	
    <div  id="login_body">
     <div id="login_left">
	
     <marquee behavior="scroll" height="150" direction=up scrollamount=2 scrolldelay=5 onmouseover="this.stop()" onmouseout="this.start()">
    <div style="color:#7F8D18;">
	<p>欢迎访问海彦后台管理系统</P>
	<p>温馨提示：</p>
	<p>本系统目前处于开发阶段，部分功能仍待完善。</p>
	
	</div>
	</marquee>
     </div>
        <span id="loginContainer">
        	<img id="login_img" src="__PUBLIC__/images/login.png"/>
            <!--<form  id="loginForm" >-->
                <table>
                    <tr>
                        <th><span class="login-input"><label for="name">用户名：</label></span></th>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-xlarge" tabindex="1" name="username" id="username" /></td>
                    </tr>
                    <tr>
                        <th><span class="login-input"><label for="pwd">密码：</label><a href=""></a></span> </th>
                    </tr>
                    <tr>
                        <td><input type="password" class="input-xlarge" tabindex="2" name="password" id="password" /></td>
                    </tr>
                   
                    <tr>
                        <th><span class="login-input"><label for="code">验证码：</label></span></th>
                    </tr>
                    <tr>
                        <td class="code">
                            <input type="text" class="input-mini" tabindex="3" name="code" id="code" />
                            <img id="verify_code" src="<?php echo U('Admin/Login/verify','','');?>" onclick="change_code()"/>
                            <a href="javascript:void(0)" onclick="change_code()">看不清，换一张</a>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                <tr id="login">
                	<td>
                    <input type="checkbox" name="remember" id="remember" />&nbsp;&nbsp;&nbsp;记住我&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button onclick="checklogin()" type="button" tabindex="3" class="btn btn-info"><i class="icon-edit icon-white"></i>&nbsp;&nbsp;登录</button>
            	</td>
                </tr>
                </table>
            <!--</form>-->
        </span>
    </div>
    <script type="text/javascript">
    //登录页面,验证码
    function change_code(){
    	$('#verify_code').attr("src",verifyUrl+'/'+Math.random());
    	return false;
    }
    $('#name').focus();  
    </script>
</body>
</html>