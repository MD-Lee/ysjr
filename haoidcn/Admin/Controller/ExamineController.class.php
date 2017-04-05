<?php
namespace Admin\Controller;
use Think\Controller;
class ExamineController extends CommonController{
	public function examine(){
		$data = array(
				'sh_five' => "active",
				'sh_block4' => " style='display:block';",
				'sh_two15' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function add_examine(){
		$info = I('info');
		$info['pwd'] = md5($info['pwd']);
		$info['limits'] = 2;
		$user = D('user');
		$result = $user->add($info);
		if($result){
			$data = "添加成员成功";
			$this->ajaxReturn($data);
		}
	}
	
	public function examine_list(){
		$user = D('user');
		$list = $user->where("limits=2")->select();
		$this->assign('list',$list);
		$data = array(
				'sh_five' => "active",
				'sh_block4' => " style='display:block';",
				'sh_two16' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function assignment(){
		$id = I('id');
		$user = D('user');
		$list = $user->where("id='$id'")->select();
		$this->ajaxReturn($list);
	}
	
	public function edit_examine(){
		$id = I('id');
		$info = I('info');
		$info['pwd'] = md5($info['pwd']);
		$info['limits'] = 2;
		$user = D('user');
		$result = $user->where("id='$id'")->save($info);
		if($result){
			$data = "修改成功";
			$this->ajaxReturn($data);
		}
	}
	
	public function delete_examine(){
		$id = I('id');
		$user = D('user');
		$result = $user->where("id='$id'")->delete();
		if($result){
			$data = "删除成功";
			$this->ajaxReturn($data);
		}
	}
	
	public function edit_pwd(){
		$id = I('id');
		$pwd1 = I('pwd1');
		$pwd1 = md5($pwd1);
		$pwd = I('pwd');
		$pwd = md5($pwd);
		$user = D('user');
		$result = $user->where("id='$id'")->select();
		if($result[0]['pwd'] == $pwd1){
			$res = $user->where("id='$id'")->setField("pwd",$pwd);
			$data = "修改密码成功";
			$this->ajaxReturn($data);
		}else{
			$data = "旧密码错误";
			$this->ajaxReturn($data);
		}
	}
}