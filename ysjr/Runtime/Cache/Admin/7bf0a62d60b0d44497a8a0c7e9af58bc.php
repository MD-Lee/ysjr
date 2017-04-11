<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo (C("URL")); ?>/css/Weixin.login.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.form-3.51.0.js"></script>
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
		<div align="center">
			<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/1-zhuceye.png" class="img-responsive">
		</div>
		<form id="login" action="<?php echo U('Weixin/user_login');?>">
		  <div class="form-group">
		    <input type="textl" class="form-control" name="info[mobile]" placeholder="请输入您的手机号">
		  </div>
		  <div class="form-group">
		    <input type="password" class="form-control" name="info[password]" placeholder="请输入密码">
		  </div>
		  <input type="hidden" value="<?php echo ($openid); ?>" id="openid">
		  <button type="button" class="btn btn-primary" onclick="user_login()">登录</button>
		</form>
		<div class="text">
			<a href="<?php echo U('Weixin/reset_pwd');?>">忘记密码?</a>
			<a href="<?php echo U('Weixin/register');?>" class="float">注册用户</a>
		</div>
		<div class="class" style="display:none;width: 50px;height: 50px;position: fixed;left: 45%;top:35%;">
			<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/jiazai.png" width="50px" height="50px">
		</div>
	</div>
</body>
<script>
//用户登录的输入框不能为空的验证 
function checkText(){
	return $("#login").validate({
		rules:{
			"info[mobile]":{
				required:true
			},
			"info[password]":{
				required:true,
				minlength:6
			}
		},
		messages:{
			"info[mobile]":{
				required:'请输入您的手机号'
			},
			"info[password]":{
				required:'请输入密码',
				minlength:"密码长度不能小于6个字母"
			}
		}
	})
}
//用户登录方法
function user_login(){
	if(!checkText().form())return;
	$('.class').css('display','block');
	$('#login').ajaxSubmit({
		type:"POST",
		url:$('#login').attr('action'),
		datatype:'json',
		success:function(data){
			if(data.info == '密码错误'){
				$('.class').css('display','none');
				alert(data.info);
			}else if(data.info == '用户不存在'){
				$('.class').css('display','none');
				alert(data.info);
			}else if(data.info == '正在申请中'){
				setTimeout(function(){window.location.href="/index.php/Weixin/examine?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '未持证自拍'){
				setTimeout(function(){window.location.href="/index.php/Weixin/zhengfeng?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '续期还款中'){
				setTimeout(function(){window.location.href="/index.php/Weixin/examine?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '继续借款'){
				setTimeout(function(){window.location.href="/index.php/Weixin/continue_loan?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '银行卡未验证'){
				setTimeout(function(){window.location.href="/index.php/Weixin/examine?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '未选择借款套餐'){
				setTimeout(function(){window.location.href="/index.php/Weixin/choice_money?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '未还款'){
				setTimeout(function(){window.location.href="/index.php/Weixin/overdue?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '状态'){
				setTimeout(function(){window.location.href="/index.php/Weixin/examine?phone="+data.phone+"&openid="+data.openid},1000);
			}else if(data.info == '银行卡未绑定'){
				setTimeout(function(){window.location.href="/index.php/Weixin/queren_loan?phone="+data.phone+"&openid="+data.openid},1000);
			}
		}
	})
	
}
</script>
</html>