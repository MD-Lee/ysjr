<?php 
namespace Org\Lm;
define("BIZTYPE", "mobile");//采集类型
define("METHOD", "api.mobile.get");//接口名称
define("APIURL","https://t.limuzhengxin.cn/api/gateway");//接口名称
define("APPKEY","7788566276865220");//!!!需自行设定!!!
define("SECRET","9Yneo5bTwDY1e5kmkntZxMlgE5qr6eTs");//!!!需自行设定!!!
define("VERSION","1.2.0");
define("CALLBACKUTL","");//回调函数非必填
define("CARDNO","");//查询用户的身份证号非必填
define("NAME","");//查询用户的真实姓名非必填
define("CONTENTTYPE","all");//查询指定内容 //!!!需自行设定!!!
define("OTHERINFO",""); //!!!需自行设定!!!
define("COUNTS" ,"50");//尝试次数
define("SCOUNTS" ,"10");//间隔时间

class Lm{
	public function process($username,$password){


	//运营商采集参数
	$params = array(
		"method" => METHOD,
		"apiKey" => APPKEY,
		"username" => $username,
		"password" => $password,
		"contentType" => CONTENTTYPE,
		"otherInfo" => OTHERINFO,
		"callBackUrl" => CALLBACKUTL,
		"identityCardNo" => CARDNO,
		"identityName" => NAME
	);

	//生成参数字符串
	$paramString = $this->getParamString($params);

	//提交请求
	$content = $this->curl(APIURL,$paramString,1);
	$result = json_decode($content,true);
		if($result){
  
			//受理成功的情况
			if($result['code'] =='0010'){
			// myEcho("该请求受理成功");

				//请求成功获取token
				$token = $result['token'];

				//运营商采集状态参数
				$params = array(
					"method" => "api.common.getStatus",
					"apiKey" => APPKEY,
					"bizType" => BIZTYPE,
					"token" => $token
				);

				//生成参数字符串
				$paramString = $this->getParamString($params);
				$i = 1;
				do{
					//myEcho("轮循第【".$i."】次 start");
					$return_resuly=$this->roundRobin($token, $paramString);
					//轮训获取结果
					if($return_resuly['re']){
						$res['msg']=$return_resuly['msg']?$return_resuly['msg']:'';
						$res['code']=$return_resuly['code']?$return_resuly['code']:'';
						
						return $res;
						//myEcho("轮循 end");
						//myEcho("获取信息结束");
						break;
					}
					//myEcho("轮循第【".$i++."】次 end");

					ob_flush();
					flush();
					sleep(SCOUNTS);
					$count=COUNTS;
					if($count-- <= 0){
						$res['msg']="获取信息结束。没有获取到数据";
						return $res;
						//myEcho("获取信息结束。没有获取到数据");
						break;
					}
				}
				while(1);
				

			}else{
				return $res['msg']='正在努力请求';
				//myEcho($result['code'].":".$result['msg']);
			}
		}else{
			return $res['msg']='请求失败，请等会再尝试';
			//myEcho("请求失败");
		}
	//return $result;
	}
	//设定请求参数(加密生成sign并生成请求字符串)
	public function getParamString($params){

	

		//计算签名
		$paramsSign = $params;
		$paramsSign['version'] =VERSION.SECRET;

		//按照key排序
		ksort($paramsSign);

		//echo(urldecode(http_build_query($paramsSign)))."</br>";
		//加密获取sign
		$sign=sha1(urldecode(http_build_query($paramsSign)));//对该字符串进行 SHA-1 计算，得到签名，并转换成 16 进制小写编码
		
		
		//设置请求参数
		$params['version'] = VERSION;
		$params['sign'] = $sign;

		$paramString = http_build_query($params);

		return $paramString;
	}


	//轮训获取结果
	public function roundRobin($token, $paramstring){

	
		//状态查询
		$json = $this->curl(APIURL, $paramstring,1);
		$result = json_decode($json, true);

		$code = $result['code'];
		$msg = $result['msg'];
		$token = $result['token'];
			
		//$this->myEcho("<pre>");
		//$this->myEcho("循环取的状态:".$code."");
		//$this->myEcho("循环取的信息:");
		//$this->myEcho($json);

		if(!isset($code) || empty($code)) {
			//未取到结果集.继续轮训
			return $new_result['re'] = false;
			//return false;
		}
		
		//0开头标处理成功相关
		if ($this->startWith($code, "0")) {

			if ("0100" == $code) {//登陆成功
				//$this->myEcho("对象结果查询 >>>>>" + $msg);
				return $new_result['re'] = false;
				//return false;
			} else if ("0006" == $code) {//等待输入信息
				/*new add*/
				$new_result['re'] = true;
				$new_result['msg'] = '';
				$new_result['code'] = '';
				return $new_result;
				
				/*new add end*/
				
			} else if ("0000" == $code) {//成功
				//$this->myEcho("对象结果查询 >>>>>");
				//发送对象结果查询
				//$this->getData($token);
				$new_result['re'] = true;
				return $new_result;
				//return true;
			}
			//其他情况继续轮训
			else {
				$new_result['re'] = false;
				return $new_result;
				//return false;
			}
		}
		
		$new_result['code'] = $result['code'];
		
		$new_result['msg'] = $result['msg'];
		
		$new_result['re'] = true;
		
		//其他异常停止循环s
		return $new_result;
		//return true;
	}

	//等待输入信息
	public function sendInput($token){

		//global APPKEY,APIURL;
		
		$file = $token.'_input.txt';
		file_put_contents($file, "");
		//$this->myEcho($file."-文件创建成功。请在文件内输入上述提示信息");
		$input = "";
		try{
			do{
			$input = file_get_contents($file);
			ob_flush();
			flush();
			sleep(2);
			}while(empty($input));
		}catch(Exception $ex){
			//$this->myEcho("等待输入信息超时");
		}
		

		//$this->myEcho("您输入的信息为：".$input);
		@unlink ($file);

		//发送短信参数
		$params = array(
		  "method" => "api.common.input",
		  "apiKey" => APPKEY,
		  "token" => $token,
		  "input" => $input
		);

		$paramstring = getParamString($params);

		//获取结果
		$json = $this->curl(APIURL, $paramstring,1);
		
		//$this->myEcho("<pre>");
		//$this->myEcho($json);
		return $json;
	}

	//获取结果集
	public function getData($token) {

		//global APIURL,APPKEY,$version,SECRET,BIZTYPE;
		$METHODMe = "api.common.getResult";
		$params = array(
			  "method" => $METHODMe,
			  "apiKey" => APPKEY,
			  "token"=>$token,
			  "bizType" => BIZTYPE
			);
		$paramstring = $this->getParamString($params);

		//获取结果
		$json = $this->curl(APIURL, $paramstring,1);
		
		//$this->myEcho("<pre>");
		//$this->myEcho($json);

	}

	//第一个是原串,第二个是 部份串
	public function startWith($str, $needle) {
		return strpos($str, $needle) === 0;
	}

	//请求接口返回内容
	public	function curl($url,$params=false,$ispost=0){
		$httpInfo = array();
		$ch = curl_init();
	 
		curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
		curl_setopt( $ch, CURLOPT_USERAGENT , 'limuzhengxin.com' );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
		curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		if( $ispost )
		{
			curl_setopt( $ch , CURLOPT_POST , 1 );
			curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
			curl_setopt( $ch , CURLOPT_URL , $url );
		}
		else
		{
			if($params){
				curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
			}else{
				curl_setopt( $ch , CURLOPT_URL , $url);
			}
		}
		$response = curl_exec( $ch );
		if ($response === FALSE) {
			myEcho("cURL Error: " . curl_error($ch));
			return false;
		}
		$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
		$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
		curl_close( $ch );
		return $response;
	}


	//显示日志并记录
	public function myEcho($str){

	global $log;

	$str = $str."</br>";
	print_r($str);
	$log .= $str;
}

}
	