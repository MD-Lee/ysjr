<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>借款合同</title>
</head>
<body>

<body>
<div  class="rightpanel">
	<!-- head binge -->
	
	<!-- head end -->
	<div style="padding-left: 34px">
	<h1 style="margin-bottom:40px;text-align:center;line-height:21px">
    <strong><span style="font-family: 宋体;color: rgb(85, 85, 85);font-size: 32px">借款协议</span></strong>
	</h1>
	<p style="margin-bottom:0;line-height:21px">
	    <span style=";font-family:宋体;color:rgb(85,85,85);font-size:14px">合同编号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">SWHJ_4-1740207</span>
	</p>
	<p style="margin-bottom:0;line-height:21px">
	    <span style=";font-family:宋体;color:rgb(85,85,85);font-size:14px">签订日期：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($riqi['payment_time']); ?></span>
	</p>
	<p>
	    <span style=";font-family:Tahoma;font-size:15px">&nbsp;</span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方（出借人）：</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px"><?php echo ($chujie['name']); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">身份证号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($chujie['uid']); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方（借款人）：</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px"><?php echo ($user_name); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">身份证号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($id); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">手机号码：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($phone); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">银行卡号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($bank); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">丙方:<?php echo ($chujie['company']); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">地址：<?php echo ($chujie['address']); ?></span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">58</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">号证大立方大厦</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">1810</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">室</span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">联系电话：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($chujie['mobile']); ?></span>
	</p>
	<p style="line-height:24px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">电子邮箱：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($chujie['mailbox']); ?></span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">1.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">丙方是一家在上海市合法成立并有效存续的公司，拥有</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">“</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">现金巴士</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">”</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">微信公众号及</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">APP</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">等相关服务软件（下称</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">“</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">现金巴士</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">”</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">或</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">“</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">平台</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">”</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">）经营权，为甲乙双方提供借贷咨询、居间、账户管理等服务。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">2.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方已在平台注册，并承诺其提供给平台的信息是完全真实有效的。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">3.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方承诺对本协议涉及的借款具有完全的支配能力，为其合法所得，并承诺其提供给丙方的信息是完全真实有效的。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">4.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方有借款需求，并通过平台提交借款申请，甲方亦同意借款，甲乙双方有意接受丙方的居间服务，成立借贷关系。</span>
	</p>
	<p style="margin-bottom:0;line-height:21px">
	    <strong><span style="font-family: 微软雅黑;font-size: 14px">各方经协商一致，于</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">&nbsp;<?php echo ($riqi['payment_time']); ?></span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">通过丙方平台以电子文本的形式达成协议如下，协议各方已对本协议各条款内容作了充分理解，特别是加粗字体部分：</span></strong>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">定义</span></strong>
	</h2>
	<p style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;font-size: 14px">除非上下文另行要求</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">, </span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">本合同中的下列词语和用语含义如下</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">:</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">1.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">本金，指甲方出借给乙方的金额。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">2.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">利息，指基于本金产生的相关收益，含正常借款期内利息、容时期利息、逾期利息。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">3.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">容时期，指借款期满后</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">7</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">天内，容时期会产生容时期利息及其他费用。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">4.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">逾期，指容时期满后的状态，逾期会产生逾期利息及其他费用。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">5.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">还款，指乙方偿还借款本息及</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">或支付快速信审费、账户管理费的行为。</span></strong>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第一条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">借款基本信息</span></strong>
	</h2>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">借款日期：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['apply_time']); ?></span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">借款本金：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['money_num']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">元</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">借款期限：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['time_length']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">天</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">正常借款期内，</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">利息：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['interest']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">元</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">账户管理费（丙方收取）：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['account_money']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">元</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">快速审核服务费（丙方收取）：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['letter']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">元</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">还款日期：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($riqi['appoint_time']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">，当天一次性还清</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">还款金额：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($money_info['sum']); ?></span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">元。三方协商一致，丙方可代甲方收取乙方偿还的本息。</span>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第二条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">借款发放方式</span></strong>
	</h2>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲乙双方确认，甲方通过个人网银或第三方支付渠道将款项转入乙方在丙方平台注册帐号绑定的银行卡账户。款项一经从甲方的银行账户或第三方支付账户转出或支付，即视为资金已经发放，乙方不得以任何理由拒绝履行本协议项下的还款义务。</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">若乙方收到的借款金额与本协议约定不一致的，协议各方同意按照以下方式处理：</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:Symbol;color:rgb(85,85,85);font-size:13px">·&nbsp;</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">1</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">）实际收到金额小于本协议约定借款金额的，任何一方应在</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">3</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">天内通过平台或电话通知其他方，由丙方安排</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">1</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">日内补齐差额至乙方绑定银行卡，借款期限自补齐时起算。否则，本合同借款金额按照实际支付金额计算（其中正常借款期内，利息按照乙方实际收到金额计收，快速信审费及账户管理费仍按照第一条约定金额收取；乙方容时或逾期还款的，容时期及逾期期间，利息及账户管理费按照乙方实际收到金额计收）。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:Symbol;color:rgb(85,85,85);font-size:13px">·&nbsp;</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">2</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">）实际收到金额大于本协议约定借款金额的，任何一方应在</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">3</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">天内通过平台或电话通知其他方，乙方应在</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">1</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">日内退还多余金额。否则本合同借款自始金额按照实际支付金额计算（其中正常借款期内，利息按照乙方实际收到金额计收，快速信审费及账户管理费仍按照第一条约定金额收取；乙方容时或逾期还款的，容时期及逾期期间，利息及账户管理费按照乙方实际收到金额计收）。</span>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第三条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">容时还款</span></strong>
	</h2>
	<p style="line-height:21px">
	    <span style=";font-family:宋体;color:rgb(85,85,85);font-size:14px">如因乙方原因，乙方在本协议的还款日无法按时还款，甲方及丙方同意乙方容时还款，容时还款最长期限为</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">7</span><span style=";font-family:宋体;color:rgb(85,85,85);font-size:14px">天，同时乙方承诺向甲方支付容时期利息，向丙方支付容时期账户管理费。容时期利息和容时期账户管理费统称为</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">“</span><span style=";font-family:宋体;color:rgb(85,85,85);font-size:14px">容时期费用</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">”</span>
	</p>
	<p style="line-height:21px">
	    <strong><span style="font-family: 宋体;font-size: 14px">容时期利息总额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">&nbsp;= </span></strong><strong><span style="font-family: 宋体;font-size: 14px">借款金额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">×</span></strong><strong><span style="font-family: 宋体;font-size: 14px">对应容时期利息利率</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">(0.04%)×</span></strong><strong><span style="font-family: 宋体;font-size: 14px">容时天数。</span></strong>
	</p>
	<p style="line-height:21px">
	    <strong><span style="font-family: 宋体;font-size: 14px">容时期账户管理费总额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">&nbsp;= </span></strong><strong><span style="font-family: 宋体;font-size: 14px">借款金额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">×</span></strong><strong><span style="font-family: 宋体;font-size: 14px">对应容时期账户管理费率</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">(0.96%)×</span></strong><strong><span style="font-family: 宋体;font-size: 14px">容时天数。</span></strong>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:宋体;color:rgb(85,85,85);font-size:14px">容时期是甲方和丙方给予乙方还款的宽限期，如超过还款最长容时期限后，乙方仍无法偿还应还款总额及容时费用总额，则视为乙方逾期还款，应当按照本协议的约定承担违约责任。</span>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第四条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">各方权利和义务</span></strong>
	</h2>
	<h3 style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">甲方的权利和义务</span></strong>
	</h3>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">1.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方应在本协议签订日期通过本协议第二条中规定的借款发放方式，将足额的借款本金支付给乙方。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">2.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方保证其所用于出借的资金来源合法，甲方是该资金的合法所有人，如果第三人对资金归属、合法性问题发生争议，由甲方负责解决。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">3.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方享有其出借款项所带来的利息收益。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">4.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">如乙方违约，甲方有权要求丙方提供其已获得的乙方信息，丙方应当提供。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">5.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">甲方有权根据自己的意愿进行本协议下其对乙方债权的转让。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">6.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方应确保其提供信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">7.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方授权丙方管理其在本协议项下对乙方的债权，管理权限包括代为收取本金、利息，代为接受乙方的续期申请，代为向乙方催收。</span>
	</p>
	<h3 style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">乙方权利和义务</span></strong>
	</h3>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">1.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方必须按本协议第一条中的规定，在还款日一次性足额支付本金、利息、账户管理费，快速信审费，如无法在还款日按时还款，还款自动进入</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">7</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">天容时期，乙方除支付上述费用外，还须分别向甲方和丙方支付本协议第三条中规定的容时期利息和容时期账户管理费。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">2.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方承诺所借款项不用于任何违法用途</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">, </span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">否则由乙方自行承担全部责任。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">3.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方应确保其提供的信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">4.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方不得将本协议项下的任何权利义务转让给其他任何第三方。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">5.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方清楚并同意丙方作为甲方在本协议项下债权的管理人，乙方授权丙方在借款的还款日通过丙方提供的第三方支付方式从乙方绑定的银行账户内划转应还款金额，并协助丙方获得第三方划扣所需的文件及授权。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">6.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方在此无条件且不可撤销地授权：如乙方发生逾期还款行为，丙方即有权与乙方运营商详单中的电话或者短信联系人取得联系，告知乙方联系人本借款合同的内容并请求乙方联系人向乙方转达违约提醒，丙方与乙方联系人的联系方式包括但不限于电话、短信、电子邮件和上门等。</span><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">乙方知悉并同意，甲方或丙方向乙方联系人公布乙方的逾期情况是由于乙方的违约行为，该等分享或公开并不侵犯或损害到乙方的隐私权利。乙方充分知悉并同意，丙方为乙方提供本产品</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">服务的前提是乙方同意丙方将乙方的逾期还款等违约情形予以公开并就还款事项联系紧急联系人。若乙方不同意将其违约情况予以公开</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">就还款事项联系乙方联系人，则本业务缺乏开展的前提，丙方有权不提供本产品</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">服务。基于行业特性和丙方向乙方提供服务的特殊方式，若丙方公开乙方的违约情形对乙方造成任何的困扰、损害等，乙方放弃该等隐私权利的救济。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-weight:bold;font-size:14px">7.&nbsp;</span><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">乙方同意本协议第九条委托代扣款授权的相关内容。</span></strong>
	</p>
	<h3 style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">丙方的权利和义务</span></strong>
	</h3>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">1.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">甲方授权并委托丙方或丙方指定的第三方代其收取本协议第一条中所约定的借款本金、利息，代收后按照甲方的要求进行处置，乙方对此表示认可。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">2.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲方同意，丙方有权基于市场调查、产品营销及提升产品服务质量等原因与甲方联络，包括拨打电话、发送微信消息或手机短信等方式。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">3.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">甲、乙双方一致同意，丙方有权代甲方对乙方进行关于本协议借款的违约提醒及催收工作，包括但不限于电话通知、短信通知、微信通知、手机应用推送通知、发律师函、上门催收提醒、对乙方提起诉讼等。丙方进行以上催收工作所产生的相关费用由乙方承担，甲方在此确认委托丙方为其进行以上工作，并授权丙方可以将此违约提醒及催收工作委托给本协议外的其他方进行。乙方对前述委托的提醒、催收事项已明确知晓并应积极配合。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">4.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">丙方有权向乙方收取账户管理费和快速信审费，并在有必要时对乙方进行违约提醒及催收工作，包括但不限于电话通知、短信通知、微信通知、手机应用推送通知、发律师函、上门催收提醒、对乙方提起诉讼等。</span><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">丙方进行以上催收工作所产生的相关费用由乙方承担，丙方有权将此违约提醒及催收工作委托给本协议外的其他方进行。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-weight:bold;font-size:14px">5.&nbsp;</span><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">如乙方发生逾期还款行为，丙方有权与乙方运营商详单中的电话或者短信联系人取得联系，告知乙方联系人本借款合同的内容并请求乙方联系人向乙方转达违约提醒，丙方与乙方联系人的联系方式包括但不限于电话、短信、电子邮件和上门等，丙方进行以上违约提醒及</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">或催收工作所产生的相关费用由乙方承担。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-weight:bold;font-size:14px">6.&nbsp;</span><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 14px">丙方接受甲乙双方的委托行为所产生的法律后果由相应委托方承担。如因乙方或甲方或其他方（包括但不限于技术问题）造成的延误或错误，丙方不承担任何责任。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">7.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">丙方应对甲方和乙方的信息及本协议内容保密；如任何一方违约，或因相关权力部门要求（包括但不限于法院、仲裁机构、金融监管机构等），丙方有权直接披露。</span>
	</p>
	<h3 style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">第五条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">违约责任</span></strong>
	</h3>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">1.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">合同各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">2.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查费、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息等其他费用。此时，乙方还应向丙方支付所有应付的账户管理费、快速信审费、容时期账户管理费（如有）、逾期管理费（如有）和违约引发的其他费用。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">3.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方应按照如下顺序清偿款项：</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">1</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）根据本协议产生的其他全部费用。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">2</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）本协议第五条第</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">5</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">款约定的逾期账户管理费。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">3</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）本协议第五条第</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">4</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">款约定的逾期利息。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">4</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）本协议第三条第约定的容时期账户管理费。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">5</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）本协议第三条第约定的容时期利息。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">6</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）快速信审费。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">7</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）正常的账户管理费。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">8</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）正常的利息。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">9</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">）正常的本金。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">4.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期利息。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: 微软雅黑;font-size: 14px">逾期利息总额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">&nbsp;= </span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">借款金额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">×</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">对应逾期利息利率</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">(0.05%)×</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">逾期天数。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">5.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向丙方支付逾期账户管理费。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <strong><span style="font-family: 微软雅黑;font-size: 14px">逾期管理费总额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">&nbsp;= </span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">借款金额</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">×</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">对应逾期管理费率</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">(1.95%)×</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">逾期天数。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">6.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">如果乙方逾期，或甲方</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">丙方发现乙方出现逃避、拒绝沟通或拒绝承认欠款事实、故意转让资金、信用情况恶化等影响本协议履行的情形，丙方有权将乙方的</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">“</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">逾期记录</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">”</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">、</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">“</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">恶意行为</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">”</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">或</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">“</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">不良情况</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">”</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">记入公民征信系统，或将乙方违约失信的相关信息及乙方其他信息向其亲属朋友、媒体、用人单位、公安机关、检查机关、法律机关披露，丙方不承担任何法律责任。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">7.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">当乙方逾期还款时，在乙方还清全部本金、正常利息、账户管理费、快速信审费、容时期利息、容时期账户管理费、逾期利息、逾期账户管理费之前，逾期利息及逾期账户管理费的计算不停止。</span>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第六条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">征信授权</span></strong>
	</h2>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">1.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方知晓并同意丙方依据《征信业管理条例》及相关法律法规，委托第三方征信机构，合法调查乙方信息，包括但不限于个人基本信息、借贷交易信息、银行卡交易信息、电商交易信息、公用事业信息、央行征信报告。所获取的信息，仅在此笔借贷业务的居间服务和贷后管理工作中使用。丙方将对所获取的信息妥善进行保管，除为乙方提供信审服务</span></strong><strong><span style="font-family: &#39;Courier New&#39;;font-size: 14px">/</span></strong><strong><span style="font-family: 微软雅黑;font-size: 14px">借款资金的合作方外，未经乙方授权，不得向其他机构或个人公开、编辑或透露信息内容。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">2.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方知晓并同意丙方依据《征信业管理条例》及相关法律法规，向第三方征信机构提交乙方在此笔借贷业务中产生的相关信息，包括但不限于个人基本信息、借款申请信息、借款合同信息以及还款行为信息，并记录在征信机构的个人信用信息数据库中。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">3.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方同意若乙方未按时履行还款义务，丙方按合同所留联系方式对乙方进行提醒并告知，乙方若仍未履行还款义务，丙方可将乙方的逾期还款信息提交至第三方征信机构，记录在征信机构的个人信用信息库中。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">4.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方知晓并同意，乙方已被明确告知未按时还款信息一旦记录在第三方征信机构的个人信用信息数据库中，在日后的经济活动中对乙方可能产生的不良影响。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">5.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方知晓第三方征信机构包括但不限于：北京华道征信有限公司、北京安融惠众征信有限公司、上海资信有限公司和鹏元资信评估有限公司。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">6.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方保证其所提供的个人信息均为乙方本人的真实信息，不可为他人的信息或虚假信息，若涉嫌恶意信息作假或盗用他人信息，将可能记入网络征信系统，影响乙方的征信记录，同时丙方将保留追究乙方相应法律责任的权利。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">7.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">如乙方所提供的个人信息中的全部或部分信息为他人信息或虚假信息，丙方将有权暂停或终止与乙方的全部或部分服务协议，由此行为所产生的全部法律责任将由乙方承担，丙方将不对此承担法律责任。</span>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第七条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">提前还款</span></strong>
	</h2>
	<p style="line-height:21px">
	    <strong><span style="font-family: 宋体;font-size: 14px">乙方提前还款的，需还款金额与到期日应还款金额一致。</span></strong>
	</p>
	<h3 style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">第八条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">法律及争议解决</span></strong>
	</h3>
	<p style="line-height:21px">
	    <strong><span style="font-family: 宋体;font-size: 14px">本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由丙方所在地的人民法院管辖。</span></strong>
	</p>
	<h3 style="line-height:21px">
	    <strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">第九条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 微软雅黑;color: rgb(85, 85, 85);font-size: 21px">委托代扣款授权</span></strong>
	</h3>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">授权账户信息</span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">开户名：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">**</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px"><?php echo ($user_name); ?></span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">身份证号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($id); ?></span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">持卡人手机号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($phone); ?></span>
	</p>
	<p style="line-height:21px">
	    <span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">银行卡号：</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px"><?php echo ($bank); ?></span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">1.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方保证以上</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">“</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">授权账户信息</span><span style=";font-family:&#39;Courier New&#39;;color:rgb(85,85,85);font-size:14px">”</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">中的身份及所提供的信息真实、有效、准确及合法，因乙方身份或所提供信息错误而引起的法律后果及损失，由乙方自行承担。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">2.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">乙方同意丙方通过第三方支付公司代扣支付平台，从乙方的银行账户中将还款金额一次性全部划拨到丙方在第三方支付公司的专用账户；若因乙方银行账户中的可扣取金额不足以支付全部还款金额从而导致扣款失败的，乙方同意丙方通过降低扣取数额的方式多次尝试扣款，将乙方银行账户内的可扣取金额全部拨划至丙方在第三方支付公司的专用账户，直至本协议项下的借款全部偿还完毕为止。扣款成功后，对代扣金额中甲方应得的本金、利息及其他费用，丙方按照甲方的要求支付给甲方，乙方对此表示认可。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">3.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方应当按照预付款的金额在上述银行卡内存入足够的款项，丙方工作人员根据乙方预付款金额办理相关扣款转账手续；由于挂失、账户冻结、金额不足等原因造成扣款失败而导致乙方损失的，由乙方自行承担。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">4.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">若乙方申请对本协议项下的借款进行续期的，则乙方应当在上述银行卡内存入足够的款项，丙方工作人员根据乙方续期所需交纳的款项（包括但不限于利息、快速信审费、账户管理费、续期手续费等）办理相关扣款转账手续；由于挂失、账户冻结、金额不足等原因造成扣款失败而导致乙方续期未成功或造成乙方其他损失的，由乙方自行承担。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">5.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">乙方变更付款授权账户时，须及时通知丙方，并在平台进行变更账号绑定。因乙方未及时办理变更手续而导致的结果，由乙方承担。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">6.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">本项授权自签订日起开始生效，有效期至本协议项下借款本息、费用清偿之日止。</span>
	</p>
	<h2 style="line-height:21px">
	    <strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">第十条</span></strong><strong><span style="font-family: &#39;Courier New&#39;;color: rgb(85, 85, 85);font-size: 21px">&nbsp;</span></strong><strong><span style="font-family: 黑体;color: rgb(85, 85, 85);font-size: 21px">附则</span></strong>
	</h2>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">1.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">本协议采用电子文本形式制成，并保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">2.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">本协议自文本最终生成之日生效。经甲方、乙方和丙方协商一致后，各方可对本协议进行变更或补充，并另行签署补充协议。经丙方同意后，乙方可申请对本协议项下的借款进行续期，具体约定以三方另行签署的《借款续期协议》为准。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">3.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">本协议签订之日起至借款全部清偿之日止，乙方或甲方有义务在下列信息变更三日内提供更新后的信息给丙方：手机号码、身份证号码、亲属联系人及社会联系人姓名、职业、银行账户的变更。若因任何一方不及时提供上述变更信息而带来的损失或额外费用应由该方承担。</span></strong>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">4.&nbsp;</span><span style=";font-family:微软雅黑;color:rgb(85,85,85);font-size:14px">如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</span>
	</p>
	<p style="margin-top:7px;margin-bottom:7px;margin-left:48px;margin-top:auto;margin-bottom:auto;line-height:21px">
	    <span style="font-family: 微软雅黑;font-weight: bold;font-size: 14px">5.&nbsp;</span><strong><span style="font-family: 微软雅黑;font-size: 14px">本协议各条目标题仅为方便各方阅读使用，具体意思以条文内容约定为准。</span></strong>
	</p>
	<p>
	    <span style=";font-family:Tahoma;font-size:15px">&nbsp;</span>
	</p>
	<p>
	    <br/>
	</p>
	</div>
</div>
</body>
</html>