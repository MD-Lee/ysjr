<?php
namespace Org\Wechat;
define("TOKEN", "q0I07jGMQZ4S3TjJ3440wJ7q4qQnPW9t");
class Wechat{

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    public function responseMsg(){
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            switch ($RX_TYPE)
            {
                case "text":
                    $resultStr = $this->receiveText($postObj);
                    break;
                case "image":
                    $resultStr = $this->receiveImage($postObj);
                    break;
                case "event":
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                default:
                    $resultStr = "";
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }


    function receiveImage($object){
        $FromUserName = trim($object->FromUserName);
        $CreateTime = date("Y-m-d H:i:s",time());
        $PicUrl = trim($object->PicUrl);
        $MediaId = trim($object->MediaId);
        $service = D('service');
        $list = $service->where("openid='$FromUserName'")->select();
        $phone = $list[0]['phone'];
        if($phone){
            $access_token = $this->access_token();
            $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$MediaId;
            $fileInfo = $this->downloadWeixinFile($url);
            //判断目录是否存在，是的话创建
            $img_url = "./Uploads/".date("Y-m-d",time());
            is_dir("$img_url") || mkdir("$img_url");
            //判断图片是否存在，是的话创建
            $img_url = $img_url."/".time().".".rand(1,9999).".jpg";
            file_exists("$img_url") || file_put_contents("$img_url",$fileInfo['body']);

            $info = array(
                'openid'=> $FromUserName,
                'phone'=> $phone,
                'time'=> $CreateTime,
                'img_url'=> $img_url,
            );
            $weixin_img = D('weixin_img');
            $img = $weixin_img->where("openid='$FromUserName'")->select();
            if($img){
                $user_money_info = D('user_money_info');
                $result = $user_money_info->where("phone='$phone'")->order("id desc")->select();
                if($result[0]['is_adopt'] == '-1' or $result[0]['is_adopt'] == '2' or $result[0]['is_adopt'] == '3'){
                    $info['is_adopt'] = '0';
                    $weixin_img->where("openid='$FromUserName'")->save($info);
                }
            }else{
                $weixin_img->add($info);
            }

            $arr_item[] = array(
                "Title" =>"资料上传成功",
                "Description" =>"尊敬的用户您好，你的资料已经上传成功到我们的后台审核系统，我们的审核人员会尽快与您联系，感谢您对e快金的支持和厚爱！",
                "PicUrl" =>"$PicUrl"
            );
            $itemTpl = "    <item>
						        <Title><![CDATA[%s]]></Title>
						        <Description><![CDATA[%s]]></Description>
						        <PicUrl><![CDATA[%s]]></PicUrl>
						    </item>
						";
            $item_str = "";
            foreach ($arr_item as $item)
                $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl']);

            $newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<Content><![CDATA[]]></Content>
				<ArticleCount>%s</ArticleCount>
				<Articles>
				$item_str</Articles>
				<FuncFlag>%s</FuncFlag>
				</xml>";

            $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
            return $resultStr;
        }else{
            $access_token = $this->access_token();
            $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
            $text = <<<json
	    	{
			    "touser":"$FromUserName",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"尊敬的用户您尚未注册",
			             "description":"请注册完再持证自拍上传资料",
			         }
			         ]
			    }
			}
json;
            $this->https_request($url,$text);
        }

    }

    function receiveEvent($object)
    {
        $FromUserName = $object->FromUserName;
        $user = D('service');
        $user_id = $user->where("openid='$FromUserName'")->find();
        $phone = $user_id['phone'];
        $user_money_info = D('user_money_info');
        $result = $user_money_info->where("openid='$FromUserName'")->order("id desc")->select();
        $user_mobile = D('user_mobile');
        $pwd = $user_mobile->where("phone='$phone'")->select();
        $user_info = D('user_info');
        $info = $user_info->where("openid='$FromUserName'")->select();
        $user_work = D('user_work');
        $work = $user_work->where("openid='$FromUserName'")->select();
        $user_gam = D('user_gam');
        $gam = $user_gam->where("openid='$FromUserName'")->select();
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "欢迎关注e快金";
                $tuijian = trim($object->EventKey);
                if ($tuijian != null){
                    $tuijian = trim($object->EventKey);
                    $access_token = $this->access_token();
                    $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
                    $text = <<<json
			    	{
					    "touser":"$FromUserName",
					    "msgtype":"news",
					    "news":{
					        "articles": [
					         {
					             "title":"推荐码",
					             "description":"{$tuijian}",
					         }
					         ]
					    }
					}
json;
                    $this->https_request($url,$text);
                    $time = date("Y-m-d",time());
                    $openid = trim($FromUserName);
                    $tj = D('tuijian');
                    $tuijian_info = array(
                        'time'=>$time,
                        'tuijian'=>$tuijian,
                        'openid'=>$openid
                    );
                    $list = $tj->where("openid='$openid'")->select();
                    if($list){
                        $tj->where("openid='$openid'")->save($tuijian_info);
                    }else{
                        $tj->add($tuijian_info);
                    }
                }
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    case "V01":
                        if($user_id == null){
                            $contentStr[] = array(
                                "Title" =>"注册",
                                "Description" =>"尊敬的用户，您尚未注册，无法使用本功能,点击<查看全文>进行注册",
                                "Url" =>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                            );
                        }else if($pwd  == null){
                            $contentStr[] = array(
                                "Title" =>"尚未验证",
                                "Description" =>"您尚未进行手机认证，点击<查看全文>开始手机认证",
                                "Url" =>"http://www.leeyears.com/index.php/Weixin/mobile?phone=$phone&openid=$FromUserName"
                            );
                        }else if($result[0]['is_adopt'] == '1'){
                            $contentStr[] = array(
                                "Title" =>"手机已认证",
                                "Description" =>"尊敬的用户，您已经完成手机认证"
                            );
                        }else{
                            $contentStr[] = array(
                                "Title" =>"数据验证中",
                                "Description" =>"我们正在马不停蹄的验证您的手机数据，请您的稍等片刻"
                            );
                        }
                        break;
                    case "V02":
                        if($user_id == null){
                            $contentStr[] = array(
                                "Title" =>"注册",
                                "Description" =>"尊敬的用户，您尚未注册，无法使用本功能,点击<查看全文>进行注册",
                                "Url" =>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                            );
                        }else if(empty($info) or empty($gam)){
                            $contentStr[] = array(
                                "Title" =>"尚未认证",
                                "Description" =>"您的身份尚未认证,点击<查看全文>开始身份认证",
                                "Url" =>"http://www.leeyears.com/index.php/Weixin/user_info?phone=$phone&openid=$FromUserName"
                            );
                        }else if($result[0]['is_adopt'] == '0'){
                            $contentStr[] = array(
                                "Title" =>"身份认证中",
                                "Description" =>"我们正在马不停蹄的验证您的身份资料，请您的稍等片刻"
                            );
                        }else if($result[0]['is_adopt'] == '1'){
                            $contentStr[] = array(
                                "Title" =>"身份已认证",
                                "Description" =>"尊敬的用户您好，您的身份已经认证成功"
                            );
                        }else if($info and $gam){
                            $contentStr[] = array(
                                "Title" =>"已提交",
                                "Description" =>"姓名：{$info[0]['name']}
身份证号：
{$info[0]['uid']}
职业：{$work[0]['work']}
薪资：{$work[0]['wages']}
联系人手机号
{$gam[0]['family']}：{$gam[0]['family_mobile']}
{$gam[0]['gam']}:{$gam[0]['gam_mobile']}
点击查看详细信息",
                                "Url" =>"http://www.leeyears.com/index.php/Weixin/user_info?phone=$phone&openid=$FromUserName"
                            );
                        }
                        break;
                    case "V04":
                        $contentStr[] = array(
                            "Title" =>"有奖调研",
                            "Description" =>"尊敬的用户，完成本次调研您可以获得再次申请的机会！点击<查看全文>开始调研",
                            "Url" =>"http://www.leeyears.com/index.php/Weixin/survey"
                        );
                        break;
                    case "V05":
                        $contentStr[] = array(
                            "Title" =>"您可直接微信留言，我们将尽快回复您！",
                            "Description" =>"咨询时间：周一至周日 早上9：30-晚上17：30",
                        );
                        break;
                    case "V06":
                        $contentStr[] = array(
                            "Title" =>"我是CEO，任何客服解决不了的问题可以给我留言",
                            "Description" =>"尊敬的用户您有任何问题都可以直接微信留言，我们的客服将第一时间回复您，若仍不能完美解决您的问题，请点击我给CEO吐槽",
                            "Url" =>"http://www.leeyears.com/index.php/Weixin/message?openid=$FromUserName"
                        );
                        break;
                    case "V08":
                        if($user_id == null){
                            $contentStr[] = array(
                                "Title" =>"注册",
                                "Description" =>"尊敬的用户，您尚未注册，无法使用本功能,点击<查看全文>进行注册",
                                "Url" =>"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
                            );
                        }else{
                            $contentStr[] = array(
                                "Title" =>"个人资料",
                                "Description" =>"手机号：{$user_id['phone']}
点击<查看全文>了解详情",
                                "Url" =>"http://www.leeyears.com/index.php/Weixin/info?phone=$phone&openid=$FromUserName"
                            );
                        }
                        break;
                }
                break;
            default:
                break;

        }
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($object, $contentStr);
        }else{
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return $resultStr;
    }

    function transmitNews($object, $arr_item, $funcFlag = 0)
    {
        //首条标题28字，其他标题39字
        if(!is_array($arr_item))
            return;

        $itemTpl = "    <item>
						        <Title><![CDATA[%s]]></Title>
						        <Description><![CDATA[%s]]></Description>
						        <Url><![CDATA[%s]]></Url>
						    </item>
						";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['Url']);

        $newsTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[news]]></MsgType>
				<Content><![CDATA[]]></Content>
				<ArticleCount>%s</ArticleCount>
				<Articles>
				$item_str</Articles>
				<FuncFlag>%s</FuncFlag>
				</xml>";

        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;
    }

    function transmitText($object, $content, $funcFlag = 0)
    {
        $textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[text]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>%d</FuncFlag>
				</xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
        return $resultStr;
    }

    public function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    function downloadWeixinFile($url)
    {
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

    function saveWeixinFile($filename, $filecontent)
    {
        $local_file = fopen($filename, 'w');
        if (false !== $local_file){
            if (false !== fwrite($local_file, $filecontent)) {
                fclose($local_file);
            }
        }
    }

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
        $output = $this->https_request($url);
        $array = json_decode($output,true);
        $access_token = $array['access_token'];
        return  $access_token;
    }

    //自定义菜单
    public function menu(){
        $access_token = $this->access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $data = <<<json
		 {
			"button":[
			{
	           "name":"测试中",
			   "sub_button":[
			   {
					"type":"view",
					"name":"e借款",
					"url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
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
					"url":"http://www.leeyears.com/index.php/Weixin/agreement1"
				}]
		    },
			{
	           "name":"测试中",
			   "sub_button":[
				{
					"name":"个人资料",
					"type":"click",
	           		"key":"V08"
				},
				{
					"name":"我要还款",
					"type":"view",
	           		"url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/loan_details&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
				},
				{
	               "type":"view",
	               "name":"我要推广",
	               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/code&response_type=code&scope=snsapi_base&state=1#wechat_redirect"
	            }]
		    },
			{
	           "name":"测试中",
	           "sub_button":[
	           {	
	               "type":"click",
	               "name":"有奖调研",
	               "key":"V04"
	            },
	            {
	               "type":"view",
	               "name":"常见问题",
	               "url":"http://www.leeyears.com/index.php/Weixin/problem"
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