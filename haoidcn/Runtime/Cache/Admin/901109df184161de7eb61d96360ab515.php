<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>注册成功</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo (C("URL")); ?>/css/Weixin.register_success.css" rel="stylesheet">
<style>
.class {
	-webkit-animation:rotage-change 2s linear 0.5s infinite ;
}
@-webkit-keyframes rotage-change {
             /*起始*/
         from {         
              -webkit-transform: rotate(0deg);
         }
         /*结束*/
         to {
              -webkit-transform: rotate(360deg);
         }
      }

</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/successful.png" class="yes">
			</div>
			<div class="col-md-7">
				<h3 class="prosit">恭喜您，注册成功！</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/successful2.png" width="70px">
			</div>
			<div class="col-md-7">
				<h4>只要验证手机，20分钟即可快速获得500-3000元额度，息费最低仅15元。</h4>
			</div>
		</div>
		<input type="hidden" value="<?php echo ($phone); ?>">
		<a  href="http://www.leeyears.com/index.php/Weixin/choice_money?phone=<?php echo ($phone); ?>&openid=<?php echo ($openid); ?>" class="btn btn-primary" id="register">开始借款</a>
	</div>
	<div class="class" style="display:none;width: 50px;height: 50px;position: fixed;left: 45%;top:35%;">
		<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/jiazai.png" width="50px" height="50px">
	</div>
</body>
<script>
$('#register').click(function(){
	$('.class').css('display','block');
})
</script>
</html>