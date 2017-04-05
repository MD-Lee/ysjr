<?php
namespace Admin\Controller;

use Think\Controller;

class CardController extends Controller {
    public function index(){
		$uid=empty($_SESSION ['uid'])?(int)$_POST['uid']:$_SESSION ['uid'];
		if($uid<1){
			$state["code"] 	= 1;
			$state["msg"] 	= "无用户,uid";
			$state["data"] 	= "";
			$state["page"] 	= 0;
			echo json_encode($state);
			exit;
		}
		
		$Card = D("card");
		$count  = $Card->where("uid=".$uid)->count("id");    //计算总数
		
		if($count<1){
			$state["code"] 	= 2;
			$state["msg"] 	= "无数据";	
			$state["data"] 	= "";
			$state["page"] 	= 0;
		}else{		
			$Page   = new \Think\Page($count,10);
			$Page->show();			
			
			$list = $Card->order("id desc")
						->where("uid=".$uid)
						->limit($Page->firstRow. ',' . $Page->listRows)
						->select();
			
			$state["code"] 	= 0;
			$state["data"] 	= $list;
			$state["page"]  = ceil($count / $Page->listRows);
			$state["msg"] 	= "";
    	}		
		echo json_encode($state);
    }
	public function add(){
		
		if($_POST){
			
			$uid=empty($_SESSION ['uid'])?(int)$_POST['uid']:$_SESSION ['uid'];
			if(!$uid){
				$state["code"] 	= 1;
				$state["msg"] 	= "无用户,uid";
				$state["data"] 	= "";
				echo json_encode($state);
				exit;
			}
			
			
			$url="/Uploads/".date('Y-m-d');
			$upload=THINK_PATH."..".$url;
			is_dir($upload) or mkdir($upload);
			
			
			$name=date('YmdHis_').rand(1,9999).".jpg";
			
			file_put_contents($upload."/".$name,base64_decode(I("pic")));
		
			$data = array(
					'uid'			=>	$uid,
					'bank_id'		=>	I("bank_id"),
					'number'		=>	I("number"),
					'name'			=>	I("name"),
					'id_card'		=>	I("id_card"),
					'mobile'		=>	I("mobile"),
					'credit'		=>	I("credit"),
					'temp_credit'	=>	I("temp_credit"),
					'bill_day'		=>	I("bill_day"),
					're_bill_day'	=>	I("re_bill_day"),
					'pic'			=>	$url."/".$name
			);

			$se = D("card")->add($data);
			$state["code"] 	= 0;
			$state["msg"] 	= "添加成功";
			$state["data"] 	= "";
			echo json_encode($state);
		}
	}
}