<?php
namespace Admin\Controller;
use Think\Controller;
class CronController extends Controller{
	
	//curl方法
	public function https_request($url,$data = null)
	{
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
		$output = $this->https_request($url,$arr);
		$array = json_decode($output,true);
		$access_token = $array['access_token'];
		return  $access_token;
	}
	
	public function dingshi(){
		$daoqi = D('daoqi');
		$res = $daoqi->select();
		$days = $res[0]['days'];
		$payment_list = D('payment_list');
		$date = date("Y-m-d",time());
		$time = date("Y-m-d",strtotime("$date +$days day"));  //当前时间
		$result = $payment_list->where("appoint_time='$time'")->select();
		foreach ($result as $value){
				//当时间和约定还款时间一样，就给用户推送一条消息通知用户
				$access_token = $this->access_token();
				$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
				$text = <<<json
	    	{
			    "touser":"{$value['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"尊敬的用户，您的借款快到期了",
			             "description":"您的借款与{$value['appoint_time']}到期,请尽快还款",
			         }
			         ]
			    }
			}
json;
			$this->https_request($url,$text);
		}
	}
	
	public function yuqi(){
		$payment_list = D('payment_list');
		$result = $payment_list->where("is_overdue=1 and is_repayment=0")->select();
		foreach ($result as $value){
			//给逾期的用户发送信息
			$access_token = $this->access_token();
			$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
			$text = <<<json
	    	{
			    "touser":"{$value['openid']}",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"尊敬的用户，您已经逾期了",
			             "description":"您的借款已经逾期{$value['yuqi_time']}天了,请尽快还款",
			             "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/loan_details&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
			         }
			         ]
			    }
			}
json;
			$this->https_request($url,$text);
		}
	}
}