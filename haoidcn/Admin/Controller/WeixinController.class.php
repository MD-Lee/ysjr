<?php
namespace Admin\Controller;
use Think\Controller;
class WeixinController extends Controller{
	
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
	//获取用户信息
	public function get_user_info(){
		$access_token = $this->access_token();
		$openid = $this->openid();
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
		$output = $this->https_request($url);
		$array = json_decode($output,true);
		return $array;
	}
	//用户登录界面
	public function login(){
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
		$array = $this->get_user_info();
		if($array['openid'] != null){
			$_SESSION['openid'] = $array['openid'];
		}
		$openid = $_SESSION['openid'];
		$nickname = $array['nickname'];
		$service = D ( 'service' );
		$result = $service->where("openid='$openid'")->select();
		$phone = $result[0]['phone'];
		$user = $service->where ( "phone='$phone'" )->select ();
		$tj = D('tuijian');
		$info = $tj->where("openid='$openid'")->find();
		$tj = $info['tuijian'];
		$id = substr($tj,8);
		$user_tj = $service->where("id='$id'")->find();
		$tuijian = $user_tj['phone'];
		$access_token = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		// 1.判断这个用户存不存在
		if ($user) {
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
								header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
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
								header("Location:http://www.leeyears.com/index.php/Weixin/zhengfeng?phone=$phone&openid=$openid");
							}
						}else if($is_adopt [0] ['is_adopt'] == '-1'){
							$tupian = $weixin_img->where("phone='$phone'")->find();
							//该用户个人信息未填完整
							$res = $payment_list->where("phone='$phone' and is_repayment=0")->select();
							if($res[0]['wait_xuqi'] == '1' or $res[0]['wait_xuqi'] == '3'){
								header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
							}else if($tupian['img1'] == null or $tupian['img2'] == null or $tupian['img3'] == null){
								header("Location:http://www.leeyears.com/index.php/Weixin/zhengfeng?phone=$phone&openid=$openid");
							}else{
								header("Location:http://www.leeyears.com/index.php/Weixin/continue_loan?phone=$phone&openid=$openid");
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
										header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
									}else{
										header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
									}
								} else if ($yinhangka [0] ['is_payment'] == '1') {
									if($yinhangka[0]['condition'] == '1'){
										header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
									}else{
										$actual_time = $payment_list->field("actual_time")->where("phone='$phone' and is_repayment=0")->select();
										if($actual_time){
											header("Location:http://www.leeyears.com/index.php/Weixin/overdue?phone=$phone&openid=$openid");
										}else{
											$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
											$jiekuan = $user_money_info->where("id='{$time['id']}'")->find();
											if($jiekuan['repayment_state'] == 1){
												header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
											}else{
												header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
											}
										}
									}
								} else if ($yinhangka [0] ['is_payment'] == '2') {
									// 该用户银行卡验证失败，跳转到绑定银行卡界面
									$bank_info->where("phone='$phone'")->setField("is_payment",'0');
									header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
								}
							} else {
								// 该用户还未绑定银行卡，跳转到绑定银行卡界面
								header("Location:http://www.leeyears.com/index.php/Weixin/queren_loan?phone=$phone&openid=$openid");
							}
						} else if ($is_adopt [0] ['is_adopt'] == '2') {
							// 该用户未通过审核，跳转到选择借款套餐界面
							header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
						} else if ($is_adopt [0] ['is_adopt'] == '3') {
							// 该用户取消申请，跳转到选择借款套餐界面
							header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
						}
					} else {
						if($is_adopt[0]['is_adopt'] == '3'){
							header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
						}else{
							// 该用户未填写个人信息，跳转到继续借款界面
							header("Location:http://www.leeyears.com/index.php/Weixin/continue_loan?phone=$phone&openid=$openid");
						}
					}
				}else{
					if($is_adopt[0]['is_adopt'] == '3'){
						header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
					}else{
						// 该用户未填服务密码，跳转到继续借款界面
						header("Location:http://www.leeyears.com/index.php/Weixin/continue_loan?phone=$phone&openid=$openid");
					}
				}
			} else {
				// 该用户还没选择借款套餐，跳转到选择借款套餐界面
				header("Location:http://www.leeyears.com/index.php/Weixin/choice_money?phone=$phone&openid=$openid");
			}
		} else {
			// 不存在的话跳到注册页面
			$this->assign('tuijian',$tuijian);
			$this->assign('openid',$openid);
			$this->assign('nickname',$nickname);
			$this->display();
		}
	}
	
	
	//是否继续借款界面
	public function continue_loan(){
		$phone = I('phone');
		$openid = I('openid');
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
	public function message_verify(){
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
		$res = $config->select();
		//$result[0]['phone_target']短信接口网址;$result[0]['phone_user']短信平台账号
		$pass = md5($res[0]['phone_pass']); //短信平台密码
		$content="[E快金]您的验证码是{$verify}";//要发送的短信内容
		$sendurl = $res[0]['phone_target']."sms?u=".$res[0]['phone_user']."&p=".$pass."&m=".$phone."&c=".urlencode($content);

		$result =file_get_contents($sendurl) ;
		$data = $statusStr[$result];
		$this->ajaxReturn($data);
	}
	//提交用户注册接口方法
	public function user_register(){
		$verify = '123123';//$_SESSION['verify'];   //获取到session里面的验证码
		$info = I('info');
		$phone = $info['phone'];
		/*if($phone != $_SESSION['phone']){
			$data = "手机号码不一致";
			$this->ajaxReturn($data);
			exit;
		}*/
		$openid = $info['openid'];
		$info['password'] = md5($info['pwd']);
		$info['time'] = date("Y-m-d H:i:s",time());
		if($info['message_verify'] == $verify){      //把用户输入的验证码和session里面的验证码进行比对
			$user = D('service');    //用户表
			$result = $user->field('phone')->where("phone='$phone'")->select();
			if($result){
				$data = '该用户已存在';
				$this->ajaxReturn($data);
			}else{
				if(is_array($info)){
					$time = date("Y-m-d H:i:s",time());
					$activity = D('activity');
					$re = $activity->field("max(id) as id")->find();
					$res = $activity->where("id='{$re['id']}' and time_start < '$time' and time_end > '$time'")->find();
					if($res != null){
						$access_token = $this->access_token();
						$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
						$text = <<<json
	    	{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"尊敬的用户,您好",
			             "description":"活动期间{$res['time_start']}到{$res['time_end']}，新用户可以获得{$res['money_num']}元优惠卷",
			         }
			         ]
			    }
			}
json;
						$this->https_request($url,$text);
						$info['money'] = $res['money_num'];
					}
					$res2 = $user->add($info);
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
		$phone = I('phone');
		$openid = I('openid');
		$service = D('service');
		$result = $service->where("phone='$phone'")->find();
		$this->assign('activity',$result['money']);
		$loan_money = D('loan_money');   //借款金额信息表
		$list = $loan_money->select();
		$this->assign('list',$list);
		$this->assign('phone',$phone);
		$this->assign('openid',$openid);
		$this->display();
	}
	
	public function loan(){
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
	
	//保存用户借款金额信息接口
	public function user_money_info(){
		$info = array(
				'phone'=>$_POST['phone'],
				'apply_time'=>date("Y-m-d H:i:s",time()),
				'money_num'=>$_POST['money_num'],
				'time_length'=>$_POST['time_length'],
				'letter'=>$_POST['letter'],
				'interest'=>$_POST['interest'],
				'account_money'=>$_POST['account_money'],
				'sum'=>$_POST['sum'],
				'daozhang'=>$_POST['daozhang'],
				'openid'=>$_POST['openid'],
				'repayment_state'=>0
		);
		$user_money_info = D('user_money_info');    //用户借款信息表
 		$phone = $info['phone'];
 		$result = $user_money_info->where("phone='$phone' and is_adopt=-1")->select();
 		if($result){
 			$info['state'] = '0';
 			$info['is_adopt'] = '-1';
 			$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
 			$user_money_info->where("id='{$time['id']}'")->save($info);
 			$data = '下一步';
 			$this->ajaxReturn($data);
 		}else{
 			if(is_array($info)){
 				if(!$user_money_info->create($info)){
 					//如果创建失败，表示验证没有通过，输出错误提示信息
 					exit($user_money_info->getError());
 				}else{
 					$user_money_info->add();
 					$data = '下一步';
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
		$phone = I('phone');
		$openid = I('openid');
		/*查找手机运营商的接口*/
		$ch = curl_init();
		$url = 'http://apis.baidu.com/apistore/mobilephoneservice/mobilephone?tel='.$phone;
		$header = array(
				'apikey: 2f6c440117bc13ccf196baa4b254efbb',//百度API接口给用户提供的秘钥
		);
		// 添加apikey到header
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
	
		$result = json_decode($res,true);
		$user_mobile = D('user_mobile');
		$list = $user_mobile->where("phone='$phone'")->select();
		$this->assign('list',$list);
		$this->assign('result',$result);//把接口得到的数据变量传到页面上显示
		$this->assign('openid',$openid);
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','0');
		$this->display();
	}
	
	//手机认证界面
	public function mobile(){
		$phone = I('phone');
		$openid = I('openid');
		/*查找手机运营商的接口*/
		$ch = curl_init();
		$url = 'http://apis.baidu.com/apistore/mobilephoneservice/mobilephone?tel='.$phone;
		$header = array(
				'apikey: 2f6c440117bc13ccf196baa4b254efbb',//百度API接口给用户提供的秘钥
		);
		// 添加apikey到header
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		
		$result = json_decode($res,true);
		$user_mobile = D('user_mobile');
		$list = $user_mobile->where("phone='$phone'")->select();
		$this->assign('list',$list);
		$this->assign('result',$result);//把接口得到的数据变量传到页面上显示
		$this->assign('openid',$openid);
		$this->display();
	}
	//验证手机界面
	public function verify_mobile(){
		$phone = I('phone');
		$openid = I('openid');
		/*查找手机运营商的接口*/
		$ch = curl_init();
		$url = 'http://apis.baidu.com/apistore/mobilephoneservice/mobilephone?tel='.$phone;
		$header = array(
				'apikey: 2f6c440117bc13ccf196baa4b254efbb',//百度API接口给用户提供的秘钥
		);
		// 添加apikey到header
		curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 执行HTTP请求
		curl_setopt($ch , CURLOPT_URL , $url);
		$res = curl_exec($ch);
		
		$result = json_decode($res,true);
		$user_mobile = D('user_mobile');
		$list = $user_mobile->where("phone='$phone'")->select();
		$this->assign('list',$list);
		$this->assign('result',$result);//把接口得到的数据变量传到页面上显示
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
	//验证手机接口方法
	public function verify_mobile_method(){
		$info = I('info');
		$phone = I('phone');
		$verify = $info['verify'];
		$info['phone'] = $phone;
		if(is_array($info)){
			if(!check_verify($verify)){
				$data = "亲，验证码输错了哦！";
				$this->ajaxReturn($data);
			}else{
				$user_mobile = D('user_mobile');
				$pwd = $user_mobile->where("phone='$phone'")->select();
				if($pwd){
					$user_mobile->where("phone='$phone'")->save($info);
				}else{
					$user_mobile->add($info);
				}
				$data = "下一步";
				$this->ajaxReturn($data);
			}
		}
	}
	
	
	
	//身份认证界面
	public function user_info(){
		$phone = I('phone');
		$user_info = D('user_info');
		$list1 = $user_info->where("phone='$phone'")->select();
		$user_work = D('user_work');
		$list2 = $user_work->where("phone='$phone'")->select();
		$user_gam = D('user_gam');
		$list3 = $user_gam->where("phone='$phone'")->select();
		$xuesheng = D('xuesheng');
		$list4 = $xuesheng->where("phone='$phone'")->select();
		$openid = I('openid');
		$this->assign('openid',$openid);
		$this->assign('phone',$phone);
		$this->assign('list1',$list1);
		$this->assign('list2',$list2);
		$this->assign('list3',$list3);
		$this->assign('list4',$list4);
		$this->display();
	}
	//验证身份界面
	public function verify_user_info(){
		$phone = I('phone');
		$user_info = D('user_info');
		$list1 = $user_info->where("phone='$phone'")->select();
		$user_work = D('user_work');
		$list2 = $user_work->where("phone='$phone'")->select();
		$user_gam = D('user_gam');
		$list3 = $user_gam->where("phone='$phone'")->select();
		$xuesheng = D('xuesheng');
		$list4 = $xuesheng->where("phone='$phone'")->select();
		$openid = I('openid');
		$this->assign('openid',$openid);
		$this->assign('phone',$phone);
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
		$phone = $info['phone'];
		$info['time'] = date("Y-m-d H:i:s",time());
		$user_info = D('user_info');    //用户个人信息表
		$user = $user_info->where("phone='$phone'")->select();
		if($user){
			$user_info->where("phone='$phone'")->save($info);
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
		$phone = $info['phone'];
		$info['province'] = $_POST['province5'];
		$info['city'] = $_POST['city5'];
		$user_work = D('user_work');            //用户工作信息表
		$user = $user_work->where("phone='$phone'")->select();
		if($user){
			$user_work->where("phone='$phone'")->save($info);
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
		$info = I('info');
		$phone = $info['phone'];
		$info['province'] = $_POST['province4'];
		$info['city'] = $_POST['city4'];
		// 取得成功上传的文件信息
		$img = $this->upload();
		if(!empty($img)){
			$info['url'] = $img['img2']['savepath'].$img['img2']['savename'];
		}
		$xuesheng = D('xuesheng');            //用户工作信息表
		$user = $xuesheng->where("phone='$phone'")->find();
		if($user){
			if(empty($user['url'])){
				$data = '请上传学信截图';
				$this->ajaxReturn($data);
				exit;
			}
			$xuesheng->where("phone='$phone'")->save($info);
			$data = '下一页';
			$this->ajaxReturn($data);
		}else{
			if(!empty($info['url'])){
				$xuesheng->add($info);
				$data = '下一页';
				$this->ajaxReturn($data);
			}else{
				$data = '请上传学信截图';
				$this->ajaxReturn($data);
			}
		}
	}
	//添加用户社会关系接口
	public function add_user_gam(){
		$info = I('info');
		$openid = $info['openid'];
		$phone = $info['phone'];
		$user_work = D("user_work");
		$user_info = D("user_info");
		$xuesheng = D('xuesheng');
		$geren = $user_info->where("phone='$phone'")->select();
		$gongzuo = $user_work->where("phone='$phone'")->select();
		$xue = $xuesheng->where("phone='$phone'")->select();
		$user_gam = D('user_gam');        //用户社会关系表
		$user_money_info = D('user_money_info');
		$user = $user_gam->where("phone='$phone'")->select();
		if($geren == null){
			$data = '信息填写不完整';
			$this->ajaxReturn($data);
			exit;
		}else if($user and $geren){
			if($gongzuo){
				$user = D('service');
				$user->where("phone='$phone'")->setField("is_Loan",'0');
				$user_gam->where("phone='$phone'")->save($info);
				$data = '提交';
				$this->ajaxReturn($data);
			}else{
				if($xue){
					$user = D('service');
					$user->where("phone='$phone'")->setField("is_Loan",'0');
					$user_gam->where("phone='$phone'")->save($info);
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
		$phone = I('phone');
		$openid = I('openid');
		$weixin_img = D('weixin_img');
		$result = $weixin_img->where("phone='$phone'")->find();
		$this->assign('res',$result);
		$this->assign('phone',$phone);
		$this->assign('openid',$openid);
		$this->display();
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
	public function upload_img(){
		$info = I('info');
		$openid = $info['openid'];
		$phone = I('phone');
		// 取得成功上传的文件信息
		$img = $this->upload();
		if(!empty($img)){
			$info['img1'] = $img['img1']['savepath'].$img['img1']['savename'];
			$info['img2'] = $img['img2']['savepath'].$img['img2']['savename'];
			$info['img3'] = $img['img3']['savepath'].$img['img3']['savename'];
		}
		$info['time'] = date("Y-m-d",time());
		$user_money_info = D('user_money_info');
		$weixin_img = D('weixin_img');
		$result = $weixin_img->where("phone='$phone'")->find();
		if($result){
			$weixin_img->where("phone='$phone'")->save($info);
		}else if($info['img1'] != null and $info['img2'] != null and $info['img3'] != null){
			$weixin_img->add($info);
		}else if(empty($info['img1']) or empty($info['img2']) or empty($info['img3'])){
			$data = '提交失败,请按照提示上传图片';
			$this->ajaxReturn($data);
			exit;
		}
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','0');
		$access_token = $this->access_token();
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
		$this->https_request($url,$text);
		$data = '提交成功';
		$this->ajaxReturn($data);
	}
	//成功提交审核界面
	public function alipay(){
		$phone = I('phone');
		$service = D('service');
		$result = $service->where("phone='$phone'")->select();
		$openid = $result[0]['openid'];
		$weixin_img = D('weixin_img');
		$img = $weixin_img->where("openid='$openid'")->select();
		if($img[0]['img1'] == null && $img[0]['img2'] == null && $img[0]['img2'] == null){
			$data = "未持证自拍不能进行审核";
			$this->assign('data',$data);
		}
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
		$phone = I('phone');
		$openid = I('openid');
		$user_money_info = D('user_money_info');
		$money = $user_money_info->field('is_adopt')->where("phone='$phone'")->order("id desc")->select();
		$weixin_img = D('weixin_img');
		$payment_list = D('payment_list');
		if($money[0]['is_adopt'] == '0'){
			$img = $weixin_img->where("phone='$phone'")->select();
			$list = $payment_list->where("phone='$phone'")->select();
			if($list[0]['wait_xuqi'] == '2'){
				$data = '8';  //申请续期状态
			}else{
				if($img){
					$data = '1';
				}else{
					$data = '3';
				}
			}
		}else if($money[0]['is_adopt'] == '1'){
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
					$weixin = $weixin_img->where("openid='$openid'")->select();
					if($weixin){
						$data = '4';
					}else{
						$data = "5";
					}
				}
			}
		}else if($money[0]['is_adopt'] == '-1'){
			
			$res = $payment_list->where("phone='$phone'")->select();
			if($res[0]['wait_xuqi'] == '1'){
				$data = '6';  //续期中
			}else if($res[0]['wait_xuqi'] == '3'){
				$data = '7';  //还款中
			}
		}
		$this->assign('data',$data);
		$this->assign('phone',$phone);
		$this->display();
	}
	//借款详情界面
	public function lend_details(){
		$phone = I('phone');
		$user_money_info = D('user_money_info');
		$list = $user_money_info->where("phone='$phone'")->order("id desc")->select();
		$this->assign('list',$list);
		$this->assign('phone',$phone);
		$this->display();
	}
	//取消用户申请接口
	public function cancel_apply(){
		$phone = I('phone');
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$user_money_info->where("id='{$time['id']}'")->setField('is_adopt','3');
		$data = "取消成功";
		$this->ajaxReturn($data);
	}
	//绑定银行卡界面
	public function queren_loan(){
		$card_bank = D('card_bank');     //银行卡名称表
		$bank_name = $card_bank->select();
		$this->assign('bank_name',$bank_name);
		$phone = I('phone');
		$user_info = D('user_info');
		$info = $user_info->where("phone='$phone'")->find();
		$bank_info = D('bank_info');
		$list = $bank_info->where("phone='$phone'")->select();
		$this->assign('list',$list);
		$this->assign('phone',$phone);
		$this->assign('name',$info['name']);
		$this->display();
	}
	
	//把用户的银行卡信息添加到数据库
	public function bank_card(){
		$info = I('info');
		$mingzi = I('name');
		$info['name'] = $mingzi; 
		$phone = $info['phone'];
		$user_info = D('user_info');
		$img = $this->upload();
		if(!empty($img)){
			$info['img'] = $img['img1']['savepath'].$img['img1']['savename'];
		}
		$user = D('service');
		$result = $user->field('openid')->where("phone='$phone'")->select();
		$info['openid'] = $result[0]['openid'];
		$openid = $result[0]['openid'];
		$bank_info = D('bank_info');         //用户银行卡信息表
		if(is_array($info)){
			if(!$bank_info->create($info)){
				//如果创建失败，表示验证没有通过，输出错误提示信息
				exit($bank_info->getError());
			}else{
				$bank = $bank_info->where("phone='$phone'")->find();
				if($bank){
					if(empty($bank['img'])){
						$data = '请上传学信截图';
						$this->ajaxReturn($data);
						exit;
					}
					$info['is_payment'] = "0";
					$info['condition'] = 0;
					$bank_info->where("phone='$phone'")->save($info);
				}else{
					if(!empty($info['img'])){
						$bank_info->add();
					}else{
						$data = '请上传学信截图';
						$this->ajaxReturn($data);
						exit;
					}
				}
				$access_token = $this->access_token();
				$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
				$text = <<<json
				{
				    "touser":"$openid",
				    "msgtype":"news",
				    "news":{
				        "articles": [
				         {
				             "title":"正在验证银行卡，请耐心等待",
				             "description":"尊敬的用户您好！我们正在马不停蹄的验证您的银行卡信息，请耐心等待",
				         }
				         ]
				    }
				}
json;
				$this->https_request($url,$text);
				$data = '放款成功';
				$this->ajaxReturn($data);
			}
		}
	}
	
	//个人资料界面
	public function info(){
		$phone = I('phone');
		$user = D('service');
		$get_user = $user->where("phone='$phone'")->select();
		$user_info = D('user_info');
		$info = $user_info->where("phone='$phone'")->select();
		$user_work = D('user_work');
		$work = $user_work->where("phone='$phone'")->select();
		$user_money_info = D('user_money_info');
		$money = $user_money_info->where("phone='$phone'")->order("id desc ")->select();
		$bank_info = D('bank_info');
		$bank = $bank_info->where("phone='$phone'")->find();
		$payment_list = D('payment_list');
		$id = $payment_list->field("max(id) as id")->where("phone='$phone'")->find();
		$fang = $payment_list->join("haoidcn_user_money_info as a ON haoidcn_payment_list.phone=a.phone")->where("haoidcn_payment_list.id='{$id['id']}'")->find();
		$xuesheng = D('xuesheng');
		$xue = $xuesheng->where("phone='$phone'")->find();
		$this->assign('xuesheng',$xue);
		$this->assign('user',$get_user);
		$this->assign('user_info',$info);
		$this->assign('user_work',$work);
		$this->assign('user_money_info',$money);
		$this->assign('bank_info',$bank);
		$this->assign('fang',$fang);
		$this->display();
	}
	
	//借款详情界面
	public function loan_info(){
		$phone = I('phone');
		$user = D('service');
		$get_user = $user->where("phone='$phone'")->select();
		$user_info = D('user_info');
		$info = $user_info->where("phone='$phone'")->select();
		$user_work = D('user_work');
		$work = $user_work->where("phone='$phone'")->select();
		$user_money_info = D('user_money_info');
		$money = $user_money_info->where("phone='$phone'")->order("id desc ")->select();
		$bank_info = D('bank_info');
		$bank = $bank_info->where("phone='$phone'")->find();
		$payment_list = D('payment_list');
		if($get_user[0]['is_loan'] == '1'){
			$payment = $payment_list->where("phone='$phone' and is_repayment=0")->find();
			$this->assign('payment',$payment);
		}
		$this->assign('user',$get_user);
		$this->assign('user_info',$info);
		$this->assign('user_work',$work);
		$this->assign('user_money_info',$money);
		$this->assign('bank_info',$bank);
		$this->display();
	}
	
	//给CEO留言
	public function message(){
		$openid = I('openid');
		$service = D('service');
		$user = $service->where("openid='$openid'")->select();
		$phone = $user[0]['phone'];
		$this->assign('phone',$phone);
		$this->display();
	}
	
	//添加用户留言到数据库
	public function add_message(){
		$phone = I('phone');
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
			$access_token = $this->access_token();
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
		$this->display();
	}
	
	//添加调研资料
	public function add_survey(){
		$info = array(
				'phone'=>$_POST['phone'],
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
		$openid = $this->openid();
		if($openid != null){
			$_SESSION['openid'] = $openid;
		}
		$user = D('service');
		$result = $user->where("openid='{$_SESSION['openid']}'")->select();
		$phone = $result[0]['phone'];
		$user_money_info = D('user_money_info');
		$info = $user_money_info->where("phone='$phone'")->order("id desc")->select();
		if($result){
			$payment_list = D('payment_list');
			$re = $payment_list->where("phone='$phone' and is_repayment=0")->select();
			if($re == null){
				header("Location:http://www.leeyears.com/index.php/Weixin/loan_info?phone=$phone&openid=$openid");
			}else if($re[0]['actual_time'] == null){
				if($info[0]['is_adopt'] == '0'){
					header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
				}else{
					if($re[0]['wait_xuqi'] == '1' or $re[0]['wait_xuqi'] == '3'){
						header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
					}
					$payment_list = D('payment_list');
					$list = $payment_list->where("phone='$phone' and is_repayment=0")->find();
					$Date_1=$list['appoint_time'];
					$Date_2=date("Y-m-d",time());
					$Date_List_a1=explode("-",$Date_1);
					$Date_List_a2=explode("-",$Date_2);
					$d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
					$d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
					$Days=round(($d1-$d2)/3600/24);
					$user_overdue = D('user_overdue');
					$overdue = $user_overdue->find();
					$loan_money = D('loan_money');
					$money_num = $list['money_num'];
					$bank = substr($list['bank_num'],15);
					$loan_jine = $loan_money->where("money_num='$money_num'")->select();
					$money = $loan_jine[0]['money_num']-$loan_jine[0]['sum'];
					$money2 = $loan_jine[1]['money_num']-$loan_jine[1]['sum'];
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
					$this->assign('phone',$phone);
					$this->assign('bank',$bank);
					$this->assign('day1',$day1);
					$this->assign('day2',$day2);
					$this->display();
				}
			}else{
				if($list[0]['wait_xuqi'] == '2' or $list[0]['wait_xuqi'] == '4'){
					if($info[0]['is_adopt'] == '0'){
						header("Location:http://www.leeyears.com/index.php/Weixin/examine?phone=$phone&openid=$openid");
					}else if($info[0]['is_adopt'] == '1'){
						$payment_list = D('payment_list');
						$list = $payment_list->where("phone='$phone'")->find();
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
						$this->assign('phone',$phone);
						$this->assign('money',$money);
						$this->display();
					}
				}
				header("Location:http://www.leeyears.com/index.php/Weixin/loan_info?phone=$phone&openid=$openid");
			}
		}else{
			header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect");
		}
	}
	
	
	public function bring(){
		$phone = I('phone');
		$money = I('money');
		$openid = I('openid');
		$time_length = I('time_length');
		$sum = I('sum');
		$appoint_time = I('appoint_time');
		$type = I('type');
		$this->assign('phone',$phone);
		$this->assign('money',$money);
		$this->assign('openid',$openid);
		$this->assign('time_length',$time_length);
		$this->assign('sum',$sum);
		$this->assign('appoint_time',$appoint_time);
		$this->assign('type',$type);
		$admin_data = D('admin_data'); //官方账号
		$result = $admin_data->find();
		$zhifu = $result['account_num'];//官方支付宝账号
		$this->assign('account_num',$zhifu);
		$user_info = D('user_info');   //用户个人信息表
		$list = $user_info->where("phone='$phone'")->select();
		$this->assign('list',$list);
		$this->display();
	}
	//全额还款
	public function yes_ok(){
		$money = I('money');
		$phone = I('phone');
		$service = D('service');
		$user = $service->where("phone='$phone'")->find();
		$user_money_info = D('user_money_info');
		$result = $user_money_info->where("phone='$phone'")->order("id desc")->select();
		$time = date("Y-m-d",time());
		$payment_list = D('payment_list');
		$list = array(
				'actual_time'=>$time,
				'trade_mode'=>'1',
				'huankuan_type'=>'1',
				'is_repayment'=>1
		);
		$payment_list->where("phone='$phone'")->save($list);
		$access_token = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$text = <<<json
			{
			    "touser":"{$user['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"交易提醒",
			             "description":"尊敬的用户，您{$result[0]['apply_time']}在e快金借款{$result[0]['money_num']}元{$result[0]['time_length']}天，已成功还款.
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
		$phone = I('phone');
  		$time_length = I('time_length');
 		$sum = I('sum');
 		$info = array(
				'renewal_time'=>$time_length,
				'renewal_money'=>$sum,
 				'trade_mode'=>'2',
 				'wait_xuqi'=>'1',
 				'huankuan_type'=>'2'
		);
		$payment_list = D('payment_list');
		$payment_list->where("phone='$phone'")->save($info);
		$data = "支付宝还款";
		$this->ajaxReturn($data);
	}
	
	
	//全额选择支付宝交易
	public function zfb_jy2(){
		$phone = I('phone');
		$money = I('money');
		$payment_list = D('payment_list');
		$payment_list->where("phone='$phone'")->setField('trade_mode','2');
		$payment_list->where("phone='$phone'")->setField('wait_xuqi','3');
		$payment_list->where("phone='$phone'")->setField('huankuan_type','1');
		$data = "支付宝还款";
		$this->ajaxReturn($data);
	}
	
	public function xuqi(){
		$phone = I('phone');
		$openid = I('openid');
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
		$access_token = $this->access_token();
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
		$phone = I('phone');
		$time_length = I('time_length');
		$sum = I('sum');
		$info = array(
			'time_length'=>$time_length,
			'sum'=>$sum,
			'state'=>'0',
			'is_adopt'=>'0'
		);
		$service = D('service');
		$user = $service->where("phone='$phone'")->find();  //查找出用户的openID信息
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$user_money_info->where("id='{$time['id']}'")->save($info);
		$user_money_info->where("id='{$time['id']}'")->setInc("is_renewal",1);
		$payment_list = D('payment_list');
		$list = array(
				'trade_mode'=>'1',
				'wait_xuqi'=>'2',
				'huankuan_type'=>'2'
		);
		$payment_list->where("phone='$phone'")->save($list);
		$time1 = date("Y-m-d",time());
		$access_token = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$text = <<<json
			{
			    "touser":"{$user['openid']}",
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
	//借款合同界面
	public  function jiekuan(){
		$phone = I('phone');
		$user_money_info = D('user_money_info');
		$time = $user_money_info->field("max(id) as id")->where("phone='$phone'")->find();
		$money_info = $user_money_info->where("id='{$time['id']}'")->find();
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
		$num = substr_replace($bank['bank_num'],"**************",0,16);
		$this->assign('bank',$num);
		$this->assign('phone',$phone);
		$this->assign('riqi',$list);
		$this->assign('money_info',$money_info);
		$this->display();
	}
}