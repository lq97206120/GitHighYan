<?php
class CommonAction extends Action{
	//�˺����ڱ�ʵ����֮��һ����һ��ִ��
	public function _initialize(){
		//判断登录成功
		if(!isset($_SESSION[C('USER_AUTH_KEY')])){
			$this->redirect('Admin/Login/index');
		}
		//访问权限 控制
		if(C('USER_AUTH_ON')){
			import('ORG.Util.RBAC');
			RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');
		}
	}
}