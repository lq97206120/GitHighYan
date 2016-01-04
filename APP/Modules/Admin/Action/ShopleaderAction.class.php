<?php
class ShopleaderAction extends CommonAction{
	
	//店铺订单查询
	public function order(){
		
		import("ORG.Util.Page");
		$count=M('order')->where(array('ossname'=>$_GET['ossname']))->order('shopok')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$field=array('onum','omnum','omname','omphone','ougname','odgname','obgname','osunum','bookdate','leaderverifystatus','ispullleader','providerpull','pullok','providerok','shopok','okdate');
		$order=M('order')->where(array('ossname'=>$_GET['ossname']))->limit($limit)->field($field)->order('leaderverifystatus,providerpull,pullok,providerok,shopok')->select();
		$this->order=$order;
		
		$shop=D('ShopRelation')->relation('goods')->where(array('sid'=>$_GET['sid']))->find();
		$possess=$shop['goods'];
		
		$cloth=shopposess($possess,1);
		$pants=shopposess($possess,2);
		$vest=shopposess($possess,3);
//		p($cloth);
//		p($pants);
//		p($vest);
		$this->sid=$_GET['sid'];
		$this->osunum=$_GET['unum'];
		$this->ossname=$_GET['ossname'];
		$this->cloth=$cloth;
		$this->pants=$pants;
		$this->vest=$vest;
		$this->page = $page->show ();
		$this->display();
	}
	
// 添加订单
	public function orderinsert() {
		
		$shop=M('shop')->where(array('sid'=>$_POST['sid']))->field(array('sname,saddr,sphone,smail'))->find();	
		//p($shop);	
//		p($_POST['cloth']);
//		p($_POST['pants']);
//		p($_POST['vest']);
		$field=array('gnum','gname','gid');
		//处理选择框
		$ougid=I('cloth',0,'intval');
		$odgid=I('pants',0,'intval');
		$obgid=I('vest',0,'intval');
		//处理数据库字段为空的问题
		$cloth=M('goods')->where(array('gid'=>$ougid))->field($field)->find();
			if(empty($cloth))
				{
					$cloth['gnum']='';$cloth['gname']='';
				}	
		$pants=M('goods')->where(array('gid'=>$odgid))->field($field)->find();	
			if(empty($pants))
					{
						$pants['gnum']='';$pants['gname']='';
					}	
		$vest=M('goods')->where(array('gid'=>$obgid))->field($field)->find();
			if(empty($vest))
					{
						$vest['gnum']='';$vest['gname']='';
					}	
		
		$receive=array(
				'omnum'=>$_POST['omnum'],
				'omname'=>$_POST['omname'],
				'omphone'=>$_POST['omphone'],
				'ougid'=>$ougid,
				'ougnum'=>$cloth['gnum'],
				'ougname'=>$cloth['gname'],
				'ushoulderwidth1'=>$_POST['ushoulderwidth1'],
				'ushoulderwidth2'=>$_POST['ushoulderwidth2'],
				'usleevewidth1'=>$_POST['usleevewidth1'],
				'usleevewidth2'=>$_POST['usleevewidth2'],
				'uclothlength1'=>$_POST['uclothlength1'],
				'uclothlength2'=>$_POST['uclothlength2'],
				'ubreathsur1'=>$_POST['ubreathsur1'],
				'ubreathsur2'=>$_POST['ubreathsur2'],
				'uwaistsur1'=>$_POST['uwaistsur1'],
				'uwaistsur2'=>$_POST['uwaistsur2'],
				'uhipsur1'=>$_POST['uhipsur1'],
				'uhipsur2'=>$_POST['uhipsur2'],
				'ubreathwidth1'=>$_POST['ubreathwidth1'],
				'ubreathwidth2'=>$_POST['ubreathwidth2'],
				'ubackwidth1'=>$_POST['ubackwidth1'],
				'ubackwidth2'=>$_POST['ubackwidth2'],
				'unecksur'=>$_POST['unecksur'],
				'uneckstyle'=>$_POST['uneckstyle'],
				'ubosom'=>$_POST['ubosom'],
				'usleevesur'=>$_POST['usleevesur'],
				'ucode'=>$_POST['ucode'],
				'uclothfabric'=>$_POST['uclothfabric'],
		
				'odgid'=>$odgid,
				'odgnum'=>$pants['gnum'],
				'odgname'=>$pants['gname'],
				'dwaistsur1'=>$_POST['dwaistsur1'],
				'dwaistsur2'=>$_POST['dwaistsur2'],
				'dhipsur1'=>$_POST['dhipsur1'],
				'dhipsur2'=>$_POST['dhipsur2'],
				'dpantslength1'=>$_POST['dpantslength1'],
				'dpantslength2'=>$_POST['dpantslength2'],
				'dupcrotch1'=>$_POST['dupcrotch1'],
				'dupcrotch2'=>$_POST['dupcrotch2'],
				'dallcrotch1'=>$_POST['dallcrotch1'],
				'dallcrotch2'=>$_POST['dallcrotch2'],
				'dwaistdown1'=>$_POST['dwaistdown1'],
				'dwaistdown2'=>$_POST['dwaistdown2'],
				'dlegsur1'=>$_POST['dlegsur1'],
				'dlegsur2'=>$_POST['dlegsur2'],
				'dkneesur1'=>$_POST['dkneesur1'],
				'dkneesur2'=>$_POST['dkneesur2'],
				'dpantssur'=>$_POST['dpantssur'],
				'belly'=>I('belly','','intval'),
				'sleg'=>I('sleg','','intval'),
				'upleg'=>I('upleg','','intval'),
				'flathip'=>I('flathip','','intval'),
				'oleg'=>I('oleg','','intval'),
				'xleg'=>I('xleg','','intval'),
				'dcode'=>$_POST['dcode'],
				'dpantsfabric'=>$_POST['dpantsfabric'],
		
				'obgid'=>$obgid,
				'obgnum'=>$vest['gnum'],
				'obgname'=>$vest['gname'],
				'bfrontlength'=>$_POST['bfrontlength'],
				'bbacklength'=>$_POST['bbacklength'],
				'bup'=>$_POST['bup'],
				'bcenter'=>$_POST['bcenter'],
				'bcode'=>$_POST['bcode'],
				'bbackfabric'=>$_POST['bbackfabric'],
		
				'ossname'=>$shop['sname'],
				'ossaddr'=>$shop['saddr'],
				'ossphone'=>$shop['sphone'],
				'ossmail'=>$shop['smail'],
				'osunum'=>$_POST['osunum'],
				
				
			);
			$db=M('order');
			$result=$db->add($receive);
			if($result){
				$this->success("添加成功",U('Admin/Shopleader/order',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'],'ossname'=>$_POST['ossname'],)));
			}else 
				$this->error("添加失败",U('Admin/Shopleader/order',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'],'ossname'=>$_POST['ossname'],)));
			
		

	}
	//读取订单修改信息
	public function readorder(){
		
		$order=M('order')->where(array('onum'=>$_GET['onum']))->find();
		$this->order=$order;
				
		$shop=D('ShopRelation')->relation('goods')->where(array('sid'=>$_GET['sid']))->find();
		$possess=$shop['goods'];
		
		$cloth=shopposess($possess,1);
		$pants=shopposess($possess,2);
		$vest=shopposess($possess,3);
//		p($cloth);
//		p($pants);
//		p($vest);
		$this->sid=$_GET['sid'];
		$this->osunum=$_GET['unum'];
		$this->ossname=$_GET['ossname'];
		$this->cloth=$cloth;
		$this->pants=$pants;
		$this->vest=$vest;
		$this->display();
	}
	//更新订单信息
	public function orderupdate() {
		
		$field=array('gnum','gname','gid');
		//处理选择框
		$ougid=I('cloth',0,'intval');
		$odgid=I('pants',0,'intval');
		$obgid=I('vest',0,'intval');
		//处理数据库字段为空的问题
		$cloth=M('goods')->where(array('gid'=>$ougid))->field($field)->find();
			if(empty($cloth))
				{
					$cloth['gnum']='';$cloth['gname']='';
				}	
		$pants=M('goods')->where(array('gid'=>$odgid))->field($field)->find();	
			if(empty($pants))
					{
						$pants['gnum']='';$pants['gname']='';
					}	
		$vest=M('goods')->where(array('gid'=>$obgid))->field($field)->find();
			if(empty($vest))
					{
						$vest['gnum']='';$vest['gname']='';
					}	
		//处理打样
		if($_POST['ispullleader']=='1') {$pullok=0;$providerpull=0;}
		else {$pullok=1;$providerpull=1;}
		
		$receive=array(
				'onum'=>$_POST['onum'],
				'omnum'=>$_POST['omnum'],
				'omname'=>$_POST['omname'],
				'omphone'=>$_POST['omphone'],
				'ougid'=>$ougid,
				'ougnum'=>$cloth['gnum'],
				'ougname'=>$cloth['gname'],
				'ushoulderwidth1'=>$_POST['ushoulderwidth1'],
				'ushoulderwidth2'=>$_POST['ushoulderwidth2'],
				'usleevewidth1'=>$_POST['usleevewidth1'],
				'usleevewidth2'=>$_POST['usleevewidth2'],
				'uclothlength1'=>$_POST['uclothlength1'],
				'uclothlength2'=>$_POST['uclothlength2'],
				'ubreathsur1'=>$_POST['ubreathsur1'],
				'ubreathsur2'=>$_POST['ubreathsur2'],
				'uwaistsur1'=>$_POST['uwaistsur1'],
				'uwaistsur2'=>$_POST['uwaistsur2'],
				'uhipsur1'=>$_POST['uhipsur1'],
				'uhipsur2'=>$_POST['uhipsur2'],
				'ubreathwidth1'=>$_POST['ubreathwidth1'],
				'ubreathwidth2'=>$_POST['ubreathwidth2'],
				'ubackwidth1'=>$_POST['ubackwidth1'],
				'ubackwidth2'=>$_POST['ubackwidth2'],
				'unecksur'=>$_POST['unecksur'],
				'uneckstyle'=>$_POST['uneckstyle'],
				'ubosom'=>$_POST['ubosom'],
				'usleevesur'=>$_POST['usleevesur'],
				'ucode'=>$_POST['ucode'],
				'uclothfabric'=>$_POST['uclothfabric'],
		
				'odgid'=>$odgid,
				'odgnum'=>$pants['gnum'],
				'odgname'=>$pants['gname'],
				'dwaistsur1'=>$_POST['dwaistsur1'],
				'dwaistsur2'=>$_POST['dwaistsur2'],
				'dhipsur1'=>$_POST['dhipsur1'],
				'dhipsur2'=>$_POST['dhipsur2'],
				'dpantslength1'=>$_POST['dpantslength1'],
				'dpantslength2'=>$_POST['dpantslength2'],
				'dupcrotch1'=>$_POST['dupcrotch1'],
				'dupcrotch2'=>$_POST['dupcrotch2'],
				'dallcrotch1'=>$_POST['dallcrotch1'],
				'dallcrotch2'=>$_POST['dallcrotch2'],
				'dwaistdown1'=>$_POST['dwaistdown1'],
				'dwaistdown2'=>$_POST['dwaistdown2'],
				'dlegsur1'=>$_POST['dlegsur1'],
				'dlegsur2'=>$_POST['dlegsur2'],
				'dkneesur1'=>$_POST['dkneesur1'],
				'dkneesur2'=>$_POST['dkneesur2'],
				'dpantssur'=>$_POST['dpantssur'],
				'belly'=>I('belly','','intval'),
				'sleg'=>I('sleg','','intval'),
				'upleg'=>I('upleg','','intval'),
				'flathip'=>I('flathip','','intval'),
				'oleg'=>I('oleg','','intval'),
				'xleg'=>I('xleg','','intval'),
				'dcode'=>$_POST['dcode'],
				'dpantsfabric'=>$_POST['dpantsfabric'],
		
				'obgid'=>$obgid,
				'obgnum'=>$vest['gnum'],
				'obgname'=>$vest['gname'],
				'bfrontlength'=>$_POST['bfrontlength'],
				'bbacklength'=>$_POST['bbacklength'],
				'bup'=>$_POST['bup'],
				'bcenter'=>$_POST['bcenter'],
				'bcode'=>$_POST['bcode'],
				'bbackfabric'=>$_POST['bbackfabric'],
				'ispullleader'=>$_POST['ispullleader'],
				'pullok'=>$pullok,
				'providerpull'=>$providerpull,
				'leaderverifystatus'=>$_POST['leaderverifystatus'],
						
			);
			
			$db=M('order');
			$result=$db->save($receive);
			if($result){
				if($_POST['leaderverifystatus']=='1'){
					$center=M('shop')->where(array('sname'=>"管理部门"))->find();
					$mail=$center['smail'];
					
					$r=think_send_mail("{$mail}",'海彦',"新订单","有新订单,订单号为:{$receive['onum']}.");
					
					
				}
				$this->success("保存成功",U('Admin/Shopleader/order',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'],'ossname'=>$_POST['ossname'],)));
			}else 
				$this->error("保存失败",U('Admin/Shopleader/order',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'],'ossname'=>$_POST['ossname'],)));
	
	}
	//订单查询
	public function ordersearch(){
		
		$searchcondition = I ( 'searchcondition','');
		$searchcontent = I('searchcontent','');
		$ossname=I('ossname','');
		if(!empty($searchcondition) && !empty($searchcontent)){
			import ( 'ORG.Util.Page' );
			//处理审核状态
			if($searchcondition=="leaderverifystatus"){
				if($searchcontent=="已审核")$searchcontent=1;
				else $searchcontent=0;
			}
			//处理店长意见
			if($searchcondition=="ispullleader"){
				if($searchcontent=="要打样")$searchcontent=1;
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
			//员工查询编号条件
			$condition['ossname']=$ossname;
			$count=M('order')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$order=M('order')->where($condition)->limit ( $limit )->order('shopok,leaderverifystatus,ispullleader')->select ();
			//分配商品
			$shop=D('ShopRelation')->relation('goods')->where(array('sid'=>$_POST['sid']))->find();
			$possess=$shop['goods'];
			
			$cloth=shopposess($possess,1);
			$pants=shopposess($possess,2);
			$vest=shopposess($possess,3);
		
			$this->sid=$_POST['sid'];
			$this->osunum=$_POST['osunum'];
			$this->ossname=$ossname;
			$this->cloth=$cloth;
			$this->pants=$pants;
			$this->vest=$vest;
			$this->page = $page->show ();
			$this->order = $order;
			$this->display('order');
		
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

//处理打样收发
	public function pullok($onum){
		if (! empty ($onum )) {
				$receive=array('onum'=>$onum,'pullok'=>1,);
				$result =M('order')->save($receive);
				
				$order=M(order)->where(array('onum'=>$onum))->find();
				$opsname=$order['opsname'];
				$shop=M('shop')->where(array('sname'=>$opsname))->find();
				$mail=$shop['smail'];
				$r=think_send_mail("{$mail}",'海彦',"打样完成","打样完成,订单号为:{$onum}.");
				
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		}
	//处理成品收发
	public function shopok($onum){
		if (! empty ($onum )) {
				$date=date("Y-m-d");
				$receive=array('onum'=>$onum,'shopok'=>1,'okdate'=>$date,);
				$result =M('order')->save($receive);
				if (false !== $result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( '帐号错误！' );
			}
		}
		//处理员工
		public function user(){
			
			import("ORG.Util.Page");
			$user=D('UserRelation')->relation(true)->order('unum')->select();
			$user=user_manyone($user,$_GET['sid']);
			$count=count($user);
			$page=new Page($count,12);
			$limit = $page->firstRow . ',' . $page->listRows;
			$user=D('UserRelation')->relation(true)->order('unum')->limit($limit)->select();
			$user=user_manyone($user,$_GET['sid']);
			$this->user=$user;
			$this->sid=$_GET['sid'];
			$this->page = $page->show ();
			$this->display();
			
			
		}
	// 添加员工
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
				
				$this->success("添加成功",U('Admin/Shopleader/user',array('sid'=>$_POST['shop'])));
			}else 
				$this->error("添加失败",U('Admin/Shopleader/user',array('sid'=>$_POST['shop'])));
			
		}
		else{
			
			$this->error("用户已经存在",U('Admin/Shopleader/user',array('sid'=>$_POST['shop'])));
		}

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
			
				$result=M('user')->save($user);
				
				if($result){
					$this->success("修改成功",U('Admin/Shopleader/user',array('sid'=>$_POST['sid'])));
				}else
					$this->error("未改动",U('Admin/Shopleader/user',array('sid'=>$_POST['sid'])));
	}
	// 删除用户
	public function delete($uid) {
		
			if (! empty ( $uid )) {
				$user = M ( "user" );
				$result = $user->delete ( $uid );
				//清空role_user中的记录
				$deleteroleResult=M('role_user')->where(array('user_id'=>$uid))->delete();
				//清空shop_user中的记录
				$deleteshopResult=M('shop_user')->where(array('user_id'=>$uid))->delete();
				if (false !== $roleResult||$shopResult||$result) {
					
				} else {
					$this->error ( '删除出错！' );
				}
			} else {
				$this->error ( 'ID错误！' );
			}
		
	}
	//商品管理
	public function goodslist(){
		//获取所有商品
		$goods=M('goods')->select();
		
		//获取该单位有的商品
		$possess=M('goods_shop')->where(array('shop_id'=>$_GET['sid']))->getField('goods_id',true);
		
		//组合数组
		$goods=goods_merge($goods,$possess);
				
		$shop=M('shop')->where(array('sid'=>$_GET['sid']))->field(array('sname,sid'))->find();
		$this->goods=$goods;
		$this->shop=$shop;
		//p($shop);
		//p($goods);
		$this->display();
	}
//处理部门的商品列表
	public function goodslistHandle(){
		//清除之前的记录
		$deleteResult=M('goods_shop')->where(array('shop_id'=>$_POST['sid']))->delete();
		foreach($_POST['goods'] as $v){
			$data[]=array('goods_id'=>$v,'shop_id'=>$_POST['sid']);
		}
		
		if(M('goods_shop')->addAll($data)){
			$this->success('修改成功！',U('Admin/Shop/index'));
		}else 
			$this->error("删除失败！",U('Admin/Shop/index'));
	}
}