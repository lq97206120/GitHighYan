<?php
class BookAction extends CommonAction{
	
	public function index(){
	
		import("ORG.Util.Page");
		$count=M('book')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$book=M('book')->limit($limit)->order('bstatus,bdate desc')->select();
		$this->book=$book;
		$this->page = $page->show ();
		$this->display();
	}
	//处理状态
	public function changebstatus($bnum) {
		
			if (! empty ($bnum )) {
				$receive=array('bnum'=>$bnum,'bstatus'=>1,);
				$result =M('book')->save($receive);
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		
	}
	//预约单查询
	public function searchuser(){
	
	$searchcondition = I ( 'searchcondition','');
	$searchcontent = I('searchcontent','');
			if(!empty($searchcondition) && !empty($searchcontent)){
			import ( 'ORG.Util.Page' );
			//处理性别
			if($searchcondition=="bmale"){
				if($searchcontent=="男")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理状态
			if($searchcondition=="bstatus"){
				if($searchcontent=="已处理")$searchcontent=1;
				else $searchcontent=0;
			}
			$condition[$searchcondition] = array('like','%'.$searchcontent.'%');
			$count=M('book')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$book=M('book')->where($condition)->limit ( $limit )->order('bstatus asc')->select ();
			$this->page = $page->show ();
			$this->book=$book;
			$this->display('index');
		
		}
	}
}