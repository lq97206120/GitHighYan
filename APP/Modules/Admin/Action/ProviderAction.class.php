<?php
class ProviderAction extends CommonAction{
	//订单查询
	public function index(){
		
		import("ORG.Util.Page");
		$count=M('order')->where(array('leaderverifystatus'=>'1','assignstatus'=>'1','opsname'=>$_GET['opsname']))->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$field=array('onum','ougname','odgname','obgname','ossname','ossaddr','ossphone','ossmail','bookdate','ispullleader','providerpull','pullok','providerok','shopok','okdate');
		$order=M('order')->limit($limit)->where(array('leaderverifystatus'=>'1','assignstatus'=>'1','opsname'=>$_GET['opsname']))->field($field)->order('shopok,ispullleader desc,providerpull,pullok desc')->select();
		$this->opsname=$_GET['opsname'];
		$this->order=$order;
		$this->page = $page->show ();
		$this->display();
	}
	//读取订单信息
	public function readorder(){
		$order=M('order')->where(array('onum'=>$_GET['onum']))->find();
		$this->opsname=$_GET['opsname'];
		$this->order=$order;
		$this->display();
	}
	//查询订单
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
			
			//处理样本收发
			if($searchcondition=="providerpull"){
				if($searchcontent=="已寄出")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理打样状态
			if($searchcondition=="pullok"){
				if($searchcontent=="已打样")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理成品收发
			if($searchcondition=="providerok"){
				if($searchcontent=="已寄出")$searchcontent=1;
				else $searchcontent=0;
			}
			
			//处理完成状态
			if($searchcondition=="shopok"){
				if($searchcontent=="已完成")$searchcontent=1;
				else $searchcontent=0;
			}
			
			$condition[$searchcondition] = array('like','%'.$searchcontent.'%');
			//员工查询编号条件
			$condition['opsname']=$_POST['opsname'];
			$count=M('order')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$order=M('order')->where($condition)->limit ( $limit )->order('shopok,leaderverifystatus,ispullleader')->select ();
			
			$this->opsname=$_POST['opsname'];
		
			$this->page = $page->show ();
			$this->order = $order;
			$this->display('index');
		
		}
	}
	//处理打样状态
	public function changepull($onum){
		if (! empty ($onum )) {
				$receive=array('onum'=>$onum,'providerpull'=>1,);
				$result =M('order')->save($receive);
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		}
	//处理成品状态
	public function changeproviderok($onum){
		if (! empty ($onum )) {
				$receive=array('onum'=>$onum,'providerok'=>1,);
				$result =M('order')->save($receive);
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		}
		
		
}