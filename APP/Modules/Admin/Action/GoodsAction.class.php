<?php
class GoodsAction extends CommonAction{
	//商品列表
	public function index(){
		import("ORG.Util.Page");
		$count=M('goods')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$goods=M('goods')->limit($limit)->select();
		$this->goods=$goods;
		$this->page = $page->show ();
		//p($goods);
		$this->display();
	}
// 添加商品
	public function insert() {
		
		$goodsResult=M('goods')->where(array('gnum'=>$_POST['gnum']))->find();
		
		if(empty($goodsResult)){
				$receive=array(
				'gnum'=>$_POST['gnum'],
				'gname'=>$_POST['gname'],
				'gclass'=>$_POST['gclass'],
				'gstatus'=>'1',
			
			);
			$goods=M('goods')->add($receive);
			if($goods){
				$this->success("添加成功",U('Admin/Goods/index'));
			}else 
				$this->error("添加失败",U('Admin/Goods/index'));
			
		}
		else{
			
			$this->error("商品已经存在",U('Admin/Goods/index'));
		}

	}
	//更新商品信息
	public function update() {
			
			$goods=array(
				'gid'=>$_POST['gid'],
				'gnum'=>$_POST['gnum'],
				'gname'=>$_POST['gname'],
				'gclass'=>$_POST['gclass'],
				'gstatus'=>$_POST['gstatus'],
								
				);
				$result=M('goods')->save($goods);
				if($result){
					$this->success("修改成功",U('Admin/Goods/index'));
				}else
					$this->error("未改动",U('Admin/Goods/index'));
	}
	// 删除商品
	public function delete($gid) {
		
			if (! empty ( $gid )) {
				$goods = M ( "goods" );
				$result = $goods->delete ( $gid );
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( 'ID错误！' );
			}
		
	}
//查询商品
	public function searchuser(){
		
		$searchcondition = I ( 'searchcondition','');
		$searchcontent = I('searchcontent','');
		if($searchcondition=='gclass'){
			switch($searchcontent){
				case '上衣': $searchcontent=1;break;
				case '裤子':	$searchcontent=2;break;
				case '鞋子':	$searchcontent=3;break;
					
			}
					
		}
		
		if(!empty($searchcondition) && !empty($searchcontent) ){
			import ( 'ORG.Util.Page' );
			$condition[$searchcondition] = array('like','%'.$searchcontent.'%');
			$count=M('goods')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$goods=M('goods')->where($condition)->limit ( $limit )->select ();
			$this->page = $page->show ();
			$this->goods = $goods;
			
			$this->display();
		
		}
	}
	//商品分配列表
	public function shoplist(){
		//获取所有部门
		$shop=M('shop')->select();
		
		//获取有该商品的部门
		$assign=M('goods_shop')->where(array('goods_id'=>$_GET['gid']))->getField('shop_id',true);
	
		//组合数组
		$shop=shop_merge($shop,$assign);
		//p($goods);
		$goods=M('goods')->where(array('gid'=>$_GET['gid']))->field(array('gnum,gname,gid'))->find();
		$this->shop=$shop;
		$this->goods=$goods;
		//p($shop);
		//p($goods);
		$this->display();
		
	}
	//处理商品分配列表
	public function shoplistHandle(){
		//清除之前的记录
		$deleteResult=M('goods_shop')->where(array('goods_id'=>$_POST['gid']))->delete();
		foreach($_POST['shop'] as $v){
			$data[]=array('shop_id'=>$v,'goods_id'=>$_POST['gid']);
		}
		
		if(M('goods_shop')->addAll($data)){
			$this->success('修改成功！',U('Admin/Goods/index'));
		}else 
			$this->error("删除失败！",U('Admin/Goods/index'));
	}
}