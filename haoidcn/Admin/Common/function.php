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
	$weixin['appid'] = "appid";
	$weixin['secret'] = "appsecret";
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
	$weixin = weixin();
	$appid = $weixin['appid'];
	$secret = $weixin['secret'];
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
	$output = https_request($url);
	$array = json_decode($output,true);
	$access_token = $array['access_token'];
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