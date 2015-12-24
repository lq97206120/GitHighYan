<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css">
	<script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script>
	<script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script>
</head>
<body style="padding:20px 20px 0px 20px">
	<h2 align="center">部门列表</h2>
	<form id="searchform" method='post' action="__URL__/searchuser" class="form-horizontal">
	<table id = "search" >
	  <tr>
	  	<td>
		  	<select name="searchcondition" class="form-control">
				  <option value ="sname">部门名称</option>
				  <option value ="saddr">地址</option>
				  <option value ="sphone">电话</option>
			</select>
	  	</td>
	  	<td>
	  		<input type="text" class="form-control"  id="searchcontent" name="searchcontent">
	  	</td>
	  	<td>
	  	</td>
		<td>
			<button class="btn  btn-default" id="searchbtn" name="searchbtn" type="button">查询&nbsp;<i class="icon-search icon-large icon-white"></i> </button>
		</td>
	  </tr>
	</table>
	</form>
	<br/>
	<button class="btn btn-default "  data-toggle="modal" data-target="#adduserModal">
					添加部门
			</button>
	<button id="userEdit" class="btn btn-default "  data-target="#edituserModal">
			修改部门信息
	</button>
	
	<div style="margin:10px 0;"></div>
	
	
	<table id="dg" title="部门信息列表" style="width:1100px;height:308px" >
	<?php if(is_array($shop)): foreach($shop as $key=>$u): ?><tr>
		<td><?php echo ($u["sid"]); ?></td>
		<td><?php echo ($u["sname"]); ?></td>
		<td><?php echo ($u["saddr"]); ?></td>
		<td><?php echo ($u["sphone"]); ?></td>
		<td><a href="<?php echo U('Admin/Shop/goodslist',array('sid'=>$u['sid']));?>">商品管理</a></td>
		<td><?php if($u['sstatus'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
		<td>
			<a href="javascript:void(0)" onclick="deleteuser(<?php echo ($u["sid"]); ?>)">删除</a>
		</td>		
	</tr><?php endforeach; endif; ?>
	</table>
	<div align="center">
	<?php echo ($page); ?>
	</div>
	
		<!-- Modal 添加信息-->
	<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	  <div class="modal-dialog" >
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">添加部门</h4>
	      </div>
	      <div class="modal-body">
	        <form id="form1" method='post' action="__URL__/insert" class="form-horizontal">
		
		   <div class="form-group">
			    <label for="usernum" class="col-sm-2 control-label">部门名称</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="sname" name="sname"  placeholder="不能为空">
			    </div>
		  </div>
		  <div class="form-group">
			    <label for="username" class="col-sm-2 control-label">地址</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="saddr" name="saddr"  placeholder="不能为空">
			    </div>
		  </div>
		  <div class="form-group">
			    <label for="usertel" class="col-sm-2 control-label">联系电话</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="sphone" name="sphone"  placeholder="联系电话">
			    </div>
		  </div>
			
	      
		   <div class="modal-footer">
		   	<input type="reset" class="btn btn-primary" name="Submit2" value="重 置">
	       <input type="submit" class="btn btn-primary" value="保 存" id="adduserbtn" name="adduserbtn">
	      </div>
		  
		  </form>
	      </div>
	    </div>
	  </div>
	</div>
	
	
	<!-- Modal 修改信息 -->
	<div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
	   <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">修改部门信息</h4>
	      </div>
	      <div class="modal-body">
	      <form id="form2" method='post' action="__URL__/update" class="form-horizontal">

		   <div class="form-group">
			    <label for="usernum" class="col-sm-2 control-label">部门名称</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="sname" name="sname"  placeholder="不能为空" >
			      
			    </div>
		  </div>
		  <div class="form-group">
			    <label for="username" class="col-sm-2 control-label">地址</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="saddr" name="saddr"  placeholder="不能为空">
			    </div>
		  </div>
		 
		  <div class="form-group">
			    <label for="usertel" class="col-sm-2 control-label">联系电话</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="sphone" name="sphone"  placeholder="联系电话">
			    </div>
		  </div>
		  <div class="form-group">
			    <label for="usersex" class="col-sm-2 control-label">状态</label>
			    <div class="col-sm-10">
			      	<input type="radio"   name="sstatus" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio"   name="sstatus" value='0' style="width: 50px"/>&nbsp;&nbsp;关闭
			    </div>
		  </div> 

		   <div class="form-group">
		     <input type="hidden" name="sid" id="sid">
		  </div>
		  <div class="modal-footer">
	       <input type="submit" class="btn btn-primary" value="保 存" >
	      </div>
		  </form>
		 </div>
	    </div>
	  </div>
	</div>
	<script>
		function deleteuser(sid){
			if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/delete/sid/"+sid,
				success:function(data,textStatus,jqXHR){
				alert("删除成功");
					window.location.reload();

				},
				error:function(jqXHR,textStatus,errorThrown){
					alert("删除失败");
				}
			})
				
			}
			else{
			
				return;
			}	
		}
		
		$(function(){
			$('#searchbtn').click(function(){
				if($('#searchcontent').val() == ''){
					alert('请输入查询内容');
					return false;
				}else{
					$('#searchform').submit();
				}
										
			});
			
		});
		
		$(function(){
			$('#adduserModal').on('shown.bs.modal',function(e){
			$('#adduserModal #usernum').focus();
		});
			$('#adduserbtn').click(function(){
								
				if($('#adduserModal #sname').val() == '' || $('#adduserModal #saddr').val() == ''||$('#adduserModal #sphone').val() == ''){
					alert('每个单元都不能为空！');
					return false;
				}
										
			});
			
		});
		$(function(){
			$('#edituserModal').on('shown.bs.modal',function(e){
			$('#edituserModal #username').focus();
		});
			$('#edituserbtn').click(function(){
				if($('#edituserModal #username').val() == '' || $('#edituserModal #usernum').val() == ''||$('#edituserModal #password').val() == ''){
					alert('姓名或学号为空！');
					return false;
				}else{
					if($('#edituserModal #usersex').val() != '男' && $('#edituserModal #usersex').val() != '女'){
						alert('性别只能为男或女');
						return false;
					}else{
						//$('#form2').submit();
						var user_id=$("#edituserModal #userid").val();
						var user_name=$("#edituserModal #username").val();
						var user_num=$("#edituserModal #usernum").val();
						var user_sex=$("#edituserModal #usersex").val();
						var user_birth=$("#edituserModal #userbirth").val();
						var user_endtime=$("#edituserModal #userendtime").val();
						var user_grade=$("#edituserModal #usergrade").val();
						var user_major=$("#edituserModal #usermajor").val();
						var user_tel=$("#edituserModal #usertel").val();
						var user_mail=$("#edituserModal #usermail").val();
						var user_nation=$("#edituserModal #usernation").val();
						var user_limits=$("#edituserModal #userlimits").val();
						var user_url=$("#edituserModal #url").val();
						$.ajax({
							type:"POST",
							url:"__URL__/update",
							data:{userid:user_id,username:user_name,usernum:user_num,usersex:user_sex,userbirth:user_birth,userendtime:user_endtime,usergrade:user_grade,usermajor:user_major,usertel:user_tel,usermail:user_mail,usernation:user_nation,userlimits:user_limits,url:user_url},
							success:function(data,textStatus,jqXHR){
								alert("修改成功");
								window.location.reload();

							},
							error:function(jqXHR,textStatus,errorThrown){
								alert("修改失败");
								window.location.reload();
							}
						});
					}
				}
										
			});
			
		});
	
		$(function(){
			
			$('#userEdit').click(function(){
				var row = $('#dg').datagrid('getSelected');
				
				if(row == null){
					alert('请选择一条数据');
				}
				$('#edituserModal #sid').val(row.sid);
				$('#edituserModal #sname').val(row.sname);
				$('#edituserModal #saddr').val(row.saddr);
				$('#edituserModal #sphone').val(row.sphone);
				if(row.sstatus=="开启")$("#edituserModal input[name='sstatus'][value=1]").attr("checked",true);
					else $("#edituserModal input[name='sstatus'][value=0]").attr("checked",true);
				$('#edituserModal').modal();
			});
			
			
			$('#dg').datagrid({
		       fitColumns:true,
				rownumbers:true,
				singleSelect:true,
				autoRowHeight:false,
				
			  columns:[[
				{field:'sid',hidden:true},
				{field:'sname',title:"部门名称",width:30},
		        {field:'saddr',title:'地址',width:80},
		        {field:'sphone',title:"电话",width:40},
		        {field:'sgoods',title:"商品管理",width:20},
		        {field:'sstatus',title:"状态",width:20},
		        {field:'ss',title:'操作',width:30},
		       
		        
		   	  ]]
			});
		});
	</script>
</body>
</html>