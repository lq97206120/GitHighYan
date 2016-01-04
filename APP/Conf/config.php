<?php
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST'=>'Index,Admin,Wechat',
	'DEFAULT_GROUP'=>'Index',
	'APP_GROUP_MODE'=>1,
	'APP_GROUP_PATH'=>'Modules',

	//解析模板路径
	'TMPL_FILE_DEPR' => '_',

 	//链接数据库
     'DB_HOST'=>'127.0.0.1',
     'DB_USER'=>'root',
     'DB_PWD'=>'0556',
     'DB_NAME'=>'highyan',
     'DB_PREFIX'=>'hy_',
	//默认过滤函数
	'DEFAULT_FILTER'=>'htmlspecialchars',
<<<<<<< HEAD
=======
	//配置微信参数
	'LOAD_EXT_CONFIG' => 'wechat',
     //邮件配置
    'THINK_EMAIL' => array(
        'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器
        'SMTP_PORT'   => '465', //SMTP服务器端口
        'SMTP_USER'   => '13917377764@163.com', //SMTP服务器用户名
        'SMTP_PASS'   => 'lq5500/680652597', //SMTP服务器密码
        'FROM_EMAIL'  => '13917377764@163.com', //发件人EMAIL
        'FROM_NAME'   => '海彦', //发件人名称
        'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
        'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
    ),
>>>>>>> 855e70bb320f20b9fb05518accacd719e63f1af8
);
?>