<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>借款详情</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo (C("URL")); ?>/css/lend_details.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.form-3.51.0.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/common.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/PCASClass.js"></script>
<style>
#button{
	font-size: 18px;
    border-radius: 30px;
    margin-top: 20px;
    height: 40px;
    width: 80%;
}
</style>
</head>
<body>
	<!--表单数据-->
	<div class="list">
		<table>
			<tbody>
				<tr>
					<td>借款类型</td>
					<td>普通借款</td>
				</tr>
				<tr class="add">
					<td>申请时间</td>
					<td id="time"><?php echo ($list[0]['apply_time']); ?></td>
				</tr>
				<tr>
					<td>金额</td>
					<td id="money"><?php echo ($list[0]['money_num']); ?>元</td>
				</tr>
				<tr class="add">
					<td>期限</td>
					<td id="term"><?php echo ($list[0]['time_length']); ?>天</td>
				</tr>
				<tr>
					<td>打款日</td>
					<td>---</td>
				</tr>
				<tr class="add">
					<td>约定还款日</td>
					<td>---</td>
				</tr>
				<tr>
					<td>实际还款日</td>
					<td>---</td>
				</tr>
				<tr>
					<td>快速信审费</td>
					<td id="letter"><?php echo ($list[0]['letter']); ?>元</td>
				</tr>
				<tr class="add">
					<td>账户管理费</td>
					<td id="manage"><?php echo ($list[0]['account_money']); ?>元</td>
				</tr>
				<tr>
					<td>息费</td>
					<td id="info"><?php echo ($list[0]['interest']); ?>元</td>
				</tr>
				<?php if($list[0]['is_adopt'] == 1): ?><tr>
					<td>实际到账金额（已扣除相关费用）</td>
					<td id="info"><?php echo ($list[0]['daozhang']); ?>元</td>
				</tr><?php endif; ?>
				<tr>
					<td>到期还款额</td>
					<td class="repay"><?php echo ($list[0]['sum']); ?>元</td>
				</tr>
				<tr class="add font">
					<td>状态说明</td>
					<td>
						<?php if($list[0]['is_adopt'] == -1): ?>未提交
						<?php elseif($list[0]['is_adopt'] == 0): ?>
							申请中
						<?php elseif($list[0]['is_adopt'] == 1): ?>
							初审通过
						<?php elseif($list[0]['is_adopt'] == 2): ?>
							不通过
						<?php else: ?>
							已取消申请<?php endif; ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<!--取消借款与继续借款订单-->
	<?php if($list[0]['is_adopt'] == 3): ?><div class="pos" style="display:none">
			<div class="center center-block clearfix">
				<input type="hidden" value="<?php echo ($phone); ?>" id="phone">
				<?php if($list[0]['is_adopt'] != 1): ?><button  class="pull-left btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-m">
	              		取消申请
	           	</button>
				<a href="JavaScript:history.go(-1)"><button  class="pull-right btn btn-primary">继续申请</button></a><?php endif; ?>			
			</div>
		</div>
	<?php else: ?>
		<div class="pos" style="display:block">
			<div class="center center-block clearfix">
				<input type="hidden" value="<?php echo ($phone); ?>" id="phone">
				<?php if($list[0]['is_adopt'] != 1): ?><button  class="pull-left btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-m">
	              		取消申请
	           	</button><?php endif; ?>
				<a href="JavaScript:history.go(-1)"><button  class="pull-right btn btn-primary">继续申请</button></a>				
			</div>
		</div><?php endif; ?>
	<!-- 清理缓存弹窗 -->
        <div class="modal fade bs-example-modal-m" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-body">
                     <p class="free-phone">确定要取消这次借款申请吗？</p>
                  </div>
                  <div class="modal-header clearfix">
                    <div class="call">
                        <button id="regNow " type="button" class="btn on yans btn-default u-btn-default nonumber registerednow" data-dismiss="modal" data-toggle="modal" data-target=".bs-example-modal-lgs">
                            <span class="caching" style="display:block" onclick="cancel_apply()">确认</span>
                        </button>
                        <button id="regNow" type="button" class="btn on  btn-default u-btn-default nonumber registerednow" data-dismiss="modal" data-toggle="modal" data-target=".bs-example-modal-lgs">
                            <span class="color">取消</span>
                        </button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        
</body>
<script>
//用户取消申请
function cancel_apply(){
	var phone = $('#phone').val();
	$.ajax({
		type:"POST",
		url:"<?php echo U('Weixin/cancel_apply');?>",
		data:{'phone':phone},
		datatype:"json",
		success:function(data){
			alert(data);
			setTimeout(function(){window.location.href="/index.php/Weixin/info?phone="+phone},1000);
		}
	})
}
</script>
</html>