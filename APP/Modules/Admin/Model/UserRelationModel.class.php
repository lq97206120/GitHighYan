<?php
/*
 * 用户与角色关联模型
 */
Class UserRelationModel extends RelationModel{
	
		//定义主表名称
	Protected $tableName='user';
	//定义关联关系
	Protected $_link=array(
			'role'=>array(
					'mapping_type'=>MANY_TO_MANY,//多对多关系
					'mapping_name'=>'role',
					'foreign_key'=>'user_id',//主表在中间表的字段名称
					'relation_foreign_key'=>'role_id',//副表在中间表的字段 名称
					'relation_table'=>'hy_role_user',//中间表
					'mapping_fields'=>'id,name,remark',
			),
			'shop'=>array(
			'mapping_type'=>MANY_TO_MANY,//多对多关系
			'mapping_name'=>'shop',
			'foreign_key'=>'user_id',//主表在中间表的字段名称
			'relation_foreign_key'=>'shop_id',//副表在中间表的字段 名称
			'relation_table'=>'hy_shop_user',//中间表
			'mapping_fields'=>'sid,sname',
			)
	);
	
}