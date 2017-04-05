<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>会员管理</title>

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




<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo (C("URL")); ?>js/jquery.cookie.js"></script>
<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
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
        <!-- head binge -->
        
			
        <ul class="breadcrumbs">
            <li><a href="<?php echo U('Console/dashboard');?>"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li><a href="<?php echo U('Console/dashboard');?>">后台面板</a> <span class="separator"></span></li>
            <li>会员管理</li>
        </ul>
		
		<!-- head end -->
        
        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                   <div>
                        <div class="widgetbox personal-information">
                            <h4 class="widgettitle">会员管理</h4>
                            <div class="widgetcontent" id="user" method="get">
	                            <form id="form" action="<?php echo U('Admin/s_manage');?>">
	                            	<input type="hidden" value="<?php echo ($type); ?>" id="type">
	                            	<select name="type" style="width: 80px;" id="select1">
	                            		<option value="1">手机号</option>
	                            		<option value="2">姓名</option>
	                            	</select>
	                            	<input type="text" class="input-xlarge" name="content" placeholder="请输入要搜索的手机号码或姓名" style="width:150px;" value="<?php echo ($content); ?>">
	                            	<input type="hidden" value="<?php echo ($is_adopt); ?>" id="is_adopt">
	                            	<select name="is_adopt" style="width:100px;" id="select2">
                            			<option value="">选择状态</option>
                            			<option value="-1">未完善个人资料</option>
                            			<option value="0">申请中</option>
                            			<option value="1">通过审核</option>
                            			<option value="2">未通过</option>
                            			<option value="3">已取消申请</option>
                            		</select>
                            		<?php if($limits == '1'): ?><input type="hidden" value="<?php echo ($loan_people); ?>" id="loan_people">
	                            		<select name="loan_people" style="width:100px;" id="select3">
	                            			<option value="">选择审核人员</option>
		                            			<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["userid"]); ?>"><?php echo ($vo["userid"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	                            		</select><?php endif; ?>
                            		<span>日期：<input type="text" id="datepicker1" style="width:80px" name="apply_time1" value="<?php echo ($apply_time1); ?>">至<input type="text" id="datepicker2" style="width:80px" name="apply_time2" value="<?php echo ($apply_time2); ?>"></span>
	                            	<input type="submit" class="btn btn-primary" value="搜索" name="submit">
	                            </form>
	                            <div  id="tab1">
	                            	<table class="table table-bordered">
	                            		<tr>
	                            			<th width="300px;">昵称</th>
	                            			<th width="100px;">姓名</th>
	                            			<th width="200px;">手机</th>
	                            			<th width="300px;">注册时间</th>
	                            			<th width="200px;">状态</th>
	                            			<th width="100px;">审核人员</th>
	                            			<th width="100px;">推荐人</th>
	                            		</tr>
	                            		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="s_manage<?php echo ($vo["id"]); ?>">
	                            				<td><?php echo ($vo["uname"]); ?></td>
	                            				<td><?php echo ($vo["name"]); ?></td>
	                            				<td><a href="<?php echo U('Admin/user_details',array('phone'=>$vo[phone]));?>"><?php echo ($vo["phone"]); ?></a></td>
	                            				<td><?php echo ($vo["time"]); ?></td>
	                            				<td>
	                            					<?php if($vo["is_adopt"] == -1): ?>未完善个人资料
		                           					<?php elseif($vo["is_adopt"] == 0): ?>
		                           						<span style="color:red">申请中</span>
		                           					<?php elseif($vo["is_adopt"] == 1): ?>
		                           						通过审核
		                           					<?php elseif($vo["is_adopt"] == 2): ?>
		                           						未通过
		                           					<?php else: ?>
		                           						已取消申请<?php endif; ?>
	                            				</td>
	                            				<td><?php echo ($vo["loan_people"]); ?></td>
	                            				<td><?php echo ($vo["recommend"]); ?></td>
	                            			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	                            	</table> 
	                            	<?php echo ($page); ?>
                            	</div>
                            	<div id="tab2" style="display:none">
		                    		<table class="table table-bordered" id="table">
		                    			<tr id="tr">
	                            			<th width="300px;">昵称</th>
	                            			<th width="100px;">姓名</th>
	                            			<th width="200px;">手机</th>
	                            			<th width="300px;">注册时间</th>
	                            			<th width="200px;">状态</th>
	                            			<th width="100px;">审核人员</th>
	                            			<th width="100px;">推荐人</th>
	                            		</tr>
		                    		</table> 
		                    	</div>
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
<script src="http://malsup.github.io/jquery.form.js"></script>
<script>
var type = $('#type').val();
$('#select1').find("option[value='"+type+"']").attr("selected",true);
var is_adopt = $('#is_adopt').val();
$('#select2').find("option[value='"+is_adopt+"']").attr("selected",true);
var loan_people = $('#loan_people').val();
$('#select3').find("option[value='"+loan_people+"']").attr("selected",true);

//日期选择器 
  $(function() {
    $( "#datepicker1" ).datepicker({ dateFormat:"yy-mm-dd" });
    $( "#datepicker2" ).datepicker({ dateFormat:"yy-mm-dd" });
  });
//搜索手机用户 
function user_search(){
	$('#table #tr').siblings('tr').remove();
	$('#form').ajaxSubmit({
		type:"POST",
		url:"<?php echo U('Admin/s_manage_search');?>",
		datatype:"json",
		success:function(data){
			$.each(data,function(){
				if(this.is_adopt == -1){
					$('#table').append("<tr>"
					+"<td>"+this.uname+"</td>"
					+"<td>"+this.name+"</td>"
					+"<td><a href='/index.php/Admin/user_details?phone="+this.phone+"'>"+this.phone+"</a></td>"
					+"<td>"+this.time+"</td>"
					+"<td>未完善个人资料</td>"
					+"<?php if("+this.loan_people+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.loan_people+"</td>"
					+"<?php endif; ?>"
					+"<?php if("+this.recommend+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.recommend+"</td>"
					+"<?php endif; ?>"
					+"</tr>");
				}else if(this.is_adopt == 0){
					$('#table').append("<tr>"
					+"<td>"+this.uname+"</td>"
					+"<td>"+this.name+"</td>"
					+"<td><a href='/index.php/Admin/user_details?phone="+this.phone+"'>"+this.phone+"</a></td>"
					+"<td>"+this.time+"</td>"
					+"<td><span style='color:red'>申请中</span></td>"
					+"<?php if("+this.loan_people+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.loan_people+"</td>"
					+"<?php endif; ?>"
					+"<?php if("+this.recommend+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.recommend+"</td>"
					+"<?php endif; ?>"
					+"</tr>");
				}else if(this.is_adopt == 1){
					$('#table').append("<tr>"
					+"<td>"+this.uname+"</td>"
					+"<td>"+this.name+"</td>"
					+"<td><a href='/index.php/Admin/user_details?phone="+this.phone+"'>"+this.phone+"</a></td>"
					+"<td>"+this.time+"</td>"
					+"<td>通过审核</td>"
					+"<?php if("+this.loan_people+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.loan_people+"</td>"
					+"<?php endif; ?>"
					+"<?php if("+this.recommend+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.recommend+"</td>"
					+"<?php endif; ?>"
					+"</tr>");
				}else if(this.is_adopt == 2){
					$('#table').append("<tr>"
					+"<td>"+this.uname+"</td>"
					+"<td>"+this.name+"</td>"
					+"<td><a href='/index.php/Admin/user_details?phone="+this.phone+"'>"+this.phone+"</a></td>"
					+"<td>"+this.time+"</td>"
					+"<td>未通过审核</td>"
					+"<?php if("+this.loan_people+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.loan_people+"</td>"
					+"<?php endif; ?>"
					+"<?php if("+this.recommend+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.recommend+"</td>"
					+"<?php endif; ?>"
					+"</tr>");
				}else if(this.is_adopt == 3){
					$('#table').append("<tr>"
					+"<td>"+this.uname+"</td>"
					+"<td>"+this.name+"</td>"
					+"<td><a href='/index.php/Admin/user_details?phone="+this.phone+"'>"+this.phone+"</a></td>"
					+"<td>"+this.time+"</td>"
					+"<td>已取消申请</td>"
					+"<?php if("+this.loan_people+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.loan_people+"</td>"
					+"<?php endif; ?>"
					+"<?php if("+this.recommend+" == null): ?>"
					+"<td></td>"
					+"<?php else: ?>"
					+"<td>"+this.recommend+"</td>"
					+"<?php endif; ?>"
					+"</tr>");
				}
			});
			$('#tab1').css('display','none');
			$('#tab2').css('display','block');
		}
	})
}
</script>
</html>