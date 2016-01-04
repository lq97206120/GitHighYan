<?php
class InformAction extends CommonAction{

	public function index(){
		import("ORG.Util.Page");
		$count=M('inform')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		$inform=M('inform')->limit($limit)->order('idate desc')->select();
		$this->page = $page->show ();
		$this->inform=$inform;
		$this->display();
	}
	
// 添加公告
	public function insert() {
		
			$receive=array(
				'ititle'=>$_POST['ititle'],
				'icontent'=>$_POST['icontent'],
				'idate'=>time(),
				
			);
			$inform=M('inform')->add($receive);
			if($inform){
							
				$this->success("添加成功",U('Admin/Inform/index'));
			}else 
				$this->error("添加失败",U('Admin/Inform/index'));
		
		

	}
	// 删除公告
	public function deleteinform($iid) {
		
			if (! empty ( $iid )) {
				
				$result = M('inform')->delete ( $iid );
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( 'ID错误！' );
			}
		
	}
}