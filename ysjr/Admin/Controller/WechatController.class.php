<?php
namespace Admin\Controller;
use Think\Controller;
class WechatController extends Controller{
	public function index(){
        $weixins = new \Org\Wechat\Wechat();
        $weixins->valid();
        $weixins->responseMsg();
    }	
	//自定义菜单
	public function menu(){
		$access_token = $this->access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		
		$data = <<<json
		 {
			"button":[
			{
	           "name":"主功能",
			   "sub_button":[
			   {
					"type":"view",
					"name":"十万火急借款",
					"url":"http://ysjr.9xgk.com/index.php/Weixin/loan"
			
				},
				{
					"type":"click",
					"name":"手机认证",
					"key":"V01"
				},
				{
					"type":"click",
					"name":"身份认证",
					"key":"V02"
				},
				{
					"type":"view",
					"name":"法律责任",
					"url":"http://ysjr.9xgk.com/index.php/Weixin/agreement1"
				}]
		    },
			{
	           "name":"我",
			   "sub_button":[
				{
					"name":"个人资料",
					"type":"click",
	           		"key":"V08"
				},
				{
					"name":"我要还款",
					"type":"view",
	           		"url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://ysjr.9xgk.com/index.php/Weixin/loan_details&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
				},
				{
	               "type":"view",
	               "name":"我要推广",
	               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://ysjr.9xgk.com/index.php/Weixin/code&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
	            }]
		    },
			{
	           "name":"更多服务",
	           "sub_button":[
	           {	
	               "type":"click",
	               "name":"有奖调研",
	               "key":"V04"
	            },
	            {
	               "type":"view",
	               "name":"常见问题",
	               "url":"http://ysjr.9xgk.com/index.php/Weixin/problem"
	            },
	            {
	               "type":"click",
	               "name":"联系客服",
	               "key":"V05"
	            },
	            {
	               "type":"click",
	               "name":"留言给CEO",
	               "key":"V06"
	            }]
		    }]
		 }
json;
		$output = $this->https_request($url,$data);
		echo $output;
	}
	
	
	
}