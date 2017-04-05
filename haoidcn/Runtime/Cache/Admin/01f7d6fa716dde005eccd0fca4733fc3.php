<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>借款服务与隐私协议</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo (C("URL")); ?>/css/agreement.css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/common.js"></script>
	</head>
	<body>
		<div class="text">
		<br/>
	        <?php echo ($conetnt); ?>
	    <br/>
		<br/>
		</div>
		<div class="pos">
				<a class="back abs" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect">
					返回
				</a>
		</div>
	</body>
</html>