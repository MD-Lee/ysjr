<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller {
	
	public function _initialize() {

		header("Content-type: text/html; charset=utf-8");
		
		Session_start();
		$userid = strtolower(I("session.userid"));
		$pass = I("session.pass");
		 
		//是否已登录
		if(empty($userid) && empty($pass)){
			 
			$this->redirect('Index/index');
			exit;
			 
		}
		 
		
		$User = D("User");
		$user_arr = $User->where("userid='$userid'")->find();

		//权限
		$limits = $user_arr['limits'];
		$this->assign("limits",$limits);
		
		$id = $user_arr['id'];
		
		$province = $user_arr['province'];
		$city = $user_arr['city'];
		
		
		//自动分配任务
		$user = D('user');  //后台管理用户表
		$user_money_info = D('user_money_info');//用户借款详情表
		$bank_info = D('bank_info');//用户银行卡信息表
		$user_work = D('user_work');
		$result2 = $user->field('id')->where("limits=2")->select();//获取审核人员的id
		$i=0;
		$result = $user_money_info->query("select * from haoidcn_user_money_info as a left join haoidcn_user_work as b ON a.phone=b.phone where is_adopt=0"); //获取借款任务数据
		foreach ($result as $value){
			$daili = $user->where("limits=3 and city='{$value['city']}'")->find(); //获取代理人信息
			if($daili){
				$user_money_info->where("is_adopt = 0 and phone='{$value['phone']}'")->setField('loan_people',$daili['userid'].'(代)');
				continue;
			}
			$uid=$result2[$i%count($result2)]['id']; 
			$info = $user->where("id='$uid'")->find();
			$user_money_info->where("is_adopt = 0  and phone='{$value['phone']}'")->setField('loan_people',$info['userid'].'(审)');
			$i++;
		}
		//学生身份的分配
		$j = 0;
		$xuesheng = D('xuesheng');
		$res = $xuesheng->join("haoidcn_user_money_info as a ON haoidcn_xuesheng.phone=a.phone")->where("a.is_adopt=0")->select();
		foreach ($res as $xue){
			$daili = $user->where("limits=3 and city='{$xue['city']}'")->find(); //获取代理人信息
			if($daili){
				$user_money_info->where("is_adopt = 0 and phone='{$xue['phone']}'")->setField('loan_people',$daili['userid'].'(代)');
				continue;
			}
			$uid=$result2[$j%count($result2)]['id'];
			$info = $user->where("id='$uid'")->find();
			$user_money_info->where("is_adopt = 0  and phone='{$xue['phone']}'")->setField('loan_people',$info['userid'].'(审)');
			$j++;
		}

		//逾期的用户
		$payment_list = D('payment_list');
		$result = $payment_list->select();
		foreach ($result as $key=>$value){
			$Date_1=$result[$key]['appoint_time'];
			$Date_2=date('Y-m-d',time());
			$Date_List_a1=explode("-",$Date_1);
			$Date_List_a2=explode("-",$Date_2);
			$d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
			$d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
			$Days=round(($d1-$d2)/3600/24);
			if($Days < 0){
				$info = array(
						'is_overdue'=>'1',
						'yuqi_time'=>str_replace("-", "", $Days)
				);
				$payment_list->where("id='{$result[$key]['id']}'")->save($info);
			}
		}
		
		if($limits == '1'){
			$bank_info = D('bank_info');
			$bank = $bank_info->where("is_payment=0")->count();
			$user_money_info = D('user_money_info');
			$data = $user_money_info->join("haoidcn_user_mobile ON haoidcn_user_money_info.phone=haoidcn_user_mobile.phone")->join("haoidcn_weixin_img ON haoidcn_user_money_info.openid=haoidcn_weixin_img.openid")->limit($Page->firstRow. ',' . $Page->listRows)->where("haoidcn_user_money_info.is_adopt=0 and haoidcn_user_money_info.is_adopt!=-1 and haoidcn_user_money_info.is_adopt!=3")->order('apply_time desc')->count();
			$fangkuang = $user_money_info->join("haoidcn_bank_info as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_service as b ON haoidcn_user_money_info.phone=b.phone")->where("state=1 and is_payment=1 and is_loan=0  and is_adopt=1 and a.condition=0 and repayment_state=0")->count();
			$shoukuan = $payment_list->where("is_repayment=0")->count();
		}else if($limits == "2"){
			$bank_info = D('bank_info');
			$bank = $bank_info->join("haoidcn_user_money_info as a ON haoidcn_bank_info.phone=a.phone")->where("is_payment=0 and loan_people like '$userid%'")->count();
			$user_money_info = D('user_money_info');
			$data = $user_money_info->where("state='0' and is_adopt='0' and loan_people like '$userid%'")->count();
		}else if($limits == "3"){
			$bank_info = D('bank_info');
			$bank = $bank_info->join("haoidcn_user_work as a ON haoidcn_bank_info.phone=a.phone")->join("haoidcn_user_money_info as b ON haoidcn_bank_info.phone=b.phone")->where("a.city='$city' and b.loan_people like '$userid%' and is_payment=0")->count();
			$user_money_info = D('user_money_info');
			$data = $user_money_info->query("select count(*) from haoidcn_user_money_info as a left join haoidcn_user_work as b ON a.phone=b.phone where is_adopt!=-1 and is_adopt=0 and is_adopt!=3 and b.city='$city'");
			$data = $data[0]['count(*)'];
			$fangkuang = $user_money_info->join("haoidcn_bank_info as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_service as b ON haoidcn_user_money_info.phone=b.phone")->where("state=1 and is_adopt=1 and is_payment=1 and is_loan=0  and a.condition=0 and repayment_state=0")->count();
		}
		$state_num = $bank+$data+$fangkuang;
		$this->assign('state_num',$state_num);
		$this->assign('bank_list',$bank);
		$this->assign('shuju',$data);
		$this->assign('fangkuang',$fangkuang);
		$this->assign('shoukaun',$shoukuan);
	}
	
	
	
}