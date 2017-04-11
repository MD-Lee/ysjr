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
    		$Page = new \Think\Page($count,10);
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();
    		$this->assign('page',$show);
    		$list = $user_money_info->join("haoidcn_user_mobile ON haoidcn_user_money_info.phone=haoidcn_user_mobile.phone")->join("haoidcn_weixin_img ON haoidcn_user_money_info.openid=haoidcn_weixin_img.openid")->join("haoidcn_user_info as a ON haoidcn_user_money_info.phone=a.phone")->limit($Page->firstRow. ',' . $Page->listRows)->where("haoidcn_user_money_info.is_adopt=0")->order('is_renewal desc,apply_time')->select();
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
    	$appid = "appid";
    	$secret = "appsecret";
    	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
    	$output = $this->https_request($url);
    	$array = json_decode($output,true);
    	$access_token = $array['access_token'];
    	return  $access_token;
    }
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
    	$phone = I('phone');
    	$content = I('content');
    	$level = I('level');
    	$service = D('service');
    	$service->where("phone='$phone'")->setField('level',$level);
    	$user_money_info = D('user_money_info');
    	$shengqing = $user_money_info->where("phone='$phone'")->order("id desc")->select();
    	$loan_money = D('loan_money');
    	$time_length = I('time_length');
    	$date = $loan_money->where("money_num='$content' and time_length='$time_length'")->find();
    	$info = array(
    			'state'=>'1',
    			'is_adopt'=>'1',
    			'money_num'=>$content,
    			'time_length'=>$date['time_length'],
    			'letter'=>$date['letter'],
    			'interest'=>$date['interest'],
    			'account_money'=>$date['account_money'],
    			'sum'=>$content,
    			'daozhang'=>$date['sum'],
    			'loan_people'=>$loan_people
    	);
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$result = $user_money_info->where("id='{$time['id']}'")->save($info);
    	if($result){
    		$res = $user_money_info->where("phone=$phone")->order("id desc")->select();
    		$openid = $res[0]['openid'];
    		$access_token = $this->access_token();
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
申请额度：{$shengqing[0]['money_num']}元
平台审批额度：{$content}元
实际到账金额：{$res[0]['daozhang']}元
您的申请已通过初审，请点击<阅读全文>完成绑定/确认放款银行卡操作，感谢您对e快金的信任与支持",
			    		 "url":"http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone"
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
    		$access_token = $this->access_token();
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
    		$access_token = $this->access_token();
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
    		$count = $user_money_info->join("haoidcn_bank_info as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_service as b ON haoidcn_user_money_info.phone=b.phone")->where('is_adopt=1  and is_payment=1 and repayment_state=0')->count();
    		$Page = new \Think\Page($count,10);
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();
    		$list = $user_money_info->query("select a.phone,apply_time,money_num,time_length,state,b.is_payment,d.is_Loan,loan_people,is_adopt,daozhang,bank_num,account_opening,name,b.condition from haoidcn_user_money_info as a left join haoidcn_bank_info as b ON a.openid = b.openid left join haoidcn_weixin_img as c ON a.openid=c.openid left join haoidcn_service as d ON a.openid=d.openid where is_Loan=0 and state=1 and is_adopt=1 and is_payment=1 and b.condition=0 and repayment_state=0 order by apply_time desc");
    		$this->assign('page',$show);
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_money_info->query("select a.phone,apply_time,money_num,time_length,state,b.is_payment,d.is_Loan,loan_people,daozhang,bank_num,account_opening,b.name,b.condition from haoidcn_user_money_info as a left join haoidcn_bank_info as b ON a.openid = b.openid left join haoidcn_weixin_img as c ON a.openid=c.openid left join haoidcn_service as d ON a.openid=d.openid left join haoidcn_user_work as e ON a.openid=e.openid where is_Loan=0 and  is_adopt=1 and state=1 and is_payment=1 and b.condition=0 and repayment_state=0 and e.province='$province' and e.city='$city' and a.loan_people like '$userid%' order by apply_time desc");
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
    	$phone = I('phone');
    	$service = D('service');
    	$service->where("phone='$phone'")->setField('is_Loan','1');
    	$list = $service->where("phone='$phone'")->select();
    	$id = $list[0]['openid'];
    	$user_money_info = D('user_money_info');
    	$loan_info = $user_money_info->where("phone='$phone'")->order("id desc")->select();
    	$bank_info = D('bank_info');
    	$bank = $bank_info->where("phone='$phone'")->select();
    	if(empty($bank)){
    		$data = "放款失败";
    		$this->ajaxReturn($data);
    	}
    	$time = date('Y-m-d H:i:s',time());
    	$info = array(
    			'openid'=>$id,
    			'phone'=>$phone,
    			'bank_num'=>$bank[0]['bank_num'],
    			'money_num'=>$loan_info[0]['money_num'],
    			'time_length'=>$loan_info[0]['time_length'],
    			'letter'=>$loan_info[0]['letter'],
    			'account_money'=>$loan_info[0]['account_money'],
    			'interest'=>$loan_info[0]['interest'],
    			'sum'=>$loan_info[0]['sum'],
    			'actual_money'=>$loan_info[0]['daozhang'],
    			'payment_time'=>$time,
    			'appoint_time'=>date('Y-m-d',strtotime("{$time} +{$loan_info[0]['time_length']} day")),
    			'actual_time'=>'',
    			'trade_mode'=>"",
    			'wait_xuqi'=>'',
    			'huankuan_type'=>'',
    	);
    	$payment_list = D('payment_list');
    	$result = $payment_list->add($info);
    	if($result){
    		$access_token = $this->access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$id",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您好
您在{$loan_info[0]['apply_time']}期间申请的借款{$loan_info[0]['money_num']}元已成功汇到您的银行卡！
交易时间：{$time}
交易类型：收款
交易金额：{$info['actual_money']}元,已扣除相关费用
备注：如有疑问，请给e快金微信号留言",
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
    	$phone = I('phone');
    	$content = I('content');
    	$service = D('service');
    	$service->where("phone='$phone'")->setField("is_Loan",2);
    	$info = $service->where("phone='$phone'")->find();
    	$openid = $info['openid'];
    	$bank_info = D('bank_info');
    	$bank_info->where("phone='$phone'")->setField("condition",1);
    	$access_token = $this->access_token();
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
    	$phone = I('phone');
    	$this->assign('phone',$phone);
    	$this->display();
    }
    
    public function whole_info(){
    	$phone = I('phone');
    	$user_money_info = D('user_money_info');
    	$list = $user_money_info->query("select * from haoidcn_user_money_info as a left join haoidcn_user_info as b ON a.phone=b.phone left join haoidcn_user_work as c ON a.phone=c.phone left join haoidcn_user_gam as d ON a.phone=d.phone left join haoidcn_user_mobile as e ON a.phone=e.phone where a.phone='$phone'");
    	$this->ajaxReturn($list);
    }
    
    public function details(){
    	$phone = I('phone');
    	$user = D('service');
    	$xuesheng = D('xuesheng');
    	$user_money_info = D("user_money_info");
    	$list = $user->query("select * from haoidcn_service as a left join haoidcn_user_info as b ON a.phone=b.phone  left join haoidcn_user_gam as d ON a.phone=d.phone left join haoidcn_user_mobile as e ON a.phone=e.phone left join haoidcn_bank_info as f ON a.phone=f.phone left join haoidcn_weixin_img as g ON a.openid=g.openid left join haoidcn_user_money_info as h ON a.phone=h.phone left join haoidcn_user_mobile as y ON a.phone=y.phone where a.phone='$phone'");
    	$this->assign('list',$list);
    	$this->assign('phone',$phone);
    	$user_work = D('user_work');
    	$work = $user_work->where("phone='$phone'")->find();
    	$this->assign('work',$work);
    	$payment_list = D('payment_list');
    	$info = $payment_list->where("phone='$phone' and is_repayment=0")->find();
    	$this->assign('info',$info);
    	$xs = $xuesheng->where("phone='$phone'")->find();
    	$res = $user_money_info->where("phone='$phone'")->order("id desc")->select();
    	$this->assign('xuesheng',$xs);
    	$this->assign('res',$res);
    	$this->display();
    }
    public function ok_adopt(){
    	$phone = I('phone');
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$list = $user_money_info->where("id='{$time['id']}'")->find();
    	$this->assign('phone',$phone);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    public function ok_xuqi(){
    	$userid = strtolower(I("session.userid"));
    	$phone = I('phone');
    	$user_money_info = D('user_money_info');
    	$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
    	$list = $user_money_info->where("id='{$time['id']}'")->find();
    	$id = $list['openid'];
    	$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','1');
    	$payment_list = D('payment_list');
    	$result = $payment_list->where("phone='$phone' and is_repayment=0")->find();
    	$info = array(
    			'time_length'=>$list['time_length'],
    			'sum'=>$list['sum'],
    			'appoint_time'=>date('Y-m-d',strtotime("{$result['appoint_time']} +{$list['time_length']} day")),
    	);
    	$payment_list->where("phone='$phone'")->save($info);
    	if($userid == 'admin'){
    		$user_money_info->where("id='{$time['id']}'")->setField('loan_people','admin');
    	}
    	$payment_list = D('payment_list');
    	$res = $payment_list->where("phone='$phone'")->select();
    	$access_token = $this->access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$id",
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
备注：如有疑问，请给e快金微信号留言",
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