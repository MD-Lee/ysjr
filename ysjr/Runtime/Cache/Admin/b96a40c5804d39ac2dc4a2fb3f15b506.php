<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>个人信息</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo (C("URL")); ?>/css/info.css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="wrap">
			<div class="tab-tit clearfix" id="tabTit">
				<span class="sel fl data">个人资料</span>
				<span class="fl loan">我的借款</span>
			</div>
			<div class="tab-con" id="tabCon">
				<div class="block lan">
					<div class="table-list">
						<table>
							<tbody>
								<tr>
									<td>手机号码</td>
									<td><?php echo ($user[0]['phone']); ?></td>
									<td>&nbsp;</td>
									<td>
										<i class="fr tu"></i>
										<a href="<?php echo U('Weixin/logout',array('phone'=>$user[0]['phone']));?>" class="fr">注销</a>
									</td>
								</tr>
								<tr class="color">
									<td>登录密码</td>
									<td>
										******
									</td>
									<td>
										<i class="fr tu"></i>
										<a href="<?php echo U('Weixin/reset_pwd');?>" class="fr">重置</a>
									</td>
									<td>
										<i class="fr tu"></i>
										<a href="<?php echo U('Weixin/new_pwd',array('phone'=>$user[0]['phone']));?>" class="fr">修改</a>
									</td>
								</tr>
								<tr>
									<td>职业</td>
									<?php if($xuesheng == null): ?><td>
										<?php if($user_work[0]['work'] == null): ?>--
										<?php else: ?>
											<?php echo ($user_work[0]['work']); endif; ?>
									</td>
									<?php else: ?>
									<td>
										<?php echo ($xuesheng['work']); ?>
									</td><?php endif; ?>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr class="color">
								<?php if($xuesheng == null): ?><td>收入水平</td>
									<td>
										<?php if($user_work[0]['wages'] == null): ?>--
										<?php else: ?>
											<?php echo ($user_work[0]['wages']); endif; ?>
									</td>
								<?php else: ?>
									<td>学校</td>
									<td>
										<?php echo ($xuesheng['school']); ?>
									</td><?php endif; ?>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="table-list">
						<table>
							<tbody>
								<tr>
									<td rowspan="5" style="width: 47px;">
									<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/pen.svg" style="width: 100%;">
									</td>
									<td style="text-align: center; ">身份证号</td>
									<td>
										<?php if($user_info[0]['uid'] == null): ?>--
										<?php else: ?>
											<?php echo ($user_info[0]['uid']); endif; ?>
									</td>
									<td></td>
								</tr>
								<tr class="color">
									<td style="text-align: center; ">真实姓名</td>
									<td>
										<?php if($user_info[0]['name'] == null): ?>--
										<?php else: ?>
											<?php echo ($user_info[0]['name']); endif; ?>
									</td>
									<?php if($user_money_info[0]['is_adopt'] == '-1' or $user_money_info[0]['is_adopt'] == '2' or $user_money_info[0]['is_adopt'] == '3'): ?><td>
											<a href="<?php echo U('Weixin/user_info',array('phone'=>$user[0]['phone'],'openid'=>$user[0]['openid']));?>">填写</a>
										</td><?php endif; ?>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="table-list">
						<table>
							<tbody>
								<tr>
									<td rowspan="5" style="width: 47px;">
										<img src="<?php echo (C("URL")); ?>/images/xianjinbashi/bank2.svg" style="width: 100%;">
									</td>
									<td style="text-align: center; ">银行名称</td>
									<td>
										<?php if($bank_info['bank_name'] == null): ?>--
										<?php else: ?>
											<?php echo ($bank_info['bank_name']); endif; ?>
									</td>
								</tr>
								<tr class="color">
									<td style="text-align: center;">银行卡号</td>
									<td>
										<?php if($bank_info['bank_num'] == null): ?>--
										<?php else: ?>
											<?php echo ($bank_info['bank_num']); endif; ?>
									</td>
									<td>

										<a href="<?php echo U('Weixin/queren_loan',array('phone'=>$user[0]['phone'],'openid'=>$user[0]['openid']));?>" style="color: transparent;">填写</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
				<div class="lan ">
				<?php if($user_money_info == null ): ?><div class="record" style="text-align: center;">您尚未借款</div>
				<?php else: ?>
				<?php if(is_array($user_money_info)): $i = 0; $__LIST__ = $user_money_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="record">
						<table>
							<tbody>
								<tr>
									<td>借款类型</td>
									<td>普通借款</td>
									<td>&nbsp;</td>
								</tr>
								<tr class="color">
									<td>申请时间</td>
									<td><?php echo ($vo["apply_time"]); ?></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>金额</td>
									<td><?php echo ($vo["money_num"]); ?></td>
									<td>&nbsp;</td>
								</tr>
								<tr class="color">
									<td>期限</td>
									<td><?php echo ($vo["time_length"]); ?></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>打款日</td>
									<?php if($fang['is_repayment'] == 0 or $vo['is_adopt'] != 1): ?><td>---</td>
									<?php elseif($vo['is_adopt'] == 1 and $fang['is_repayment'] == 0): ?>
									<td><?php echo ($fang['payment_time']); ?></td><?php endif; ?>
									<td>&nbsp;</td>
								</tr>
								<tr class="color">
									<td>约定还款日</td>
									<?php if($fang['appoint_time'] == null or $vo['is_adopt'] != 1): ?><td>---</td>
									<?php elseif($vo['is_adopt'] == 1 and $fang['is_repayment'] == 0): ?>
									<td><?php echo ($fang['appoint_time']); ?></td><?php endif; ?>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>借款状态</td>
									<td>
										<?php if($vo['is_adopt'] == -1){ if($fang == null){ echo "未完善个人资料"; }else if($fang['wait_xuqi'] == 1){ echo "续期中"; }else if($fang['wait_xuqi'] == 2){ if($fang['actual_time'] != null){ echo "未完善个人资料"; } }else if($fang['wait_xuqi'] == 3){ if($fang['is_repayment'] == 1){ echo "未完善个人资料"; } }else if($fang['wait_xuqi'] == 4){ if($fang['is_repayment'] == 1){ echo "未完善个人资料"; } } }else if($vo['is_adopt'] == 0){ echo '申请中'; }else if($vo['is_adopt'] == 1){ if($bank_info){ if($bank_info[is_payment] == 0){ echo '银行卡验证中'; }else if($bank_info[is_payment] == 1){ if($fang['is_repayment'] == null){ if($user[0]['is_loan'] == 2){ echo '放款失败，请再次确定银行卡信息是否正确'; }else{ echo '等待放款中'; } }else if($fang['is_repayment'] == 0){ if($fang['huankuan_type'] == 1){ echo "还款中"; }else if($fang['wait_xuqi'] == 1){ echo '续期中'; }else{ if($fang){ echo "放款成功"; } } }else{ if($vo['repayment_state'] == 1){ echo "已还款"; }else{ echo "等待放款中"; } } }else if($bank_info[is_payment] == 2){ echo "银行卡未通过验证"; } }else{ echo '初审通过'; } }else if($vo['is_adopt'] == 2){ echo '未通过'; }else if($vo['is_adopt'] == 3){ echo '已经取消申请'; } ?>
									</td>
									<td>&nbsp;</td>
								</tr>
								<?php if($vo['is_adopt'] == -1): ?><tr class="color">
										<td>
											<p class="cancel" data-toggle="modal" data-target=".bs-example-modal-m"></p>
											<p>取消申请</p>
										</td>
										<td>&nbsp;</td>
										<td>
											<a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/register&response_type=code&scope=snsapi_base&state=1#wechat_redirect">
												<p class="continue"></p>
												<p>继续借款</p>
											</a>
	
										</td>
									</tr><?php endif; ?>
								<?php if($fang != null and $vo['is_adopt'] == 1): ?><tr class="color">
										<td>
											<a href="<?php echo U('Weixin/jiekuan',array('phone'=>$user[0]['phone']));?>">
												<p class="continue"></p>
												<p>查看合同</p>
											</a>
										</td>
										<td>&nbsp;</td>
										<?php if($fang['actual_time'] == null): ?><td>
											<a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=appid&redirect_uri=http://www.leeyears.com/index.php/Weixin/loan_details&response_type=code&scope=snsapi_base&state=1#wechat_redirect">
												<p class="continue"></p>
												<p>我要还款</p>
											</a>
	
										</td><?php endif; ?>
									</tr><?php endif; ?>
							</tbody>
						</table>
					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</div>
			</div>
		</div>
		<!--弹窗-->
		<div class="modal fade bs-example-modal-m" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body">
						<p class="free-phone">确定要取消这次借款申请吗？</p>
					</div>
					<div class="modal-header clearfix">
						<div class="call">
							<button id="regNow " type="button" class="btn on yans btn-default u-btn-default nonumber registerednow" data-dismiss="modal" data-toggle="modal" data-target=".bs-example-modal-lgs">
                            <span class="caching" style="display:block">确认</span>
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
	<script type="text/javascript">
		//功能描述：点击tab格，改变当前的样式，并且显示对应到内容
		$(".tab-tit span").click(function() {
			var index = $(this).index();
			$(this).addClass("sel").siblings().removeClass("sel");
			$(".tab-con>div").eq(index).addClass("block ").siblings().removeClass("block ");
		})
	</script>

</html>