<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>e快金</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="<?php echo (C("URL")); ?>/css/examine.css" rel="stylesheet">
	</head>

	<body>
		<div class="header top-head">
			<h4 class="title">e借款
				<a class="back">
					<i class="icon icon-back pull-left"></i>
				</a>
			</h4>
		</div>
		<div class="con">
			<ul class="list">
				<?php if($data == 1 or $data == 8): ?><li class="list-item color" id="one">
						<i class="icons loading"></i>
						后台审核
						<?php if($data == 8): ?><span class="fr text">续期审核中</span>
						<?php else: ?>
						<span class="fr text">预计20分钟</span><?php endif; ?>
					</li>
				<?php elseif($data == 3): ?>
					<li class="list-item color" id="one">
						<i class="icons loading"></i>
						后台审核
						<span class="fr text">未持证自拍</span>
					</li>
				<?php else: ?>
					<li class="list-item color" id="one">
						<i class="icons loading yes"></i>
						后台审核
						<span class="fr text">完成</span>
					</li><?php endif; ?>
				
			<?php if($data != 8): ?><li class="list-item">
					<em class="next"></em>
				</li>
				
				<?php if($data == 1 or $data == 3): ?><li class="list-item" id="two">
						<i class="icons"></i>
						绑定银行卡
						<span class="fr text">未绑定</span>
					</li>
				<?php elseif($data == 2): ?>
					<li class="list-item color" id="two">
						<i class="icons loading"></i>
						绑定银行卡
						<span class="fr text">正在验证</span>
					</li>
				<?php elseif($data == 5 or $data == 4 or $data == 6 or $data == 7): ?>
					<li class="list-item color" id="two">
						<i class="icons loading yes"></i>
						绑定银行卡
						<span class="fr text">完成</span>
					</li><?php endif; ?>
				
				<li class="list-item">
					<em class="next"></em>
				</li>
				
				<?php if($data == 1 or $data == 2 or $data == 5 or $data == 3): ?><li class="list-item" id="five">
						<i class="icons"></i>
						开始放款
						<span class="fr text">未放款</span>
					</li>
				<?php elseif($data == 4): ?>
					<li class="list-item color" id="five">
						<i class="icons loading yes"></i>
						开始放款
						<span class="fr text">等待</span>
					</li><?php endif; ?>
				
				<?php if($data == 6): ?><li class="list-item color" id="five">
						<i class="icons loading yes"></i>
						续期中
						<span class="fr text">等待审核</span>
					</li>
				<?php elseif($data == 7): ?>
					<li class="list-item color" id="five">
						<i class="icons loading yes"></i>
						还款中
						<span class="fr text">等待审核</span>
					</li><?php endif; endif; ?>
			</ul>
			<button class="sure">
				后台审核中...
			</button>
<!--			<p class="explain">我们正在审核您的资料，请耐心等待。<br>点击<a href="">查看详情</a></p>
-->		</div>
	</body>
	<script type="text/javascript">
		if($("#one").children(".icons").hasClass("yes")) {
			$("#one").children(".text").text("完成");
			$("#two").addClass("color").children(".icons").addClass("loading");
		}
	</script>
</html>