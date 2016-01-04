<?php
class EmployeeAction extends CommonAction{
	
	public function book(){
		//预约查询
		import("ORG.Util.Page");
		$count=M('book')->where(array('bsid'=>$_GET['sid']))->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$book=M('book')->where(array('bsid'=>$_GET['sid']))->limit($limit)->order('bstatus,bdate desc')->select();
		$this->book=$book;
		//店铺id
		$this->bsid=$_GET['sid'];
		$this->uid=$_GET['uid'];
		$this->page = $page->show ();
		$this->display();
	}
	//处理预约单状态
	public function changebstatus($bnum,$uid) {
			$user=M('user')->where(array('uid'=>$uid))->find();
			$buid=$user['uid'];
			$bunum=$user['unum'];
			$buname=$user['uname'];
			if (! empty ($bnum )) {
				$receive=array('bnum'=>$bnum,'bstatus'=>1,'buid'=>$buid,'bunum'=>$bunum,'buname'=>$buname);
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
	public function booksearch(){
	
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
			$condition['bsid']=$_POST['bsid'];
			$count=M('book')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$book=M('book')->where($condition)->limit ( $limit )->order('bstatus asc')->select ();
			$this->page = $page->show ();
			$this->book=$book;
			$this->bsid=$_POST['bsid'];
			$this->uid=$_POST['uid'];
			$this->display('book');
		
		}
	}
	//个人订单查询
	public function selforder(){
		
		import("ORG.Util.Page");
		$count=M('order')->where(array('osunum'=>$_GET['unum']))->order('shopok')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$field=array('onum','omnum','omname','omphone','ougname','odgname','obgname','osunum','bookdate','leaderverifystatus','ispullleader','providerpull','pullok','providerok','shopok','okdate');
		$order=M('order')->where(array('osunum'=>$_GET['unum']))->limit($limit)->field($field)->order('leaderverifystatus,providerpull,pullok,providerok,shopok')->select();
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
				$this->success("添加成功",U('Admin/Employee/selforder',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'])));
			}else 
				$this->error("添加失败",U('Admin/Employee/selforder',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'])));
			
		

	}
	//读取修改订单
	public function readselforder(){
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
						
			);
			
			$db=M('order');
			$result=$db->save($receive);
			
			if($result){
				$this->success("添加成功",U('Admin/Employee/selforder',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'])));
			}else 
				$this->error("添加失败",U('Admin/Employee/selforder',array('unum'=>$_POST['osunum'],'sid'=>$_POST['sid'])));
	
	}
	
	//个人查询
	public function selfsearch(){
		
		$searchcondition = I ( 'searchcondition','');
		$searchcontent = I('searchcontent','');
		$osunum=I('osunum','');
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
			$condition['osunum']=$osunum;
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
			$this->cloth=$cloth;
			$this->pants=$pants;
			$this->vest=$vest;
			$this->page = $page->show ();
			$this->order = $order;
			$this->display('selforder');
		
		}
	}
// 个人删除订单
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
	
	//店铺订单查询
	public function shoporder(){
		
		import("ORG.Util.Page");
		$count=M('order')->where(array('ossname'=>$_GET['ossname']))->order('shopok')->count();
		$page=new Page($count,10);
		$limit = $page->firstRow . ',' . $page->listRows;
		$field=array('onum','omnum','omname','omphone','ougname','odgname','obgname','osunum','bookdate','leaderverifystatus','ispullleader','providerpull','pullok','providerok','shopok','okdate');
		$order=M('order')->where(array('ossname'=>$_GET['ossname']))->limit($limit)->field($field)->order('leaderverifystatus,providerpull,pullok,providerok,shopok')->select();
		$this->order=$order;
		
//		$shop=D('ShopRelation')->relation('goods')->where(array('sid'=>$_GET['sid']))->find();
//		$possess=$shop['goods'];
//		
//		$cloth=shopposess($possess,1);
//		$pants=shopposess($possess,2);
//		$vest=shopposess($possess,3);
//		p($cloth);
//		p($pants);
//		p($vest);
//		$this->sid=$_GET['sid'];
		$this->ossname=$_GET['ossname'];
//		$this->cloth=$cloth;
//		$this->pants=$pants;
//		$this->vest=$vest;
		$this->page = $page->show ();
		$this->display();
	}
	//店铺订单读取
	public function readshoporder(){
		
		$order=M('order')->where(array('onum'=>$_GET['onum']))->find();
		$this->order=$order;
		$this->ossname=$_GET['ossname'];
		$this->display();
	}
//店铺订单查询
	public function shopsearch(){
		
		$searchcondition = I ( 'searchcondition','');
		$searchcontent = I('searchcontent','');
		
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
			$condition['ossname']=$_POST['ossname'];
			$count=M('order')->where($condition)->count ();
			$page=new Page($count,10);
			$limit=$page->firstRow . ',' . $page->listRows;
			$order=M('order')->where($condition)->limit ( $limit )->order('shopok,leaderverifystatus,ispullleader')->select ();
			
			$this->ossname=$_POST['ossname'];
		
			$this->page = $page->show ();
			$this->order = $order;
			$this->display('shoporder');
		
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
	//会员查询
	public function memb(){
		
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
	public function insertmemb() {
				
		$receive=array(
			
			'mname'=>$_POST['mname'],
			'mmale'=>$_POST['mmale'],
			'mdate'=>$_POST['mdate'],
			'mphone'=>$_POST['mphone'],
			'mstatus'=>'1',
			);
		
			$memb=M('memb')->add($receive);
			if($memb){
				$this->success("添加成功",U('Admin/Employee/memb'));
			}else 
				$this->error("添加失败",U('Admin/Employee/memb'));

	}	
	//会员查询
	public function searchmemb(){
	
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
			$this->display('memb');
		
		}
	}

}