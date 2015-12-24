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
	<h2 align="center">商品列表</h2>
	<form id="searchform" method='post' action="__URL__/searchuser" class="form-horizontal">
	<table id = "search" >
	  <tr>
	  	<td>
		  	<select name="searchcondition" class="form-control">
				  <option value ="gnum">商品编号</option>
				  <option value ="gname">商品名称</option>
				  <option value ="gclass">商品种类</option>
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
					添加商品
			</button>
	<button id="userEdit" class="btn btn-default "  data-target="#edituserModal">
			修改商品信息
	</button>
	
	<div style="margin:10px 0;"></div>
	
	
	<table id="dg" title="商品信息列表" style="width:1100px;height:308px" >
	<?php if(is_array($goods)): foreach($goods as $key=>$u): ?><tr>
		<td><?php echo ($u["gid"]); ?></td>
		<td><?php echo ($u["gnum"]); ?></td>
		<td><?php echo ($u["gname"]); ?></td>
		<td><?php if($u['gclass'] == 1): ?>上衣<?php elseif($u['gclass'] == 2): ?>裤子<?php else: ?>鞋子<?php endif; ?></td>
		<td><a href="<?php echo U('Admin/Goods/shoplist',array('gid'=>$u['gid']));?>">分配管理</a></td>
		<td><?php if($u['gstatus'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></td>
		<td>
			<a href="javascript:void(0)" onclick="deleteuser(<?php echo ($u["gid"]); ?>)">删除</a>
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
	        <h4 class="modal-title" id="myModalLabel">添加商品</h4>
	      </div>
	      <div class="modal-body">
	        <form id="form1" method='post' action="__URL__/insert" class="form-horizontal">
		   
		    <div class="form-group">
			    <label for="usernum" class="col-sm-2 control-label">商品编码</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="gnum" name="gnum"  placeholder="不能为空">
			    </div>
		 	 </div>
			  <div class="form-group">
				    <label for="usernum" class="col-sm-2 control-label">商品名称</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="gname" name="gname"  placeholder="不能为空">
				    </div>
			  </div>
			  <div class="form-group">
				    <label for="usersex" class="col-sm-2 control-label">种类</label>
				    <div class="col-sm-10">
				     <input type="radio"   name="gclass" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;上衣&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio"     name="gclass" value='2' style="width: 50px"/>&nbsp;&nbsp;裤子
					<input type="radio"     name="gclass" value='3' style="width: 50px"/>&nbsp;&nbsp;鞋子
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
	        <h4 class="modal-title" id="myModalLabel">修改商品信息</h4>
	      </div>
	      <div class="modal-body">
	      <form id="form2" method='post' action="__URL__/update" class="form-horizontal">

		   <div class="form-group">
			    <label for="usernum" class="col-sm-2 control-label">商品编号</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="gnum" name="gnum"  placeholder="不能为空" readonly="true" >
			      
			    </div>
		  </div>
		  <div class="form-group">
			    <label for="username" class="col-sm-2 control-label">商品名称</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="gname" name="gname"  placeholder="不能为空">
			    </div>
		  </div>
 		  <div class="form-group">
			    <label for="usersex" class="col-sm-2 control-label">种类</label>
			    <div class="col-sm-10">
			      	<input type="radio"   name="gclass" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;上衣&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio"   name="gclass" value='2' style="width: 50px"/>&nbsp;&nbsp;裤子
					<input type="radio"   name="gclass" value='3' style="width: 50px"/>&nbsp;&nbsp;鞋子
			    </div>
		  </div> 
		 
		  <div class="form-group">
			    <label for="usersex" class="col-sm-2 control-label">状态</label>
			    <div class="col-sm-10">
			      	<input type="radio"   name="gstatus" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio"   name="gstatus" value='0' style="width: 50px"/>&nbsp;&nbsp;关闭
			    </div>
		  </div> 

		   <div class="form-group">
		     <input type="hidden" name="gid" id="gid">
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
		function deleteuser(gid){
			if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/delete/gid/"+gid,
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
								
				if($('#adduserModal #gnum').val() == '' || $('#adduserModal #gname').val() == ''){
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
				$('#edituserModal #gid').val(row.gid);
				$('#edituserModal #gnum').val(row.gnum);
				$('#edituserModal #gname').val(row.gname);
				if(row.gclass=="上衣")$("#edituserModal input[name='gclass'][value=1]").attr("checked",true);
					else{if(row.gclass=="裤子")$("#edituserModal input[name='gclass'][value=2]").attr("checked",true);
							else $("#edituserModal input[name='gclass'][value=3]").attr("checked",true);	}
				if(row.gstatus=="开启")$("#edituserModal input[name='gstatus'][value=1]").attr("checked",true);
					else $("#edituserModal input[name='gstatus'][value=0]").attr("checked",true);
				$('#edituserModal').modal();
			});
			
			
			$('#dg').datagrid({
		       fitColumns:true,
				rownumbers:true,
				singleSelect:true,
				autoRowHeight:false,
				
			  columns:[[
				{field:'gid',hidden:true},
				{field:'gnum',title:"商品编号",width:30},
		        {field:'gname',title:'商品名称',width:80},
		        {field:'gclass',title:"商品种类",width:40},
		        {field:'gshop',title:"分配管理",width:20},
		        {field:'gstatus',title:"状态",width:20},
		        {field:'ss',title:'操作',width:30},
		       
		        
		   	  ]]
			});
		});
	</script>
</body>
</html>