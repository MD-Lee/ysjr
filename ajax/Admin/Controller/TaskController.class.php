<?php
namespace Admin\Controller;

use Think\Controller;

class TaskController extends Controller {
   public function index(){
	   $uid=empty($_SESSION ['uid'])?(int)$_POST['uid']:$_SESSION ['uid'];
		if(!$uid){
			$state["code"] 	= 1;
			$state["msg"] 	= "无用户,uid";
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}
			
	   $card_id=(int)$_POST['card_id'];
	   //$card_id=1;
	   if($card_id<1){
			$state["code"] 	= 2;
			$state["msg"] 	= "card_id错误";
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}
	  	   
		$card_transaction = D("card_transaction");		
		
		$count  = $card_transaction->where("card_id=$card_id")
							->where("date='".date('Y-m-d')."'")
							->count("id");    //计算总数
		
		if($count<1){
			$state["code"] 	= 3;
			$state["msg"] 	= "无数据";	
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}
					
		$Page   = new \Think\Page($count,10);
		$Page->show();
		
		$card = D("card")->field('bank_name')->where("id=$card_id")->limit(1)->find();			
		
		
		$list = $card_transaction
						->where("card_id=$card_id")
						->where("date='".date('Y-m-d')."'")
						->field('task_id,end,credit_card')
						->order("id desc")
						->limit($Page->firstRow. ',' . $Page->listRows)
						->select();
		foreach($list as $k =>$v){
			$task=D("card_task")->field('title,date,t_start,t_end,c_start,c_end,bus_type_name')
								->where("id={$v['task_id']}")->find();
			if(!empty($task)){
				$list[$k]=array_merge($task,$list[$k]);
			}
			$list[$k]['bank_name']=$card['bank_name'];
		}
		
		$state["code"] 	= 0;
		$state["msg"] 	= "";
		$state["data"] 	= $list;
		$state["page"] = ceil($count / $Page->listRows);
		echo json_encode($state);
    }
	public function complete(){
	   $uid=empty($_SESSION ['uid'])?(int)$_POST['uid']:$_SESSION ['uid'];
		if(!$uid){
			$state["code"] 	= 1;
			$state["msg"] 	= "无用户,uid";
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}
			
	   $card_id=(int)$_POST['card_id'];
	   //$card_id=1;
	   if($card_id<1){
			$state["code"] 	= 2;
			$state["msg"] 	= "card_id错误";
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}
		
		$task_id=(int)$_POST['task_id'];
	   //$task_id=1;
	   if($task_id<1){
			$state["code"] 	= 3;
			$state["msg"] 	= "task_id错误";
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}		

		$data['end']		=1;
		$data['credit_card']=(float)$_POST['money'];
		$data['times']		=date('Y-m-d H:i:s');
		
		
		$t=D("card_transaction")->where('card_id='.(int)$card_id)
								->where('task_id='.(int)$task_id)
								->where('uid='.(int)$uid)
								->save($data);
		if(empty($t)){
			$state["code"] 	= 4;
			$state["msg"] 	= "更新失败";
			$state["data"] 	= "";
			$state["page"] 	= "";
			echo json_encode($state);
			exit;
		}
		
		$state["code"] 	= 0;
		$state["msg"] 	= "成功";
		$state["data"] 	= "";
		$state["page"] 	= "";
		echo json_encode($state);
		exit;
    }	
}