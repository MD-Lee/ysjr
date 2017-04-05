<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>账户注销</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo (C("URL")); ?>/css/logout.css" rel="stylesheet">	
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.validate.min.js"></script>	
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.form-3.51.0.js"></script>
	</head>
	<body>
		<h3 class="title">账户注销</h3>
		<p class="explain">我们充分尊重您的隐私，您可以在这里注销账号，我们将删除关于您的所有用户信息，也请您毫无保留的给我们吐槽注销的原因。</p>
		<p class="phoe">您的手机号码：<span class="num" id="phone"><?php echo ($phone); ?></span></p>
		<div class="list">
			<form id="form" action="<?php echo U('Weixin/logout_method');?>">
				<p class="password">
					<input type="password" placeholder="账号密码" name="password"/>
				</p>
				<p class="text">
					<textarea name="reason" rows="" cols="" placeholder="请输入注销原因"></textarea>
				</p>
				<button class="btn btn-primary" type="button" id="register" onclick="cancel()">我要注销</button>
			</form>
		</div>
	</body>
	<script>
	//输入框非空方法 
	function checkText(){
		return $("#form").validate({
			errorPlacement: function(error, element) {  
			    error.appendTo(element.parent());  
			},
			errorElement: "p",
			rules:{
				"password":{
					required:true
				},
				"reason":{
					required:true
				}
			},
			messages:{
				"password":{
					required:'请输入您的密码'
				},
				"reason":{
					required:'请输入注销原因'
				}
			}
		})
	}
	function cancel(){
		if(!checkText().form())return;
		var phone = $('#phone').text();
		$('#form').ajaxSubmit({
			type:"POST",
			url:$('#form').attr('action'),
			data:{'phone':phone,},
			datatype:"json",
			success:function(data){
				if(data == '注销成功'){
					alert(data);
					setTimeout(function(){WeixinJSBridge.call('closeWindow')},1000);
				}else if(data == '密码错误'){
					alert(data);
				}
			}
		})
	}
	</script>
</html>