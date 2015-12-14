<?php

/*
 * 部门与商品关联模型
 */
Class ShopRelationModel extends RelationModel{
	
		//定义主表名称
	Protected $tableName='shop';
	//定义关联关系
	Protected $_link=array(
			'goods'=>array(
					'mapping_type'=>MANY_TO_MANY,//多对多关系
					'mapping_name'=>'goods',
					'foreign_key'=>'shop_id',//主表在中间表的字段名称
					'relation_foreign_key'=>'goods_id',//副表在中间表的字段 名称
					'relation_table'=>'hy_goods_shop',//中间表
					//'mapping_fields'=>'gid,gnum,gname',
			),
			
	);
	
}