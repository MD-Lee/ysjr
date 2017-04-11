<?php
namespace Admin\Controller;
use Think\Controller;
class ContractController extends CommonController{
	public function contract_list(){
		$payment_list = D('payment_list');
		$user_money_info = D('user_money_info');
		$list = $payment_list->join("haoidcn_user_info as b ON haoidcn_payment_list.phone=b.phone")->select();
		foreach ($list as $key=>$value){
			$money = $user_money_info->where("phone='{$list[$key]['phone']}'")->find();
			$list[$key]['loan_people'] = $money['loan_people'];
		}
		$this->assign('list',$list);
		$data = array(
				'bb' => "active",
				'sh_block8' => " style='display:block';",
				'sh_two32' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
}