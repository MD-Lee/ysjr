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
		$redirect_uri='http://'.$_SERVER['HTTP_HOST'];
		$access_token = access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		
		$data = <<<json
		 {
			"button":[
			{
	           "name":"主功能",
			   "sub_button":[
			   {
					"type":"view",
					"name":"及时雨",
					"url":"$redirect_uri/index.php/Weixin/choice_money"
			
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
					"url":"$redirect_uri/index.php/Weixin/agreement1"
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
	           		"url":"$redirect_uri/index.php/Weixin/loan_details"
				},
				{
	               "type":"view",
	               "name":"我的借款",
	               "url":"$redirect_uri/index.php/Weixin/info/t/1"
	            },
				{
	               "type":"view",
	               "name":"优惠券",
	               "url":"$redirect_uri/index.php/Weixin/info/t/2"
	            },
				 {
                    "type": "pic_sysphoto", 
                    "name": "持证自拍", 
                    "key": "rselfmenu_1_0", 
                   "sub_button": [ ]
                 }
				]
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
	               "url":"$redirect_uri/index.php/Weixin/problem"
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
		$output = https_request($url,$data);
		echo $output;
	}
	
	
	
}