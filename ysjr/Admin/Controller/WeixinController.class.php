<?php
namespace Admin\Controller;
use Think\Controller;
class WeixinController extends Controller{
	 public function __construct(){
		parent::__construct();
	   if(!$_SESSION['openid']){
			$redirect_uri='http://'.$_SERVER['HTTP_HOST'].__ACTION__;
			$redirect_uri = urlencode($redirect_uri);
			new_get_user_info($redirect_uri);
		}
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
	//用code获取用户openID
	public function openid(){
		$weixin = weixin();
		$appid = $weixin['appid'];
		$secret = $weixin['secret'];
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$_GET['code']."&grant_type=authorization_code";
		$json = $this->https_request($url);
		$array = json_decode($json,true);
		return $array['openid'];
	}
	//获取access_token的值
	/*  public function access_token(){
		$weixin = weixin();
		$appid = $weixin['appid'];
		$secret = $weixin['secret'];
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		$output = $this->https_request($url);
		$array = json_decode($output,true);
		$access_token = $array['access_token'];
		return  $access_token;
	}  */
	/* //获取用户信息
	public function get_user_info(){
		$access_token = access_token();
		$openid = $this->openid();
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
		$output = $this->https_request($url);
		$array = json_decode($output,true);
		return $array;
	} */
	public function lee(){
		$url="http://api.jisuapi.com/bankcardverify4/verify?appkey=f21fab567be0a064&bankcard=6230200191105902&realname=李阳&idcard=370284199111166015&mobile=13356399628";
		
		$re=$this->https_request($url);
		var_dump($re);
		die;
		$jssdk = new \Org\Jssdk\Jssdk;
		$signPackage = $jssdk->GetSignPackage();
		$this->assign('signPackage',$signPackage);
		//print_r($signPackage);
		$this->display();
	}
	//用户登录界面
	public function login(){

		    $phone = D('service')->where("openid='oRWuqv_zJy6ptMAcxfv1sxz-dxWc'")->field('phone,uname')->find();

		/*手机号认证*/
		
		var_dump($phone);
		$openid = I('openid');
		$this->assign('openid',$openid);
		$this->display();
	}
	//用户登录接口方法
	public function user_login(){
		$info = I('info');
		$phone = $info['mobile'];
		$info['password'] = md5($info['password']);  //对密码加密
		$user = D('service');    //用户表
		$res = $user->field('openid')->where("phone='$phone'")->select();
		$openid = $res[0]['openid'];
		$result = $user->field('password')->where("phone='$phone'")->select();
		if($result){
			if($result[0]['password'] == $info['password']){
				// 该用户存在的
				// 2.判断这个用户是否选择借款套餐
				$user_mobile = D('user_mobile');
				$user_money_info = D ( 'user_money_info' );
				$money = $user_money_info->where ( "phone='$phone'" )->order("id desc")->select ();
				$service_pwd = $user_mobile->where("phone='$phone'")->select();
				$user_info = D ( 'user_info' );
				$geren = $user_info->where ( "phone='$phone'" )->select ();
				$user_work = D ( 'user_work' );
				$gongzuo = $user_work->where ( "phone='$phone'" )->select ();
				$user_gam = D ( 'user_gam' );
				$shehui = $user_gam->where ( "phone='$phone'" )->select ();
				$is_adopt = $user_money_info->where ( "phone='$phone'" )->order("id desc")->select ();
				$weixin_img = D ( 'weixin_img' );
				$payment_list = D('payment_list');
				if ($money) {
					// 3.如果该用户已经选择借款套餐
					if ($service_pwd) {
						// 4.如果该用户已经填完服务密码的话，判断是否填完个人信息
						if ($geren and $gongzuo and $shehui) {
							// 该用户已经填写完个人信息，判断该用户借款状态
							if ($is_adopt [0] ['is_adopt'] == '0') {
								$img = $weixin_img->where("phone='$phone'")->select();
								if($img){
									// 推送一条消息该用户正在申请中
									$text = <<<json
				    		{
							    "touser":"$openid",
							    "msgtype":"news",
							    "news":{
							        "articles": [
							         {
							             "title":"尊敬的用户，您的借款信息正在申请中",
							             "description":"正在申请中"
							         }
							         ]
							    }
							}
json;
									$this->https_request($url,$text);
									$data = array(
											'info'=>'正在申请中',
											'phone'=>$phone,
											'openid'=>$openid
									);
									$this->ajaxReturn($data);
								}else{
									// 推送一条消息该用户未持证自拍
									$text = <<<json
				    		{
							    "touser":"$openid",
							    "msgtype":"news",
							    "news":{
							        "articles": [
							         {
							             "title":"尊敬的用户，您还未持证自拍",
							             "description":"尊敬的用户您好，为了防止他人代办的行为，我们需要您手拿身份证进行自拍，证明这次借款是您本人的操作。要求证件号清晰可见，审核通过后我们才会把借款金额打到您已绑定的银行卡中",
							         }
							         ]
							    }
							}
json;
									$this->https_request($url,$text);
									$data = array(
											'info'=>'未持证自拍',
											'phone'=>$phone,
											'openid'=>$openid
									);
									$this->ajaxReturn($data);
								}
							}else if($is_adopt [0] ['is_adopt'] == '-1'){
								$tupian = $weixin_img->where("phone='$phone'")->select();
								//该用户个人信息未填完整
								$res = $payment_list->where("phone='$phone'")->select();
								if($res[0]['wait_xuqi'] == '1' or $res[0]['wait_xuqi'] == '3'){
									$data = array(
											'info'=>'续期还款中',
											'phone'=>$phone,
											'openid'=>$openid
									);
									$this->ajaxReturn($data);
								}else if($tupian[0]['img1'] == null and $tupian[0]['img2'] == null and $tupian[0]['img3'] == null){
									$data = array(
											'info'=>'未持证自拍',
											'phone'=>$phone,
											'openid'=>$openid
									);
									$this->ajaxReturn($data);
								}else{
									$data = array(
											'info'=>'继续借款',
											'phone'=>$phone,
											'openid'=>$openid
									);
									$this->ajaxReturn($data);
								}
							}else if ($is_adopt [0] ['is_adopt'] == '1') {
								$bank_info = D ( 'bank_info' );
								$bank = $bank_info->where ( "phone='$phone'" )->select ();
								// 该用户已经通过审核，判断该用户是否绑定银行卡
								if ($bank) {
									// 判断该用户的银行卡是否验证成功
									$yinhangka = $bank_info->field ( 'is_payment' )->where ( "phone='$phone'" )->select ();
									if ($yinhangka [0] ['is_payment'] == '0') {
										$data = array(
												'info'=>'银行卡未验证',
												'phone'=>$phone,
												'openid'=>$openid
										);
										$this->ajaxReturn($data);
									} else if ($yinhangka [0] ['is_payment'] == '1') {
										// 继续判断该用户的持证自拍
										$img = $weixin_img->where ( "openid='$openid'" )->select ();
										if ($img) {
				
											$actual_time = $payment_list->field("actual_time")->where("phone='$phone'")->select();
											if($actual_time){
												if($actual_time[0]['actual_time'] != null){
													$service = D('service');
													$service_user = $service->where("phone='$phone'")->select();
													if($service_user[0]['is_loan'] == '0'){
														$data = array(
																'info'=>'银行卡未验证',
																'phone'=>$phone,
																'openid'=>$openid
														);
														$this->ajaxReturn($data);
													}else{
														$data = array(
																'info'=>'未选择借款套餐',
																'phone'=>$phone,
																'openid'=>$openid
														);
														$this->ajaxReturn($data);
													}
												}else{
													$data = array(
															'info'=>'未还款',
															'phone'=>$phone,
															'openid'=>$openid
													);
													$this->ajaxReturn($data);
												}
											}else{
												$data = array(
														'info'=>'状态',
														'phone'=>$phone,
														'openid'=>$openid
												);
												$this->ajaxReturn($data);
											}
										} else {
											// 推送消息该用户还剩最后一步持证自拍
											$text = <<<json
							    		{
							     			"touser":"$openid",
										    "msgtype":"news",
										    "news":{
										        "articles": [
										         {
										             "title":"尊敬的用户您好，您申请借款流程还剩最后一步，持证自拍",
										             "description":"为了防止他人代办的行为，我们需要您手拿身份证进行自拍，证明这次借款是您本人的操作。要求证件号清晰可见，审核通过后我们才会把借款金额打到您已绑定的银行卡中",
										         }
										         ]
										    }
							     		}
json;
											$this->https_request($url,$text);
											$data = array(
													'info'=>'未持证自拍',
													'phone'=>$phone,
													'openid'=>$openid
											);
											$this->ajaxReturn($data);
										}
									} else if ($yinhangka [0] ['is_payment'] == '2') {
										// 该用户银行卡验证失败，跳转到绑定银行卡界面
										$bank_info->where("phone='$phone'")->setField("is_payment",'0');
										$data = array(
												'info'=>'银行卡未绑定',
												'phone'=>$phone,
												'openid'=>$openid
										);
										$this->ajaxReturn($data);
									}
								} else {
									// 该用户还未绑定银行卡，跳转到绑定银行卡界面
									$data = array(
											'info'=>'银行卡未绑定',
											'phone'=>$phone,
											'openid'=>$openid
									);
									$this->ajaxReturn($data);
								}
							} else if ($is_adopt [0] ['is_adopt'] == '2') {
								// 该用户未通过审核，跳转到选择借款套餐界面
								$data = array(
										'info'=>'未选择借款套餐',
										'phone'=>$phone,
										'openid'=>$openid
								);
								$this->ajaxReturn($data);
							} else if ($is_adopt [0] ['is_adopt'] == '3') {
								// 该用户取消申请，跳转到选择借款套餐界面
								$data = array(
										'info'=>'未选择借款套餐',
										'phone'=>$phone,
										'openid'=>$openid
								);
								$this->ajaxReturn($data);
							}
						} else {
							if($is_adopt[0]['is_adopt'] == '3'){
								$data = array(
										'info'=>'未选择借款套餐',
										'phone'=>$phone,
										'openid'=>$openid
								);
								$this->ajaxReturn($data);
							}else{
								$data = array(
										'info'=>'继续借款',
										'phone'=>$phone,
										'openid'=>$openid
								);
								$this->ajaxReturn($data);
								// 该用户未填写个人信息，跳转到继续借款界面
							}
						}
					}else{
						if($is_adopt[0]['is_adopt'] == '3'){
							$data = array(
									'info'=>'未选择借款套餐',
									'phone'=>$phone,
									'openid'=>$openid
							);
							$this->ajaxReturn($data);
						}else{
							// 该用户未填服务密码，跳转到继续借款界面
							$data = array(
									'info'=>'继续借款',
									'phone'=>$phone,
									'openid'=>$openid
							);
							$this->ajaxReturn($data);
						}
					}
				} else {
					// 该用户还没选择借款套餐，跳转到选择借款套餐界面
					$data = array(
							'info'=>'未选择借款套餐',
							'phone'=>$phone,
							'openid'=>$openid
					);
					$this->ajaxReturn($data);
				}
			}else{
				$data = array(
					'info'=>'密码错误',
					'phone'=>$phone,
					'openid'=>$openid
				);
				$this->ajaxReturn($data);
			}
		}else{
			$data = array(
				'info'=>'用户不存在',
				'phone'=>$phone,
				'openid'=>$openid
			);
			$this->ajaxReturn($data);
		}
	}
	//用户注册界面
	public function register(){
		remind();//定时执行任务
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$service_info = M('service')->where($map)->find();
		$nickname = $service_info['uname'];
		$service = D ( 'service' );
        $phone = $service_info['phone'];
		
		/* $tj = D('tuijian');
		$info = $tj->where("openid='$openid'")->find();
		$tj = $info['tuijian'];
		$id = substr($tj,8);
		$user_tj = $service->where("id='$id'")->find();
		$tuijian = $user_tj['phone']; */
		$access_token = access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
        // 1.判断这个用户存不存在
		if ($phone) {
			// 该用户存在的
			// 2.判断这个用户是否选择借款套餐
			$user_mobile = D('user_mobile');
			$user_money_info = D ( 'user_money_info' );
			$money = $user_money_info->where ( "phone='$phone'" )->select ();

			$service_pwd = $user_mobile->where("phone='$phone'")->select();
			$user_info = D ( 'user_info' );
			$geren = $user_info->where ( "phone='$phone'" )->select ();
			$user_work = D ( 'user_work' );
			$gongzuo = $user_work->where ( "phone='$phone'" )->select ();
			$user_gam = D ( 'user_gam' );
			$shehui = $user_gam->where ( "phone='$phone'" )->select ();
			$is_adopt = $user_money_info->where( "phone='$phone'" )->order("id desc")->select();
			//var_dump($is_adopt);
			//exit;
			$weixin_img = D ( 'weixin_img' );
			$payment_list = D('payment_list');
			if ($money) {
				// 3.如果该用户已经选择借款套餐
				if ($service_pwd) {
					// 4.如果该用户已经填完服务密码的话，判断是否填完个人信息
					if ($geren  and $shehui) {
						// 该用户已经填写完个人信息，判断该用户借款状态
						if ($is_adopt [0] ['is_adopt'] == '0') {
							$img = $weixin_img->where("phone='$phone'")->select();
							if($img){
								// 推送一条消息该用户正在申请中
								$text = <<<json
				    		{
							    "touser":"$openid",
							    "msgtype":"news",
							    "news":{
							        "articles": [
							         {
							             "title":"尊敬的用户，您的借款信息正在申请中",
							             "description":"正在申请中"
							         }
							         ]
							    }
							}
json;
								$this->https_request($url,$text);
								$this->redirect('examine');
								//header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
							}else{
								// 推送一条消息该用户未持证自拍
								$text = <<<json
				    		{
							    "touser":"$openid",
							    "msgtype":"news",
							    "news":{
							        "articles": [
							         {
							             "title":"尊敬的用户，您还未持证自拍",
							             "description":"尊敬的用户您好，为了防止他人代办的行为，我们需要您手拿身份证进行自拍，证明这次借款是您本人的操作。要求证件号清晰可见，审核通过后我们才会把借款金额打到您已绑定的银行卡中",
							         }
							         ]
							    }
							}
json;
								$this->https_request($url,$text);
								$this->redirect('zhengfeng');
								//header("Location:http://www.leeyears.com/index.php/Weixin/zhengfeng?phone=$phone&openid=$openid");
							}
						}else if($is_adopt [0] ['is_adopt'] == '-1'){
							$tupian = $weixin_img->where("phone='$phone'")->find();
							//该用户个人信息未填完整
							$res = $payment_list->where("phone='$phone' and is_repayment=0")->select();
							if($res[0]['wait_xuqi'] == '1' or $res[0]['wait_xuqi'] == '3'){
								$this->redirect('examine');
								//header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
							}else if($tupian['img1'] == null or $tupian['img2'] == null or $tupian['img3'] == null){
								$this->redirect('zhengfeng');
								//header("Location:http://www.leeyears.com/index.php/Weixin/zhengfeng?phone=$phone&openid=$openid");
							}else{
								$this->redirect('continue_loan');
								//header("Location:http://www.leeyears.com/index.php/Weixin/continue_loan?phone=$phone&openid=$openid");
							}
						}else if ($is_adopt [0] ['is_adopt'] == '1') {
							$bank_info = D ( 'bank_info' );
							$bank = $bank_info->where ( "phone='$phone'" )->select ();
							// 该用户已经通过审核，判断该用户是否绑定银行卡
							if ($bank) {
								// 判断该用户的银行卡是否验证成功
								$yinhangka = $bank_info->where ( "phone='$phone'" )->select ();
								if ($yinhangka [0] ['is_payment'] == '0') {
									if($yinhangka[0]['condition'] == 1){
										$this->redirect('queren_loan');
										//header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
									}else{
										$this->redirect('examine');
										//header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
									}
								} else if ($yinhangka [0] ['is_payment'] == '1') {
									if($yinhangka[0]['condition'] == '1'){
										$this->redirect('queren_loan');
										//header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
									}else{
										$actual_time = $payment_list->field("actual_time")->where("phone='$phone' and is_repayment=0")->select();
										if($actual_time){
											$this->redirect('overdue');
											//header("Location:http://www.leeyears.com/index.php/Weixin/overdue?phone=$phone&openid=$openid");
										}else{
											$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
											$jiekuan = $user_money_info->where("id='{$time['id']}'")->find();
											if($jiekuan['repayment_state'] == 1){
													$this->redirect('choice_money');
											//	header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
											}else{
												$this->redirect('examine');
												//header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
											}
										}
									}
								} else if ($yinhangka [0] ['is_payment'] == '2') {
									// 该用户银行卡验证失败，跳转到绑定银行卡界面
									$bank_info->where("phone='$phone'")->setField("is_payment",'0');
									$this->redirect('queren_loan');
									//header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
								}
							} else {
								// 该用户还未绑定银行卡，跳转到绑定银行卡界面
								$this->redirect('queren_loan');
								//header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
							}
						} else if ($is_adopt [0] ['is_adopt'] == '2') {
							// 该用户未通过审核，跳转到选择借款套餐界面
							$this->redirect('choice_money');
							//header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
						} else if ($is_adopt [0] ['is_adopt'] == '3') {
							// 该用户取消申请，跳转到选择借款套餐界面
							$this->redirect('choice_money');
							//header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
						}
					} else {
						if($is_adopt[0]['is_adopt'] == '3'){
							$this->redirect('choice_money');
							//header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
						}else{
							// 该用户未填写个人信息，跳转到继续借款界面
							$this->redirect('continue_loan');
							//header("Location:http://www.leeyears.com/index.php/Weixin/continue_loan?phone=$phone&openid=$openid");
						}
					}
				}else{
					if($is_adopt[0]['is_adopt'] == '3'){
						$this->redirect('choice_money');
						//header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
					}else{
						$this->redirect('continue_loan');
						// 该用户未填服务密码，跳转到继续借款界面
						//header("Location:http://www.leeyears.com/index.php/Weixin/continue_loan?phone=$phone&openid=$openid");
					}
				}
			} else {
                // 该用户还没选择借款套餐，跳转到选择借款套餐界面
			    $this->redirect('choice_money');



				//header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
			}
		} else {
			
			// 不存在的话跳到注册页面
			//$this->assign('tuijian',$tuijian);
			/* $this->assign('openid',$openid);
			$this->assign('nickname',$nickname); */
			$this->display();
		}
	}
	
	
	//是否继续借款界面
	public function continue_loan(){
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		//$map['is_adopt']=-1;
		$phone = M('service')->where($map)->getField('phone');
		$user_money_info = D('user_money_info');
		$user_monile = D('user_mobile');
		//1.判断手机是否验证
		$service_pwd = $user_monile->where("phone='$phone'")->select();
		if($service_pwd){
			//该用户手机已验证
			//2.判断该用户是否填写个人信息
			$user_info = D('user_info');
			$geren = $user_info->where("phone=$phone")->select();
			$user_work = D('user_work');
			$gongzuo = $user_work->where("phone=$phone")->select();
			$user_gam = D('user_gam');
			$shehui = $user_gam->where("phone=$phone")->select();
			if($geren  and $shehui){
				//该用户个人信息资料未填写完整，跳转到填写个人信息界面
				$is_adopt = $user_money_info->where("phone='$phone'")->order("id desc")->select();
				if($is_adopt[0]['is_adopt'] == '-1'){
					$url = "verify_user_info";
				}
			}else{
				//该用户个人信息资料未填写完整，跳转到填写个人信息界面
				$url = "verify_user_info";
			}
		}else{
			//该用户手机未验证，跳转到手机验证界面
			$url = "verify_mobile";
		}
		$this->assign('phone',$phone);
		$this->assign('openid',$openid);
		$this->assign('url',$url);
		$this->display();
	}
	
	
	
	//获取短信验证码接口方法
	/* public function message_verify(){
		$verify = rand(100000,999999);   //把随机验证码提交到session里面
		$_SESSION['verify'] = $verify;
		$phone = I('phone');
		$_SESSION['phone'] = $phone;
		$statusStr = array(
				"0" => "短信发送成功",
				"-1" => "参数不全",
				"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
				"30" => "密码错误",
				"40" => "账号不存在",
				"41" => "余额不足",
				"42" => "帐户已过期",
				"43" => "IP地址限制",
				"50" => "内容含有敏感词"
		);
		$config = D('config');    //保存短信宝账号信息的表
		$res = $config->find();
		//$result[0]['phone_target']短信接口网址;$result[0]['phone_user']短信平台账号
		$pass = md5($res['phone_pass']); //短信平台密码
		$content="[及时雨微额速达]您的验证码是{$verify}";//要发送的短信内容
		$sendurl = $res['phone_target']."sms?u=".$res['phone_user']."&p=".$pass."&m=".$phone."&c=".urlencode($content);

		$result =file_get_contents($sendurl) ;
		$data = $statusStr[$result];

		$this->ajaxReturn($data);
	} */
	public function message_verify(){
		$verify = rand(100000,999999);   //把随机验证码提交到session里面
		$_SESSION['verify'] = $verify;
		$mobile = I('phone');
		$_SESSION['phone'] = $mobile;
		$content="【及时雨微额速达】您的验证码是{$verify}";//要发送的短信内容
		$userid = 3116;
		$account = "jsy";
		$password = "jsy123";
		$url = "http://dx.qxtsms.cn/sms.aspx?action=send&userid=".$userid."&account=".$account."&password=".$password."&mobile=".$mobile."&content=".$content."&sendTime=&checkcontent=0";
		$restult = https_request($url,1);
		$xml = simplexml_load_string($restult);
		$data = json_decode(json_encode($xml),TRUE);
		$result = $data['returnstatus']=='Success'?"短信发送成功":"失败";
		$this->ajaxReturn($result);
		
	}
	//提交用户注册接口方法
	public function user_register(){
		$verify = $_SESSION['verify'];   //获取到session里面的验证码
		$info = I('info');
		$phone = $info['phone'];
		/*if($phone != $_SESSION['phone']){
			$data = "手机号码不一致";
			$this->ajaxReturn($data);
			exit;
		}*/
		
		$openid = $_SESSION['openid'];
		
		//$info['password'] = md5($info['pwd']);
		$info['time'] = date("Y-m-d H:i:s",time());
		if($info['message_verify'] == $verify){      //把用户输入的验证码和session里面的验证码进行比对
			$user = D('service');    //用户表
			$result = $user->field('phone')->where("phone='$phone'")->select();
			if($result){
				$data = '该用户已存在';
				$this->ajaxReturn($data);
			}else{
				if(is_array($info)){
					$map['openid']=$openid;
					$res2 = $user->where($map)->save($info);
					//echo $user->getLastsql();
					if($res2){
						$data = "注册成功";
						$this->ajaxReturn($data);
					}else{
						$data = "注册失败";
						$this->ajaxReturn($data);
					}
				}
			}
		}else{
			$data = "手机验证码错误";
			$this->ajaxReturn($data);
		}
	}
	//用户重置密码界面
	public function reset_pwd(){
		$this->display();
	}
	//用户重置密码接口方法
	public function user_reset_pwd(){
		$info = I('info');
		$phone = $info['phone'];
		$verify = $_SESSION['verify'];
		if($info['verify'] == $verify){
			$user = D('service');
			$result = $user->field('password')->where("phone='$phone'")->select();
			if($result){
				$data  = '重置密码';
				$this->ajaxReturn($data);
			}else{
				$data = '重置失败,该用户还没注册';
				$this->ajaxReturn($data);
			}
		}else{
			$data = '手机验证码失败';
			$this->ajaxReturn($data);
		}
	}
	//用户输入新密码界面
	public function new_pwd(){
		$phone = I('phone');
		$this->assign('phone',$phone);
		$this->display();
	}
	//到数据库更改密码接口
	public function change_pwd(){
		$info = I('info');
		$phone = $info['phone'];
		$info['password'] = md5($info['password']);
		if(is_array($info)){
			$user = D('service');
			$user->where("phone='$phone'")->save($info);
			$data = '更改密码成功';
			$this->ajaxReturn($data);
		}
	}
	//用户注册成功界面
	public function register_success(){
		$phone = I('phone');
		$openid = I('openid');
		$this->assign('openid',$openid);
		$this->assign('phone',$phone);
		$this->display();
	}
	//选择金额借款界面
	public function choice_money(){
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		//$map['is_adopt']=-1;
		$service_info = M('service')->where($map)->field('id,phone,status,remark,auditing_time')->find();
		$phone = $service_info['phone'];
		$status = $service_info['status'];
		$auditing_time = $service_info['auditing_time']+2592000;
		
		if(empty($phone)){
			 $this->redirect('Weixin/register');
		}
		/*-1 未提交资料 0 审核中 1 审核成功 2 审核失败  3 重新提交资料审核中*/
		if($status == 2 && ($auditing_time>time())){
			$this->redirect('Weixin/fail_content',array('id'=>$service_info['id'],'type'=>1));
		}elseif($status == 2 && ($auditing_time<time())){
			$this->redirect('Weixin/verify_mobile');
		}elseif($status == -1){
			$this->redirect('Weixin/verify_mobile');
		}elseif($status == 0 || $status == 3){
			$this->redirect('Weixin/audit');
		}elseif($status == 1){
			/*审核通过*/
			
			$is_adopt =M('user_money_info')->field('apply_time,id,is_adopt,is_success')->where($map)->order('id desc')->find();
			if(!empty($is_adopt)){
				$apply_time = strtotime($is_adopt ['apply_time'])+2592000;
				if($is_adopt['is_adopt'] == 2 && ($apply_time>time())){
				
				$this->redirect('Weixin/fail_content',array('id'=>$is_adopt['id']));
				 
				}elseif($is_adopt['is_adopt'] == 0){
					$this->redirect('Weixin/examine');
				}elseif($is_adopt['is_adopt'] == 1){
					$where['user_money_info'] = $is_adopt['id'];
					$is_repayment = M('payment_list')->where($where)->getField('is_repayment');
					if($is_repayment != 1){
						$this->redirect('Weixin/examine');
					}
					
				}
			}
			
		}
		/* $is_adopt =M('user_money_info')->field('apply_time,id,is_adopt')->where($map)->order('id desc')->find();
		$bank = M('bank_info')->field('is_payment')->where($map)->find();
		$apply_time = strtotime($is_adopt ['apply_time'])+2592000;
		if(!empty($is_adopt)){
			if($is_adopt['is_adopt'] == 2 && ($apply_time>time())){
			
			$this->redirect('Weixin/fail_content',array('id'=>$is_adopt['id']));
			 
			}elseif($is_adopt['is_adopt'] == 0){
				$this->redirect('Weixin/examine');
			}elseif($is_adopt['is_adopt'] == 1 ){
				if($bank['is_payment'] == 0){
					$this->redirect('Weixin/examine');
				}
			}
		
		} */
		/*优惠券*/
		$time=time();
		$sql="SELECT * FROM haoidcn_user_cash_coupon WHERE openid= '".$openid."' AND  status=0 AND time_start<=".$time." AND time_end >= ".$time;
		$cash_coupon=D()->query($sql);
		$this->assign('cash_coupon',$cash_coupon);
		/*额度*/
		$where['repayment_state']=1;
		$where['openid']=$openid;
		$credit=M('user_money_info')->where($where)->sum('credit');
		
		$credit=$credit['tp_sum']?$credit['tp_sum']:0;
		
		$map['credit']  = array('ELT',$credit);
		
		$loan_money_info=M('loan_money')->where($map)->group('money_num')->order('money_num asc')->select();//借款金额信息表
		//print_r($loan_money_info);
		$this->assign('loan_money_info',$loan_money_info);
		$service = D('service');
		$result = $service->where("phone='$phone'")->find();
		$this->assign('activity',$result['money']);
		//$loan_money = D('loan_money');   //借款金额信息表
		//$list = $loan_money->select();
		//$this->assign('list',$list);
		$this->assign('phone',$phone);
		$this->assign('openid',$openid);
		$this->display();
	}
	
	public function loan(){
		
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		//$map['is_adopt']=-1;
		$phone = M('service')->where($map)->getField('phone');
		if(empty($phone)){
			 $this->redirect('Weixin/register');
		}
	
		$is_adopt =M('user_money_info')->field('apply_time,id,is_adopt')->where($map)->order('id desc')->find();
		$bank = M('bank_info')->field('is_payment')->where($map)->find();
		$apply_time = strtotime($is_adopt ['apply_time'])+2592000;
		if(!empty($is_adopt)){
			if($is_adopt['is_adopt'] == 2 && ($apply_time>time())){
			
			$this->redirect('Weixin/fail_content',array('id'=>$is_adopt['id']));
			 
			}elseif($is_adopt['is_adopt'] == 0){
				$this->redirect('Weixin/examine');
			}elseif($is_adopt['is_adopt'] == 1 ){
				if($bank['is_payment'] == 0){
					$this->redirect('Weixin/examine');
				}
			}
		
		}
		
		
		
		
		$this->assign('openid',$openid);
		$this->assign('phone',$phone);
		$this->display();
	}
	/*审核中*/
	public function audit(){
		$this->display();
	}
	/*审核失败*/
	public function fail_content(){
		$map['id'] = I('id');
		
		$type = I('type');
		if($type == 1){
			$fail_content = M('service')->where($map)->getField('remark');
		}else{
			$fail_content = M('user_money_info')->where($map)->getField('fail_content');
		}
		
		$this->assign('fail_content',$fail_content);
		$this->display();
	}
	
	public function get_money(){
		$money = I('money');
		$time_length = I('time');
		if($money and $time_length){
			$loan_money = D('loan_money');
			$info = $loan_money->where("money_num=$money and time_length=$time_length")->select();
		}else{
			$info = "数据未收到";
		}
		$this->ajaxReturn($info);
	}
	/*优惠券选择*/
	public function cash_coupon_money(){
		$map['id'] = I('id');
		
		$map['openid'] = $_SESSION['openid'];
		$user_cash_coupon = M('user_cash_coupon')->field('money_num,status')->where($map)->find();
		if(empty($user_cash_coupon)){
			$data['error'] = 2;
			$data['content'] = "该优惠券不存在";
		}else{
			if($user_cash_coupon['status'] == 1){
				$data['error'] = 2;
			 $data['content'] = "该优惠券已使用";
			}else{
				$data['error'] = 1;
				$data['content'] = $user_cash_coupon['money_num'];
				
			}
		}
		die(json_encode($data));
	}
	
	//保存用户借款金额信息接口
	public function user_money_info(){
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		$info = array(
				'phone'=>$phone,
				'apply_time'=>date("Y-m-d H:i:s",time()),
				'money_num'=>$_POST['money_num'],
				'time_length'=>$_POST['time_length'],
				'letter'=>$_POST['letter'],
				'interest'=>$_POST['interest'],
				'account_money'=>$_POST['account_money'],
				'sum'=>$_POST['sum'],
				'daozhang'=>$_POST['daozhang'],
				'openid'=>$openid,
				'coupon_id'=>$_POST['ncoupon_id'],
				'repayment_state'=>0
		);
		
		$user_money_info = D('user_money_info');    //用户借款信息表
 		
 		$result = $user_money_info->where("openid='$openid' and is_adopt=-1")->select();
 		if($result){
 			$info['state'] = '0';
 			$info['is_adopt'] = '-1';
 			$time = $user_money_info->field("max(id) as id")->where("openid='$openid' and is_adopt=-1")->find();
 			$user_money_info->where("id='{$time['id']}'")->save($info);
 			$data = '1';
 			$this->ajaxReturn($data);
 		}else{
 			if(is_array($info)){
 				if(!$user_money_info->create($info)){
 					//如果创建失败，表示验证没有通过，输出错误提示信息
 					exit($user_money_info->getError());
 				}else{
 					$user_money_info->add($info);
 					$data = '1';
 					$this->ajaxReturn($data);
 				}
 			}
 		}
	}
	//服务密码界面
	public function guide(){
		$this->display();
	}
	
	//更新手机认证界面
	public function fuwu(){
		
		
		
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		$url = 'http://life.yhd.com/mobile/findMobileInfo.do?mobileNum='.$phone.'&chargePrice=100&source=1';
		$res=https_request($url);
		$res=json_decode($res);
		$carrier=$res->mobileInfo->provinceName.$res->mobileInfo->typeName;
		$telString=$res->mobileInfo->mobile;
		$this->assign('telString',$telString);//把接口得到的数据变量传到页面上显示
		$this->assign('carrier',$carrier);//把接口得到的数据变量传到页面上显示
		
		$user_mobile = D('user_mobile');
		$list = $user_mobile->where("phone='$phone'")->select();
		$this->assign('list',$list);
	
		$this->assign('openid',$openid);
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','0');
		$this->display();
	}
	
	//手机认证界面
	public function mobile(){
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$phone = M('service')->where($map)->getField('phone');

		$url = 'http://life.yhd.com/mobile/findMobileInfo.do?mobileNum='.$phone.'&chargePrice=100&source=1';
		$res = https_request($url);
		$res = json_decode($res);
		$carrier = $res->mobileInfo->provinceName.$res->mobileInfo->typeName;
		$telString = $res->mobileInfo->mobile;
		$user_mobile = D('user_mobile');
		$list = $user_mobile->where("phone='$phone'")->select();
		
		$this->assign('telString',$telString);//把接口得到的数据变量传到页面上显示
		$this->assign('carrier',$carrier);//把接口得到的数据变量传到页面上显示
	
		$this->display();
	}
	
	//验证手机界面
	public function verify_mobile(){
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		
		$url = 'http://life.yhd.com/mobile/findMobileInfo.do?mobileNum='.$phone.'&chargePrice=100&source=1';
		$res=https_request($url);
		$res=json_decode($res);
		$carrier=$res->mobileInfo->provinceName.$res->mobileInfo->typeName;
		$telString=$res->mobileInfo->mobile;
		
		$user_mobile = D('user_mobile');
		$list = $user_mobile->where("phone='$phone'")->find();
		if($list){
			$this->redirect('verify_user_info');
		}
		$this->assign('list',$list);
		$this->assign('telString',$telString);//把接口得到的数据变量传到页面上显示
		$this->assign('carrier',$carrier);//把接口得到的数据变量传到页面上显示
		$this->assign('openid',$openid);
		$this->display();
	}
	//图形验证码
	public function verify_c(){
		$Verify = new \Think\Verify();
		$Verify->fontSize = 18;
		$Verify->length   = 4;
		$Verify->useNoise = false;
		$Verify->codeSet = '0123456789';
		$Verify->imageW = 120;
		$Verify->imageH = 40;
		$Verify->entry();
	}
	//验证手机接口方法 修改去除服务密码  改为手机号实名认证
	public function verify_mobile_method(){
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$info = I('info');
		$phone = I('phone');
		
		$verify = $info['verify'];
		$info['phone'] = $phone;
		$info['openid'] = $openid;
		
		$info['uID'] = $info['idcard'];
		$info['name'] = $info['name'];
		$info['status'] = 1;
		//$service_pwd = $info['service_pwd'];
		//$info['service_pwd'] = $service_pwd;
	
		if(is_array($info)){
			
			if(!check_verify($verify)){
				$data = "1";
				$this->ajaxReturn($data);
			}else{
				
				//$Lm = new \Org\Lm\Lm();
				
				//$username = $phone;//用户名 !!!需自行设定!!!
				//$password = base64_encode($service_pwd);//用户密码 //!!!需自行设定!!!
				//$lee = $Lm->process($username,$password);
				//$lee=array("msg"=>"密码错误","code"=>"1102");
				$result = validate_mobile($info['name'], $info['idcard'], $phone);//new add
				
				//$result=1;
				if($result == 2 || $result == 3){
					$data = $result==2?2:3;
					
					$this->ajaxReturn($data);
					/* if($lee['code'] == "1102"){
						$data = 2;
						$this->ajaxReturn($data);
					}elseif($lee['code'] == "2030"){
						$data = 3;
						$this->ajaxReturn($data);
					}else{
						$data = 4;
						$this->ajaxReturn($data);
					} */
				}else{
					$user_mobile = D('user_mobile');
					$pwd = $user_mobile->where($map)->find();
					if($pwd){
						$user_mobile->where($map)->save($info);
					}else{
						$user_mobile->add($info);
					}
					$user_info = M('user_info')->where($map)->find();
					if($user_info){
						M('user_info')->where($map)->save($info);
					}else{
						M('user_info')->add($info);
					}
					$data = "下一步";
					$this->ajaxReturn($data);
				}
				
			}
		}
	}
	
	
	
	//身份认证界面
	public function user_info(){
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$user_info = D('user_info');
		$list1 = $user_info->where($map)->select();
		$user_work = D('user_work');
		$list2 = $user_work->where($map)->select();
		$user_gam = D('user_gam');
		$list3 = $user_gam->where($map)->select();
		$xuesheng = D('xuesheng');
		$list4 = $xuesheng->where($map)->select();
		$this->assign('openid',$openid);
		
		$this->assign('list1',$list1);
		$this->assign('list2',$list2);
		$this->assign('list3',$list3);
		$this->assign('list4',$list4);
		$this->display();
	}
	//验证身份界面
	public function verify_user_info(){
		
		$openid=$_SESSION['openid'];
		$user_info = D('user_info');
		$list1 = $user_info->where("openid='$openid'")->select();
		$user_work = D('user_work');
		$list2 = $user_work->where("openid='$openid'")->select();
		$user_gam = D('user_gam');
		$list3 = $user_gam->where("openid='$openid'")->select();
		$xuesheng = D('xuesheng');
		$list4 = $xuesheng->where("openid='$openid'")->select();
		
		$this->assign('openid',$openid);
		
		$this->assign('list1',$list1);
		$this->assign('list2',$list2);
		$this->assign('list3',$list3);
		$this->assign('list4',$list4);
		$this->display();
	}
	
	//个人征信协议
	public function gerenzhengxin(){
		$name = I('name');
		if(strlen($name) == 9){
			$name = substr_replace($name,"**",3);
		}else if(strlen($name) == 6){
			$name = substr_replace($name,"*",3);
		}
		$uid = I('uid');
		if(strlen($uid) == 15){
			$uid = substr_replace($uid,"**********",2,10);
			$this->assign('uid',$uid);
		}else if(strlen($uid) == 18){
			$uid = substr_replace($uid,"************",2,12);
			$this->assign('uid',$uid);
		}
		$time = I('time');
		$this->assign('name',$name);
		$this->assign('time',$time);
		$this->display();
	}
	
	//添加用户个人信息接口
	public function add_user_info(){
		$info = I('info');
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		$info['phone']=$phone;
		$info['openid']=$openid;
		$info['time'] = date("Y-m-d H:i:s",time());
		$user_info = D('user_info');    //用户个人信息表
		$user = $user_info->where("openid='$openid'")->select();
		if($user){
			$user_info->where("openid='$openid'")->save($info);
			$data = '下一页';
			$this->ajaxReturn($data);
		}
		if(is_array($info)){
			if(!$user_info->create($info)){
				//如果创建失败，表示验证没有通过，输出错误提示信息
				exit($user_info->getError());
			}else{
				$user_info->add();
				$data = '下一页';
				$this->ajaxReturn($data);
			}
		}
	}
	//添加用户职业信息接口
	public function add_user_work(){
		$info = I('info');
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		$info['phone']=$phone;
		$info['openid']=$openid;
		$info['province'] = $_POST['province5'];
		$info['city'] = $_POST['city5'];
		$user_work = D('user_work');            //用户工作信息表
		$user = $user_work->where("openid='$openid'")->select();
		if($user){
			$user_work->where("openid='$openid'")->save($info);
			$data = '下一页';
			$this->ajaxReturn($data);
		}
		if(is_array($info)){
			if(!$user_work->create($info)){
				//如果创建失败，表示验证没有通过，输出错误提示信息
				exit($user_work->getError());
			}else{
				$user_work->add();
				$data = '下一页';
				$this->ajaxReturn($data);
			}
		}
	}
	
	public function xuexin(){
		$this->display();
	}
	//添加学生用户信息接口
	public function add_xuesheng(){
		$info = I('info');
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$phone = M('service')->where($map)->getField('phone');
		$info['phone']=$phone;
		$info['openid']=$openid;
		M('user_work')->where($map)->delete();
		/* $info['province'] = $_POST['province4'];
		$info['city'] = $_POST['city4'];
		// 取得成功上传的文件信息
		$img = $this->upload();
		if(!empty($img)){
			$info['url'] = $img['img2']['savepath'].$img['img2']['savename'];
		} */
	
		$xuesheng = D('xuesheng');            //用户工作信息表
		$user = $xuesheng->where("openid='$openid'")->find();
		if($user){
			/* if(empty($user['url'])){
				$data = '请上传学信截图';
				$this->ajaxReturn($data);
				exit;
			} */
			$xuesheng->where("openid='$openid'")->save($info);
			$data = '下一页';
			$this->ajaxReturn($data);
		}else{
			$res = $xuesheng->add($info);
			if($res){
				$data = '下一页';
				$this->ajaxReturn($data);
			}else{
				$data = '保存失败';
				$this->ajaxReturn($data);
			}
			
			/* if(!empty($info['url'])){
				$xuesheng->add($info);
				$data = '下一页';
				$this->ajaxReturn($data);
			}else{
				$data = '请上传学信截图';
				$this->ajaxReturn($data);
			} */
		}
	}
	//添加用户社会关系接口
	public function add_user_gam(){
		$info = I('info');
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		$info['phone']=$phone;
		$info['openid']=$openid;
		$user_work = D("user_work");
		$user_info = D("user_info");
		$xuesheng = D('xuesheng');
		$geren = $user_info->where("openid='$openid'")->select();
		$gongzuo = $user_work->where("openid='$openid'")->select();
		$xue = $xuesheng->where("openid='$openid'")->select();
		$user_gam = D('user_gam');        //用户社会关系表
		$user_money_info = D('user_money_info');
		$user = $user_gam->where("openid='$openid'")->select();
		if($geren == null){
			$data = '信息填写不完整';
			$this->ajaxReturn($data);
			exit;
		}else if($user and $geren){
			if($gongzuo){
				$user = D('service');
				$user->where("openid='$openid'")->setField("is_Loan",'0');
				$user_gam->where("openid='$openid'")->save($info);
				$data = '提交';
				$this->ajaxReturn($data);
			}else{
				if($xue){
					$user = D('service');
					$user->where("openid='$openid'")->setField("is_Loan",'0');
					$user_gam->where("openid='$openid'")->save($info);
					$data = '提交';
					$this->ajaxReturn($data);
				}else{
					$data = '信息填写不完整';
					$this->ajaxReturn($data);
				}
			}
		}else if($gongzuo){
			if(is_array($info)){
				if(!$user_gam->create($info)){
					//如果创建失败，表示验证没有通过，输出错误提示信息
					exit($user_gam->getError());
				}else{
					$user_gam->add();
					$data = '提交';
					$this->ajaxReturn($data);
				}
			}
		}else{
			if($xue){
				if(is_array($info)){
					if(!$user_gam->create($info)){
						//如果创建失败，表示验证没有通过，输出错误提示信息
						exit($user_gam->getError());
					}else{
						$user_gam->add();
						$data = '提交';
						$this->ajaxReturn($data);
					}
				}
			}else{
				$data = '信息填写不完整';
				$this->ajaxReturn($data);
			}
		}
	}
	
	//上传身份证界面
	public function zhengfeng(){
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
	//	$phone = M('service')->where($map)->getField('phone');
		$weixin_img = D('weixin_img');
		$result = $weixin_img->where("openid='$openid'")->find();
		
		$jssdk = new \Org\Jssdk\Jssdk;
		$signPackage = $jssdk->GetSignPackage();
		$this->assign('signPackage',$signPackage);
		$this->assign('res',$result);
		$this->display();
		/* $map['is_adopt'] = 2;
		$fail_time=time()-60*60*24*30;
		$apply_time=M('user_money_info')->where($map)->order('id desc')->getField('apply_time');
		
		if(empty($result) || ($apply_time>$fail_time)){
			//一个月之内申请失败或者为空
			$jssdk = new \Org\Jssdk\Jssdk;
			$signPackage = $jssdk->GetSignPackage();
			$this->assign('signPackage',$signPackage);
			$this->assign('res',$result);
			$this->display();
		}else{
			$this->redirect('Weixin/alipay');
		} */
	}
	
	//文件上传方法
	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     553145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './'; // 设置附件上传根目录
		$upload->savePath  =      __ROOT__.'/Uploads/'; // 图片放置的目录
		// 上传文件 
		$info   =   $upload->upload();
		return $info;
	}
	/*自拍照上传*/
	public function uploadImage($MediaId){
		$access_token = access_token();
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$MediaId;
        $fileInfo = newdownloadWeixinFile($url);
        //判断目录是否存在，是的话创建
        $img_url = "./Uploads/".date("Y-m-d",time());
        is_dir("$img_url") || mkdir("$img_url");
        //判断图片是否存在，是的话创建
        $img_url = $img_url."/".time().".".rand(1,9999).".jpg";
        file_exists("$img_url") || file_put_contents("$img_url",$fileInfo['body']);
		$img_url=substr($img_url,1);
		return $img_url;
	}
	
	
	public function upload_img(){
		//$info = I('info');
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		$info['openid']=$openid;
		$info['phone']=$phone;
		$is_new = $_POST['is_new'];
		
		if($is_new){
			if($_POST['media_id3']){
				$info['img_url']=$this->uploadImage($_POST['media_id3']);
			}
			
			$info['img1']=$this->uploadImage($_POST['media_id1']);
			$info['img2']=$this->uploadImage($_POST['media_id2']);
		
			// 取得成功上传的文件信息
			//$img = $this->upload();
			/* if(!empty($img)){
				$info['img1'] = $img['img1']['savepath'].$img['img1']['savename'];
				$info['img2'] = $img['img2']['savepath'].$img['img2']['savename'];
				$info['img3'] = $img['img3']['savepath'].$img['img3']['savename'];
			} */
			
			$info['time'] = date("Y-m-d",time());
			$user_money_info = D('user_money_info');
			$weixin_img = D('weixin_img');
			$result = $weixin_img->where("openid='$openid'")->find();
			if($result){
				$weixin_img->where("openid='$openid'")->save($info);
			}else if($info['img_url'] != null){
				$weixin_img->add($info);
			}else if(empty($info['img_url'])){
				$data = '提交失败,请按照提示上传图片';
				$this->ajaxReturn($data);
				exit;
			}
			$data = '提交成功';
			$this->ajaxReturn($data);
		}else{
			$data = '提交成功';
			$this->ajaxReturn($data);
		}
		
		
		/* $time = $user_money_info->field("max(id) as id")->where("openid='$openid'")->find();
		$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','0');
		$access_token = access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$text = <<<json
		{
		    "touser":"$openid",
		    "msgtype":"news",
		    "news":{
		        "articles": [
		         {
		             "title":"您申请的借款已经成功提交!",
		             "description":"正在审核中",
		         }
		         ]
		    }
		}
json;
		$this->https_request($url,$text); */
		
		
	}
	//成功提交审核界面
	public function alipay(){
		$id = I('id'); 
		$money_num = M('user_money_info')->where("id='$id'")->getField('money_num');
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;

		$phone = M('service')->where($map)->getField('phone');
		
		$service = D('service');
		$result = $service->where("openid='$openid'")->select();
		
		$weixin_img = D('weixin_img');
		$img = $weixin_img->where("openid='$openid'")->select();
		
		/* if($img[0]['img1'] == null && $img[0]['img2'] == null && $img[0]['img2'] == null){
			$data = "未持证自拍不能进行审核";
			$this->assign('data',$data);
		} */
		/*管理员提醒*/
		$time=date('Y-m-d',time());
		
		$name=M('user_info')->where($map)->getField("name");
		
		$news_data= array (
							    'first' =>array('value' => urlencode("收到一笔借款，请及时进行处理")),
								'keyword1' =>array('value' => urlencode($name)),
								'keyword2' => array('value' => urlencode($money_num)),
								'keyword3' => array('value' => urlencode("线上出借")),
								'keyword4' =>array('value' => urlencode($time)),
							  );
		template_news($news_data,1);
		/*END*/
		$this->assign('phone',$phone);
		$this->display();
	}
	
	//支付宝认证界面
	public function zfb(){
		$phone = I('phone');
		$this->assign('phone',$phone);
		$this->display();
	}
	
	public function add_zfb(){
		$info = I('info');
		$zfb = D('zfb');
		$result = $zfb->add($info);
		if($result){
			$data = "提交认证";
			$this->ajaxReturn($data);
		}else{
			$data = "提交失败";
			$this->ajaxReturn($data);
		}
	}
	
	//借款状态界面
	public function examine(){
		
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$phone = M('service')->where($map)->getField('phone');
		
		$user_money_info = D('user_money_info');
		$money = $user_money_info->field('is_success,is_adopt,id,protocol')->where($map)->order("id desc")->select();
		
		$weixin_img = D('weixin_img');
		$payment_list = D('payment_list');
		
		$bank_info = D('bank_info');
		$bank = $bank_info->field('is_payment')->where($map)->find();
		if($money[0]['is_adopt'] == '0'){
			$data = '1';  //审核中
			if($list[0]['wait_xuqi'] == '2'){
				$data = '8';  //申请续期状态 续期成功
			}  
		}else if($money[0]['is_adopt'] == '1'){
			if($money[0]['is_success'] == 1){
				$datas = "1";
			}
			$bank_info = D('bank_info');
			$bank = $bank_info->field('is_payment')->where("phone='$phone'")->select();
			if($bank[0]['is_payment'] == '0'){
				$data = "2";
			}else if($bank[0]['is_payment'] == '1'){
				$res = $payment_list->where("phone='$phone'")->select();
				if($res[0]['wait_xuqi'] == '1'){
					$data = '6';  //续期中
				}else if($res[0]['wait_xuqi'] == '3'){
					$data = '7';  //还款中
				}else{
					
						$data = '4';
					
				}
			}
		} else if($money[0]['is_adopt'] == '-1'){
			
			$res = $payment_list->where("phone='$phone'")->select();
			if($res[0]['wait_xuqi'] == '1'){
				$data = '6';  //续期中
			}else if($res[0]['wait_xuqi'] == '3'){
				$data = '7';  //还款中
			}
		}
		$this->assign('id',$money[0]['id']);
		$this->assign('data',$data);
		$this->assign('datas',$datas);
		$this->assign('phone',$phone);
		$this->display();
	}
	//借款详情界面
	public function lend_details(){
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$phone = M('service')->where($map)->getField('phone');
		$user_money_info = D('user_money_info');
		$list = $user_money_info->where("phone='$phone'")->order("id desc")->select();
		$this->assign('list',$list);
		$this->assign('phone',$phone);
		$this->display();
	}
	//取消用户申请接口
	public function cancel_apply(){
		$id = I('id');
		if($id){
			$user_money_info = D('user_money_info');
			$user_money_info->where("id='$id'")->setField('is_adopt','3');	
		
		}else{
			$openid = $_SESSION['openid'];
			$map['openid'] = $openid;
			$phone = M('service')->where($map)->getField('phone');
			$user_money_info = D('user_money_info');
			$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
			$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','3');
		}
		
		$data = "取消成功";
		$this->ajaxReturn($data);
	}
	//绑定银行卡界面
	public function queren_loan(){
		$t = I('t');

		$t = $t ? $t : 0;
		$card_bank = D('card_bank');     //银行卡名称表
		$bank_name = $card_bank->select();
		$this->assign('bank_name',$bank_name);
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$user_info =  D('user_info')->where($map)->field('name,uID')->find();
		$list =  D('bank_info')->where($map)->select();
		$this->assign('list',$list);
		$this->assign('t',$t);
		
		$this->assign('name',$user_info['name']);
		$this->assign('uid',$user_info['uid']);
		$this->display();
	}
	
	//把用户的银行卡信息添加到数据库
	public function bank_card(){
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$info['name'] = I('name'); 
		$post_info = I('info'); 
		$t = $post_info['t'];//0 信息确认  1 贷款确认 
		$info['bank_name'] = $post_info['bank_name']; 
		$info['account_opening'] =  $post_info['account_opening']; 
		$info['bank_num'] =  $post_info['bank_num']; 
		$info['bank_mobile'] =  $post_info['bank_mobile']; 
		$info['province'] =  $_POST['province5']; 
		$info['city'] =  $_POST['city5']; 
		$info['bank_mobile'] =  $post_info['bank_mobile']; 
		$bank_id_number =  $post_info['bank_id_number']; //身份证号
		
		$uID = M('user_info')->where($map)->getField('uID');
		if($uID != $post_info['bank_id_number']){
			$data = '填写的身份证号与个人资料填写的身份证号不一致';
			$this->ajaxReturn($data);
			exit;
		}
		$bank_info = D('bank_info');         //用户银行卡信息表
		$bank = $bank_info->where($map)->find();
		if($bank){
			if($bank['bank_mobile'] != $post_info['bank_mobile'] || $bank['bank_num'] != $post_info['bank_num']){
				//$result = validate_bank($post_info['bank_num'],$info['name'],$post_info['bank_id_number'],$post_info['bank_mobile']);
				$result = 1;
				if($result){
					$t = 0;
					M('service')->where($map)->setField('status',0);
					$info['status'] = 1; 
					$info['is_payment'] = 1; 
				}else{
					$data = '抱歉，银行卡号校验不一致！请检查各项信息是否正确';
					$this->ajaxReturn($data);
					exit;
				}
			}else{
				
				$time = M('user_money_info')->field("max(id) as id")->where("openid='$openid' and is_adopt=-1")->find();
				M('user_money_info')->where("id='{$time['id']}'")->setField('is_adopt',0);
			}
		}else{
				//$result = validate_bank($post_info['bank_num'],$info['name'],$post_info['bank_id_number'],$post_info['bank_mobile']);
				$result =1;
				if($result){
					$t = 0;
					M('service')->where($map)->setField('status',0);
					$info['status'] = 1; 
					$info['is_payment'] = 1; 
				}else{
					$data = '抱歉，银行卡号校验不一致！请检查各项信息是否正确';
					$this->ajaxReturn($data);
					exit;
				}
		}
		$phone = M('service')->where($map)->getField('phone');
		$info['phone'] = $phone; 
		$info['openid'] = $openid; 
		if(is_array($info)){
			if(!$bank_info->create($info)){
				//如果创建失败，表示验证没有通过，输出错误提示信息
				exit($bank_info->getError());
			}else{
				$bank = $bank_info->where($map)->find();
				if($bank){
					
					//$info['is_payment'] = "0";
					$info['condition'] = 0;
					$bank_info->where($map)->save($info);
				}else{
					$bank_info->add();
				}
				
				$access_token = access_token();
				$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
				if($t){
					$title = "您的借款信息正在申请中";
					$description = "尊敬的用户您好！我们正在马不停蹄的给你打款，请耐心等待";
				}else{
					$time =  date('Y-m-d',time());
					$news_data= array (
							    'first' =>array('value' => urlencode("有新的提交资料审核，请及时进行处理")),
								'keyword1' =>array('value' => urlencode($info['name'])),
								'keyword2' => array('value' => urlencode($time)),
							  );
					template_news($news_data,2);
					$title = "个人信息已提交，请耐心等待";
					$description = "尊敬的用户您好！我们正在马不停蹄的验证您的信息，请耐心等待";
				}
				$text = <<<json
				{
				    "touser":"$openid",
				    "msgtype":"news",
				    "news":{
				        "articles": [
				         {
				             "title":"$title",
				             "description":"$description",
				         }
				         ]
				    }
				}
json;
				$this->https_request($url,$text);
				$data = '提交成功';
				$this->ajaxReturn($data);
			}
		}
	}
	
	//个人资料界面
	public function info(){
		$t = I('t')? I('t') : 3;
		$this->assign('t',$t);
		$openid = $_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		if(empty($phone)){
			 $this->redirect('Weixin/register');
		}
		$user = D('service');
		$get_user = $user->where($map)->select();
	
		$user_info = D('user_info');
		$info = $user_info->where($map)->select();
		
		$user_work = D('user_work');
		$work = $user_work->where($map)->select();
		
		$user_money_info = D('user_money_info');
		$money = $user_money_info
				->join("haoidcn_payment_list as a ON haoidcn_user_money_info.id=a.user_money_info")
				->where("haoidcn_user_money_info.openid='$openid'")
				->field('haoidcn_user_money_info.*,a.actual_time,a.payment_time,a.wait_xuqi,a.is_repayment,a.huankuan_type,a.appoint_time')
				->order("id desc ")
				->select();
	
		$bank_info = D('bank_info');
		$bank = $bank_info->where($map)->find();
		
		$payment_list = D('payment_list');
		//$id = $payment_list->field("max(id) as id")->where("openid='$openid'")->find();
		
		/* $fang = $payment_list->join("haoidcn_user_money_info as a ON haoidcn_payment_list.openid=a.openid")
							->where("haoidcn_payment_list.user_money_info=a.id")
							
							->find(); */

		$xuesheng = D('xuesheng');
		$xue = $xuesheng->where($map)->find();
		
		
		$cash_coupon = D('user_cash_coupon')->where($map)->select();//优惠券
		
		$this->assign('xuesheng',$xue);
		$this->assign('user',$get_user);
		$this->assign('user_info',$info);
		$this->assign('user_work',$work);
		$this->assign('cash_coupon',$cash_coupon);
		$this->assign('user_money_info',$money);
		$this->assign('bank_info',$bank);
		//$this->assign('fang',$fang);
		$this->display();
	}
	
	//借款详情界面
	public function loan_info(){
		$openid=$_SESSION['openid'];
		$user_money_info_id = I('id');
		
		$user = D('service');
		$get_user = $user->where("openid='$openid'")->select();
		$user_info = D('user_info');
		$info = $user_info->where("openid='$openid'")->select();
		$user_work = D('user_work');
		$work = $user_work->where("openid='$openid'")->select();
		$user_money_info = D('user_money_info');
		$money = $user_money_info->where("id='$user_money_info_id'")->select();
		$bank_info = D('bank_info');
		$bank = $bank_info->where("openid='$openid'")->find();
		$payment_list = D('payment_list');
		if($get_user[0]['is_loan'] == '1'){
			$payment = $payment_list->where("user_money_info='$user_money_info_id' and is_repayment=0")->find();
			$this->assign('payment',$payment);
		}
		$this->assign('user',$get_user);
		$this->assign('user_info',$info);
		$this->assign('user_work',$work);
		$this->assign('user_money_info',$money);
		$this->assign('user_money_info_id',$user_money_info_id);
		$this->assign('bank_info',$bank);
		$this->display();
	}
	
	//给CEO留言
	public function message(){
		$openid = $_SESSION['openid'];
		$service = D('service');
		$phone = $service->where("openid='$openid'")->getField('phone');
		if(empty($phone)){
			$this->redirect('register');
		}
		$this->display();
	}
	
	//添加用户留言到数据库
	public function add_message(){
		$openid = $_SESSION['openid'];
		$phone = D('service')->where("openid='$openid'")->getField('phone');
		$info = I('info');
		$info['phone'] = $phone;
		$user_message = D('user_message');
		$user_message->add($info);
		$data = "添加成功";
		$this->ajaxReturn($data);
	}
	
	//注销页面
	public function logout(){
		$phone = I('phone');
		$this->assign('phone',$phone);
		$this->display();
	}
	
	//注销方法把用户所有的资料清空
	public function logout_method(){
		$phone = I('phone');
		$password = I('password');
		$user = D("service");   //用户表
		$res = $user->where("phone='$phone'")->select();  
		//验证该用户的密码是否正确，正确才能注销
		if($res[0]['password'] == md5($password)){
			$openid = $res[0]['openid'];
			$user->where("phone='$phone'")->delete();
			$user_info = D('user_info');
			$user_info->where("phone='$phone'")->delete();
			$user_work = D("user_work");
			$user_work->where("phone='$phone'")->delete();
			$user_gam = D('user_gam');
			$user_gam->where("phone='$phone'")->delete();
			$user_money_info = D('user_money_info');
			$user_money_info->where("phone='$phone'")->delete();
			$user_mobile = D('user_mobile');
			$user_mobile->where("phone='$phone'")->delete();
			$bank_info = D('bank_info');
			$bank_info->where("phone='$phone'")->delete();
			$payment_list = D('payment_list');
			$payment_list->where("phone='$phone'")->delete();
			$weixin_img = D('weixin_img');
			$weixin_img->where("openid='$openid'")->delete();
			$xuesheng = D('xuesheng');
			$xuesheng->where("phone='$phone'")->delete();
			$access_token = access_token();
			$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
			$text = <<<json
			{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"注销成功",
			             "description":"您好，您已注销成功",
			         }
			         ]
			    }
			}
json;
			$this->https_request($url,$text);
			$data = "注销成功";
			$this->ajaxReturn($data);
		}else{
			$data = "密码错误";
			$this->ajaxReturn($data);
		}
	}
	
	//借款协议界面
	public function agreement1(){
		$agreement = D('agreement');
		$list = $agreement->select();
		$content = htmlspecialchars_decode($list[0]['content']);
		$list[0]['content'] = htmlspecialchars_decode($content);
		$this->assign('conetnt',$list[0]['content']);
		$this->display();
	}
	
	
	//借款服务与隐私协议
	public function agreement(){
		$agreement = D('agreement');
		$list = $agreement->select();
		$content = htmlspecialchars_decode($list[0]['content']);
		$list[0]['content'] = htmlspecialchars_decode($content);
		$this->assign('conetnt',$list[0]['content']);
		$this->display();
	}
	//常见问题界面
	public function problem(){
		$article_problem = D('article_problem');
		$list = $article_problem->select();
		$list2 = $article_problem->where("top=1")->select();
		$this->assign('list',$list);
		$this->assign('list2',$list2);
		$this->display();
	}
	//有奖调研
	public function survey(){
		$openid = $_SESSION['openid'];
		$service = D('service');
		$phone = $service->where("openid='$openid'")->getField('phone');
		if(empty($phone)){
			$this->redirect('register');
		}
		$this->display();
	}
	
	//添加调研资料
	public function add_survey(){
		$openid = $_SESSION['openid'];
		$service = D('service');
		$phone = $service->where("openid='$openid'")->getField('phone');
		$info = array(
				'phone'=>$phone,
				'follow'=>$_POST['follow'],
				'factor'=>$_POST['factor'],
				'money_num'=>$_POST['money_num'],
				'time_length'=>$_POST['time_length'],
				'purpose'=>$_POST['purpose'],
				'problem'=>$_POST['problem'],
				'service'=>$_POST['service'],
				'credit'=>$_POST['credit'],
				'faith'=>$_POST['faith'],
				'bad_faith'=>$_POST['bad_faith'],
				'is_need_money'=>$_POST['is_need_money'],
				'time_lack'=>$_POST['time_lack'],
				'pay_off'=>$_POST['pay_off'],
				'proposal'=>$_POST['proposal'],
				'complain'=>$_POST['complain'],
				'time'=>date("Y-m-d H:i:s",time())
		);
		if(is_array($info)){
			$survey = D('survey');
			$res = $survey->add($info);
			if($res){
				$data = "提交成功";
				$this->ajaxReturn($data);
			}
		}
	}
	
	//未还款界面
	public function overdue(){
		$this->display();
	}
	
	//我要还款界面
	public function loan_details(){
		$id=I('id');//user_money_info ID
		if(empty($id)){
			$this->redirect('info',array('t'=>1));
		}
		$this->assign('id',$id);
		$openid=$_SESSION['openid'];
		$info = D('user_money_info')->where("id='$id'")->find();
		if($info){
			$payment_list = D('payment_list');
			
			$list = $payment_list->where("openid='$openid' and user_money_info='$id'")->find();
			if($list == null){
				$this->redirect('loan_info',array('id'=>$id));
			}else if($list['actual_time'] == null){
				if($info['is_adopt'] == '0'){
					$this->redirect('examine');
					
				}else{
					if($list['wait_xuqi'] == '1' or $list['wait_xuqi'] == '3'){
						$this->redirect('examine');
					}
					$Date_1 = $list['appoint_time'];//约定还款日期
					$Date_2 = date("Y-m-d",time());//当前时间
					$Date_List_a1 = explode("-",$Date_1);
					$Date_List_a2=explode("-",$Date_2);
					$d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
					$d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
					$Days=round(($d1-$d2)/3600/24);
					$is_volume = $Days<-7?1:0;//判断是否在容时期 1不在 0 在
					$volume_interest = M('user_volume')->where('id=1')->getField('interest');//容时期罚金
					$user_overdue = D('user_overdue');//逾期罚金
					$overdue = $user_overdue->find();
					
					$loan_money = D('loan_money');
					$money_num = $list['money_num'];
					$bank = substr($list['bank_num'],15);
					$loan_jine = $loan_money->where("money_num='$money_num'")->select();
					$money = $loan_jine[0]['sum']-$loan_jine[0]['money_num'];
					$money2 =$loan_jine[1]['sum']- $loan_jine[1]['money_num'];
					$this->assign('money',$money);
					$this->assign('money2',$money2);
					$d = $list['appoint_time'];
					$day1 = date('Y-m-d',strtotime("$d +7 day"));
					$day2 = date('Y-m-d',strtotime("$d +14 day"));
					$this->assign('loan_money',$loan_jine);
					$this->assign('overdue',$overdue['interest']);
					$this->assign('sum',$list['sum']);
					$this->assign('days',$Days);
					$this->assign('list',$list);
					
					$this->assign('bank',$bank);
					$this->assign('day1',$day1);
					
					$this->assign('day2',$day2);
					$this->assign('is_volume',$is_volume);
					$this->assign('volume_interest',$volume_interest);
					$this->display();
				}
			}else{
				if($list['wait_xuqi'] == '2' or $list['wait_xuqi'] == '4'){
					if($info['is_adopt'] == '0'){
						$this->redirect('examine');
					}else if($info['is_adopt'] == '1'){
						$payment_list = D('payment_list');
						$list = $payment_list->where("user_money_info='$id'")->find();
						$Date_1=$list['appoint_time'];
						$Date_2=date("Y-m-d",time());
						$Date_List_a1=explode("-",$Date_1);
						$Date_List_a2=explode("-",$Date_2);
						$d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
						$d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
						$Days=round(($d1-$d2)/3600/24);
						$user_overdue = D('user_overdue');
						$overdue = $user_overdue->select();
						$xuqi = D('xuqi');
						$res = $xuqi->select();
						$money = $res[0]['xuqi'];
						$sum = $list['sum'] + $overdue['interest'];
						$this->assign('overdue',$overdue[0]['interest']);
						$this->assign('sum',$sum);
						$this->assign('days',$Days);
						$this->assign('list',$list);
	
						$this->assign('money',$money);
						$this->display();
					}
				}
				
				$this->redirect('loan_info',array('id'=>$id));
			}
		}
	}
	
	
	public function bring(){
		$id = I('id');
		$money = I('money');
		$volume_money = I('volume_money');
		$openid = $_SESSION['openid'];
		$time_length = I('time_length');
		$sum = I('sum');
		$appoint_time = I('appoint_time');
		$type = I('type');
		$aa = I('aa'); //2 银行卡 1支付宝
		$this->assign('id',$id);
		$this->assign('money',$money);
		$this->assign('openid',$openid);
		$this->assign('time_length',$time_length);
		$this->assign('sum',$sum);
		$this->assign('appoint_time',$appoint_time);
		$this->assign('type',$type);
		$this->assign('volume_money',$volume_money);
		
		$admin_data = D('admin_data'); //官方账号
		$result = $admin_data->find();
		$zhifu = $aa==1?$result['account_num']: $result['bank_number'];//官方账号
		
		$this->assign('account_num',$zhifu);
		
		$user_info = D('user_info');   //用户个人信息表
		$list = $user_info->where("openid='$openid'")->select();
		
		$this->assign('list',$list);
		$this->assign('aa',$aa);
		$this->display();
	}
	//全额还款
	public function yes_ok(){
		$money = I('money');
		$id = I('id');
		$service = D('service');
		$openid = $_SESSION['openid'];  //查找出用户的openID信息
		$user_money_info = D('user_money_info');
		$result = $user_money_info->where("id='$id'")->find();
		$time = date("Y-m-d",time());
		$payment_list = D('payment_list');
		
		$list = array(
				'actual_time'=>$time,
				'trade_mode'=>'1',
				'huankuan_type'=>'1',
				'is_repayment'=>1
		);
		$payment_list->where("user_money_info='$id'")->save($list);
		$access_token = access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$text = <<<json
			{
			    "touser":"{$openid}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您{$result['apply_time']}在及时雨微额速达借款{$result['money_num']}元{$result['time_length']}天，已成功还款.
交易时间：$time
交易类型：还款费用结算
交易金额：{$money}元
若有任何疑问请直接微信留言，感谢您的参与与支持",
			         }
			         ]
			    }
			}
json;
		$this->https_request($url,$text);
		$data = "还款成功";
		$this->ajaxReturn($data);
	}
	
	//续期选择支付宝交易
	public function zfb_jy(){
		$money = I('money');
		$id = I('id');
		$aa = I('aa');
		$volume_money = I('volume_money');
		$volume_money = $volume_money ?$volume_money :0;
  		$time_length = I('time_length');
 		$sum = I('sum');
		$trade_mode =$aa==1?2:1;//2 银行卡 1支付宝
 		$info = array(
				'renewal_time'=>$time_length,
				'renewal_money'=>$sum,
 				'trade_mode'=>$trade_mode,
 				'wait_xuqi'=>'1',
 				'huankuan_type'=>'2',
				'volume_money'=>$volume_money
		);
		$payment_list = D('payment_list');
		$payment_list->where("user_money_info='$id'")->save($info);
		
		$data = "支付宝还款";
		$this->ajaxReturn($data);
	}
	
	
	//全额选择支付宝交易
	public function zfb_jy2(){
		$id = I('id');
		$money = I('money');
		$aa = I('aa');
		
		$volume_money = I('volume_money');
		$volume_money = $volume_money ?$volume_money :0;
		$trade_mode =$aa==1?2:1;//2 银行卡 1支付宝
		/*管理员提醒*/
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		
		$name = M('user_info')->where($map)->getField("name");
		
		$news_data= array (
							    'first' =>array('value' => urlencode("您收到了还款申请，请及时进行处理")),
								'keyword1' =>array('value' => urlencode($name)),
								'keyword2' => array('value' => urlencode($money)),
								'keyword3' => array('value' => urlencode("还款")),
								
							  );
		template_news($news_data);
		
		/*END*/
		$payment_list = D('payment_list');
		$payment_list->where("user_money_info='$id'")->setField('trade_mode',$trade_mode);
		$payment_list->where("user_money_info='$id'")->setField('wait_xuqi','3');
		$payment_list->where("user_money_info='$id'")->setField('huankuan_type','1');
		$payment_list->where("user_money_info='$id'")->setField('volume_money',$volume_money);
		$data = "支付宝还款";
		$this->ajaxReturn($data);
	}
	
	public function xuqi(){
		$openid=$_SESSION['openid'];
		$map['openid']=$openid;
		$phone = M('service')->where($map)->getField('phone');
		
	
		$this->assign('phone',$phone);
		$this->assign('openid',$openid);
		$this->display();
	}
	public function is_xuqi(){
		$phone = I('phone');
		$openid = I('openid');
		$payment_list = D('payment_list');
		$payment_list->where("phone='$phone'")->setField('wait_xuqi','2');
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','0');
		$access_token = access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$text = <<<json
			{
			    "touser":"{$openid}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您已成功申请续期.",
			         }
			         ]
			    }
			}
json;
		$this->https_request($url,$text);
		$data = "续期成功";
		$this->ajaxReturn($data);
	}
	//续期费用
	public function yes_ok2(){
		$money = I('money');
		$id = I('id');
		$time_length = I('time_length');
		$sum = I('sum');
		$info = array(
			'time_length'=>$time_length,
			'sum'=>$sum,
			'state'=>'0',
			'is_adopt'=>'0'
		);

		$openid = $_SESSION['openid'];  //查找出用户的openID信息
		$user_money_info = D('user_money_info');
		
		$user_money_info->where("id='$id")->save($info);
		$user_money_info->where("id='$id'")->setInc("is_renewal",1);
		$payment_list = D('payment_list');
		$list = array(
				'trade_mode'=>'1',
				'wait_xuqi'=>'2',
				'huankuan_type'=>'2'
		);
		$payment_list->where("user_money_info='$id'")->save($list);
		$time1 = date("Y-m-d",time());
		$access_token = access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$text = <<<json
			{
			    "touser":"{$openid}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您已成功申请续期.
交易时间：$time1
交易类型：续期服务费结算
交易金额：{$money}元
若有任何疑问请直接微信留言，感谢您的参与与支持",
			         }
			         ]
			    }
			}
json;
		$this->https_request($url,$text);
		$data = "续期成功";
		$this->ajaxReturn($data);
	}
	
	
	public function ziji(){
		$result = template_id_short();
		var_dump($result);
	}
	
	
	//我要推广二维码
	public function code(){
		$access_token = $this->access_token();
		$openid = $this->openid();
		$service = D('service');
		$user = $service->where("openid='$openid'")->select();
		$phone = $user[0]['phone'];
		$uid = $user[0]['id'];
		if($user){
			$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
			$data = <<<json
			{
				"expire_seconds": 604800,
				"action_name": "QR_SCENE",
				"action_info":
				{"scene":
					{"scene_id":$uid}
				}
			}
json;
			$json = $this->https_request($url,$data);
			$code = json_decode($json,true);
			$img =  "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($code["ticket"]);
			$this->assign('phone',$phone);
			$this->assign('img',$img);
			$this->display();
		}else{
			$access_token = $this->access_token();
			$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
			$text = <<<json
    		{
     			"touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"尊敬的用户您好，您还没注册",
			             "description":"先注册，再推广",
			         }
			         ]
			    }
     		}
json;
			$this->https_request($url,$text);
			header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect");
		}
	}
	
	//互看芝麻分的界面
	public function zhima(){
		$this->display();
	}
	/*协议*/
	public function protocol(){
		$openid = $_SESSION['openid'];
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("openid='$openid' and is_adopt=-1")->find();
		$id = $time['id'];
		
		
		$name=M('user_info')->where("openid='$openid'")->getField('name');
    	$loan_info = $user_money_info->where("id='$id'")->find();
		$time = date('Y-m-d H:i:s',time());
		$appoint_time=date('Y-m-d',strtotime("{$time} +{$loan_info['time_length']} day"));//还款日期
		$money=$loan_info['sum']-$loan_info['daozhang'];//综合费用
		$time_length=$loan_info['time_length'];//借款时长
		$this->assign('loan_info',$loan_info);
		$this->assign('money',$money);
		$this->assign('appoint_time',$appoint_time);
		$this->assign('name',$name);
		$this->assign('id',$id);
		$this->display();
	}
	public function protocol_ok(){
		$id = I('id');
		$data['protocol']=1;
		$data['is_adopt']=0;
		
		M('user_money_info')->where("id='$id'")->save($data);
		$this->redirect('alipay',array('id'=>$id));
	}
	//服务合同页面
	public  function fuwuxy(){
		$id = I('id');
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$money_info = D('user_money_info')->where("id='$id'")->find();
	
		$number = strtotime($money_info['apply_time']);
		$where['user_money_info'] = $id;

		$geren = D('user_info')->where($map)->find();
		$this->assign('user_name',$geren['name']);
		$this->assign('riqi',$money_info['apply_time']);
		$this->assign('id',$geren['uid']);
		$this->assign('number',$number);
		$this->display();
	}
	//借款合同界面
	public  function jiekuan(){
		$id = I('id');
		$openid = $_SESSION['openid'];
		$map['openid'] = $openid;
		$user_money_info = D('user_money_info');
		$money_info = $user_money_info->where("id='$id'")->find();
		
		$apply_time = strtotime($money_info['apply_time'])+($money_info['time_length']*3600*24);
		
		$appoint_time=date('Y-m-d',$apply_time);
		$number = strtotime($money_info['apply_time']);//协议编号
		$phone=$money_info['phone'];
		$admin_data = D('admin_data');
		$chujie = $admin_data->find();
		
		$name = "*".substr($chujie['name'],3);
		
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
		$where['user_money_info'] = $id;
		$list = $payment_list->where($where)->find();

		$info = D('user_info');
		$geren = $info->where($map)->find();
		
		
		if(strlen($geren['uid']) == 15){
			$id = substr_replace($geren['uid'],"**********",2,10);
			$this->assign('id',$id);
		}else if(strlen($geren['uid']) == 18){
			$id = substr_replace($geren['uid'],"************",2,12);
			$this->assign('id',$id);
		}
		
		$user_name = "*".substr($geren['name'],3);
		
		$this->assign('user_name',$user_name);
		$bank_info = D('bank_info');
		$bank = $bank_info->where("phone='$phone'")->find();
		$num = substr_replace($bank['bank_num'],"**************",2,10);
		$this->assign('bank',$num);
		$this->assign('phone',$phone);
		$this->assign('riqi',$list);
		$this->assign('number',$number);
		$this->assign('apply_time',$money_info['apply_time']);
		$this->assign('money_info',$money_info);
		$this->assign('appoint_time',$appoint_time);
		$this->display();
	}
	
	
}