<?php
namespace Admin\Controller;
use Think\Controller;
class DaoqiController extends CommonController{
	public function daoqi(){
		$daoqi = D('daoqi');  
		$result = $daoqi->select();
		$days = $result[0]['days']; 
		$id = $result[0]['id'];
		$this->assign('days',$days);
		$this->assign('id',$id);
		$data = array(
				'sh_seven' => "active",
				'sh_block6' => " style='display:block';",
				'sh_two27' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function add_daoqi(){
		$info = I('info');
		$id = $info['id'];
		if(is_array($info)){
			$daoqi = D('daoqi');
			$result = $daoqi->where("id='$id'")->select();
			if($result){
				$daoqi->where("id='$id'")->save($info);
				$data = '更新配置成功';
				$this->ajaxReturn($data);
			}else{
				$daoqi->add($info);
				$data = '更新配置成功';
				$this->ajaxReturn($data);
			}
		}
	}
}