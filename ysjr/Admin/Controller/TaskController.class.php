<?php
namespace Admin\Controller;

use Think\Controller;

class TaskController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->assign("data",array('task' => " style='display:block';"));
	}

    public function index(){
		$Task = D("card_task");		
		
		$count  = $Task->count("id");    //计算总数		
		
    	$Page   = new \Think\Page($count,10);
		$Page->setConfig('prev', "上一页");
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('first', '首页');
    	$Page->setConfig('last', '尾页');
    	$show 	= $Page->show();
    	$this->assign("page",$show);
    	
    	$list = $Task->order("id desc")->limit($Page->firstRow. ',' . $Page->listRows)->select();
    	$this->assign("list",$list);
		
		$this->display();
    }
	public function add(){
		//添加
		if($_POST){
			$bus_type_name = D("card_bus_type")->where('id='.I("bus_type_id"))->limit(1)->find();
			
			$data = array(
					'title'			=>	I("title"),
					'date'			=>	I("date"),
					't_start'		=>	I("t_start"),
					't_end'			=>	I("t_end"),
					'c_start'		=>	I("c_start"),
					'c_end'			=>	I("c_end"),
					'bus_type_id'	=>	I("bus_type_id"),
					'bus_type_name'	=>	$bus_type_name['name']
			);

			$se = D("card_task")->add($data);
		
			$this->success('新增成功，即将返回列表页面', U('Task/index'));
			exit;
		}
		
		
		$this->assign("bus_type",D("card_bus_type")->select());
		$this->display();
	}
	public function edit($id){
		$Task = D("card_task");
		
		
		//修改
		if($_POST){
			$bus_type_name = D("card_bus_type")->where('id='.I("bus_type_id"))->limit(1)->find();
			
			$data = array(
					'title'			=>	I("title"),
					'date'			=>	I("date"),
					't_start'		=>	I("t_start"),
					't_end'			=>	I("t_end"),
					'c_start'		=>	I("c_start"),
					'c_end'			=>	I("c_end"),
					'bus_type_id'	=>	I("bus_type_id"),
					'bus_type_name'	=>	$bus_type_name['name']
			);

			$se = $Task->where('id='.(int)$id)->save($data);
			$this->success('修改成功，即将返回列表页面', U('Task/index'));
			exit;
		}
		
		$this->assign("bus_type",D("card_bus_type")->select());
		
		
		$rs = $Task->where('id='.(int)$id)->find();
		$this->assign("rs",$rs);
		
		$this->display();
    }
    //审核用户管理界面
    public function loan_task(){
		
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$loan_money = D('loan_money');
    	$loan = $loan_money->select();
    	$name = $user->select();
    	$info = $user->where("userid='$userid'")->find();
    	$user_money_info = D('user_money_info');
    	$is_renewal = $user_money_info->select();
    	if($info['limits'] == '1'){
    		$count = $user_money_info->where("is_adopt=0")->count();
    		//$count = $user_money_info->count();
    		$Page = new \Think\Page($count,10);
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();
    		$this->assign('page',$show);
    		//$list = $user_money_info->join("haoidcn_user_mobile ON haoidcn_user_money_info.phone=haoidcn_user_mobile.phone")->join("haoidcn_weixin_img ON haoidcn_user_money_info.openid=haoidcn_weixin_img.openid")->join("haoidcn_user_info as a ON haoidcn_user_money_info.phone=a.phone")->limit($Page->firstRow. ',' . $Page->listRows)->where("haoidcn_user_money_info.is_adopt=0")->order('is_renewal desc,apply_time')->select();
    		$list = $user_money_info->join("haoidcn_user_info as a ON haoidcn_user_money_info.openid=a.openid",'LEFT')
					->field('haoidcn_user_money_info.*,a.name,a.time')
					->limit($Page->firstRow. ',' . $Page->listRows)
					->where("haoidcn_user_money_info.is_adopt=0") 
					->order('is_renewal desc,apply_time')
					->select();
			 //echo D('user_money_info')->getLastSql();
			 
			$this->assign('list',$list);
    	}else if($info['limits'] == '2'){
    		$count = $user_money_info->count();
    		$Page = new \Think\Page($count,10);
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();
    		$this->assign('page',$show);
    		$list = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->limit($Page->firstRow. ',' . $Page->listRows)->where("loan_people like '$userid%'")->order("apply_time desc")->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_money_info->join("haoidcn_user_work as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_user_mobile as c ON haoidcn_user_money_info.phone=c.phone")->where("province='$province' and city='$city' and loan_people like '$userid%'")->order("apply_time desc")->select();
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_two' => "active",
    			'sh_block1' => " style='display:block';",
    			'sh_two06' => " class='active'"
    	);
    	$this->assign('name',$name);
    	$this->assign('loan',$loan);
    	$this->assign('is_renewal',$is_renewal);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    //搜索审核用户任务的信息
    public function search_loan_task(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$apply_time1 = I('apply_time1');
    	$apply_time2 = I('apply_time2');
    	$type = I('type');
    	$content = I('content');
    	$money_num = I('money_num');
    	$time_length = I('time_length');
    	$is_renewal = I('is_renewal');
    	$state = I('state');
    	$loan_people = I('loan_people');
    	$user_money_info = D('user_money_info');
    	$bank_info = D('bank_info');
    	$payment_list = D('payment_list');
    	if($result['limits'] == '1'){
    		$where = "haoidcn_user_money_info.phone=a.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "loan_people like '$userid%' ";
    	}else if($result['limits'] == '3'){
    		$where = "city='{$result['city']}' ";
    	}
    	if($content){
    		if($type == '1'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_service as c ON haoidcn_user_money_info.phone=c.phone")->where("haoidcn_user_money_info.phone like '%$content%'")->select();
    			foreach ($info as $key=>$value){
    				if($info[$key]['is_adopt'] == '0'){
    					$info[$key]['is_adopt'] = '申请中';
    				}else if($info[$key]['is_adopt'] == '1'){
    					$phone = $bank_info->where("phone='{$info[$key]['phone']}'")->find();
    					if($phone['is_payment'] == '1'){
    						$payment = $payment_list->where("phone='{$info[$key]['phone']}'")->find();
    						if($payment['is_repayment'] == '0'){
    							if($payment['is_overdue'] == '0'){
    								if($payment['wait_xuqi'] == '1'){
    									$info[$key]['is_adopt'] = '续期申请中';
    								}else if($payment['wait_xuqi'] == '3'){
    									$info[$key]['is_adopt'] = '还款中';
    								}else{
    									$info[$key]['is_adopt'] = '未还款';
    								}
    							}else{
    								$info[$key]['is_adopt'] = '逾期';
    							}
    						}else if($payment['is_repayment'] == '1'){
    							if($info[$key]['repayment_state'] == '1'){
    								$info[$key]['is_adopt'] = '已还款';
    							}else if($info[$key]['is_loan'] == '1'){
    								$info[$key]['is_adopt'] = '已放款';
    							}else{
    								$info[$key]['is_adopt'] = '等待放款';
    							}
    						}else{
    							$info[$key]['is_adopt'] = '银行卡通过';
    						}
    					}else if($phone['is_payment'] == '2'){
    						$info[$key]['is_adopt'] = '银行卡未通过';
    					}else{
    						$info[$key]['is_adopt'] = '初审通过';
    					}
    				}else if($info[$key]['is_adopt'] == '2'){
    					$info[$key]['is_adopt'] = '未通过';
    				}else if($info[$key]['is_adopt'] == '3'){
    					$info[$key]['is_adopt'] = '取消申请';
    				}
    			}
    			//var_dump($info);
    			$this->ajaxReturn($info);
    			exit;
    		}else{
    			$info = $user_money_info->join("haoidcn_user_mobile ON haoidcn_user_money_info.phone=haoidcn_user_mobile.phone")->join("haoidcn_user_info as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_service as c ON haoidcn_user_money_info.phone=c.phone")->where("a.name like '%$content%'")->select();
    			foreach ($info as $key=>$value){
    				if($info[$key]['is_adopt'] == '0'){
    					$info[$key]['is_adopt'] = '申请中';
    				}else if($info[$key]['is_adopt'] == '1'){
    					$phone = $bank_info->where("phone='{$info[$key]['phone']}'")->find();
    					if($phone['is_payment'] == '1'){
    						$payment = $payment_list->where("phone='{$info[$key]['phone']}'")->find();
    						if($payment['is_repayment'] == '0'){
    							if($payment['is_overdue'] == '0'){
    							if($payment['wait_xuqi'] == '1'){
    									$info[$key]['is_adopt'] = '续期申请中';
    								}else if($payment['wait_xuqi'] == '3'){
    									$info[$key]['is_adopt'] = '还款中';
    								}else{
    									$info[$key]['is_adopt'] = '未还款';
    								}
    							}else{
    								$info[$key]['is_adopt'] = '逾期';
    							}
    						}else if($payment['is_repayment'] == '1'){
    							if($info[$key]['repayment_state'] == '1'){
    								$info[$key]['is_adopt'] = '已还款';
    							}else if($info[$key]['is_loan'] == '1'){
    								$info[$key]['is_adopt'] = '已放款';
    							}else{
    								$info[$key]['is_adopt'] = '等待放款';
    							}
    						}else{
    							$info[$key]['is_adopt'] = '银行卡通过';
    						}
    					}else if($phone['is_payment'] == '2'){
    						$info[$key]['is_adopt'] = '银行卡未通过';
    					}else{
    						$info[$key]['is_adopt'] = '初审通过';
    					}
    				}else if($info[$key]['is_adopt'] == '2'){
    					$info[$key]['is_adopt'] = '未通过';
    				}else if($info[$key]['is_adopt'] == '3'){
    					$info[$key]['is_adopt'] = '取消申请';
    				}
    			}
    			$this->ajaxReturn($info);
    			exit;
    		}
    	}
    	if($money_num){
    		$where .= "and money_num='$money_num' ";
    	}
    	if($time_length){
    		$where .= "and time_length='$time_length' ";
    	}
    	if($is_renewal){
    		$where .= "and is_renewal='$is_renewal' ";
    	}
    	//搜索状态
    	if($state){
    		
    		if($state == '0'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->where("is_adopt=0")->select();
    		}else if($state == '1'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->where("is_adopt=1")->select();
    		}else if($state == '2'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->where("is_adopt=2")->select();
    		}else if($state == '3'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_bank_info as c ON haoidcn_user_money_info.phone=c.phone")->where("is_payment=1")->select();
    		}else if($state == '4'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_bank_info as c ON haoidcn_user_money_info.phone=c.phone")->where("is_payment=2")->select();
    		}else if($state == '5'){
    			$info = $user_money_info->query("select a.phone,apply_time,money_num,time_length,state,b.is_payment,d.is_Loan,loan_people,is_adopt,daozhang,bank_num,account_opening,name,b.condition from haoidcn_user_money_info as a left join haoidcn_bank_info as b ON a.openid = b.openid left join haoidcn_weixin_img as c ON a.openid=c.openid left join haoidcn_service as d ON a.openid=d.openid where is_loan=0 and state=1 and is_payment=1 and b.condition=0 order by apply_time desc");
    		}else if($state == '6'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_payment_list as c ON haoidcn_user_money_info.phone=c.phone")->select();
    		}else if($state == '7'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_payment_list as c ON haoidcn_user_money_info.phone=c.phone")->join("haoidcn_service as d ON haoidcn_user_money_info.phone=d.phone")->where("is_repayment=1")->select();
    		}else if($state == '8'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_payment_list as c ON haoidcn_user_money_info.phone=c.phone")->where("is_repayment=0 and is_overdue=0")->select();
    		}else if($state == '9'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_payment_list as c ON haoidcn_user_money_info.phone=c.phone")->where("is_overdue=1 and is_repayment=0")->select();
    		}else if($state == '10'){
    			$info = $user_money_info->join("haoidcn_user_mobile as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_payment_list as c ON haoidcn_user_money_info.phone=c.phone")->where("wait_xuqi=3 and is_repayment=0")->select();
    		}
    		foreach ($info as $key=>$value){
    			if($info[$key]['is_adopt'] == '0'){
    				$info[$key]['is_adopt'] = '申请中';
    			}else if($info[$key]['is_adopt'] == '1'){
    				$phone = $bank_info->where("phone='{$info[$key]['phone']}'")->find();
    				if($phone['is_payment'] == '1'){
    					$payment = $payment_list->where("phone='{$info[$key]['phone']}'")->find();
    					if($payment['is_repayment'] == '0'){
    						if($payment['is_overdue'] == '0'){
    							if($payment['wait_xuqi'] == '1'){
    								$info[$key]['is_adopt'] = '续期申请中';
    							}else if($payment['wait_xuqi'] == '3'){
    								$info[$key]['is_adopt'] = '还款中';
    							}else{
    								$info[$key]['is_adopt'] = '未还款';
    							}
    						}else{
    							$info[$key]['is_adopt'] = '逾期';
    						}
    					}else if($payment['is_repayment'] == '1'){
    						if($info[$key]['repayment_state'] == '1'){
    							$info[$key]['is_adopt'] = '已还款';
    						}else if($info[$key]['is_loan'] == '1'){
    							$info[$key]['is_adopt'] = '已放款';
    						}else{
    							$info[$key]['is_adopt'] = '等待放款';
    						}
    					}else{
    						$info[$key]['is_adopt'] = '银行卡通过';
    					}
    				}else if($phone['is_payment'] == '2'){
    					$info[$key]['is_adopt'] = '银行卡未通过';
    				}else{
    					$info[$key]['is_adopt'] = '初审通过';
    				}
    			}else if($info[$key]['is_adopt'] == '2'){
    				$info[$key]['is_adopt'] = '未通过';
    			}else if($info[$key]['is_adopt'] == '3'){
    				$info[$key]['is_adopt'] = '取消申请';
    			}
    		}
    		$this->ajaxReturn($info);
    		exit;
    	}
    	if($loan_people){
    		$where .= "and loan_people like '$loan_people%' ";
    	}
    	if($apply_time1 and $apply_time2){
    		$where .= "and apply_time>'$apply_time1' and apply_time < '$apply_time2'";
    	}
    	
    	$info = $user_money_info->join("haoidcn_user_mobile ON haoidcn_user_money_info.phone=haoidcn_user_mobile.phone")->join("haoidcn_user_info as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_work as b ON haoidcn_user_money_info.phone=b.phone")->join("haoidcn_service as c ON haoidcn_user_money_info.phone=c.phone")->where("$where")->select();
    	foreach ($info as $key=>$value){
    		if($info[$key]['is_adopt'] == '0'){
    			$info[$key]['is_adopt'] = '申请中';
    		}else if($info[$key]['is_adopt'] == '1'){
    			$phone = $bank_info->where("phone='{$info[$key]['phone']}'")->find();
    			if($phone['is_payment'] == '1'){
    				$payment = $payment_list->where("phone='{$info[$key]['phone']}'")->find();
    				if($payment['is_repayment'] == '0'){
    					if($payment['is_overdue'] == '0'){
    						if($payment['wait_xuqi'] == '1'){
    							$info[$key]['is_adopt'] = '续期申请中';
    						}else if($payment['wait_xuqi'] == '3'){
    							$info[$key]['is_adopt'] = '还款中';
    						}else{
    							$info[$key]['is_adopt'] = '未还款';
    						}
    					}else{
    						$info[$key]['is_adopt'] = '逾期';
    					}
    				}else if($payment['is_repayment'] == '1'){
    					if($info[$key]['repayment_state'] == '1'){
    						$info[$key]['is_adopt'] = '已还款';
    					}else if($info[$key]['is_loan'] == '1'){
    						$info[$key]['is_adopt'] = '已放款';
    					}else{
    						$info[$key]['is_adopt'] = '等待放款';
    					}
    				}else{
    					$info[$key]['is_adopt'] = '银行卡通过';
    				}
    			}else if($phone['is_payment'] == '2'){
    				$info[$key]['is_adopt'] = '银行卡未通过';
    			}else{
    				$info[$key]['is_adopt'] = '初审通过';
    			}
    		}else if($info[$key]['is_adopt'] == '2'){
    			$info[$key]['is_adopt'] = '未通过';
    		}else if($info[$key]['is_adopt'] == '3'){
    			$info[$key]['is_adopt'] = '取消申请';
    		}
    	}
    	$this->ajaxReturn($info);
    }
    
    
    //个人征信协议
    public function xieyi(){
    	$phone = I('phone');
    	$user_info = D('user_info');
    	$info = $user_info->where("phone='$phone'")->find();
    	$this->assign('name',$info['name']);
    	$this->assign('uid',$info['uid']);
    	$this->assign('time',$info['time']);
    	$this->display();
    }
	
	//借款合同界面
	public  function jiekuan(){
		$id = I('id');
		$user_money_info = D('user_money_info');
		
		$money_info = $user_money_info->where("id='$id'")->find();
		$phone=$money_info['phone'];
		$number = strtotime($money_info['apply_time']);
		
		$admin_data = D('admin_data');
		$chujie = $admin_data->find();
		if(strlen($chujie['name']) == 9){
			$name = substr_replace($chujie['name'],"**",3);
		}else if(strlen($chujie['name']) == 6){
			$name = substr_replace($chujie['name'],"*",3);
		}
		$this->assign('chujie',$chujie);
		$this->assign('name',$name);
		$uid = $chujie['uid'];
		if(strlen($uid) == 15){
			$uid = substr_replace($uid,"**********",2,10);
			$this->assign('uid',$uid);
		}else if(strlen($uid) == 18){
			$uid = substr_replace($uid,"************",2,12);
			$this->assign('uid',$uid);
		}
		$agreement = D('agreement');
		$payment_list = D('payment_list');
		
		$list = $payment_list->where("phone='$phone'")->find();
		$info = D('user_info');
		$geren = $info->where("phone='$phone'")->find();
		
		if(strlen($geren['uid']) == 15){
			$id = substr_replace($geren['uid'],"**********",2,10);
			$this->assign('id',$id);
		}else if(strlen($geren['uid']) == 18){
			$id = substr_replace($geren['uid'],"************",2,12);
			$this->assign('id',$id);
		}
		if(strlen($geren['name']) == 9){
			$user_name = substr_replace($geren['name'],"**",3);
		}else if(strlen($geren['name']) == 6){
			$user_name = substr_replace($geren['name'],"*",3);
		}
		$this->assign('user_name',$user_name);
		$bank_info = D('bank_info');
		
		$bank = $bank_info->where("phone='$phone'")->find();
		
		$num = substr_replace($bank['bank_num'],"**************",2,12);
		$this->assign('bank',$num);
		$this->assign('phone',$phone);
		$this->assign('riqi',$list);
		$this->assign('number',$number);
		$this->assign('money_info',$money_info);
		$this->display();
	}
    //服务合同页面
	public  function fuwuxy(){
		$id = I('id');
		$money_info = D('user_money_info')->where("id='$id'")->find();
		$map['openid'] = $money_info['openid'];
		$number = strtotime($money_info['apply_time']);
		$where['user_money_info'] = $id;
		$letter = cny($money_info['letter']);
		$account_money = cny($money_info['account_money']);
		$interest = cny($money_info['interest']);
		$geren = D('user_info')->where($map)->find();
		$this->assign('user_name',$geren['name']);
		$this->assign('riqi',$money_info['apply_time']);
		$this->assign('id',$geren['uid']);
		$this->assign('number',$number);
		$this->assign('letter',$letter);
		$this->assign('account_money',$account_money);
		$this->assign('interest',$interest);
		$this->display();
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
   /*  public function access_token(){
    	$appid = "appid";
    	$secret = "appsecret";
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
    	$output = $this->https_request($url);
    	$array = json_decode($output,true);
    	$access_token = $array['access_token'];
    	return  $access_token;
    } */
    //审核把状态改成通过的方法
    public function adopt_ok(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$dengji = $user->where("userid='$userid'")->find();
    	if($dengji['limits'] == '1'){
    		$loan_people = $userid;
    	}else if($dengji['limits'] == '2'){
    		$loan_people = $userid.'(审)';
    	}else if($dengji['limits'] == '3'){
    		$loan_people = $userid.'(代)';
    	}
    	$id = I('id');
		//$content = I('content');
		//$money_num = I('money_num');
    	//$level = I('level');
		
		$user_money_info=D('user_money_info')->where("id='$id'")->find();
		$openid=$user_money_info['openid'];
    	D('service')->where("openid='$openid'")->setField('level',$level);
		
    	$time_length = I('time_length');
    	//$date =D('loan_money')->where("money_num='$money_num' and time_length='$time_length'")->find();
		
    	$info = array(
    			'state'=>'1',
    			'is_adopt'=>'1',
    			/* 'money_num'=>$money_num,
    			'time_length'=>$time_length,
    			'letter'=>$date['letter'],
    			'interest'=>$date['interest'],
    			'account_money'=>$date['account_money'],
    			'sum'=>$content,
    			'daozhang'=>$date['sum'], */
    			'loan_people'=>$loan_people
    	);
    	
    	$result = D('user_money_info')->where("id='$id'")->save($info);
		
    	if($result){
    		$access_token = access_token();
			$http_url="http://".$_SERVER['HTTP_HOST'];	
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"恭喜您，初审通过!",
			             "description":"
申请额度：{$user_money_info['money_num']}元
实际到账金额：{$user_money_info['daozhang']}元
您的申请已通过初审,请等待打款",
						 "url":"$http_url/index.php/Weixin/choice_money",
			    		 
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    		$data = '审核完毕';
    		$this->ajaxReturn($data);
    	}
    }
  
    public function no_adopt(){
    	$phone = I('phone');
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$list = $user_money_info->where("id='{$time['id']}'")->find();
    	$this->assign('phone',$phone);
    	$this->assign('list',$list);
    	$this->display();
    }
    //审核不通过的方法
    public function on_adopt(){
    	$loan_people = strtolower(I("session.userid"));
    	$phone = I('phone');
    	$content = I('content');
    	$user_money_info = D('user_money_info');
    	$info = array(
    			'state'=>'1',
    			'is_adopt'=>'2',
    			'content'=>$content,
    			'loan_people'=>$loan_people
    	);
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$result = $user_money_info->where("id='{$time['id']}'")->save($info);
    	if($result){
    		$res = $user_money_info->where("phone=$phone")->order("id desc")->select();
    		$openid = $res[0]['openid'];
    			$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"很抱歉，您的申请未通过",
			             "description":"根据您提交的资料，我们系统未能通过您的借款申请，没能帮到您，实在很抱歉
拒接原因：$content
申请信息如下：
申请日期：{$res[0]['apply_time']}
借款状态：已拒绝
借款金额：{$res[0]['money_num']}
若有任何疑问请直接微信留言，感谢您的参与与支持",
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    		$data = '审核完毕';
    		$this->ajaxReturn($data);
    	}
    }
    
    //不同意续期
    public function no_xuqi(){
    	$loan_people = strtolower(I("session.userid"));
    	$phone = I('phone');
    	$content = I('content');
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$info = array(
    			'state'=>'1',
    			'is_adopt'=>'1',
    			'content'=>$content,
    			'loan_people'=>$loan_people
    	);
    	$result = $user_money_info->where("id='{$time['id']}'")->save($info);
    	if($result){
    		$res = $user_money_info->where("id='{$time['id']}'")->find();
    		$openid = $res['openid'];
    			$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"很抱歉，您的续期未通过",
			             "description":"我们系统未能通过您的续期请求
拒接原因：$content
申请信息如下：
申请日期：{$res['apply_time']}
借款状态：已拒绝
若有任何疑问请直接微信留言，感谢您的参与与支持",
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    		$data = '审核完毕';
    		$this->ajaxReturn($data);
    	}
    }
    
    //放款列表
    public function examine_list(){
    	$user_money_info = D('user_money_info');
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	$payment_list = D('payment_list');
    	
    	//搜索
    	if($_POST['content']){
    		$type = I('type');
    		$content = I('content');
    		if($content){
    			if($type == '1'){
    				$max = $user_money_info->field("max(id) as id")->where("phone='$content'")->find();
    				$res = $payment_list->join("haoidcn_user_money_info as a ON haoidcn_payment_list.phone=a.phone")->join("haoidcn_bank_info as b ON haoidcn_payment_list.phone=b.phone")->where("haoidcn_payment_list.phone='$content' and is_repayment=0 or is_repayment=1 and repayment_state=1 and a.id='{$max['id']}'")->order("haoidcn_payment_list.id desc")->select();
    				if(empty($res[0])){
    					$time = $user_money_info->field("max(id) as id")->where("phone='$content'")->find();
    					$where = "haoidcn_user_money_info.id='{$time['id']}'";
    				}
    				$this->assign('type',$type);
    			}else{
    				$res = $payment_list->join("haoidcn_user_money_info as a ON haoidcn_payment_list.phone=a.phone")->join("haoidcn_bank_info as b ON haoidcn_payment_list.phone=b.phone")->where("name='$content' and is_repayment=0 ")->order("haoidcn_payment_list.id desc")->select();
    				if(empty($res[0])){
    					$time = $user_money_info->field("max(id) as id")->join("haoidcn_bank_info as b ON haoidcn_user_money_info.phone=b.phone")->where("name='$content'")->find();
    					$where = "haoidcn_user_money_info.id='{$time['id']}' ";
    				}
    				$this->assign('type',$type);
    			}
    			$this->assign('content',$content);
    		}
    		if(!empty($where)){
    			$list = $user_money_info->join("haoidcn_service as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_bank_info as b ON haoidcn_user_money_info.phone=b.phone")->where("$where ")->select();
    		}
    		$this->assign('list',$list);
    		$this->display();
    		exit;
    	}
    	
    	if($info['limits'] == '1'){
    		$service = D('service');
    		$count = $user_money_info
					->join("haoidcn_bank_info as a ON haoidcn_user_money_info.openid=a.openid")
					->join("haoidcn_service as b ON haoidcn_user_money_info.openid=b.openid")
					->where('is_adopt=1 and is_success=0 and is_payment=1 and repayment_state=0')
					->count();
    		
			$Page = new \Think\Page($count,10);
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();
    		$list = $user_money_info->query(
			"select a.phone,a.id,apply_time,money_num,time_length,state,b.is_payment,d.is_Loan,loan_people,is_adopt,daozhang,bank_num,account_opening,name,b.condition 
			from haoidcn_user_money_info as a 
			left join haoidcn_bank_info as b ON a.openid = b.openid 
			left join haoidcn_weixin_img as c ON a.openid=c.openid 
			left join haoidcn_service as d ON a.openid=d.openid 
			where  is_success=0 and state=1 and is_adopt=1  and b.condition=0 and repayment_state=0 order by apply_time desc");
    		//echo $user_money_info->getLastSql();
			$this->assign('page',$show);
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_money_info->query("select a.phone,a.id,apply_time,money_num,time_length,state,b.is_payment,d.is_Loan,loan_people,daozhang,bank_num,account_opening,b.name,b.condition from haoidcn_user_money_info as a left join haoidcn_bank_info as b ON a.openid = b.openid left join haoidcn_weixin_img as c ON a.openid=c.openid left join haoidcn_service as d ON a.openid=d.openid left join haoidcn_user_work as e ON a.openid=e.openid where  is_success=0 and  is_adopt=1 and state=1 and is_payment=1 and b.condition=0 and repayment_state=0 and e.province='$province' and e.city='$city' and a.loan_people like '$userid%' order by apply_time desc");
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_two' => "active",
    			'sh_block1' => " style='display:block';",
    			'sh_two09' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    
    //放款
    public function loan_success(){
    	$id = I('id');
		$user_money_info = D('user_money_info');
		
    	$loan_info = $user_money_info->where("id='$id'")->find();
		
		$openid = $loan_info['openid'];
		$phone = $loan_info['phone'];
		
    	$service = D('service');
    	$service->where("openid='$openid'")->setField('is_Loan','1');
		
    	$user_money_info->where("id='$id'")->setField('is_success','1');
		
    	
    	$bank_info = D('bank_info');
    	$bank = $bank_info->where("phone='$phone'")->select();
    	if(empty($bank)){
    		$data = "放款失败";
    		$this->ajaxReturn($data);
    	}
    	$time = date('Y-m-d H:i:s',time());
    	$info = array(
				'user_money_info'=>$id,
    			'openid'=>$openid,
    			'phone'=>$phone,
    			'bank_num'=>$bank[0]['bank_num'],
    			'money_num'=>$loan_info['money_num'],
    			'time_length'=>$loan_info['time_length'],
    			'letter'=>$loan_info['letter'],
    			'account_money'=>$loan_info['account_money'],
    			'interest'=>$loan_info['interest'],
    			'sum'=>$loan_info['sum'],
    			'actual_money'=>$loan_info['daozhang'],
    			'payment_time'=>$time,
    			'appoint_time'=>date('Y-m-d',strtotime("{$time} +{$loan_info['time_length']} day")),
    			'actual_time'=>'',
    			'trade_mode'=>"",
    			'wait_xuqi'=>'',
    			'huankuan_type'=>'',
    	);
    	$payment_list = D('payment_list');
    	$result = $payment_list->add($info);
    	if($result){
    			$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您好
您在{$loan_info['apply_time']}期间申请的借款{$loan_info['money_num']}元已成功汇到您的银行卡！
交易时间：{$time}
交易类型：收款
交易金额：{$info['actual_money']}元
备注：如有疑问，请给及时雨微额速达微信号留言",
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
    		$data = "放款成功";
    		$this->ajaxReturn($data);
    	}
    }
    
    
    public function loan_fail(){
    	$id = I('id');
		
    	$content = I('content');
		
    	$service = D('service');
		
		$user_money_info = M('user_money_info')->where("id='$id'")->find();
		
		$openid = $user_money_info['openid'];
		
    	$service->where("openid='$openid'")->setField("is_Loan",2);
		
    	
		$save_data['is_success'] = 2;
		$save_data['fail_content'] = $content;
		$save_data['is_adopt'] = 2;
    	M('user_money_info')->where("id='$id'")->save($save_data);
		
    	$bank_info = D('bank_info');
		
    	$bank_info->where("openid='$openid'")->setField("condition",1);
    	$access_token = access_token();
    	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    	$text = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您好由于{$content}的原因导致，所以放款失败，请再次确认银行卡信息正确",
			         }
			         ]
			    }
			}
json;
    	$this->https_request($url,$text);
    	$data = "放款失败";
    	$this->ajaxReturn($data);
    }
    
    public function fangkuanshibai(){
    	$id = I('id');
    	$this->assign('id',$id);
    	$this->display();
    }
    
    public function whole_info(){
    	$phone = I('phone');
    	$user_money_info = D('user_money_info');
    	$list = $user_money_info->query("select * from haoidcn_user_money_info as a left join haoidcn_user_info as b ON a.phone=b.phone left join haoidcn_user_work as c ON a.phone=c.phone left join haoidcn_user_gam as d ON a.phone=d.phone left join haoidcn_user_mobile as e ON a.phone=e.phone where a.phone='$phone'");
    	$this->ajaxReturn($list);
    }
    
    public function details(){
    	$id = I('id');
		
		$map['id'] = $id;
		$openid = D("user_money_info")->where($map)->getField('openid');
		$this->assign('id',$id);
		
    	$user = D('service');
    	$xuesheng = D('xuesheng');
    	$user_money_info = D("user_money_info");
    	$list = $user->query("
		select * from haoidcn_service as a 
		left join haoidcn_user_info as b ON a.openid=b.openid 
		left join haoidcn_user_gam as d ON a.openid=d.openid 
		left join haoidcn_user_mobile as e ON a.openid=e.openid
		left join haoidcn_bank_info as f ON a.openid=f.openid 
		left join haoidcn_weixin_img as g ON a.openid=g.openid 
		left join haoidcn_user_money_info as h ON a.openid=h.openid
		left join haoidcn_user_mobile as y ON a.openid=y.openid where a.openid='$openid'");
		
    	$this->assign('list',$list);
    
    	$user_work = D('user_work');
    	$work = $user_work->where("openid='$openid'")->find();
    	$this->assign('work',$work);
    	$payment_list = D('payment_list');
    	$info = $payment_list->where("openid='$openid' and is_repayment=0")->find();
    	$this->assign('info',$info);
    	$xs = $xuesheng->where("openid='$openid'")->find();
    	$res = $user_money_info->where("openid='$openid'")->order("id desc")->select();
		$bank_info = D('bank_info');
    	$bank = $bank_info->where("openid='$openid'")->find();
    	$this->assign('xuesheng',$xs);
    	$this->assign('res',$res);
    	$this->assign('bank',$bank);
    	$this->display();
    }
    public function ok_adopt(){
		$id = I('id');
		$map['id'] = $id;
    	$list = D('user_money_info')->where($map)->find();
    	$this->assign('id',$id);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    public function ok_xuqi(){
    	$userid = strtolower(I("session.userid"));
    	//$phone = I('phone');
    	$id = I('id');
    	$user_money_info = D('user_money_info');
    	//$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$list = $user_money_info->where("id='$id'")->find();
    	$openid = $list['openid'];
    	$user_money_info->where("id='$id'")->setField('is_adopt','1');
    	$payment_list = D('payment_list');
    	$result = $payment_list->where("user_money_info='$id' and is_repayment=0")->find();
    	$info = array(
    			'time_length'=>$list['time_length'],
    			'sum'=>$list['sum'],
    			'appoint_time'=>date('Y-m-d',strtotime("{$result['appoint_time']} +{$list['time_length']} day")),
    	);
    	$payment_list->where("user_money_info='$id'")->save($info);
    	if($userid == 'admin'){
    		$user_money_info->where("id='$id'")->setField('loan_people','admin');
    	}
    	$payment_list = D('payment_list');
    	$res = $payment_list->where("user_money_info='$id'")->select();
    		$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"续期通过",
			             "description":"尊敬的用户，您好
您申请的续期已经成功通过
申请时间：{$list['apply_time']}
到期时间:{$res[0]['appoint_time']}
续期金额：{$list['money_num']}元
备注：如有疑问，请给及时雨微额速达微信号留言",
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
	    	$data = "同意续期";
	    	$this->ajaxReturn($data);
    }
}