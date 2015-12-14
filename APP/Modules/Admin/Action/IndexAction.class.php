<?php
class IndexAction extends CommonAction{
	//后台首页
	public function index(){
		$user=D('UserRelation')->relation('role')->where(array('uid'=>$_SESSION['uid']))->find();
		$this->user=$user;
		$role=$user['role'];
		$this->role=$role;
		$this->display();
	}
	//显示后台中间主页
	public function home(){
		$this->display();
	}

	//注销
	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect(GROUP_NAME.'/Login/index');
	}
}