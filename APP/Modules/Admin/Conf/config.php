<?php
return array(
	'TMPL_PARSE_STRING'=>array(
	'__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/'.'Modules/'.GROUP_NAME.'/Public',
    ),
    'URL_HTML_SUFFIX'=>'',
	'RBAC_SUPERADMIN'=>'100000',//超级管理员名称
	'ADMIN_AUTH_KEY'=>'superadmin',//超级管理员识别
	'USER_AUTH_ON'=>false,//是否开启验证
	'USER_AUTH_TYPE'=>1, //验证类型(1:登录时验证数据库,2实时验证)
	'USER_AUTH_KEY'=>'uid',//用户认证识别号
	'NOT_AUTH_MODULE'=>'Index',//无需认证的控制器模块
	'NOT_AUTH_ACTION'=>'addUserHandle,addRoleHandle,addNodeHandle,accessHandle,access',//无需认证的动作方法
	'RBAC_ROLE_TABLE'=>'hy_role',//角色表名称
	'RBAC_USER_TABLE'=>'hy_role_user',//角色与用户的中间表名称
	'RBAC_ACCESS_TABLE'=>'hy_access',//权限表名称
	'RBAC_NODE_TABLE'=>'hy_node',//节点表名称
);
    
    