<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>任务管理</title>

<!-- header binge -->


<link rel="stylesheet" href="<?php echo (C("URL")); ?>css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo (C("URL")); ?>css/bootstrap-fileupload.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo (C("URL")); ?>css/bootstrap-timepicker.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo (C("URL")); ?>css/responsive-tables.css">

<script type="text/javascript" charset="utf-8" src="<?php echo (C("URL")); ?>UE/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo (C("URL")); ?>UE/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo (C("URL")); ?>UE/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.form.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-1.9.1.min.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/modernizr.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/responsive-tables.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>prettify/prettify.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/elements.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo (C("URL")); ?>js/PCASClass.js"></script>





<!-- header end -->

<script type="text/javascript" src="<?php echo (C("URL")); ?>js/new/unify.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){

	
	jQuery('.taglist .close').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
	
});
</script>

</head>


<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
</head>
<body>

<!-- header binge -->


<div class="mainwrapper">
    
    <div class="leftpanel">
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            <li class="nav-header">欢迎 <?php echo (session('userid')); ?></li>
	        <li <?php echo ($set["active"]); ?>><a href="<?php echo U('Console/dashboard');?>"><span class="iconfa-laptop"></span> 后台面板</a></li>
            <?php if($limits == '1'): ?><!-- 管理员 -->
            		
	                <li class="dropdown <?php echo ($data["sh_one"]); ?>">
	                	<a href="">
		                	<span class="iconfa-comments"></span> 会员管理
	                	</a>
	                	<ul <?php echo ($data["sh_block"]); ?>>
	                    	<!-- <li <?php echo ($data["sh_two01"]); ?>><a href="<?php echo U('Admin/service');?>">添加会员</a></li> -->
	                        <li <?php echo ($data["sh_two01"]); ?>><a href="<?php echo U('Admin/s_manage');?>">会员列表</a></li>
	                        <li <?php echo ($data["sh_two02"]); ?>>
	                        	<a href="<?php echo U('Admin/user_money_info');?>">
		                        	用户借款信息
	                        	</a>
	                        </li>
	                        <li <?php echo ($data["sh_two03"]); ?>><a href="<?php echo U('Admin/user_info');?>">用户个人信息</a></li>
	                        <li <?php echo ($data["sh_two04"]); ?>><a href="<?php echo U('Admin/user_work');?>">用户职业信息</a></li>
	                        <li <?php echo ($data["sh_two05"]); ?>><a href="<?php echo U('Admin/user_gam');?>">用户社会关系</a></li>
	                    </ul>
	                </li>
	                
	                <li class="dropdown <?php echo ($data["sh_two"]); ?>">
	                	<a href="">
	                		<span class="iconfa-comments"></span>任务管理
	                		<?php if($state_num == 0): else: ?>
	                      		<span style="color:red;margin-left:10px;">(<?php echo ($state_num); ?>)</span><?php endif; ?>
	                	</a>
	                	<ul <?php echo ($data["sh_block1"]); ?>>
	                        <li  <?php echo ($data["sh_two06"]); ?>>
	                        	<a href="<?php echo U('Task/loan_task');?>">
	                        		借款任务管理
	                       			<?php if($shuju == 0): else: ?>
	                        			<span style="color:red;margin-left:10px;">(<?php echo ($shuju); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                        <li <?php echo ($data["sh_two07"]); ?>>
	                        	<a href="<?php echo U('Admin/bank_info');?>">
		                        	<?php if($bank_list == 0): ?>银行卡绑定信息
		                        	<?php else: ?>
		                        		银行卡绑定信息<span style="color:red;margin-left:10px;">(<?php echo ($bank_list); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                        <li  <?php echo ($data["sh_two09"]); ?>>
	                        	<a href="<?php echo U('Task/examine_list');?>">
	                        		<?php if($fangkuang == 0): ?>放款列表
		                        	<?php else: ?>
		                        		放款列表<span style="color:red;margin-left:10px;">(<?php echo ($fangkuang); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                    </ul>
	                </li>
					
	                <li class="dropdown <?php echo ($data["sh_three"]); ?>">
	                	<a href=""><span class="iconfa-comments"></span>
	                	<?php if($shoukaun == 0): ?>放款管理
	                	<?php else: ?>
	                		放款管理<span style="color:red;margin-left:10px;">(<?php echo ($shoukaun); ?>)</span><?php endif; ?>
	                	</a>
	                	<ul <?php echo ($data["sh_block2"]); ?>>
	                        <li <?php echo ($data["sh_two10"]); ?>><a href="<?php echo U('Transaction/loan_list');?>">放款完成</a></li>
	                        <li <?php echo ($data["sh_two11"]); ?>>
	                        <a href="<?php echo U('Transaction/no_repayment');?>">
	                        <?php if($shoukaun == 0): ?>未还款/已还款
	                        <?php else: ?>
	                        	未还款/已还款<span style="color:red;margin-left:10px;">(<?php echo ($shoukaun); ?>)</span><?php endif; ?>
	                        </a>
	                        </li>
	                        <li <?php echo ($data["sh_two12"]); ?>><a href="<?php echo U('Transaction/overdue');?>">逾期</a></li>
	                    </ul>
	                </li>
				<li class="dropdown <?php echo ($data["sh_four"]); ?>"><a href=""><span class="iconfa-comments"></span>代理管理</a>
                	<ul <?php echo ($data["sh_block3"]); ?>>
                        <li <?php echo ($data["sh_two13"]); ?>><a href="<?php echo U('Agent/agent');?>">添加代理成员</a></li>
                        <li <?php echo ($data["sh_two14"]); ?>><a href="<?php echo U('Agent/agent_list');?>">代理成员信息</a></li>
                    </ul>
                </li>
                
               <!-- <li class="dropdown <?php echo ($data["sh_five"]); ?>"><a href=""><span class="iconfa-comments"></span>审核员管理</a>
                	<ul <?php echo ($data["sh_block4"]); ?>>
                        <li <?php echo ($data["sh_two15"]); ?>><a href="<?php echo U('Examine/examine');?>">添加审核成员</a></li>
                        <li <?php echo ($data["sh_two16"]); ?>><a href="<?php echo U('Examine/examine_list');?>">审核成员信息</a></li>
                    </ul>
                </li>-->
                
                <li class="dropdown <?php echo ($data["sh_six"]); ?>"><a href=""><span class="iconfa-comments"></span>文章管理</a>
                	<ul <?php echo ($data["sh_block5"]); ?>>
                        <li <?php echo ($data["sh_two17"]); ?>><a href="<?php echo U('Article/add_problem');?>">添加文章</a></li>
                        <li <?php echo ($data["sh_two18"]); ?>><a href="<?php echo U('Article/problem_list');?>">文章列表</a></li>
                        <li <?php echo ($data["sh_two19"]); ?>><a href="<?php echo U('Article/message_list');?>">用户留言</a></li>
                        <li <?php echo ($data["sh"]); ?>><a href="<?php echo U('Article/surver_list');?>">调研报告列表</a></li>
                        <li <?php echo ($data["sh_two20"]); ?>><a href="<?php echo U('Article/agreement');?>">编辑协议</a></li>
                    </ul>
                </li>
                
                <!--<li class="dropdown <?php echo ($data["aa"]); ?>"><a href=""><span class="iconfa-comments"></span>活动管理</a>
                	<ul <?php echo ($data["sh_block7"]); ?>>
                        <li <?php echo ($data["sh_two30"]); ?>><a href="<?php echo U('Activity/add_activity');?>">添加活动</a></li>
                        <li <?php echo ($data["sh_two31"]); ?>><a href="<?php echo U('Activity/activity_list');?>">活动列表</a></li>
                    </ul>
                </li>
                
                
                <li class="dropdown <?php echo ($data["bb"]); ?>"><a href=""><span class="iconfa-comments"></span>合同下载</a>
                	<ul <?php echo ($data["sh_block8"]); ?>>
                        <li <?php echo ($data["sh_two32"]); ?>><a href="<?php echo U('Contract/contract_list');?>">合同列表</a></li>
                    </ul>
                </li>-->
            	
                 <li class="dropdown <?php echo ($data["sh_seven"]); ?>"><a href=""><span class="iconfa-comments"></span> 基本配置</a>
                	<ul <?php echo ($data["sh_block6"]); ?>>
                       <!-- <li <?php echo ($data["sh_two21"]); ?>><a href="<?php echo U('Admin/sms');?>">短信配置</a></li>-->
                		<li <?php echo ($data["sh_two23"]); ?>><a href="<?php echo U('Admin/money_manage');?>">借款套餐配置</a></li>
                		<li <?php echo ($data["sh_two24"]); ?>><a href="<?php echo U('Admin/overdue');?>">逾期配置</a></li>
                		<li <?php echo ($data["sh_two28"]); ?>><a href="<?php echo U('Admin/xuqi');?>">续期配置</a></li>
                		<li <?php echo ($data["sh_two29"]); ?>><a href="<?php echo U('Admin/admin_data');?>">资料配置</a></li>
                        <li <?php echo ($data["sh_two26"]); ?>><a href="<?php echo U('Index/editprofile');?>">修改密码</a></li>
                        <li <?php echo ($data["sh_two27"]); ?>><a href="<?php echo U('Daoqi/daoqi');?>">到期提醒配置</a></li>
                        <li><a href="<?php echo U('Index/exit_t');?>">退出</a></li>
                    </ul>
                </li>
                
            <?php elseif($limits == '3'): ?>
            	 <li class="dropdown <?php echo ($data["sh_one"]); ?>">
	               	<a href="">
	                	<span class="iconfa-comments"></span> 会员管理
	               	</a>
	               	<ul <?php echo ($data["sh_block"]); ?>>
	                       <li <?php echo ($data["sh_two01"]); ?>><a href="<?php echo U('Admin/s_manage');?>">会员列表</a></li>
	                       <li <?php echo ($data["sh_two02"]); ?>>
	                       	<a href="<?php echo U('Admin/user_money_info');?>">
	                        	用户借款信息
	                       	</a>
	                       </li>
	                       <li <?php echo ($data["sh_two03"]); ?>><a href="<?php echo U('Admin/user_info');?>">用户个人信息</a></li>
	                       <li <?php echo ($data["sh_two04"]); ?>><a href="<?php echo U('Admin/user_work');?>">用户职业信息</a></li>
	                       <li <?php echo ($data["sh_two05"]); ?>><a href="<?php echo U('Admin/user_gam');?>">用户社会关系</a></li>
	                   </ul>
	              </li>
                
                 <li class="dropdown <?php echo ($data["sh_two"]); ?>">
	                	<a href="">
	                		<span class="iconfa-comments"></span>任务管理
	                		<?php if($state_num == 0): else: ?>
	                      		<span style="color:red;margin-left:10px;">(<?php echo ($state_num); ?>)</span><?php endif; ?>
	                	</a>
	                	<ul <?php echo ($data["sh_block1"]); ?>>
	                        <li  <?php echo ($data["sh_two06"]); ?>>
	                        	<a href="<?php echo U('Task/loan_task');?>">
	                        		借款任务管理
	                       			<?php if($shuju == 0): else: ?>
	                        			<span style="color:red;margin-left:10px;">(<?php echo ($shuju); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                        <li <?php echo ($data["sh_two07"]); ?>>
	                        	<a href="<?php echo U('Admin/bank_info');?>">
		                        	<?php if($bank_list == 0): ?>银行卡绑定信息
		                        	<?php else: ?>
		                        		银行卡绑定信息<span style="color:red;margin-left:10px;">(<?php echo ($bank_list); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                        <!-- <li <?php echo ($data["sh_two08"]); ?>>
	                        	<a href="<?php echo U('Admin/user_img');?>">
		                        	<?php if($img == 0): ?>持证自拍审核
		                        	<?php else: ?>
		                        		持证自拍审核<span style="color:red;margin-left:10px;">(<?php echo ($img); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li> -->
	                        <li  <?php echo ($data["sh_two09"]); ?>>
	                        	<a href="<?php echo U('Task/examine_list');?>">
	                        		<?php if($fangkuang == 0): ?>放款列表
		                        	<?php else: ?>
		                        		放款列表<span style="color:red;margin-left:10px;">(<?php echo ($fangkuang); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                    </ul>
	                </li>
				
                <li class="dropdown <?php echo ($data["sh_three"]); ?>"><a href=""><span class="iconfa-comments"></span>放款管理</a>
                	<ul <?php echo ($data["sh_block2"]); ?>>
                        <li <?php echo ($data["sh_two10"]); ?>><a href="<?php echo U('Transaction/loan_list');?>">放款完成</a></li>
                        <li <?php echo ($data["sh_two11"]); ?>><a href="<?php echo U('Transaction/no_repayment');?>">未还款</a></li>
                        <li <?php echo ($data["sh_two12"]); ?>><a href="<?php echo U('Transaction/overdue');?>">逾期</a></li>
                    </ul>
                </li>
                <li class="dropdown <?php echo ($data["sh_seven"]); ?>"><a href=""><span class="iconfa-comments"></span> 基本配置</a>
                	<ul <?php echo ($data["sh_block6"]); ?>>
                        <li><a href="<?php echo U('Index/exit_t');?>">退出</a></li>
                    </ul>
                </li>
                
            <?php elseif($limits == '2'): ?>
            	<li class="dropdown <?php echo ($data["sh_two"]); ?>">
	                	<a href="">
	                		<span class="iconfa-comments"></span>任务管理
	                		<?php if($state_num == 0): else: ?>
	                      		<span style="color:red;margin-left:10px;">(<?php echo ($state_num); ?>)</span><?php endif; ?>
	                	</a>
	                	<ul <?php echo ($data["sh_block1"]); ?>>
	                        <li  <?php echo ($data["sh_two06"]); ?>>
	                        	<a href="<?php echo U('Task/loan_task');?>">
	                        		借款任务管理
	                       			<?php if($shuju == 0): else: ?>
	                        			<span style="color:red;margin-left:10px;">(<?php echo ($shuju); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                        <li <?php echo ($data["sh_two07"]); ?>>
	                        	<a href="<?php echo U('Admin/bank_info');?>">
		                        	<?php if($bank_list == 0): ?>银行卡绑定信息
		                        	<?php else: ?>
		                        		银行卡绑定信息<span style="color:red;margin-left:10px;">(<?php echo ($bank_list); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li>
	                        <!-- <li <?php echo ($data["sh_two08"]); ?>>
	                        	<a href="<?php echo U('Admin/user_img');?>">
		                        	<?php if($img == 0): ?>持证自拍审核
		                        	<?php else: ?>
		                        		持证自拍审核<span style="color:red;margin-left:10px;">(<?php echo ($img); ?>)</span><?php endif; ?>
	                        	</a>
	                        </li> -->
	                    </ul>
	                </li>
	                <li class="dropdown <?php echo ($data["sh_seven"]); ?>"><a href=""><span class="iconfa-comments"></span> 基本配置</a>
	                	<ul <?php echo ($data["sh_block6"]); ?>>
	                        <li><a href="<?php echo U('Index/exit_t');?>">退出</a></li>
	                    </ul>
	                </li><?php endif; ?>
            
            </ul>
        </div><!--leftmenu-->
    </div><!-- leftpanel -->

<!-- header end -->
    
    <div class="rightpanel">
        <!-- head binge -->
        
			
        <ul class="breadcrumbs">
            <li><a href="<?php echo U('Console/dashboard');?>"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li><a href="<?php echo U('Console/dashboard');?>">后台面板</a> <span class="separator"></span></li>
            <li>任务管理</li>
        </ul>
		
		<!-- head end -->
        
        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                   <div>
                        <div class="widgetbox personal-information">
                            <h4 class="widgettitle">任务管理</h4>
                            <div class="widgetcontent" id="user" style="height: 2500px;">
                            	<div style="float:left;margin-top: -15px;">
	                            	<?php if($list[0]['img1'] == null or $list[0]['img2'] == null or $list[0]['img3'] == null): ?><span>图片:</span>
	                            		<span>未持证自拍</span>
	                            	<?php else: ?>
		                            	<p>
		                            		<a href="<?php echo ($list[0]['img1']); ?>" target="_blank"><img src="<?php echo ($list[0]['img1']); ?>" style="width:600px;height:600px"></a>
		                            	</p>
		                            	<p>
		                            		<a href="<?php echo ($list[0]['img2']); ?>" target="_blank"><img src="<?php echo ($list[0]['img2']); ?>" style="width:600px;height:600px"></a>
		                            	</p>
		                            	<p>
		                            		<a href="<?php echo ($list[0]['img3']); ?>" target="_blank"><img src="<?php echo ($list[0]['img3']); ?>" style="width:600px;height:600px"></a>
		                            	</p>
		                            	<?php if($xuesheng != null): ?><p>
		                            		<a href="<?php echo ($xuesheng['url']); ?>" target="_blank"><img src="<?php echo ($xuesheng['url']); ?>" style="width:600px;height:300px"></a>
		                            	</p><?php endif; endif; ?>
                            	</div>
                            	
                            	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-left: 750px;">
                            	<div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								          	借款信息
								        </a>
								      </h4>
								    </div>
								    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								      	<p><span>手机号：</span><span id="phone"><?php echo ($phone); ?></span></p>
								      		<p><span style="color:red;">芝麻分：</span><span><?php echo ($list[0]['integral']); ?></span>&nbsp;&nbsp;<a href="#myModal" role="button"  data-toggle="modal">设置芝麻分</a></p>
			                            	<p><span>申请时间：</span><span><?php echo ($res[0]['apply_time']); ?></span></p>
			                            	<p><span>金额：</span><span><?php echo ($res[0]['money_num']); ?></span></p>
			                            	<p><span>期限：</span><span><?php echo ($res[0]['time_length']); ?></span></p>
			                            	<p><span>快速信审费：</label><span><?php echo ($res[0]['letter']); ?></span></span>
			                            	<p><span>息费：</span><span><?php echo ($res[0]['interest']); ?></span></p>
			                            	<p><span>账户管理费：</span><span><?php echo ($res[0]['account_money']); ?></span></p>
			                            	<p><span>到期还款额：</span><span><?php echo ($res[0]['sum']); ?></span></p>
			                            	<?php if($info != null): ?><p><span>已经扣除相关费用</span></p><?php endif; ?>
			                            	<p><span>服务密码：</span><span><?php echo ($list[0]['service_pwd']); ?></span></p>
								      </div>
								    </div>
								  </div>
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingFive">
								      <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
								          	个人信息
								        </a>
								      </h4>
								    </div>
								    <div id="collapseFive" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
								      <div class="panel-body">
								      	<p><span>手机号：</span><span><?php echo ($phone); ?></span></p>
			                            	<p><span>姓名：</span><span><?php echo ($list[0]['name']); ?></span></p>
			                            	<p><span>身份证号：</span><span><?php echo ($list[0]['uid']); ?></span></p>
			                            	<p><span>qq：</span><span><?php echo ($list[0]['qq']); ?></span></p>
			                            	<p><span>邮箱：</label><span><?php echo ($list[0]['email']); ?></span></span>
			                            	<p><span>教育水平：</span><span><?php echo ($list[0]['education']); ?></span></p>
			                            	<p><span>婚姻状况：</span><span><?php echo ($list[0]['marriage']); ?></span></p>
			                            	<p><span>有没有子女：</span><span><?php echo ($list[0]['is_children']); ?></span></p>
								      </div>
								    </div>
								  </div>
								  <?php if($xuesheng == null): ?><div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingTwo">
								      <h4 class="panel-title">
								        <a class="button" role="button" data-toggle="collapse"   data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								         	 工作信息
								        </a>
								      </h4>
								    </div>
								    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
								      <div class="panel-body">
								      	<p><span>工作名称：</span><span><?php echo ($work['work']); ?></span></p>
			                            	<p><span>工资：</span><span><?php echo ($work['wages']); ?></span></p>
			                            	<p><span>单位名称：</span><span><?php echo ($work['company_name']); ?></span></p>
			                            	<p><span>工作所在地区：</span><span><?php echo ($work['province']); echo ($work['city']); ?></span></p>
			                            	<p><span>所在地址：</span><span><?php echo ($work['address']); ?></span></p>
			                            	<p><span>单位固定电话：</span><span><?php echo ($work['zip_code']); ?></span></p>
								      </div>
								    </div>
								  </div>
								  <?php else: ?>
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingTwo">
								      <h4 class="panel-title">
								        <a class="button" role="button" data-toggle="collapse"   data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								         	 学生信息
								        </a>
								      </h4>
								    </div>
								    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
								      <div class="panel-body">
								      	<p><span>学校名称：</span><span><?php echo ($xuesheng['school']); ?></span></p>
			                            	<p><span>地区：</span><span><?php echo ($xuesheng['province']); echo ($xuesheng['city']); ?></span></p>
			                            	<p><span>入学时间：</span><span><?php echo ($xuesheng['time']); ?></span></p>
			                            	<p><span>学信网账号：</span><span><?php echo ($xuesheng['account']); ?></span></p>
			                            	<p><span>学信网密码：</span><span><?php echo ($xuesheng['password']); ?></span></p>
								      </div>
								    </div>
								  </div><?php endif; ?>
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingThree">
								      <h4 class="panel-title">
								        <a class="button" role="button" data-toggle="collapse"  data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								          	社交联系人
								        </a>
								      </h4>
								    </div>
								    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
								      <div class="panel-body">
								      	<p><span>联系人：</span><span><?php echo ($list[0]['family']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<p>姓名：<span><?php echo ($list[0]['family_name']); ?></span></p><span>电话：<span><?php echo ($list[0]['family_mobile']); ?></span></span></p>
										<p><span>联系人：</span><span><?php echo ($list[0]['gam']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<p>姓名：<span><?php echo ($list[0]['gam_name']); ?></span></p><span>电话：<span><span><?php echo ($list[0]['gam_mobile']); ?></span></span></p>
										<p><span>联系人：</span><span><?php echo ($list[0]['gam2']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<p>姓名：<span><?php echo ($list[0]['gam_name2']); ?></span></p><span>电话：<span><span><?php echo ($list[0]['gam_mobile2']); ?></span></span></p>
								      </div>
								    </div>
								  </div>
								  <?php if($info['wait_xuqi'] == 2): ?><button type="button" class="btn btn-primary" onclick="ok_xuqi(this)" value="" id="<?php echo ($phone); ?>">同意续期</button>
								  		<button type="button" class="btn"  value="" onclick="remark(this)" id="<?php echo ($phone); ?>">不同意</button>
								  <?php else: ?>
								  		<button type="button" class="btn btn-primary" onclick="adopt_ok(this)" value="" id="<?php echo ($phone); ?>">通过</button>
								  		<button type="button" class="btn"  value="" onclick="remark(this)" id="<?php echo ($phone); ?>">不通过</button><?php endif; ?>
								</div>
                            	

                            </div>
                                      
                        </div>
                        
                        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						    <h3 id="myModalLabel">设置芝麻分</h3>
						  </div>
						  <div class="modal-body">
						    <span>芝麻分:</span>
						    <input type="text" name="integral" id="integral" value="<?php echo ($list[0]['integral']); ?>">
						    <input type="hidden" name="phone" value="<?php echo ($phone); ?>">
						  </div>
						  <div class="modal-footer">
						    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
						    <button type="button" class="btn btn-primary" onclick="zmf()">确定</button>
						  </div>
						</div>
                    </div><!--row-fluid-->
                  
                  
        		 <!-- footer binge -->
								<div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2017. <a href="http://www.9xgk.com/" target="_blank">9xgk.com/</a> All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://www.9xgk.com/" target="_blank">九星高科电子商务有限公司</a></span>
                    </div>
                </div><!--footer-->
				
				<!-- footer end -->
                
                
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->

</body>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script>
function zmf(){
	var phone = $("#phone").text();
	var integral = $("#integral").val();
	$.ajax({
		type:"POST",
		url:"<?php echo U('Admin/integral');?>",
		data:{
			"integral":integral,
			"phone":phone
		},
		datatype:"json",
		success:function(data){
			if(data == '添加成功'){
				setTimeout(function(){window.location.reload()},1000);
			}else{
				alert(data);
			}
		}
	})
}
function remark(obj){
	var phone = obj.id;
	window.location.href="/index.php/Task/no_adopt?phone="+phone;
}
function adopt_ok(obj){
	var phone = obj.id;
	window.location.href="/index.php/Task/ok_adopt?phone="+phone;
}
function ok_xuqi(obj){
	var phone = obj.id;
	$.ajax({
		type:"POST",
		url:"<?php echo U('Task/ok_xuqi');?>",
		data:{'phone':phone},
		datatype:"json",
		success:function(data){
			if(data == '同意续期'){
				alert(data);
				setTimeout(function(){window.location.href="/index.php/Task/loan_task"},1000);
			}
		}
	})
}
</script>
</html>