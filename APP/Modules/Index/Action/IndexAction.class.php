<?php
class IndexAction extends Action{
	public function index(){
		$mid=I('mid',1,'intval');
		$menu=M('menu')->order('mid')->select();
		$this->menu=$menu;
		foreach($menu as $v){
			if($v['mid']==$mid){
				$singlemenu=$v;
				}
			
		}
		$this->singlemenu=$singlemenu;
		$this->display();
	}
	
	
	//联系我们
	public function contactUs(){
		$this->display();
	}
	//预约
	public function book(){
		$menu=M('menu')->order('mid')->select();
		$this->menu=$menu;
		$shop=M('shop')->where(array('sclass'=>'1'))->select();
		$this->shop=$shop;
		$this->display();
	}
	//处理添加预约
	public function bookhandle(){
		$sid=$_POST['shop'];
		$shop=M('shop')->where(array('sid'=>$sid))->find();
		
		$receive=array(
			'bname'=>$_POST['bname'],
			'bmale'=>$_POST['bmale'],
			'bphone'=>$_POST['bphone'],
			'bsid'=>$shop['sid'],
			'bshopsname'=>$shop['sname'],
			'bdate'=>time(),
		);
		$result=M('book')->add($receive);
		if($result){
			$mail=$shop['smail'];
			$r=think_send_mail("{$mail}",'海彦',"新预约","有新预约,预约号为:{$result}.");
			
			$this->success('预约成功',U('Index/Index/index'));
		}
		else 
		$this->error('预约失败',U('Index/Index/book'));
		
	}
//会员中心
	public function vipUser(){
		$this->display();
	}
	
	//预约
	public function appoint(){
		$this->display();
	}
}