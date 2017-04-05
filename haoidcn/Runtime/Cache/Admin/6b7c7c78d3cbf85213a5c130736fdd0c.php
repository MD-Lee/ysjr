<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>绑定银行卡</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo (C("URL")); ?>/css/bank.css" rel="stylesheet"> 
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.form-3.51.0.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/common.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/PCASClass.js"></script>
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
      .btn-upload input {
	display: none;
}
.btn-upload label img {
	width: 65%;
}
.con dt img {
	display: block;
	height: 100%;
}
.con dd {
	height: 20px;
	font: normal 12px/20px "Microsoft YaHei";
	text-align: center;
}
.biger {
	position: fixed;
	left: 0;
	top: 0;
	display: none;
	width: 100%;
	height: 100%;
}
.biger-bac {
	position: absolute;
	left: 0;
	top: 50%;
	width: 100%;
	height: 0;
	background-color: rgba(0, 0, 0, 0.8);
}
.biger-pic {
	position: relative;
	display: none;
	width: 100%;
	height: 50%;
	margin: 0 auto;
	padding: 50px;
}
.biger-bac img {
	display: block;
	width: 100%;
	height: 100%;
}
.biger-pic span {
	position: absolute;
	right: 50px;
	top: 50px;
	width: 20px;
	height: 20px;
	background-color: red;
	color: white;
	font: bold 12px/20px "Microsoft YaHei";
	text-align: center;
	cursor: pointer;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	-ms-border-radius: 10px;
	-o-border-radius: 10px;
	border-radius: 10px;
}
</style>
</head> 
<body>
	<div class="container">
	  <div class="row img">
			<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/lend-4.png"/>
	  </div>
	  <div class="center-block look">
	  		<a href="<?php echo U('Weixin/lend_details',array('phone'=>$phone));?>" class="center-block bowling" id="jiazai"><span class="pull-left tubiao"></span> <span>点击查看借款详情</span></a>
	  </div>
	  <form class="list" id="form" action="<?php echo U('Weixin/bank_card');?>">
	  		<div class="form-group select">
	  			<input type="hidden" value="<?php echo ($list[0]['bank_name']); ?>" id="bank">
			  	<select name="info[bank_name]" id="select1">
			  		<option value="">请选择银行</option>
				  	<?php if(is_array($bank_name)): $i = 0; $__LIST__ = $bank_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			  	</select>
			  	<span class="down">
			  		<span class="down-img"></span>
			  	</span>
			  </div>
	  		  <div class="form-group select">
	  				<input type="text" name="info[account_opening]" class="form-control" value="<?php echo ($list[0]['account_opening']); ?>" placeholder="填写开户行网点"/>
			  </div>
			<div>
			  	<p>姓名：<span id="name"><?php echo ($name); ?></span></p>
			</div>
			<div style="margin-top: 20px;">
			  	<input type="text" name="info[bank_num]" class="form-control" value="<?php echo ($list[0]['bank_num']); ?>" placeholder="请输入银行卡号"/>
			</div>
			<div class="control-group js_uploadBox" style="margin-top:20px;">
				<p>上传银行卡截图</p>
				<div class="btn-upload" style="overflow: hidden;">
				 	<label for="images1" style="float:left">
				 		<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/jia.png" alt="" />
				 	</label>
					 <input class="js_upFile"type="file" name="img1" id="images1">
					 <div class="js_showBox con"  style="float:left">
						<dt>
							<img class="js_logoBox" width="100px" src="<?php echo ($list[0]['img']); ?>"/>
						</dt>
					</div>
				</div>
				<div style="margin-top: 20px;">
					<a href="bank_anli.html">截图案例</a>
				</div>
			</div>
			<input type="hidden" value="<?php echo ($phone); ?>"  name="info[phone]">
		  <button class="btn btn-primary" type="button" id="register" onclick="bank_card()">确认绑定</button>
	  </form>
	</div>
	<div class="biger">
		<div class="biger-bac">
			<div class="biger-pic">
				<img src="<?php echo ($list[0]['img']); ?>" alt="" title=""/>
				<span>X</span>
			</div>
		</div>
	</div>
	<div class="class" style="display:none;width: 50px;height: 50px;position: fixed;left: 45%;top:35%;">
		<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/jiazai.png" width="50px" height="50px">
	</div>
</body>
<script  type="text/javascript"  src="<?php echo (C("URL")); ?>js/jquery.uploadView.js"></script>
<script>
$(".js_upFile").uploadView({
	uploadBox: '.js_uploadBox',//设置上传框容器
	showBox : '.js_showBox',//设置显示预览图片的容器
	width : 80, //预览图片的宽度，单位px
	height : 80, //预览图片的高度，单位px
	allowType: ["gif", "jpeg", "jpg", "bmp", "png"], //允许上传图片的类型
	maxSize :10, //允许上传图片的最大尺寸，单位M
	success:function(e){
		$(".js_uploadText").text('更改');
		alert('图片上传成功');
	}
});
//功能描述：点击图片，从中间展开幕布，当幕布完全展开时，放大图片出现，点击叉图片关闭，然后幕布关闭
//点击图片，展开幕布
$(".con").on("click", function() {
	var aa = $(this).children("img").attr("src");
	console.log(aa)
	$(".biger-pic").children("img").attr("src",aa);
	$(".biger").css({"display" : "block"})
	$(".biger-bac").stop().animate({
		"top" : "0",
		"height" : "100%"
	}, function() {
		$(".biger-pic").css({"display" : "block"});
	});
});

//点击叉，关闭图片并隐藏幕布模块
$(".biger-pic span").on("click", function() {
	$(".biger-pic").css({"display" : "none"});
	$(".biger-bac").stop().animate({
		"top" : "50%",
		"height" : "0"
	}, function() {
		$(".biger").css({
			"display" : "none"
		})
	});
})
$('#jiazai').click(function(){
	$('.class').css('display','block');
})
var bank = $('#bank').val();
$('#select1').find("option[value='"+bank+"']").attr("selected",true);
function checkText(){
	return $("#form").validate({
		errorPlacement: function(error, element) {  
		    error.appendTo(element.parent());  
		},
		errorElement: "div",
		rules:{
			"info[bank_name]":{
				required:true
			},
			"info[account_opening]":{
				required:true
			},
			"img1":{
				required:true
			},
			"info[bank_num]":{
				required:true,
				creditcard:true
			}
		},
		messages:{
			"info[bank_name]":{
				required:'请选择您的银行卡名称'
			},
			"info[account_opening]":{
				required:'请输入开户网点'
			},
			"img1":{
				required:'请上传银行卡截图'
			},
			"info[bank_num]":{
				required:'请输入银行卡卡号',
				creditcard:"请输入正确的银行卡号"
			}
		}
	})
}
function bank_card(){
	if(!checkText().form())return;
	//var img = $('#images1').val();
	var name = $('#name').text();
	$('.class').css('display','block');
	$('#form').ajaxSubmit({
		type:"POST",
		url:$('#form').attr('action'),
		data:{'name':name},
		datatype:"json",
		success:function(data){
			if(data == '放款成功'){
				$('.class').css('display','none');
				alert('银行卡信息提交成功');
				setTimeout(function(){WeixinJSBridge.call('closeWindow')},1000);
			}else{
				$('.class').css('display','none');
				alert(data);
			}
		}
	})
}
</script>
</html>