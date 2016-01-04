<?php
class HomeAction extends Oauth2Action{

	//用户首页
	public function index(){
		
		$this->display();
	}
	
	//通过openid查找用户
	public function get_user_by_openid($openid){
	    $user = M('user')->where(array('openid'=>$openid))->select();;
	    
		if(!empty(user))
			return $user;
		else 
			return null;
		
	}
	
	//个人信息－－电话，性别，地址等信息
	public function info(){
		$this->display();
	}
	
}