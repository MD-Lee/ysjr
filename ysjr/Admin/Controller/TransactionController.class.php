<?php
namespace Admin\Controller;

use Think\Controller;

class TransactionController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->assign("data",array('transaction' => " style='display:block';"));
	}
	
	//curl方法
	public function https_request($url,$data = null){
		$curl = curl_init();
		//设置选项，包括URL
		curl_setopt($curl,CURLOPT_URL,$url);
		//安全性要求
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
	
		if(!empty($data)){
			curl_setopt($curl,CURLOPT_POST,1);
			curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
		}
	
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	//获取access_token的值
	public function access_token(){
		$weixin = weixin();
		$appid = $weixin['appid'];
		$secret = $weixin['secret'];
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		$output = $this->https_request($url);
		$array = json_decode($output,true);
		$access_token = $array['access_token'];
		return  $access_token;
	}
	
    public function index(){
		$Transaction = D("card_transaction");
		
		$count  = $Transaction->count("id");    //计算总数		
		
    	$Page   = new \Think\Page($count,10);
		$Page->setConfig('prev', "上一页");
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('first', '首页');
    	$Page->setConfig('last', '尾页');
    	$show 	= $Page->show();
    	$this->assign("page",$show);
    	
    	$list = $Transaction->order("id desc")->limit($Page->firstRow. ',' . $Page->listRows)->select();
		
		foreach($list as $k =>$v){
			$user=D("service")->where("id={$v['uid']}")->find();
			if(!empty($user))$list[$k]['uname']=$user['uname'];
			
			$task=D("card_task")->where("id={$v['task_id']}")->find();
			if(!empty($task)){
				$list[$k]=array_merge($task,$list[$k]);
			}
		}
		
    	$this->assign("list",$list);
		
		$this->display();
    }
    
    //放款用户列表界面
    public function loan_list(){
    	$payment_list = D('payment_list');
    	$user_money_info = D('user_money_info');
    	
    	//搜索
    	if($_POST['content']){
    		$type = I('type');
    		$content = I('content');
    		if($content){
    			if($type == '1'){
    				$where = "haoidcn_payment_list.phone like '%$content%' ";
    				$this->assign('type',$type);
    			}else{
    				$where = "b.name like '%$content%' ";
    				$this->assign('type',$type);
    			}
    			$this->assign('content',$content);
    		}
    		$list = $payment_list->join("haoidcn_bank_info as b ON haoidcn_payment_list.phone=b.phone")->join("haoidcn_service ON haoidcn_payment_list.phone=haoidcn_service.phone")->where("$where")->select();
    		foreach ($list as $key=>$value){
    			$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
    			$list[$key]['loan_people'] = $money['loan_people'];
    		}
    		$this->assign('list',$list);
    		$data = array(
    				'sh_three' => "active",
    				'sh_block2' => " style='display:block';",
    				'sh_two10' => " class='active'"
    		);
    		$this->assign("data",$data);
    		$this->display();
    		exit;
    	}
    	
    	$count = $payment_list->count();
    	$Page = new \Think\Page($count,10);
    	$Page->setConfig('prev',"上一页");
    	$Page->setConfig('next',"下一页");
    	$Page->setConfig('first',"首页");
    	$Page->setConfig('last',"尾页");
    	$show = $Page->show();
    	$this->assign('page',$show);
    	$list = $payment_list->join("haoidcn_bank_info as b ON haoidcn_payment_list.phone=b.phone")->join("haoidcn_service ON haoidcn_payment_list.phone=haoidcn_service.phone")->limit($Page->firstRow. ',' . $Page->listRows)->select();
    	foreach ($list as $key=>$value){
    		$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
    		$list[$key]['loan_people'] = $money['loan_people'];
    	}
    	$this->assign('list',$list);
    	$data = array(
    			'sh_three' => "active",
    			'sh_block2' => " style='display:block';",
    			'sh_two10' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    public function no_repayment(){
    	$payment_list = D('payment_list');
    	$user_money_info = D('user_money_info');
    	//搜索
    	if($_POST['content']){
    		$type = I('type');
    		$content = I('content');
    		if($content){
    			if($type == '1'){
    				$where = "haoidcn_payment_list.phone like '%$content%' ";
    				$this->assign('type',$type);
    			}else{
    				$where = "b.name like'%$content%' ";
    				$this->assign('type',$type);
    			}
    			$this->assign('content',$content);
    		}
    		$list = $payment_list->join("haoidcn_user_info as b ON haoidcn_payment_list.phone=b.phone")->where("$where")->select();
    		foreach ($list as $key=>$value){
    			$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
    			$list[$key]['loan_people'] = $money['loan_people'];
    		}
    		$this->assign('list',$list);
    		$data = array(
    				'sh_three' => "active",
    				'sh_block2' => " style='display:block';",
    				'sh_two10' => " class='active'"
    		);
    		$this->assign("data",$data);
    		$this->display();
    		exit;
    	}
    	
    	$count = $payment_list->count();
    	$Page = new \Think\Page($count,10);
    	$Page->setConfig('prev',"上一页");
    	$Page->setConfig('next',"下一页");
    	$Page->setConfig('first',"首页");
    	$Page->setConfig('last',"尾页");
    	$show = $Page->show();
    	$this->assign('page',$show);
    	$list = $payment_list->join("haoidcn_user_info as b ON haoidcn_payment_list.phone=b.phone")->limit($Page->firstRow. ',' . $Page->listRows)->order("payment_time desc")->select();
    	foreach ($list as $key=>$value){
    		$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
    		$list[$key]['loan_people'] = $money['loan_people'];
    	}
    	$this->assign('list',$list);
    	$data = array(
    			'sh_three' => "active",
    			'sh_block2' => " style='display:block';",
    			'sh_two11' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    public function overdue(){
    	$data = array(
    			'sh_three' => "active",
    			'sh_block2' => " style='display:block';",
    			'sh_two12' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$payment_list = D('payment_list');
    	$user_overdue = D('user_overdue');
    	$user_money_info = D('user_money_info');
    	$array = $user_overdue->find();
    	
    	//搜索
    	if($_POST['content']){
    		$type = I('type');
    		$content = I('content');
    		if($content){
    			if($type == '1'){
    				$where = "haoidcn_payment_list.phone='$content' ";
    				$this->assign('type',$type);
    			}else{
    				$where = "b.name='$content' ";
    				$this->assign('type',$type);
    			}
    			$this->assign('content',$content);
    		}
    		$list = $payment_list->join("haoidcn_user_info as b ON haoidcn_payment_list.phone=b.phone")->where("$where and is_overdue=1 and is_repayment=0")->select();
    		foreach ($list as $key=>$value1){
    			$list[$key]['money'] = $list[$key]['yuqi_time']*$array['interest'];
    			$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
    			$list[$key]['loan_people'] = $money['loan_people'];
    		}
    		$this->assign('list',$list);
    		$this->display();
    		exit;
    	}
    	
    	
    	$list = $payment_list->join("haoidcn_user_info as b ON haoidcn_payment_list.phone=b.phone")->where("is_overdue=1 and is_repayment=0")->select();
    	
    	foreach ($list as $key=>$value1){
    		$list[$key]['money'] = $list[$key]['yuqi_time']*$array['interest'];
    		$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
    		$list[$key]['loan_people'] = $money['loan_people'];
    	}
    	$this->assign("list",$list);
    	$this->display();
    }
    public function is_loan(){
    	$phone = I('phone');
    	$payment_list = D('payment_list');
    	$time1 = date("Y-m-d H:i:s",time());
    	$list = $payment_list->where("phone='$phone'")->find();
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	if($list['huankuan_type'] == '1'){
    		$res = $user_money_info->where("id='{$time['id']}'")->find();
    		$user_money_info->where("id='{$time['id']}'")->setField('is_renewal',0);
    		$complete_renewal = $res['is_renewal'];
    		$user_money_info->where("id='{$time['id']}'")->setInc('complete_renewal',$complete_renewal);
    		$shoukuan = $payment_list->field("max(id) as id")->where("phone='$phone'")->find();
    		$payment_list->where("id='{$shoukuan['id']}'")->setField("actual_time",$time1);
    		$payment_list->where("id='{$shoukuan['id']}'")->setField("is_repayment",1);
    		$payment_list->where("id='{$shoukuan['id']}'")->setField("wait_xuqi",'4');
    		$user_money_info->where("id='{$time['id']}'")->setField("repayment_state",1);;
    		$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"{$list['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您的还款我们已经收到"			         
    				 }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    	}else{
    		$info = array(
    			'time_length'=>$list['renewal_time'],
    			'sum'=>$list['renewal_money'],
    			'state'=>'0',
    			'is_adopt'=>'0'
    		);
    		$user_money_info->where("id='{$time['id']}'")->save($info);
    		$shoukuan = $payment_list->field("max(id) as id")->where("phone='$phone'")->find();
    		$payment_list->where("id='{$shoukuan['id']}'")->setField('wait_xuqi','2');
    		$user_money_info->where("id='{$time['id']}'")->setInc('is_renewal',1);
    		$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"{$list['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户您的续期服务费用，我们已收到",
			    		 "url":"http://www.leeyears.com/index.php/Weixin/xuqi?id={$time['id']}"
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    	}
    	$data = "确定放款";
    	$this->ajaxReturn($data);
    }
    
    //未收到还款
    public function no_loan(){
    	$phone = I('phone');
    	$payment_list = D('payment_list');
    	$list = $payment_list->where("phone='$phone'")->find();
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','1');
    	$shoukuan = $payment_list->field("max(id) as id")->where("phone='$phone'")->find();
    	$payment_list->where("id='{$shoukuan['id']}'")->setField('wait_xuqi','');
    	$payment_list->where("id='{$shoukuan['id']}'")->setField('trade_mode','');
    	$payment_list->where("id='{$shoukuan['id']}'")->setField('huankuan_type','');
    	if($list['huankuan_type'] == '1'){
    		$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"{$list['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您的还款日已到，您的还款费用我们没有收到，请您尽快还款"
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    	}else{
    		$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"{$list['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户您的续期服务费用，我们没有收到"
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    	}
    }
    
    //借款合同
    public function contract(){
    	$phone = I('phone');
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$money_info = $user_money_info->where("id='{$time['id']}'")->find();
    	$admin_data = D('admin_data');
    	$chujie = $admin_data->find();
    	$agreement = D('agreement');
    	$payment_list = D('payment_list');
    	$list = $payment_list->where("phone='$phone'")->find();
    	$info = D('user_info');
    	$geren = $info->where("phone='$phone'")->find();
    	$id = $geren['uid'];
    	$this->assign('id',$id);
    	$user_name = $geren['name'];
    	$this->assign('user_name',$user_name);
    	$bank_info = D('bank_info');
    	$bank = $bank_info->where("phone='$phone'")->find();
    	$num = $bank['bank_num'];
    	$this->assign('chujie',$chujie);
    	$this->assign('bank',$num);
    	$this->assign('phone',$phone);
    	$this->assign('riqi',$list);
    	$this->assign('money_info',$money_info);
    	$this->display();
    }
}