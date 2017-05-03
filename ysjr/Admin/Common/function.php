<?php


function check_verify($code, $id = ""){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

// 发送邮箱
function Email($address,$title,$message){
	
	import('Org.Util.Mail');
	$mail_f = SendMail($address,$title,$message);			//发给谁，标题，内容 ，发件人
	return $mail_f;
}

//发送手机短信
function Mobile($mobile,$content,$send_code=''){	//号码，验证码，信息内容，

	$config_phone = D("config")->find();
	
	$target = $config_phone['phone_target'];
	$user = $config_phone['phone_user'];
	$pass = $config_phone['phone_pass'];
	
	
	//发送
	$post_data = "account=".$user."&password=".$pass."&mobile=".$mobile."&content=".$content;
	
	//密码可以使用明文密码或使用32位MD5加密
	$Mobile_s = new \Org\Util\Mobile();
	
 	$gets = $Mobile_s->xml_to_array($Mobile_s->Post($post_data, $target));
 	
	return $gets['SubmitResult']['code']; 
}

// 上传图片
function Upload_f(){

	$upload = new \Think\Upload();								// 实例化上传类
	$upload -> maxSize   =     3145728 ;							// 设置附件上传大小
	$upload -> exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	$upload -> rootRath  =     './Uploads/';
	$upload -> savePath  =     './Public/Uploads/'; 				// 设置附件上传目录
	
	return $upload->upload();
}


//截取中文定
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
	if(function_exists("mb_substr")){
		if($suffix)
			return mb_substr($str, $start, $length, $charset)."...";
		else
			return mb_substr($str, $start, $length, $charset);
	}elseif(function_exists('iconv_substr')) {
		if($suffix)
			return iconv_substr($str,$start,$length,$charset)."...";
		else
			return iconv_substr($str,$start,$length,$charset);
	}
	$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
	$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
	$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
	$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}

//定时器
function timer(){
	
	$office_date = D('time')->find();		//工作 时间
	$begin_time = str_replace(":","",$office_date['begin_time']);		//上班时间
	$end_time = str_replace(":","",$office_date['end_time']);			//下班时间
	$dan_time = str_replace(":","",date("H:i",time()));					//当前时间
	$begin_beputtime = $office_date['begin_beputtime'];					//开始放假时间
	$end_beputtime = $office_date['end_beputtime'];						//结束放假时间
	

	//判断上班时间
	if(time() < $begin_beputtime || time() > $end_beputtime){
		if($dan_time >= $begin_time && $dan_time <= $end_time and (date("w") != "0" or date("w") != '6')){		//判断上班时间以级周六日
			//查询所有客户的id
			$list = D("user")->where("limits='3'")->select();
			$uid_q = "";
			foreach ($list as $k=>$value){
				$uid_q .= $value['id'].',';
			}
			$uid_q = rtrim($uid_q,',');
			
			
			
			$list = D("Work")->where(" wc_sataus='1' or wc_sataus='2'")->select();		//查询工单
// 			echo D("Work")->getLastSql();
			$data = array(
					"tz_status"		=> '1',
			);

			foreach ($list as $key=>$val){

				$user = D("user")->where("id='".$val['uid']."'")->find();			//查看客户
				$service = D("service")->where("id='".$user['sid']."'")->find();	//查看售后

				if($val['tz_status'] == '-1'){
					
					$E = Email($service["email"],"新工单通知","亲爱的：".$service["uname"]."同事，".$user["uname"]."这位客户已提交新工单，工单标题为：".$val['title']."。请及时查看，并且处理。",C('MAIL_FROMNAME'));
					$M = Mobile($service["phone"],'亲爱的：'.$service["uname"].'同事。'.$user["uname"].'这位客户已提交新工单，工单标题为："'.$val['title'].'"。请及时查看，并且处理。');
					
					$E = Email($user["email"],"工单处理中通知","尊敬的客户：".$user["uname"]."。您好！您的工单标题为：“".$val['title']."”正在处理中，请耐心等候。",C('MAIL_FROMNAME'));
					$M = Mobile($user["phone"],'尊敬的客户：'.$user['uname'].'。您好！您的工单标题为：“'.$val['title'].'”正在处理中，请耐心等候。');
					
					D("work")->where("id='".$val['id']."'")->setField($data);
				}else{
					$addwork = D("addwork")->where("pid='".$val['id']."' and tz_status='-1' and uid='$uid_q'")->select();	//查看追加表
					foreach ($addwork as $key=>$a_val){	
						$E = Email($service["email"],"工单追加通知","亲爱的：".$service["uname"]."同事，".$user["uname"]."这位客户的工单标题为：“".$val['title']."” 已有最新追加，请及时查看，并且处理。",C('MAIL_FROMNAME'));
						$M = Mobile($service["phone"],'亲爱的：'.$service['uname'].'同事。'.$user['uname'].'这位客户的工单标题为：“'.$val['title'].'”已有最新追加。请及时查看，并且处理。');
						D("addwork")->where("id='".$a_val['id']."'")->setField($data);
					}
				}
			}
		}
	}
}

function weixin(){
	$weixin['appid'] = "wxef4d12ae0a86b2ad";
	$weixin['secret'] = "b34b07704e430baf2e97f357d519af64";
	return $weixin;
}

//curl方法
function https_request($url,$data = null){
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
function access_token(){
	newaccess_token();
	$condition['id']=1;
	$ret = M('wxch_config')->where($condition)->find();
	$access_token = $ret['access_token'];
	return  $access_token;
}

function template_id_short(){
	$access_token = access_token();
	$url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=".$access_token;
	$data = <<<json
	  {
           "template_id_short":"TM00015"
       }
json;
	$output = https_request($url,$data);
	$array = json_decode($output,true);
	return $array;
}


function template_news($data,$type=0,$newid){
	if($newid){
		$openid =$newid;
	}else{
		$admin_info = M('admin_data')->join("haoidcn_service as a ON haoidcn_admin_data.mobile=a.phone")->where("haoidcn_admin_data.id=1")->field('a.openid')->find();
		$openid = $admin_info['openid'];
	}
	
	$type = $type ?$type:0;
	if(!empty($openid)){
		/*1 借款模板 0还款模板 2 资料提交成功提醒*/
		switch ($type)
            {
                case "1":
                    $template_id = 'EaBjt7-3zIkbL7g88ZhRvXVvYPxMvTmrJyyiMnfz3L8';
                    break;
                case "2":
                    $template_id = 'SsRnIl6PMVwpQxyfnpdFlPfVxWpZW_YG0dpkYMRzSGw';
                    break;
                case "0":
                     $template_id = 'a2Awcz5bDzxmb3er7a8UTNktfDurEMRRwnyAUip3BJ4';
                    break;
				case "5":
                     $template_id = '7g30nXUsSluSoRll-QCOO51FFjEh-p-6hWuUMkYfDac';
                    break;
                default:
                    $template_id = "";
                    break;
            }
		//$template_id=$type?'EaBjt7-3zIkbL7g88ZhRvXVvYPxMvTmrJyyiMnfz3L8':'a2Awcz5bDzxmb3er7a8UTNktfDurEMRRwnyAUip3BJ4';
		$sendata =array (
				'touser' =>"".$openid."",
				'template_id' =>"$template_id",
				'url' =>'',
				'data' =>$data
				);
		$access_token = access_token();
		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
		$sendata=urldecode(json_encode($sendata));
		$res=https_request($url,$sendata);
		
	}
	
}
function newaccess_token(){
			/*配置信息查询*/
			$condition['id']=1;
			$ret=M("wxch_config")->where($condition)->find();
			
			$appid = $ret['appid'];
			$appsecret = $ret['appsecret'];
			$dateline = $ret['dateline'];
			$time = time();
		
        if(($time - $dateline) > 7200){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$ret_json = https_request($url);
			$ret = json_decode($ret_json);
            if($ret -> access_token){
			/*更新配置信息*/
			$data['id']=1;
			$data['access_token']=$ret->access_token;
			$data['dateline']=$time;
			M('wxch_config')->save($data);
            }
        }elseif(empty($access_token)){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$ret_json = https_request($url);
			$ret = json_decode($ret_json);
			if($ret->access_token){
			/*更新配置信息*/
			$data['id']=1;
			$data['access_token']=$ret->access_token;
			$data['dateline']=$time;
			M('wxch_config')->save($data);

			}
		}
		return $access_token;
    }
function  new_get_user_info($redirect_uri){
		    $condition['id']=1;
			$app=M("wxch_config")->where($condition)->find();
			$appid= $app['appid'];
			$appsecret = $app['appsecret'];
			$state = 'wechat';
			$scope = 'snsapi_base';
			// $scope = 'snsapi_userinfo';
			if($_GET['code']){
				$code = $_GET['code'];
				$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
				$ret_json = https_request($url);
				$ret = json_decode($ret_json);
				$openid = $ret->openid;
				session('openid',$openid);
			}else{		
				$oauth_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $redirect_uri . '&response_type=code&scope=' . $scope . '&state=' . $state . '#wechat_redirect';
				goheader($oauth_url);
			}
		 
	 }



 function goheader($oauth_url){
	    header('Expires: 0');
	    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	    header('Cache-Control: no-store, no-cahe, must-revalidate');
	    header('Cache-Control: post-chedk=0, pre-check=0', false);
	    header('Pragma: no-cache');
	    header("HTTP/1.1 301 Moved Permanently");
	    header("Location: $oauth_url");
	    exit;
	}
	
function newdownloadWeixinFile($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        curl_close($ch);
        $imageAll = array_merge(array('header' => $httpinfo), array('body' => $package));
        return $imageAll;
    }
function validate_bank($bank_num,$name,$bank_id_number,$bank_mobile){
		//银行卡四要素验证  bank_num 银行卡号   name 姓名  bank_id_number 身份证号  bank_mobile 预留手机号
		$url = "http://api.jisuapi.com/bankcardverify4/verify?appkey=f21fab567be0a064&bankcard=".$bank_num."&realname=".$name."&idcard=".$bank_id_number."&mobile=".$bank_mobile;
		$result = https_request($url);
		$jsonarr = json_decode($result, true);
		if($jsonarr['status'] != 0){
			//echo $jsonarr['msg'];
			//$data = '抱歉，银行卡号校验不一致！请检查各项信息是否正确';
			return	false;
		}else{
			return	true;
		}	
}

function validate_mobile($name, $idcard, $mobile){
	//手机实名认证  姓名  身份证号  手机号
	$url = "http://api.jisuapi.com/mobileverify/verify?appkey=f21fab567be0a064&realname=".$name."&idcard=".$idcard."&typeid=1&mobile=".$mobile;
	$result = https_request($url);
	$jsonarr = json_decode($result, true);
	if($jsonarr['status'] != 0){
		if(in_array($jsonarr['status'],array(101,102,103,104,105,106,107,108))){
			/*系统错误*/
			return	3;
		}else{
			/*信息不符合*/
			return	2;
		}
	}else{
		return	1;
	}	
}

function remind(){
	$where['is_overdue'] = 0;
	$where['is_repayment'] = 0;
	
	$time = date('Y-m-d',time());
	$list = M('payment_list')->where($where)->select();
	
	foreach($list as $v){
		$atime = strtotime($v['appoint_time']);
		$start=$atime-60*60*24;
		$btime = time();
		
		if($btime>$start){
			$news_data= array (
							    'first' =>array('value' => urlencode("马上就到还款日期了")),
								'keyword1' =>array('value' => urlencode("还款提醒")),
								'keyword2' => array('value' => urlencode("尊敬的客户")),
								'keyword3' => array('value' => urlencode("马上就到还款日期了")),
								'keyword4' =>array('value' => urlencode($time)),
							  );
							 
			template_news($news_data,5,$v['openid']);
		}
		
	}
}