<?php
class IndexAction extends CommonAction{
	//后台首页
	public function index(){
<<<<<<< HEAD
		$user=D('UserRelation')->relation('role')->where(array('uid'=>$_SESSION['uid']))->find();
		$this->user=$user;
		$role=$user['role'];
		$this->role=$role;
		$this->display();
=======
		$uid =$_SESSION['uid'];
		$us = D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
		$us=user_one($us);
		$this->us = $us;
		
		$this->display ();
>>>>>>> 855e70bb320f20b9fb05518accacd719e63f1af8
	}
	//显示后台中间主页
	public function home(){
		
		$uid =$_SESSION['uid'];
		$us = D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
		$us=user_one($us);
		$this->us = $us;
		$inform=M('inform')->order('idate desc')->select();
		$new=$inform[0];
		$this->new=$new;
		$this->display();
	}

	//注销
	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect(GROUP_NAME.'/Login/index');
	}
//	//修改个人信息
//	public function changemsg(){
//		
//		$uid = I ( 'uid', '', 'intval' );
//		$us = D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
//		$us=user_one($us);
//		$this->us = $us;
//		$this->display ();
//	}
	//处理修改个人信息方法
	public function update(){
		
				$user=array(
				'uid'=>$_POST['uid'],
				'unum'=>$_POST['unum'],
				'uname'=>$_POST['uname'],
				'umale'=>$_POST['umale'],
				'ubirth'=>$_POST['ubirth'],
				'uphone'=>$_POST['uphone'],
				);
				$result=M('user')->save($user);
				
				if($result){
					$this->success("修改成功",U('Admin/Index/index'));
				}else
					$this->error("未改动",U('Admin/Index/index'));;
	}
//	//修改密码
//	public function changepwd(){
//		$uid = I ( 'uid', '', 'intval' );
//    	$us = M ( 'user' )->find ( $uid );
//    	$this->us = $us;
//    	
//    	$this->display ();
//	}
	//处理修改密码
	public function updatepwd(){
		
		if($_POST['upasswordnew']==$_POST['upasswordrenew']){
			$oldpwd=I('upasswordold','','md5');
			$user=M('user')->find($_POST['uid']);
			if($oldpwd==$user['upassword']){
				$save['uid']=$user['uid'];
				$save['upassword']=md5($_POST['upasswordnew']);
				$result=M('user')->save($save);
				if($result)$this->success("修改成功",U("Admin/Index/index"));
				else 
				$this->error("修改失败",U("Admin/Index/index"));
			}else 
			$this->error("原始密码错误",U("Admin/Index/index"));
		}else 
		$this->error("两次输入的密码不一致",U("Admin/Index/index"));
		
	}
	//察看帮助
	public function help(){
		 $this->display ();
	}
}