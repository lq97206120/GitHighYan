

function checklogin(){
	var username = $('#username');
	var password = $('#password');
	var verify_code = $('#code');
	
	if(username.val() == ''){
		alert('用户名不能为空');
		username.focus();
		return ;
	}
	if(password.val() == ''){
		alert('密码名不能为空');
		password.focus();
		return ;
	}
	
	if(verify_code.val() == ''){
		alert('验证码码不能为空');
		verify_code.focus();
		return ;
	}
	
	$.post(loginloginUrl,{username:username.val(),password:password.val(),verify_code:verify_code.val()},function (data) {
		if(data.status == 2){
			alert('验证码错误');
			window.location.href = loginindexUrl;
		}else if(data.status == 3){
			
			window.location.href = indexUrl ;
		}else if(data.status == 0){
			alert('登录失败，请重新尝试');
			window.location.href = loginindexUrl;
		}else if(data.status==1)
		{
			alert('用户名或密码错误');
			window.location.href = loginindexUrl;
		}
		else{
			
			alert('用户已被锁定');
			window.location.href = loginindexUrl;
		}
		
	},'json');
	
}
		
	