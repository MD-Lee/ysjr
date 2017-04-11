<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>用户个人信息</title>

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
            <li>用户个人信息</li>
        </ul>
		
		<!-- head end -->
        
        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                   <div>
                        <div class="widgetbox personal-information">
                            <h4 class="widgettitle">用户个人信息</h4>
                            <div class="widgetcontent">
                            	<form id="form" action="<?php echo U('Admin/search_user_info');?>">
                            		<input type="text" class="input-xlarge" name="phone" placeholder="请输入要搜索的手机号码">
                            		<select name="education">
										  <option value="">教育水平</option>
										  <option value="小学">小学</option>
										  <option value="初中">初中</option>
										  <option value="高中">高中</option>
										  <option  value="大专">大专</option>
										  <option value="本科">本科</option>
										  <option value="研究生">研究生</option>
										  <option value="博士">博士</option>
								  	</select>
                            		<input type="button" class="btn btn-primary" value="搜索" onclick="user_search()">
                            	</form>
                            	<div id="tab1">
	                            	<table class="table table-bordered">
	                            		<tr>
	                            			<th width="150px;">手机号</th>
	                            			<th width="150px;">姓名</th>
	                            			<th width="200px;">身份证号码</th>
	                            			<th width="200px;">QQ号码</th>
	                            			<th width="200px;">电子邮箱地址</th>
	                            			<th width="200px;">芝麻分</th>
	                            			<th width="250px;">教育水平</th>
	                            			<th width="250px;">婚姻状况</th>
	                            			<th width="300px;">有没有子女</th>
	                            			<th width="350px;">操作</th>
	                            		</tr>
	                            		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	                            				<td><?php echo ($vo["phone"]); ?></td>
	                            				<td><?php echo ($vo["name"]); ?></td>
	                            				<td><?php echo ($vo["uid"]); ?></td>
	                            				<td><?php echo ($vo["qq"]); ?></td>
	                            				<td><?php echo ($vo["email"]); ?></td>
	                            				<td><?php echo ($vo["integral"]); ?></td>
	                            				<td><?php echo ($vo["education"]); ?></td>
	                            				<td><?php echo ($vo["marriage"]); ?></td>
	                            				<td><?php echo ($vo["is_children"]); ?></td>
	                            				<td>
	                            					<a href="#myModal" role="button" class="btn btn-inverse" data-toggle="modal" onclick="get_mobile(this)" id="<?php echo ($vo["phone"]); ?>">芝麻分</a>
	                            				</td>
	                            			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	                            	</table> 
									<?php echo ($page); ?>
								</div>
								<div id="tab2" style="display:none">
									<table id="table" class="table table-bordered">
										<tr id="tr">
	                            			<th width="150px;">手机号</th>
	                            			<th width="150px;">姓名</th>
	                            			<th width="200px;">身份证号码</th>
	                            			<th width="200px;">QQ号码</th>
	                            			<th width="200px;">电子邮箱地址</th>
	                            			<th width="200px;">芝麻分</th>
	                            			<th width="250px;">教育水平</th>
	                            			<th width="250px;">婚姻状况</th>
	                            			<th width="300px;">有没有子女</th>
	                            			<th width="350px;">操作</th>
	                            		</tr>
									</table>
								</div>
                            </div>
                                      
                        </div>


						<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						    <h3 id="myModalLabel">添加芝麻分</h3>
						  </div>
						  <div class="modal-body">
						    <span>芝麻分:</span>
						    <input type="text" name="integral" id="integral">
						    <input type="hidden" name="phone" value="">
						  </div>
						  <div class="modal-footer">
						    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
						    <button type="button" class="btn btn-primary" onclick="add_sesame()">确定</button>
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
function get_mobile(obj){
	var id = obj.id;
	$("input[name='phone']").val(id);
	var phone = $("input[name='phone']").val();
	$.ajax({
		type:"POST",
		url:"<?php echo U('Admin/get_integral');?>",
		data:{'phone':phone},
		datatype:"json",
		success:function(data){
			$("#integral").val(data);
		}
	})
}
//搜索手机用户 
function user_search(){
	$('#table #tr').siblings('tr').remove();
	$('#form').ajaxSubmit({
		type:"POST",
		url:$('#form').attr('action'),
		datatype:"json",
		success:function(data){
			$.each(data,function(){
				if(this.integral == null){
					$('#table').append("<tr><td>"+this.phone+"</td><td>"+this.name+"</td><td>"+this.uid+"</td><td>"+this.qq+"</td><td>"+this.email+"</td><td></td><td>"+this.education+"</td><td>"+this.marriage+"</td><td>"+this.is_children+"</td><td><a href='#myModal' role='button' class='btn btn-inverse' data-toggle='modal' onclick='get_mobile(this)' id='"+this.phone+"'>芝麻分</a></td></tr>");
				}else{
					$('#table').append("<tr><td>"+this.phone+"</td><td>"+this.name+"</td><td>"+this.uid+"</td><td>"+this.qq+"</td><td>"+this.email+"</td><td>"+this.integral+"</td><td>"+this.education+"</td><td>"+this.marriage+"</td><td>"+this.is_children+"</td><td><a href='#myModal' role='button' class='btn btn-inverse' data-toggle='modal' onclick='get_mobile(this)' id='"+this.phone+"'>芝麻分</a></td></tr>");
				}
			});
			$('#tab1').css('display','none');
			$('#tab2').css('display','block');
		}
	})
}
function add_sesame(){
	var integral = $("input[name='integral']").val();
	var phone = $("input[name='phone']").val();
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
</script>
</html>