<?php
class LoginAction extends Action{
	public function index(){

		$this->display();
	}
	
	//登陆处理
	public function login(){
		
		if (! IS_POST) halt( "页面不存在" );
		if(!IS_AJAX) halt('页面不存在');
		$data = array (
				'unum' => I ( 'username' ),
				'upassword' => md5(I ( 'password' )),
				'verify_code' => I('verify_code','','md5'),
		);
		
		if($data['verify_code'] != session('verify')){
			//验证码错误
			$this->ajaxReturn ( array ('status' => 2), 'json' );
		}
		else if($data['unum'] == '' || $data['upassword'] == ''){
			//服务器端未能接收到用户名或密码
			$this->ajaxReturn ( array ('status' => 0), 'json' );
		}
		else{
			//验证用户名密码
			$map['unum'] = $data['unum'];
			$map['upassword'] = $data['upassword'];
			$result =M('user')->where ($map)->find();
	
			if ($result == null) {
				//数据库中没有这个用户
				$this->ajaxReturn ( array ('status' => 1), 'json' );
			}
			else{
				//登陆成功处理
				if(!$result['ustatus'])
					$this->ajaxReturn ( array ('status' => 4), 'json' );
				else{
					$data=array(
							'uid'=>$result['uid'],
							'ulogintime'=>time(),
							'uloginip'=>get_client_ip(),
					);
					M('user')->save($data);
					
					session(C('USER_AUTH_KEY'),$result['uid']);
					session('unum',$result['unum']);
					session('uname',$result['uname']);
					session('upassword',$result['upassword']);
					session('uphone',$result['uphone']);
					session('umale',$result['umale']);
					session('ubirth',$result['ubirth']);
					session('udate',$result['udate']);
					session('ustatus',$result['ustatus']);
					session('ulogintime',date('Y-m-d H:i:s',$result['ulogintime']));
					session('uloginip',$result['uloginip']);
					//超级管理员识别
					if($result['unum']==C('RBAC_SUPERADMIN'))
						session(C('ADMIN_AUTH_KEY'),true);
					//读取用户权限
					import('ORG.Util.RBAC');
					RBAC::saveAccessList();
			
					$this->ajaxReturn ( array ('status' => 3), 'json' );
				} 
				

			}
		}
		
	}
	//生成验证码
	public function verify() {
		import('ORG.Util.Image');
		Image::buildImageVerify (4,1,'png',60,26);
	}
	
}