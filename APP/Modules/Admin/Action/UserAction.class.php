<?php
class UserAction extends CommonAction{
	//查询员工
	public function index(){
	
	$this->roles=M('role')->select();//列出角色表
	$this->shops=M('shop')->select();
	import("ORG.Util.Page");
	$count=D('UserRelation')->relation(true)->count();
	$page=new Page($count,13);
	$limit = $page->firstRow . ',' . $page->listRows;
	$user=D('UserRelation')->relation(true)->limit($limit)->select();
	$user=user_manyone($user);//消除数组
	$this->user=$user;
	$this->page = $page->show ();
	$this->display();
	}
	// 删除用户
	public function delete($uid) {
		
			if (! empty ( $uid )) {
				$user = M ( "user" );
				$result = $user->delete ( $uid );
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( 'ID错误！' );
			}
		
	}
	
	// 修改用户信息
	public function modify() {
		p($_POST);
		$userid = I ( 'userid', '', 'intval' );
		$us = M ( 'user' )->find ( $userid );
		$this->us = $us;
		$this->display ();
	}
	
	// 更新用户信息
	public function update() {
		
			$user=array(
				'uid'=>$_POST['uid'],
				'unum'=>$_POST['unum'],
				'uname'=>$_POST['uname'],
				'umale'=>$_POST['umale'],
				'ustatus'=>$_POST['ustatus'],
				'ubirth'=>$_POST['ubirth'],
				'udate'=>$_POST['udate'],
				'uphone'=>$_POST['uphone'],
				
				);
				//清空role_user中的记录
				$deleteroleResult=M('role_user')->where(array('user_id'=>$_POST['uid']))->delete();
				
				$role=array('user_id'=>$_POST['uid'],'role_id'=>$_POST['rolelimits'],);
				$roleResult=M('role_user')->add($role);
				//清空shop_user中的记录
				$deleteshopResult=M('shop_user')->where(array('user_id'=>$_POST['uid']))->delete();
				
				$shop=array('user_id'=>$_POST['uid'],'shop_id'=>$_POST['shoplimits'],);
				$shopResult=M('shop_user')->add($shop);
				$result=M('user')->save($user);
				
				if($roleResult||$shopResult||$result){
					$this->success("修改成功",U('Admin/User/index'));
				}else
					$this->error("未改动",U('Admin/User/index'));
	}
	
	// 添加用户
	public function insert() {
		
				
		$numResult=M('user')->where(array('unum'=>$_POST['unum']))->find();
		
		if(empty($numResult)){
				$receive=array(
				'unum'=>$_POST['unum'],
				'uname'=>$_POST['uname'],
				'umale'=>$_POST['umale'],
				'ubirth'=>$_POST['ubirth'],
				'udate'=>$_POST['udate'],
				'uphone'=>$_POST['uphone'],
				'ustatus'=>'1',
			
			);
			$user=M('user')->add($receive);
			if($user){
				
				$role=array('user_id'=>$user,'role_id'=>$_POST['role']);
				M('role_user')->add($role);
				$shop=array('user_id'=>$user,'shop_id'=>$_POST['shop']);
				M('shop_user')->add($shop);
				
				$this->success("添加成功",U('Admin/User/index'));
			}else 
				$this->error("添加失败",U('Admin/User/index'));
			
		}
		else{
			
			$this->error("用户已经存在",U('Admin/User/index'));
		}

	}
	//查询用户
	public function searchuser(){
		
		$searchcondition = I ( 'searchcondition','');
		$searchcontent = I('searchcontent','');

		
		if(!empty($searchcondition) && !empty($searchcontent) ){
			import ( 'ORG.Util.Page' );
			//查询条件的处理
			//处理性别
			if($searchcondition=="umale"){
				if($searchcontent=="男")$searchcontent=1;
				else$searchcontent=0;
			}
			//处理状态
			if($searchcondition=="ustatus"){
				if($searchcontent=="开启")$searchcontent=1;
				else$searchcontent=0;
			}
			//处理user表查询
			if($searchcondition=="unum"||$searchcondition=="uname"||$searchcondition=="uphone"||$searchcondition=="ustatus"||$searchcondition=="umale"){
				$condition[$searchcondition] = array('like','%'.$searchcontent.'%');
				$count = D( 'UserRelation' )->where($condition)->count ();
				$page = new Page ( $count, 13 );
				$limit = $page->firstRow . ',' . $page->listRows;
				
				$user = D ( 'UserRelation' )->relation(true)->where($condition)->limit ( $limit )->order('unum desc')->select ();
				
				$user=user_manyone($user);
				
				$this->page = $page->show ();
				$this->user = $user;
				$this->roles=M('role')->select();//列出角色表
				$this->shops=M('shop')->select();
				$this->display();
			}else{
				
			//处理role与shop
				$user = D ( 'UserRelation' )->relation(true)->select ();
				$user=user_manyone($user);
				
				if($searchcondition=="role"){
					for($m=0,$i=0;$i<count($user);$i++){
						if($user[$i]['roleremark']==$searchcontent){$role[$m]=$user[$i];$m++;}
					
					}
					$count =$m;
					$page = new Page ( $m, 13 );
					$limit = $page->firstRow . ',' . $page->listRows;
					$this->page = $page->show ();
					$this->user = $role;
					$this->roles=M('role')->select();//列出角色表
					$this->shops=M('shop')->select();
					$this->display();
					
					
				}elseif($searchcondition=="shop"){
					for($n=0,$j=0;$j<count($user);$j++){
						if($user[$j]['shopsname']==$searchcontent){$shop[$n]=$user[$j];$n++;}
										
				}
					$count = $n;
					$page = new Page ( $n, 13 );
					$limit = $page->firstRow . ',' . $page->listRows;
					$this->page = $page->show ();
					$this->user = $shop;
					$this->roles=M('role')->select();//列出角色表
					$this->shops=M('shop')->select();
					$this->display();
				
			}


		}
		
	}
	}
	
}


