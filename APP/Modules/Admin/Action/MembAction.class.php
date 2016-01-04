<?php
class MembAction extends CommonAction{
	
	public function index(){
		import("ORG.Util.Page");
		$count=M('memb')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$memb=M('memb')->limit($limit)->select();
		$this->memb=$memb;
		$this->page = $page->show ();
		$this->display();
		
	}

	// 添加会员
	public function insert() {
				
		$receive=array(
			
			'mname'=>$_POST['mname'],
			'mmale'=>$_POST['mmale'],
			'mdate'=>$_POST['mdate'],
			'mphone'=>$_POST['mphone'],
			'mstatus'=>'1',
			);
		
			$memb=M('memb')->add($receive);
			if($memb){
				$this->success("添加成功",U('Admin/Memb/index'));
			}else 
				$this->error("添加失败",U('Admin/Memb/index'));

	}
// 更新会员信息
	public function update() {
			
			$memb=array(
				'mnum'=>$_POST['mnum'],
				'mname'=>$_POST['mname'],
				'mmale'=>$_POST['mmale'],
				'mstatus'=>$_POST['mstatus'],
				'mpoints'=>$_POST['mpoints'],
				'mdate'=>$_POST['mdate'],
				'mphone'=>$_POST['mphone'],
				
				);
				
				$result=M('memb')->save($memb);
				
				if($result){
					$this->success("修改成功",U('Admin/Memb/index'));
				}else
					$this->error("未改动",U('Admin/Memb/index'));
	}
	//会员查询
	public function searchuser(){
	
	$searchcondition = I ( 'searchcondition','');
	$searchcontent = I('searchcontent','');
			if(!empty($searchcondition) && !empty($searchcontent)){
			import ( 'ORG.Util.Page' );
			//处理性别
			if($searchcondition=="mmale"){
				if($searchcontent=="男")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理状态
			if($searchcondition=="mstatus"){
				if($searchcontent=="开启")$searchcontent=1;
				else $searchcontent=0;
			}
			$condition[$searchcondition] = array('like','%'.$searchcontent.'%');
			$count=M('memb')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$memb=M('memb')->where($condition)->limit ( $limit )->select ();
			$this->page = $page->show ();
			$this->memb = $memb;
			$this->display('index');
		
		}
	}
	// 删除会员
	public function delete($mnum) {
		
			if (! empty ($mnum )) {
				$memb = M ( "memb" );
				$result = $memb->delete ( $mnum);
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		
	}
}