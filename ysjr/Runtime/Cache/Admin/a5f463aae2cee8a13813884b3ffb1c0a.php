<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>调研列表</title>

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
<body >

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
                        <li <?php echo ($data["sh_two17"]); ?>><a href="<?php echo U('Article/add_problem');?>">添加常见问题</a></li>
                        <li <?php echo ($data["sh_two18"]); ?>><a href="<?php echo U('Article/problem_list');?>">常见问题列表</a></li>
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
        
        <ul class="breadcrumbs">
            <li><a href="<?php echo U('Console/dashboard');?>"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li><a href="<?php echo U('Console/dashboard');?>">后台面板</a> <span class="separator"></span></li>
            <li>调研列表</li>
        </ul>
               
        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                        <div class="form-content container-fluid">
							<div class="row" style="padding-left: 34px;">
			
								<div class="fields clearfix">
									<div class="field field-mobile-field col-sm-12 required"
										data-api-code="field_1" data-type="MobileField"
										data-label="您的手机号"
										data-validations="[&quot;Presence&quot;,&quot;Uniqueness&quot;,&quot;Format&quot;]">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_1"> 手机号 </label>
											</div>
											<div class="field-content">
			
												<div data-role='verification_sender'>
													<input class="mobile-input input-with-icon" value="<?php echo ($list['phone']); ?>" readonly="true"/>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_2"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_3"> 您是怎么关注到e快金的？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
														<input type="radio" checked="checked"/><?php echo ($list['follow']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_4"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12"
										data-api-code="field_44" data-type="SectionBreak" data-label=""
										data-validations="[]">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_44"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_7"> 在e快金借款，您最看重的因素是？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="radio" checked="checked"/><?php echo ($list['factor']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_33"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-number-field col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_9"> 您期待的一次借款金额是多少？<span>（请输入500-5000之间的数字）</span>
												</label>
											</div>
											<div class="field-content">
												<input class="input-with-icon"  type="text" value="<?php echo ($list['money_num']); ?>"/>
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_10"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-drop-down col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_48"> 您期待的一次借款天数是多少？ </label>
											</div>
											<div class="field-content">
			
												<select name="time_length" id="entry_field_48"
													class="needsclick" data-has-error="false">
													<option value="<?php echo ($list['time_length']); ?>"><?php echo ($list['time_length']); ?></option>
												</select>
			
			
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_13"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-check-box col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_14"> 您在e快金借款的主要用途是？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="checkbox"  checked="checked"/>
														<?php echo ($list['purpose']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_15"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-check-box col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_16"> 借款过程中您曾经遇到过哪些问题？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="checkbox"checked="checked"/>
														<?php echo ($list['problem']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_17"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_18"> 您对我们的人工客服感觉如何？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="radio"checked="checked"/><?php echo ($list['service']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_19"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_20"> 您是否有信用卡？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
												<?php if($list['credit'] == 1): ?><input type="radio" name="credit" checked="checked"/>有
												<?php else: ?>
													<input type="radio" name="credit" checked="checked"/>没有<?php endif; ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_21"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_23"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_24"> 您在意您的征信记录吗？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="radio" checked="checked"/><?php echo ($list['faith']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12"
										data-api-code="field_25" data-type="SectionBreak" data-label=""
										data-validations="[]">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_25"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-check-box col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_26"> 您觉得征信记录不良会有哪些负面影响？ </label>
											</div>
											<div class="field-content">
												<div class="choices font-family-inherit">
													<input type="checkbox"checked="checked"/>
														<?php echo ($list['bad_faith']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_27"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_36"> 您急需用钱的时候多吗？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="radio" checked="checked"/><?php echo ($list['is_need_money']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_40"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-radio-button col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_37"> 您一般在什么时候比较缺钱？ </label>
											</div>
											<div class="field-content">
			
												<div class="choices font-family-inherit">
													<input type="radio"checked="checked"/><?php echo ($list['time_lack']); ?>
												</div>
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_8"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-number-field col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_45"> 您几号发工资？
												</label>
											</div>
											<div class="field-content">
			
												<input class="input-with-icon" type="number" value="<?php echo ($list['pay_off']); ?>"/>
			
			
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_41"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_29"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-text-area col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_30"> 您觉得e快金哪方面做的不错？<span>（请填写4-200个字符）</span>
												</label>
											</div>
											<div class="field-content">
												<div class="field-description clearfix">
												</div>
												<textarea rows="3" name="proposal" disabled="disabled"><?php echo ($list['proposal']); ?></textarea>
											</div>
										</div>
			
			
									</div>
									<div class="field field-section-break col-sm-12">
										<hr />
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_31"> </label>
											</div>
											<div class="field-content"></div>
										</div>
			
			
									</div>
									<div class="field field-text-area col-sm-12 required">
			
			
										<div class="form-group">
											<div class="field-label-container" onclick="">
												<label class="field-label font-family-inherit"
													for="entry_field_32"> 您觉得e快金哪方面做的最差？<span>（请填写4-200个字符）</span>
												</label>
											</div>
											<div class="field-content">
												<textarea rows="3" name="complain" disabled="disabled"><?php echo ($list['complain']); ?></textarea>
			
											</div>
										</div>
			
			
									</div>
								</div>
							</div>
						</div>
               	</div> 
                
        	</div><!--maincontent-->
        
    	</div><!--rightpanel-->
    
	</div><!--mainwrapper-->

</body>
</html>