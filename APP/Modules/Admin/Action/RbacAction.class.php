<?php
class RbacAction extends CommonAction{
	
	//用户列表
	public function index(){
		//多表关联模型查询
		$user=D('UserRelation')->relation('role')->select();
// 		$Model=new Model();
// 		$sql='SELECT hy_user. * ,  hy_role. * FROM hy_role, hy_user, hy_role_user WHERE ((uid = user_id)AND (role_id = id))';	
// 		$user=$Model->query($sql);
 		
 		
 		$this->user=$user;
 		$this->display();
	}
	//角色列表
	public  function role(){
		$role=M('role')->select();
		$this->assign('role',$role)->display();
	}
	//节点列表
	public function  node(){
		$field=array('id','name','title','pid');//提取有效字段
		$node=M('node')->field($field)->order('sort')->select();
		$node=node_merge($node);
		$this->assign('node',$node)->display();
	}
	//添加用户
	public function  addUser(){
	  $this->role=M('role')->select();
	  $this->display();
	}
	//添加用户处理
	public function addUserHandle(){
		$user=array(
			'unum'=>I('usernum'),
			'uname'=>I('username'),
			'upassword'=>I('password','','md5'),
			'ulogintime'=>time(),
			'uloginip'=>get_client_ip(),
			'ustatus'=>I('status'),
			
		);
		
		$role=array();
		//添加用户并写入用户角色
		if($uid=M('user')->add($user)){
			foreach($_POST['role_id'] as $v){
				$role[]=array(
						'role_id'=>$v,
						'user_id'=>$uid,
				);
			}
			M('role_user')->addAll($role);
			$this->success('添加成功！',U('Admin/Rbac/index'));
		}
		else
			$this->error('添加失败！');
	}
	//添加角色
	public function  addRole(){
		$this->display();
	}
	//处理角色添加
	public function addRoleHandle(){
		if(M('role')->add($_POST))
			$this->success('添加成功！',U('Admin/Rbac/role'));
		else
			$this->error('添加失败!');
	}
	//添加节点
	public function  addNode(){
		$this->pid=I('pid',0,'intval');
		$this->level=I('level',1,'intval');
		switch ($this->level){
			case 1:
				$this->type='应用'; break;
			case 2:
				$this->type='控制器';break;
			case 3:
				$this->type='方法';break;
		}
		
		$this->display();
	}
	
	public function addNodeHandle(){
		if(M('node')->add($_POST))
			$this->success('添加成功！',U('Admin/Rbac/node'));
		else
			$this->error('添加失败！');
	}
	//设置角色对节点的权限
	public function access(){
		$rid=I('rid',0,'intval');
		//读取角色权限
		$access=M('access')->where(array('role_id'=>$rid))->getField('node_id',true);
		//读取所有权限
		$node=M('node')->order('sort')->select();
		//整理权限
		$node=node_merge($node,$access);
		//p($node);die;
		$this->rid=$rid;
		
		$this->assign('node',$node)->display();
	}
	
	public function accessHandle(){
		$rid=I('rid',0,'intval');
		$db=M('access');
		//清空原来权限
		$db->where(array('role_id'=>$rid))->delete();
		
		foreach($_POST['access'] as $v){
			$tmp=explode('_',$v);//explode拆分字符串
			$data[]=array(
				'role_id'=>$rid,
				'node_id'=>$tmp[0],
			    'level'=>$tmp[1]	
			);
		}
		if($db->addAll($data)){
			$this->success('修改成功！',U('Admin/Rbac/role'));
			
		}
		else
			$this->error('修改失败！');
	}
	
	
	
	
	
	
	
	
}

