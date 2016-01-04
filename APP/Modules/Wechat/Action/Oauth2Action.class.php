<?php
class Oauth2Action extends Action{
	//step 1:判断是否授权，没有的话，调用微信接口
	public function _initialize(){	
		if(!isset($_SESSION['openid']))
		$this->redirect(GROUP_NAME.'/Login/oauth2');
	}
	
	//step 3:获取微信接口返回的code
	public function oauth2Code(){
	    $code = $_GET['code'];
	    echo $code;
	    //step 4:通过code获取用户access_token及openid
	    $data = $this->get_user_info($code);
	    echo $data;
	    session('openid',$data['openid']);
	    //step 6:通过拉取的用户信息，来查询是否有openid对应的用户
// 	    import('Class.Home',APP_PATH);
	    $user = HomeAction::get_user_by_openid($data['openid']);
	    if(!empty($user)){
	    	//1.存在openid对应的用户：跳转到个人中心
	    	$this->redirect(GROUP_NAME.'/Home/index');
	    }else {
	    	//2.通过openid查不到用户：创建用户，跳转到个人中心
	    	M('user')->add($data);
	    	$this->redirect(GROUP_NAME.'/Home/index');
	    }
	    		
		
	}
	
	
	
	public function get_user_info($code){
		//通过code换取网页授权access_token和openid
		$get_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?
	    		appid='.C(APP_ID).'&secret='.C(APP_SECRET).'
	    		&code='.$code.'&grant_type=authorization_code';
		$json_str = file_get_contents($get_url);
		$json_data = json_decode($json_str);
		$open_id = $json_data->openid;
		echo $open_id;
		$_SESSION['openid'] = $open_id;
		//step 5:通过access_token和openid拉取用户信息
		$access_token = $json_data->access_token;
		$user_url = 'https://api.weixin.qq.com/sns/userinfo
				?access_token='.$access_token.'&openid='.$open_id.'&lang=zh_CN';
		//请求微信链接，获取用户信息json格式
		$user_str = file_get_contents($user_url);
		$user_data = json_decode($json_str);
		$data = array (
				'openid' => $open_id,
				'nickname' =>$user_data->nickname,
				'headimgurl' => $user_data->headimgurl,
		);	
		return $data;
	}
	
	
}