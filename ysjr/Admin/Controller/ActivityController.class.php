<?php
namespace Admin\Controller;
use Think\Controller;
class ActivityController extends CommonController{
	public function add_activity(){
		$data = array(
				'aa' => "active",
				'sh_block7' => " style='display:block';",
				'sh_two30' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	public function add_date(){
		$info = I('info');
		$activity = D('activity');
		if(is_array($info)){
			$result = $activity->add($info);
			if($result){
				$data = "添加活动成功";
				$this->ajaxReturn($data);
			}else{
				$data = "添加失败";
				$this->ajaxReturn($data);
			}
		}
	}
	public function activity_list(){
		$activity = D('activity');
		$result = $activity->select();
		$this->assign('info',$result);
		$data = array(
				'aa' => "active",
				'sh_block7' => " style='display:block';",
				'sh_two31' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function delete(){
		$id = I('id');
		$activity = D('activity');
		$result = $activity->where("id='$id'")->delete();
		if($result){
			$data = "删除成功";
			$this->ajaxReturn($data);
		}else{
			$data = "删除失败";
			$this->ajaxReturn($data);
		}
	}
}