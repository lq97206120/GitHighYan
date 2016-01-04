<?php
class FrontAction extends CommonAction{
	//菜单管理
	public function menu(){
		$menu=M('menu')->order('mid')->select();
		$this->menu=$menu;
		$this->display();
	}
	//处理编辑
	public function  editmenu(){
		$singlemenu=M('menu')->where(array('mid'=>$_GET['mid']))->find();
		$this->singlemenu=$singlemenu;
		$this->display();
	}
	//处理编辑
	public function editmenuhandle(){
		$receive=array(
			'mid'=>$_POST['mid'],
			'mname'=>$_POST['mname'],
			'mcontent'=>$_POST['mcontent'],
		);
		p($receive['mid']);
		$result=M('menu')->save($receive);
		if($result){
			$this->success('保存成功',U('Admin/Front/menu'));
		}
		else
		$this->error('保存失败',U('Admin/Front/menu'));
	}
	//联系我们中的图片管理
	public function contactus(){
		$this->display();
	}
}