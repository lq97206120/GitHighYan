<?php
class LoginAction extends Action{
	//step 2: 调用微信接口，发送请求
	public function oauth2(){
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?
				appid='.C(APP_ID).'&redirect_uri='.C(REDIRECT_URI).'&response_type=code
				&scope='.C(SCOPE).'&state='.C(STATE);
		redirect($url);
		
	}
	

	//生成验证码
	public function verify() {
		import('ORG.Util.Image');
		Image::buildImageVerify (4,1,'png',60,26);
	}
	
}