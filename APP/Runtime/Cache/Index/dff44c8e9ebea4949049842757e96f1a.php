<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<!---->
<link rel="stylesheet" href="css/common.css"/>
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script language="JavaScript" src="__PUBLIC__/js/adapt_screen.js"></script>
<frameset rows="15%,5%,*,15%" cols="*" frameborder="0" framespacing="0"> 
	<frame src="<?php echo U(GROUP_NAME.'/Index/top');?>" scrolling="no">
	<frame src="<?php echo U(GROUP_NAME.'/Index/titlebar');?>" scrolling="no">
	<frame src="<?php echo U(GROUP_NAME.'/Index/homepage');?>" name="change" width="100%" height="">
	<frame src="<?php echo U(GROUP_NAME.'/Index/bottom');?>" scrolling="no">
</frameset>

</html>