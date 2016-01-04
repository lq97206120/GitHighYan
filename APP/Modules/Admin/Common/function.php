<?php

//递归重组节点信息为多维数组
function node_merge($node,$access=null,$pid=0){
	$arr=array();//本轮数组初始为空
	foreach($node as $v){
		if(is_array($access)){
			$v['access']=in_array($v['id'],$access)?1:0;
		}
		if($v['pid']==$pid){//筛选本轮合格的对象
			$v['child']=node_merge($node,$access,$v['id']);//将上级返回的数组写入['child']
			$arr[]=$v;//将自己写入本轮数组
		}
	}
	return $arr;//返回给上级['child']
}

//递归重组商品信息为多维数组
function goods_merge($goods,$possess=null){
	$arr=array();
	
	foreach($goods as $v){
		if(is_array($possess)){
			$v['possess']=in_array($v['gid'],$possess)?1:0;
		}
		else $v['possess']=0;
		 
		$arr[]=$v;
	}
	//p($arr);
<<<<<<< HEAD
	return $arr;
	//定义商品的种类
//	$class=array();
//	for($i=0;$i<4;$i++){
//		foreach($arr as $t){
//			if(($i+1)==$t['gclass'])
//			$class[$i][]=$t;
//		}
//		if(!$class[$i])$class[$i]=array();
//	}
//	return $class;//返回给上级['child']
=======
	//return $arr;
	//定义商品的种类
	$class=array();
	for($i=0;$i<=2;$i++){
		$class[$i]['classid']=$i+1;
		switch($i){
			case '0':$class[$i]['classname']="上衣";break;
			case '1':$class[$i]['classname']="裤子";break;
			case '2':$class[$i]['classname']="背心";break;
		}
		foreach($arr as $t){
			if($i==($t['gclass']-1))
			$class[$i]['contents'][]=$t;
		}
		if(!$class[$i])$class[$i]=array();
	}
	return $class;//返回给上级['child']
>>>>>>> 855e70bb320f20b9fb05518accacd719e63f1af8
}
//递归重组部门信息为多维数组
function shop_merge($shop,$assign=null){
	$arr=array();
	
	foreach($shop as $v){
		if(is_array($assign)){
			$v['assign']=in_array($v['sid'],$assign)?1:0;
		}
		else $v['assign']=0;
		 
		$arr[]=$v;
	}
	//p($arr);
	return $arr;
	//定义商品的种类
//	$class=array();
//	for($i=0;$i<4;$i++){
//		foreach($arr as $t){
//			if(($i+1)==$t['gclass'])
//			$class[$i][]=$t;
//		}
//		if(!$class[$i])$class[$i]=array();
//	}
//	return $class;//返回给上级['child']
}
//用户表的合并
<<<<<<< HEAD
function user_manyone($user){
	$arra=array();
	
	for($i=0;$i<count($user);$i++){
		$arra[$i]['uid']=$user[$i]['uid'];
		$arra[$i]['unum']=$user[$i]['unum'];
		$arra[$i]['uname']=$user[$i]['uname'];
		$arra[$i]['upassword']=$user[$i]['upassword'];
		$arra[$i]['uphone']=$user[$i]['uphone'];
		$arra[$i]['umale']=$user[$i]['umale'];
		$arra[$i]['ubirth']=$user[$i]['ubirth'];
		$arra[$i]['udate']=$user[$i]['udate'];
		$arra[$i]['ustatus']=$user[$i]['ustatus'];
		$arra[$i]['ulogintime']=$user[$i]['ulogintime'];
		$arra[$i]['uloginip']=$user[$i]['uloginip'];
		$arra[$i]['role']=$user[$i]['role'][0]['id'];
		$arra[$i]['roleremark']=$user[$i]['role'][0]['remark'];
		$arra[$i]['shop']=$user[$i]['shop'][0]['sid'];
		$arra[$i]['shopsname']=$user[$i]['shop'][0]['sname'];
	}
	return $arra;
}
=======
function user_manyone($user,$sid){
	$arra=array();
	if($sid==0){
		for($i=0;$i<count($user);$i++){
			$arra[$i]['uid']=$user[$i]['uid'];
			$arra[$i]['unum']=$user[$i]['unum'];
			$arra[$i]['uname']=$user[$i]['uname'];
			$arra[$i]['upassword']=$user[$i]['upassword'];
			$arra[$i]['uphone']=$user[$i]['uphone'];
			$arra[$i]['umale']=$user[$i]['umale'];
			$arra[$i]['ubirth']=$user[$i]['ubirth'];
			$arra[$i]['udate']=$user[$i]['udate'];
			$arra[$i]['ustatus']=$user[$i]['ustatus'];
			$arra[$i]['ulogintime']=$user[$i]['ulogintime'];
			$arra[$i]['uloginip']=$user[$i]['uloginip'];
			$arra[$i]['role']=$user[$i]['role'][0]['id'];
			$arra[$i]['roleremark']=$user[$i]['role'][0]['remark'];
			$arra[$i]['shop']=$user[$i]['shop'][0]['sid'];
			$arra[$i]['shopsname']=$user[$i]['shop'][0]['sname'];
		}
	}
	else{
	for($i=0;$i<count($user);$i++){
			if($user[$i]['shop'][0]['sid']==$sid){
					$arra[$i]['uid']=$user[$i]['uid'];
					$arra[$i]['unum']=$user[$i]['unum'];
					$arra[$i]['uname']=$user[$i]['uname'];
					$arra[$i]['upassword']=$user[$i]['upassword'];
					$arra[$i]['uphone']=$user[$i]['uphone'];
					$arra[$i]['umale']=$user[$i]['umale'];
					$arra[$i]['ubirth']=$user[$i]['ubirth'];
					$arra[$i]['udate']=$user[$i]['udate'];
					$arra[$i]['ustatus']=$user[$i]['ustatus'];
					$arra[$i]['ulogintime']=$user[$i]['ulogintime'];
					$arra[$i]['uloginip']=$user[$i]['uloginip'];
					$arra[$i]['role']=$user[$i]['role'][0]['id'];
					$arra[$i]['roleremark']=$user[$i]['role'][0]['remark'];
					$arra[$i]['shop']=$user[$i]['shop'][0]['sid'];
					$arra[$i]['shopsname']=$user[$i]['shop'][0]['sname'];
			}
		}
	}
	return $arra;
}
//个人信息修改设置
function user_one($user){
	$arra=array();
		
		$arra['uid']=$user['uid'];
		$arra['unum']=$user['unum'];
		$arra['uname']=$user['uname'];
		$arra['uphone']=$user['uphone'];
		$arra['umale']=$user['umale'];
		$arra['ubirth']=$user['ubirth'];
		$arra['udate']=$user['udate'];
		$arra['ustatus']=$user['ustatus'];
		$arra['ulogintime']=$user['ulogintime'];
		$arra['uloginip']=$user['uloginip'];
		$arra['role']=$user['role'][0]['id'];
		$arra['roleremark']=$user['role'][0]['remark'];
		$arra['shop']=$user['shop'][0]['sid'];
		$arra['shopsname']=$user['shop'][0]['sname'];
	
	return $arra;
}
function shopposess($goods,$i){
	$arra=array();
	foreach($goods as $v){
		if($i==$v['gclass'])
		$arra[]=$v;
	}
	return $arra;
}
   
>>>>>>> 855e70bb320f20b9fb05518accacd719e63f1af8
