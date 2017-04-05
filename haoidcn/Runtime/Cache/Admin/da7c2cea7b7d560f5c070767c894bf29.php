<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>借款金额</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
		<link rel="stylesheet" type="text/css" href="<?php echo (C("URL")); ?>css/swiper3.1.0.min.css" />
		<link href="<?php echo (C("URL")); ?>css/loan.css" rel="stylesheet">
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
		<div class="row">
		  	<div class="row img">
				<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/lend-1.png"/>
		  	</div>
		  </div>
		<div class="fun">
			<form action="" method="post">
				<div class="deviation" align="center">
					<p>请选择借款金额</p>
				</div>
				<div class="wrap">
					<div class="swiper-container swiper-container-horizontal">
						<div class="swiper-wrapper">
							<div class="swiper-slide close" style="margin-right: 30px;">500</div>
							<div class="swiper-slide" style="margin-right: 30px;">1000</div>
							<div class="swiper-slide" style="margin-right: 30px;">1500</div>
							<div class="swiper-slide" style="margin-right: 30px;">2000</div>
							<div class="swiper-slide" style="margin-right: 30px;">2500</div>
							<div class="swiper-slide" style="margin-right: 30px;">3000</div>
						</div>
					</div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
				<div class="deviation" align="center">
					<p>请选择借款时长</p>
				</div>
				<div class="class" style="display:none;width: 50px;height: 50px;position: fixed;left: 45%;top:35%;z-index: 99999;">
					<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/jiazai.png" width="50px" height="50px">
				</div>
				<div align="center" class="cost">
					<button class="btn btn-primary num" value="7" type="button">7天</button>
					<button class="btn num" value="14" type="button">14天</button>
				</div>
				<div class="deviation all">
					<span class="text1">快速信审费：<span class="censor"></span>元</span>
					<span class="text2">息&nbsp;&nbsp;费：<span class="accrual"></span>元</span>
				</div>
				<div class="deviation all">
					<span class="text1">账户管理费：<span class="manage"></span>元</span>
					<span class="text2">优惠卷：
					<span class="free">
					<?php if($activity == null): ?>0
					<?php else: ?>
					<?php echo ($activity); endif; ?>
					</span>
					元</span>
				</div>
				<div align="center" class="txt">
					<p>到期应还：<span class="repay"></span> <span style="color: #00B4FF;font-size: 20px;">元</span></p>
					<p>实际到账：<span class="daozhang"></span> <span style="color: #00B4FF;font-size: 20px;">元</span>(已扣除相关费用)</p>
				</div>
				<input type="hidden" id="phone" value="<?php echo ($phone); ?>">
	  	  		<input type="hidden" id="openid" value="<?php echo ($openid); ?>" name="info[openid]">
				<button class="btn" type="button" id="register" onclick="user_money_info()">下一步</button>

			</form>
		</div>

	</body>
	<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo (C("URL")); ?>js/swiper3.1.0.min.js" type="text/javascript"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			slidesPerView: 'auto',
			paginationClickable: true,
			spaceBetween: 30,
			prevButton: '.swiper-button-prev',
			nextButton: '.swiper-button-next',
		});
		
//		进入时候获取
			var qian = $(".close").text();
			var text = $(".btn-primary").val();
			$.ajax({
				type: "POST",
				url: "<?php echo U('Weixin/get_money');?>",
				data: {
					"money": qian,
					"time": text
				},
				dataType: "json",
				success: function(data) {
					if(data) {
						//						快速信审费
						$(".censor").text(data[0].letter);
						//						息费
						$(".accrual").text(data[0].interest);
						//						账户管理费
						$(".manage").text(data[0].account_money);
						//						总共
						var activity = $('.free').text();
						var sum = parseInt(data[0].sum) + parseInt(activity);
						$(".repay").text(data[0].money_num);
						$(".daozhang").text(sum);
					}
				}
			})
		//		金额选择
		$(".swiper-slide").click(function() {
			$(this).addClass("close").siblings().removeClass("close");
			var qian = $(this).text();
			var text = $(".btn-primary").val();
			$.ajax({
				type: "POST",
				url: "<?php echo U('Weixin/get_money');?>",

				data: {
					"money": qian,
					"time": text
				},
				dataType: "json",
				success: function(data) {
					if(data) {
						//						快速信审费
						$(".censor").text(data[0].letter);
						//						息费
						$(".accrual").text(data[0].interest);
						//						账户管理费
						$(".manage").text(data[0].account_money);
						//						总共
						var activity = $('.free').text();
						var sum = parseInt(data[0].sum) + parseInt(activity);
						$(".repay").text(data[0].money_num);
						$(".daozhang").text(sum);
					}
				}
			})

		})

//		天数选择
		$(".num").click(function() {
			$(this).addClass("btn-primary").siblings().removeClass("btn-primary");
			var text = $(this).val();
			var qian = $(".close").text();
			$.ajax({
				type: "POST",
				url: "<?php echo U('Weixin/get_money');?>",

				data: {
					"money": qian,
					"time": text
				},
				dataType: "json",
				success: function(data) {
					if(data) {
						//						快速信审费
						$(".censor").text(data[0].letter);
						//						息费
						$(".accrual").text(data[0].interest);
						//						账户管理费
						$(".manage").text(data[0].account_money);
						//						总共
						var activity = $('.free').text();
						var sum = parseInt(data[0].sum) + parseInt(activity);
						$(".repay").text(data[0].money_num);
						$(".daozhang").text(sum);
					}
				}
			})
		})
		
		function user_money_info(){
				$('.class').css('display','block');
				var phone = $("#phone").val();
				var openid = $("#openid").val();
				var qian = $(".close").text();  //金额 
				var time = $(".btn-primary").val();  //期限
				var letter = $(".censor").text();  //	快速信审费
				var interest = $(".accrual").text();//						息费
				var account_money = $(".manage").text();//						账户管理费
				var sum = $(".repay").text();//						到账还款 
				var daozhang = $(".daozhang").text();   //实际到账
				$.ajax({
					type:"POST",
					url:"<?php echo U('Weixin/user_money_info');?>",
					data:{
						'money_num':qian,
						'time_length':time,
						'letter':letter,
						'interest':interest,
						'account_money':account_money,
						'sum':sum,
						'phone':phone,
						'openid':openid,
						'daozhang':daozhang
					},
					datatype:"json",
					success:function(data){
						if(data == '下一步'){
							setTimeout(function(){window.location.href="/index.php/Weixin/verify_mobile?phone="+phone+"&openid="+openid},1000);
						}else{
							alert(data);
						}
					}
				})
			}
	</script>

</html>