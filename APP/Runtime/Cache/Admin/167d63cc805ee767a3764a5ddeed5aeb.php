<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/bootstrap/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/home.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/public.css"/>
    <script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script>

  </head>
 <body style="padding:20px;">
     <div id="panel-left">
      <div >
        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon-user"></span>
                    <span>个人信息</span>
                </h4>
                <a href="#" class="minimize hide"></a>
            </div>
            <div class="content" style="display: block;">
                    <p>你好，<?php echo $_SESSION['uname'] ?></p>
                    <p>所属角色：<?php echo $_SESSION['uname'] ?></p>
                    <p>登录时间：<?php date_default_timezone_set("PRC"); echo date("Y-m-d H:i:s  l") ?></p>
                    <p>登录IP：<?php $iipp=$_SERVER["REMOTE_ADDR"]; echo $iipp ?></p>
                </table>
            </div>
        </div>
      </div>
       <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-exclamation-sign"></span>
                      <span>安全提示</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content sys" style="display: block;">
                <p>建议将hdphp目录权限修改为644</p>
                <p>建议将web目录权限修改为644</p>
                <p>系统安装完成后将install目录删除</p>
              </div>
          </div>
        </div>
        <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-flag"></span>
                      <span>系统信息</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content" style="display: block;">
                <p>实验室科研信息管理平台 <span id="version"></span><span id="new-version"><a class="success" href="">有新版本发布了，马上更新？</a></span></p>
                <p class="hide" id="show-new-version"></p>
                <p>操作系统：windows/linux</p>
                <p>PHP：5.2.6.6</p>
                <p>服务器环境：Apache2.2</p>
                <p>MySQL版本：6.0</p>
              </div>
          </div>
        </div>
        </div>
        <div id="panel-right">
        <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-tags"></span>
                      <span>快捷操作</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content fast-opt" style="display: block;">
                 <a href="<?php echo U('Admin/Msg/msg');?>">公告信息</a>
                 <a href="<?php echo U('Admin/Paper/paper');?>">论文管理</a>
                 <a href="<?php echo U('Admin/Project/project');?>">项目管理</a>
                 <a href="<?php echo U('Admin/Facility/facility');?>">设备管理</a>
                 <a href="<?php echo U('Admin/Show/user');?>">成员管理</a>
                 
                
                 <div style="clear:both"></div>
              </div>
          </div>
        </div>
        <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-fire"></span>
                      <span>网站动态</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content" style="display: block;">
                <p>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  今日登录：<span class="success">xxx </span>人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  发布职位：<span class="success">xxx </span>个&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  新增项目：<span class="success">xxx </span>个
                </p>
                <p>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  总成员&nbsp;&nbsp;：<span class="success">xxx </span>人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  发布论文：<span class="success">xxx </span>篇&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  有效推广：<span class="success">xxx</span>个
                </p>
              </div>
          </div>
        </div>
        <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-question-sign"></span>
                      <span>帮助中心</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content fast-opt help-opt" style="display: block;">
                <a href="#" target="_blank">xxx网</a>
                <a href="#" target="_blank">xxx论坛</a>
                <a href="#" target="_blank">xxxPHPxxx</a>
                 <div style="clear:both"></div>
              </div>
          </div>
        </div>
        <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-home"></span>
                      <span>作者</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content" style="display: block;">
                <p>核心开发：<a href="mailto:xxx@gmail.com">xx</a></p>
                <p>技术支持：<a href="mailto:xxx@gmail.com">xx</a></p>
                <p>基于LAMP构建</p>
              </div>
          </div>
        </div>
         <div >
          <div class="box">
              <div class="title">
                  <h4>
                      <span class="icon-fire"></span>
                      <span>官方动态</span>
                  </h4>
                  <a href="#" class="minimize hide"></a>
              </div>
              <div class="content" id="news" style="display: block;">
               <p><a href="#" target="_blank">作品展示</a></p>
               <p><a href="#" target="_blank">基于ThinkPHP的开发</a></p>
               <p><a href="#">最新PHP介绍</a></p>
              </div>
          </div>
        </div>
</div>
        <style type="text/css">
        #panel-left{
          width: 45%;
          float: left;
          margin-right: 20px;
        }
        #panel-right{
          width: 45%;
          float: left;
        }
        .fast-opt a{
          padding:5px 20px;
        }
        .help-opt{
          padding:5px 10px;
        }
        #new-version{
          display: none;
          padding-left: 10px;
        }
        </style>
<script type="text/javascript" src="#"></script>
<script type="text/javascript">
  $('.title').hover(function(){
    $(this).children('.minimize').removeClass('hide');
  },function(){
    $(this).children('.minimize').addClass('hide');
  });
  $('.minimize').toggle(function(){
    $(this).parent().next().slideUp();
  },function(){
    $(this).parent().next().slideDown();
  });
</script>
  </body>
</html>