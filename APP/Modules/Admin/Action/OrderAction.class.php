<?php
class OrderAction extends CommonAction{
	//查询订单
	public function index(){
		
		import("ORG.Util.Page");
		$count=M('order')->order('shopok')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$order=M('order')->limit($limit)->where(array('leaderverifystatus'=>'1'))->order('assignstatus,shopok')->select();
		$this->order=$order;
		$provider=M('shop')->where(array('sclass'=>'3'))->select();
	
		$this->provider=$provider;
		$this->unum=$_GET['unum'];
		$this->page = $page->show ();
		$this->display();
	}
	//修改分配
	public function orderupdate(){
		
		$receive=array(
				'onum'=>$_POST['onum'],
				'opsname'=>$_POST['opsname'],
				'ocunum'=>$_POST['unum'],
				'assignstatus'=>1,
								
				);
				$result=M('order')->save($receive);
				
				if($result){
					
					$opsname=M('shop')->where(array('sname'=>$receive['opsname']))->find();
					$mail=$opsname['smail'];
					$r=think_send_mail("{$mail}",'海彦',"新订单","有新订单,订单号为:{$receive['onum']}.");
					
					$this->success("修改成功",U('Admin/Order/index',array('unum'=>$_POST['unum'])));
				}else
					$this->error("未改动",U('Admin/Order/index',array('unum'=>$_POST['unum'])));
		}
	
	//订单查询
	public function ordersearch(){
		
		$searchcondition = I ( 'searchcondition','');
		$searchcontent = I('searchcontent','');
		
		if(!empty($searchcondition) && !empty($searchcontent)){
			import ( 'ORG.Util.Page' );
			
			//处理店长意见
			if($searchcondition=="ispullleader"){
				if($searchcontent=="要打样")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理指派状态
			if($searchcondition=="assignstatus"){
				if($searchcontent=="已分配")$searchcontent=1;
				else $searchcontent=0;
			}
			
			//处理打样状态
			if($searchcondition=="pullok"){
				if($searchcontent=="已打样")$searchcontent=1;
				else $searchcontent=0;
			}
			
			//处理完成状态
			if($searchcondition=="shopok"){
				if($searchcontent=="已完成")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理商品编号
			if($searchcondition=="ognum"){
				$db=M('goods');
				$gclass=$db->where(array('gnum'=>$searchcontent))->field(array('gclass'))->find();
				$gclass=$gclass['gclass'];
				switch($gclass){
					case '1': $searchcondition="ougnum";break;
					case '2': $searchcondition="odgnum";break;
					case '3': $searchcondition="obgnum";break;
						
				}
			}
			//处理商品名称
			if($searchcondition=="ogname"){
				$db=M('goods');
				$gclass=$db->where(array('gname'=>$searchcontent))->field(array('gclass'))->find();
				$gclass=$gclass['gclass'];
				switch($gclass){
					case '1': $searchcondition="ougname";break;
					case '2': $searchcondition="odgname";break;
					case '3': $searchcondition="obgname";break;
						
				}
			}
			$condition[$searchcondition] = array('like','%'.$searchcontent.'%');
			$condition['leaderverifystatus']=1;			
			$count=M('order')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$order=M('order')->where($condition)->limit ( $limit )->order('shopok,assignstatus,ispullleader')->select ();
			
			$provider=M('shop')->where(array('sclass'=>'3'))->select();
			$this->provider=$provider;
			$this->unum=$_POST['ocunum'];
			$this->page = $page->show ();
			$this->order = $order;
			$this->display('index');
		
		}
	}
	// 删除订单
	public function deleteorder($onum) {
		
			if (! empty ($onum )) {
				$order = M ( "order" );
				$result = $order->delete ($onum);
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		
	}
}