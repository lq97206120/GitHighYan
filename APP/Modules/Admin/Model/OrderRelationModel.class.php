<?php
/*
 * 订单关联模型
 */
Class OrderRelationModel extends RelationModel{
	
		//定义主表名称
	Protected $tableName='order';
	//定义关联关系
	Protected $_link=array(
			'user'=>array(
					'mapping_type'=>MANY_TO_MANY,//多对多关系
					'mapping_name'=>'user',
					'foreign_key'=>'order_num',//主表在中间表的字段名称
					'relation_foreign_key'=>'user_id',//副表在中间表的字段 名称
					'relation_table'=>'hy_user_order',//中间表
					'mapping_fields'=>'uid,unum,uname',
			),
			
			'shop'=>array(
			'mapping_type'=>MANY_TO_MANY,//多对多关系
			'mapping_name'=>'shop',
			'foreign_key'=>'order_num',//主表在中间表的字段名称
			'relation_foreign_key'=>'shop_id',//副表在中间表的字段 名称
			'relation_table'=>'hy_shop_order',//中间表
			'mapping_fields'=>'sid,sname,saddr,sphone,sclass',
			),
	);
	
}