<?php
namespace Admin\Controller;

use Think\Controller;

class AdminController extends CommonController {
	
	//curl方法
	public function https_request($url,$data = null){
		$curl = curl_init();
		//设置选项，包括URL
		curl_setopt($curl,CURLOPT_URL,$url);
		//安全性要求
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
	
		if(!empty($data)){
			curl_setopt($curl,CURLOPT_POST,1);
			curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
		}
	
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
	//获取access_token的值
	/* public function access_token(){
		$appid = "appid";
		$secret = "appsecret";
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
		$output = $this->https_request($url);
		$array = json_decode($output,true);
		$access_token = $array['access_token'];
		return  $access_token;
	} */
	
 	//添加客户
    public function client(){
    	$data01 = array(
    		'kh_one' => "active",
    		'kh_block' => " style='display:block';",
    		'kh_two01' => " class='active'"
    	);
    	$this->assign("data01",$data01);
    	
    	//显示   用户类型    以及负责人
    	$this->sely_f();
    	
    	if(I("post.f_submit")){
    		
    		if(I("post.pwd") == I("post.pwd01")){

    			$data01 = array(
    					'userid' => strtolower(I("post.userid")),
    					'pwd' => md5(I("post.pwd")),
    					'sid' => I("post.sid"),
    					'u_status' => I("post.u_status"),
    					'limits' => 3,
    					'f_date' => time()
    			);
    			$result = D("user")->add($data01);
    			if($result){
					echo "<meta charset='utf-8' /><script>alert('客户添加成功'); location.href='client.html';</script>";
	    		}else{
					echo "<meta charset='utf-8' /><script>alert('客户添加失败');  history.go(-1);</script>";
	    		}
    		}else{
    			$this->error('新增失败');
    		}
    	}
    	
    	$this->display();
    }
    
    
    //管理客户
    public function c_manage(){
    	if(IS_AJAX){
    	
    		
    		//修改客户
    		if(I("get.sel")){
    			$data = array(
    					'id'		=>	I("get.id"),
    					'limits'	=>	'3'
    			);
    			 
    			
    			
    			$result = D("user")->field("id,userid,uname,qq,email,phone,url,u_status,sid,pwd")->where($data)->find();
    			//显示
    			if(I("get.sel") == "sel_u"){
    				$jiben = implode("-",$result);
    				$sta_arr = D("service")->where('id='.$result['sid'])->find();
    				$sta = $sta_arr['uname'];
    				$this->ajaxReturn($jiben.'-'.$sta);
    			}
    			
    			//修改密码
    			if(I("get.sel") == "sel_p"){
    				if(md5(I("get.pwd")) == $result['pwd']){
    					$data = array(
    							'pwd'	=>	md5(I("get.pwd01"))
    					);
    					$id = I("get.id");
    					$re = D("user")->where("id='$id'")->save($data);
    					if($re){
    						$se = 1;
    					}
    				}else{
    					$se = 2;
    				}
    			}
    			
    		//修改基本信息
			if(I("get.sel") == "upd"){
				
				
		 		$data = array(
		   				'userid'	=>	strtolower(I("get.userid")),
		   				'uname'		=>	I("get.uname"),
		   				'phone'		=>	I("get.phone"),
		   				'qq'		=>	I("get.qq"),
		   				'email'		=>	I("get.email"),
		   				'url'		=>	I("get.url"),
		   				'sid'		=>	I("get.sid"),
		   				'u_status'		=>	I("get.u_status")
		   		);
		   		$id = I("get.id");
		   		$se = D("user")->where("id='$id'")->save($data);
	
	   		}
    			
    			
    			$this->ajaxReturn($se);
    		}
    		
    		exit;
    		
    	}
    	

    	//删除客户
    	if(I("get.del")){
    		$id = I("get.id");
    		$result = D("user")->where("id=$id")->delete();
    	}
    	 
    	
    	//显示   用户类型    以及负责人
    	$this->sely_f();
    	
    	$data01 = array(
    		'kh_one' => "active",
    		'kh_block' => " style='display:block';",
    		'kh_two02' => " class='active'"
    	);
    	$this->assign("data01",$data01);
    	
    	
//     	显示客户列表
    	$User = D("user");
    	$count  = $User->where("limits='3'")->count();    //计算总数
    	$Page   = new \Think\Page($count,10);
    	
    	$Page->setConfig('prev', "上一页");
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('first', '首页');
    	$Page->setConfig('last', '尾页');
    	$show 	= $Page->show();
    	
    	$list = $User->table(C('DB_PREFIX').'user u, '.C('DB_PREFIX').'service s')->where("u.sid=s.id and u.limits='3'")->field('u.id,u.userid,u.uname,u.qq u_qq,u.email u_email,u.phone u_phone,u.url u_url,u.u_status,s.uname s_name,u.limits')->limit($Page->firstRow. ',' . $Page->listRows)->order("f_date desc")->select();
    	$this->assign("list",$list);
    	
    	$this->assign("page",$show);
    	$this->display();
    }
    
    
    //添加类型
    public function c_status(){
    	
    	$data = D("status")->order("time desc")->select();
    	//显示列表
    	$this->assign("data",$data);
    	
    	//添加类型
    	if(I("post.f_submit")){
    		$data = array(
    			"status" => I("post.status"),
    			"time" => time()
    		);
    		$result = D("status")->add($data);
    		
	    	if($result){
				echo "<meta charset='utf-8' /><script>alert('添加成功'); location.href='c_status.html';</script>";
	    	}else{
				echo "<meta charset='utf-8' /><script>alert('添加失败');  history.go(-1);</script>";
	   		}
    		
    	}
    	
    	//删除类型
    	if(I("get.del")){
    		$id = I("get.id");
    		$result = D("status")->where("id=$id")->delete();
    	}
    	

    	$data01['kh_one'] = "active";
    	$data01['kh_block'] = " style='display:block';";
    	$data01['kh_two03'] = " class='active'";

    	$this->assign("data01",$data01);
    	
    	$this->display();
    }
    
    //添加售后
    public function service(){
	
    	$data = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two01' => " class='active'",
    			'f_date' => time()
    	);
    	$this->assign("data",$data);
    	
    	//添加售后
    	if(I("post.f_submit")){
    		if(I("post.pwd") == I("post.pwd01")){

    			
    			$data = array(
    					"userid" => strtolower(I("post.userid")),
    					"uname" => I("post.uname"),
    					"pwd" => md5(I("post.pwd")),
    					"phone" => I("post.phone"),
    					"email" => strtolower(I("post.email")),
    					"zl_status" => "1",
    					"limits" => 2,
    					"f_date" => time()
    			);
    			$result = D("user")->add($data);
	    		
	    		if($result){
	    			$res01 = D("user")->where("userid='".strtolower(I("post.userid"))."'")->find();
	    			//添加service
	    			$data01 = array(
	    					"id"=>$res01['id'],
	    					"uname" => I("post.uname"),
	    					"phone" => I("post.phone"),
	    					"email" => strtolower(I("post.email")),
	    					"time" => time()
    				);
    				$result = D("service")->add($data01);
						echo "<meta charset='utf-8' /><script>alert('添加成功'); location.href='service.html';</script>";
	    		}else{
	    			echo "<meta charset='utf-8' /><script>alert('添加失败');  history.go(-1);</script>";
	    		}
				exit;
    		}
    		
    	}
    	
    	//显示添加是否成功
    	
    	$this->display();
    }
    
    //会员管理
    public function s_manage(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	$city = $info['city'];//获取代理的城市
    	$result = $user->select();
    	$User = D("service");
    	$user_work = D('user_work');
    	$user_info = D('user_info');
    	//页面搜索数据
    	if($_GET){
    		$content = $_GET['content'];
    		$is_adopt = $_GET['is_adopt'];
    		$loan_people = $_GET['loan_people'];
    		$apply_time1 = $_GET['apply_time1'];
    		$apply_time2 = $_GET['apply_time2'];
    		if($content){
    			if($_GET['type'] == '1'){
    				$where = " haoidcn_service.phone like '%$content%' ";
    				$this->assign('type',$_GET['type']);
    			}else{
    				$where = " a.name like '%$content%' ";
    				$this->assign('type',$_GET['type']);
    			}
    			$this->assign('content',$content);
    		}else if($is_adopt){
    			$where = " is_adopt='$is_adopt' ";
    			if($loan_people){
    				$where .= "and loan_people like '$loan_people%' ";
    				$this->assign('loan_people',$loan_people);
    			}
    			$this->assign('is_adopt',$is_adopt);
    		}else if($loan_people){
    			$where = " loan_people like '$loan_people%' ";
    			$this->assign('loan_people',$loan_people);
    		}else if($apply_time1 and $apply_time2){
    			$where = " time > '$apply_time1' and time < '$apply_time2'";
    			$this->assign('apply_time1',$apply_time1);
    			$this->assign('apply_time2',$apply_time2);
    		}
    		if($info['limits'] == '1'){
    			//$list = $User->join("haoidcn_user_money_info as b ON haoidcn_service.phone=b.phone")->order("haoidcn_service.id desc")->limit($Page->firstRow. ',' . $Page->listRows)->where("$where")->select();
    			$list = $User->order("id desc")->limit($Page->firstRow. ',' . $Page->listRows)->where("$where")->select();
    		}else if($info['limits'] == '2'){
    			$list = $User->join("haoidcn_user_money_info as b ON haoidcn_service.phone=b.phone")->join("haoidcn_user_work as c ON haoidcn_service.phone=c.phone")->order("haoidcn_service.id desc")->limit($Page->firstRow. ',' . $Page->listRows)->where("b.loan_people='$userid' and $where ")->select();
    		}else if($info['limits'] == '3'){
    			$list = $User->join("haoidcn_user_money_info as b ON haoidcn_service.phone=b.phone")->join("haoidcn_user_work as c ON haoidcn_service.phone=c.phone")->order("haoidcn_service.id desc")->limit($Page->firstRow. ',' . $Page->listRows)->where("city='$city' and $where")->select();
    		}
			
    		foreach ($list as $key=>$value){
    			//$name = $user_info->where("phone='{$list[$key]['phone']}'")->find();
    			$name = $user_info->where("openid='{$list[$key]['openid']}'")->find();
    			$list[$key]['name'] = $name['name'];
    		}
    		$this->assign('list',$list);
    		$this->assign('info',$result);
    		$data = array(
    				'sh_one' => "active",
    				'sh_block' => " style='display:block';",
    				'sh_two01' => " class='active'"
    		);
    		$this->assign("data",$data);
    		$this->display();
    		exit;
    	}
    	
    	//按照登录的用户来限制数据的显示
    	if($info['limits'] == '1'){
    		$count  = $User->count();    //计算总数
    		$Page   = new \Think\Page($count,10);
    		$Page->setConfig('prev', "上一页");
    		$Page->setConfig('next', '下一页');
    		$Page->setConfig('first', '首页');
    		$Page->setConfig('last', '尾页');
    		$show 	= $Page->show();
    		$this->assign("page",$show); 
    		//$list = $User->join("haoidcn_user_money_info as b ON haoidcn_service.phone=b.phone")->order("haoidcn_service.id desc")->limit($Page->firstRow. ',' . $Page->listRows)->select();
    		$list = $User->order("id desc")->limit($Page->firstRow. ',' . $Page->listRows)->select();
			
    		foreach ($list as $key=>$value){
    			//$name = $user_info->where("phone='{$list[$key]['phone']}'")->find();
    			$name = $user_info->where("openid='{$list[$key]['openid']}'")->find();
    			$list[$key]['name'] = $name['name'];
    		}
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_work->query("select * from haoidcn_user_work as a left join haoidcn_service as b ON a.phone=b.phone  left join haoidcn_user_money_info as d ON a.phone=d.phone where province='$province' and city='$city' and loan_people like '$userid%'");
    		foreach ($list as $key=>$value){
    			$name = $user_info->where("phone='{$list[$key]['phone']}'")->find();
    			$list[$key]['name'] = $name['name'];
    		}
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two01' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
	/*会员审核 修改*/
	
	public function auditing(){
		$id = I('id');//USER_ID
		$map['id'] = $id;
		if(empty($id)){
			$this->error('缺少参数', U('Admin/user_details',array('id'=>$id,'auditing'=>1)));
		}else{
			$sdata['status'] =1; 
			$sdata['auditing_time'] =time(); 
			$result = M('service')->where($map)->save($sdata);
			
			$openid=M('service')->where($map)->getField('openid');
			if($result){
				$access_token = access_token();
				$wurl =  U('Weixin/choice_money@ysjr.9xgk.com');
				$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
				$text = <<<json
						{
							"touser":"$openid",
							"msgtype":"news",
							"news":{
								"articles": [
								{
										"title":"审核提醒",
										"description":"尊敬的用户，您好，您提交的资料已审核成功！请点击选择金额",
										"url":"$wurl"
								}
								]
							}
						}
json;
    	$this->https_request($url,$text);
				
				$this->error('审核成功', U('Admin/user_details',array('id'=>$id)));
			}else{
				$this->error('审核失败', U('Admin/user_details',array('id'=>$id,'auditing'=>1)));	
			}	
		}

	}
	public function no_auditing(){
		$id = I('id');//USER_ID
		$map['id'] = $id;
		if(IS_POST){
			$id = I('id');//USER_ID
			$map['id'] = $id;
			$openid=M('service')->where($map)->getField('openid');
			$remark = I('remark');
			$data['remark'] = $remark;
			$data['status'] = 2;
		
			$data['auditing_time'] =time(); 
			
			$result = M('service')->where($map)->save($data);
			if($result){
			$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$data = <<<json
    		{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"很抱歉，您的申请未通过",
			             "description":"根据您提交的资料，我们系统未能通过您的借款申请，没能帮到您，实在很抱歉
拒接原因：$remark
若有任何疑问请直接微信留言，感谢您的参与与支持",
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$data);
				$data = '提交成功';
				$this->ajaxReturn($data);
			}else{
				$data = '审核失败';
				$this->ajaxReturn($data);
			}
			
			
		}
		$this->assign('id',$id);
		$this->display();
	}
	
    
    //会员详情
    public function user_details(){
    	/* $phone = I('phone'); */
		$id = I('id');
		$auditing = I('auditing');
		$openid = M('service')->where("id='$id'")->getField('openid');
		$map['openid'] = $openid;
    	$xs = D('xuesheng')->where($map)->find();
		//$user_info=M('user_info')->where($map)->find();
		
    	$list = D()->query("select g.img_url,g.img1,g.img2,a.id,b.phone,b.name,b.uID,b.qq,b.email,b.education,b.marriage,b.is_children,
							d.family,d.family_name,d.family_mobile,d.gam,d.gam_name,d.gam_mobile
						from haoidcn_service as a 
						left join haoidcn_user_info as b ON a.openid=b.openid 
						left join haoidcn_user_gam as d ON a.openid=d.openid 
						left join haoidcn_user_mobile as e ON a.openid=e.openid 
						left join haoidcn_weixin_img as g ON a.openid=g.openid  
						where a.openid='$openid'");
    	$this->assign('list',$list);
    	$user_work = D('user_work');
    	$work = $user_work->where($map)->find();
    	$this->assign('work',$work);
    	$bank_info = D('bank_info');
    	$bank = $bank_info->where($map)->find();
    	$this->assign('bank',$bank);
    	$payment_list = D('payment_list');
    	$fangkuan = $payment_list->where("openid='$openid' and is_repayment=0")->find();
    	$res =  D("user_money_info")->where($map)->order("id desc")->select();
    	$this->assign('res',$res);
    	$this->assign('fangkuan',$fangkuan);
    	$this->assign('phone',$phone);
    	$this->assign('xuesheng',$xs);
    	$this->assign('id',$id);
    	$this->assign('auditing',$auditing);
    	$this->display();
    }
    //会员列表搜索
    public function s_manage_search(){
    	$userid = strtolower(I("session.userid"));//获取登录的用户账号
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$province = $result['province'];//获取代理的省
    	$city = $result['city'];//获取代理的城市
    	$loan_people = $result['loan_people'];//获取审核人员
    	$apply_time1 = I('apply_time1');
    	$apply_time2 = I('apply_time2');
    	$phone = I('phone');
    	$name = I('name');
    	$is_adopt = I('is_adopt');
    	$loan_people = I('loan_people');
    	$user_info = D('user_info');
    	$User = D("service");
    	$user_work = D('user_work');
    	$user_money_info = D('user_money_info');
    	//搜索时判断该账户的等级：1是管理员可以搜索到所有信息，2是审核人员只能搜索到分配人员的信息，3是代理只能搜索到该代理地区的人员信息
    	if($result['limits'] == '1'){
    		$where = "haoidcn_user_money_info.phone=a.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "b.loan_people like '$loan_people%' ";
    	}else if($result['limits'] == '3'){
    		$info = $user_work->where("city='$city'")->select();
    		$this->ajaxReturn($info);
    		exit;
    	}
    	if($phone){
    		$result = $user_money_info->where("phone='$phone'")->order("id desc")->select();
    		$res = $User->where("phone='$phone'")->select();
    		$re = $user_info->where("phone='$phone'")->select();
    		$info[] = array(
    				'uname'=>$res[0]['uname'],
    				'name'=>$re[0]['name'],
    				'phone'=>$result[0]['phone'],
    				'time'=>$res[0]['time'],
    				'is_adopt'=>$result[0]['is_adopt'],
    				'loan_people'=>$result[0]['loan_people'],
    				'recommend'=>$res[0]['recommend']
    		);
    		$this->ajaxReturn($info);
    		exit;
    	}
    	if($name){
    		$result = $user_info->where("name='$name'")->find();
    		$res = $user_money_info->where("phone='{$result['phone']}'")->find();
    		$re = $User->where("phone='{$result['phone']}'")->find();
    		$info[] = array(
    				'uname'=>$re['uname'],
    				'name'=>$result['name'],
    				'phone'=>$result['phone'],
    				'time'=>$re['time'],
    				'is_adopt'=>$res['is_adopt'],
    				'loan_people'=>$res['loan_people'],
    				'recommend'=>$re['recommend']
    		);
    		$this->ajaxReturn($info);
    		exit;
    	}
    	if($is_adopt){
    		$where .= "and is_adopt='$is_adopt' ";
    	}
    	if($loan_people){
    		$where .= "and loan_people like '$loan_people%' ";
    	}
    	if($apply_time1 and $apply_time2){
    		$where .= "and time > '$apply_time1' and time < '$apply_time2' ";
    	}
    	$info = $user_money_info->join("haoidcn_service as a ON haoidcn_user_money_info.phone=a.phone")->join("haoidcn_user_info as b ON haoidcn_user_money_info.phone=b.phone")->where("$where")->select();
    	$this->ajaxReturn($info);
    }
    //用户借款信息
    public function user_money_info(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	$user_money_info = D('user_money_info');
    	if($info['limits'] == '1'){
    		$count = $user_money_info->count();    //计算这个表有多少条记录
    		$Page = new \Think\Page($count,10);    //创建分页类，设置一个页面显示多少条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();                 //show()组织分页的链接
    		$this->assign('page',$show);
    		//list获取信息列表分页的语句
    		$list = $user_money_info->limit($Page->firstRow. ',' . $Page->listRows)->order('apply_time desc')->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_money_info->query("select * from haoidcn_user_money_info as a left join haoidcn_user_work as b ON a.phone=b.phone where b.province='$province' and b.city='$city' and loan_people like '$userid%' order by apply_time desc");
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two02' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    //搜索用户借款信息
    public function search_user_money_info(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$phone = I('phone');
    	$is_adopt = I('is_adopt');
    	$user_money_info = D('user_money_info');
    	if($result['limits'] == '1'){
    		$where = "haoidcn_user_money_info.phone=a.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "loan_people like '$userid%' ";
    	}else if($result['limits'] == '3'){
    		$where = "province='{$result['province']}' and city='{$result['city']}' ";
    	}
    	if($phone){
    		$where  .= "and haoidcn_user_money_info.phone like '%$phone%' ";
    	}else if($is_adopt){
    		$where .= "and is_adopt='$is_adopt' ";
    	}
    	$user_work = D('user_work');
    	$work = $user_work->where("phone like '%$phone%'")->select();
    	$xuesheng = D('xuesheng');
    	$xs = $xuesheng->where("phone like '%$phone%'")->select();
    	if($work){
    		$info = $user_money_info->join("haoidcn_user_work as a ON haoidcn_user_money_info.phone=a.phone")->where("$where")->select();
    	}else if($xs){
    		$info = $user_money_info->join("haoidcn_xuesheng as a ON haoidcn_user_money_info.phone=a.phone")->where("$where")->select();
    	}
    	//var_dump($info);
    	$this->ajaxReturn($info);
    }
    
    //用户个人信息
    public function user_info(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	$user_info = D('user_info');              //实例化用户个人信息表
    	if($info['limits'] == '1'){
    		$count = $user_info->count();            //计算这个表有多少记录
    		$Page = new \Think\Page($count,10);      //创建分页类，设置一个页面显示10条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();                   //show()组织分页的链接
    		$this->assign('page',$show);
    		//list获取用户个人信息列表分页的语句
    		$list = $user_info->limit($Page->firstRow. ',' . $Page->listRows)->order('id desc')->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_info->join("haoidcn_user_work as a ON haoidcn_user_info.phone=a.phone")->join("haoidcn_user_money_info as b ON haoidcn_user_info.phone=b.phone")->where("province='$province' and city='$city' and loan_people like '$userid%'")->select();
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two03' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    
    public function get_integral(){
    	$phone = I('phone');
    	$user_info = D('user_info');
    	$info = $user_info->where("phone='$phone'")->select();
    	$integral = $info[0]['integral'];
    	$this->ajaxReturn($integral);
    }
    
    
    //添加芝麻分
    public function integral(){
    	$integral = I('integral');
    	$phone = I('phone');
    	$user_info = D('user_info');
    	$result = $user_info->where("phone='$phone'")->setField("integral",$integral);
    	if($result){
    		$data = "添加成功";
    		$this->ajaxReturn($data);
    	}else{
    		$data = "添加失败";
    		$this->ajaxReturn($data);
    	}
    }
    //用户个人信息搜索
    public function search_user_info(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$phone = I('phone');
    	$education = I('education');
    	$user_info = D('user_info');
    	if($result['limits'] == '1'){
    		$where = "haoidcn_user_info.phone=a.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "loan_people like '$userid%' ";
    	}else if($result['limits'] == '3'){
    		$where = "province='{$result['province']}' and city='{$result['city']}' ";
    	}
    	if($phone){
    		$where .= "and haoidcn_user_info.phone like '%$phone%' ";
    	}else if($education){
    		$where .= "and education='$education' ";
    	}
    	$info = $user_info->join("haoidcn_user_money_info as a ON haoidcn_user_info.phone=a.phone")->join("haoidcn_user_work as b ON haoidcn_user_info.phone=b.phone")->where("$where")->order('haoidcn_user_info.id desc')->select();
    	$this->ajaxReturn($info);
    }
    
    //用户职业信息
    public function user_work(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	$user_work = D('user_work');            //实例化用户工作信息表
    	if($info['limits'] == '1'){
    		$count = $user_work->count();           //计算这个表有多少记录
    		$Page = new \Think\Page($count,10);     //创建分页类，设置一个页面显示10条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();                  //show()组织分页的链接
    		$this->assign('page',$show);
    		//list获取用户工作表信息列表分页的语句
    		$list = $user_work->limit($Page->firstRow. ',' . $Page->listRows)->order('id desc')->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_work->join("haoidcn_user_money_info as a ON haoidcn_user_work.phone=a.phone")->where("province='$province' and city='$city' and loan_people like '$userid%'")->order('haoidcn_user_work.id desc')->select();
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two04' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    //搜索用户的职业信息
    public function search_user_work(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$phone = I('phone');
    	$work = I('work');
    	$user_work = D('user_work');
    	if($result['limits'] == '1'){
    		$where = "haoidcn_user_work.phone=a.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "loan_people like '$userid%' ";
    	}else if($result['limits'] == '3'){
    		$where = "province='{$result['province']}' and city='{$result['city']}' ";
    	}
    	if($phone){
    		$where .= "and haoidcn_user_work.phone like '%$phone%' ";
    	}else if($work){
    		$where .= "and work='$work' ";
    	}
    	$info = $user_work->join("haoidcn_user_money_info as a ON haoidcn_user_work.phone=a.phone")->where("$where")->order('haoidcn_user_work.id desc')->select();
    	$this->ajaxReturn($info);
    }
    
    //用户社会关系
    public function user_gam(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	$user_gam = D('user_gam');           //实例化用户社会关系表
    	if($info['limits'] == '1'){
    		$count = $user_gam->count();         //计算这个表有多少记录
    		$Page = new \Think\Page($count,10);  //创建分页类，设置一个页面显示10条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();              //show()组织分页的链接
    		$this->assign('page',$show);
    		//list获取用户社会关系信息列表分页的语句
    		$list = $user_gam->limit($Page->firstRow. ',' . $Page->listRows)->order('id desc')->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $user_gam->join("haoidcn_user_money_info as a ON haoidcn_user_gam.phone=a.phone")->join("haoidcn_user_work as b ON haoidcn_user_gam.phone=b.phone")->where("province='$province' and city='$city' and loan_people like '$userid%'")->select();
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two05' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    //搜索用户的社会关系信息
    public function search_user_gam(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$phone = I('phone');
    	$user_gam = D('user_gam');
    	if($result['limits'] == '1'){
    		$where = "haoidcn_user_gam.phone=a.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "loan_people like '$userid%' ";
    	}else if($result['limits'] == '3'){
    		$where = "province='{$result['province']}' and city='{$result['city']}' ";
    	}
    	if($phone){
    		$where .= "and haoidcn_user_gam.phone like '%$phone%' ";
    	}
    	$info = $user_gam->join("haoidcn_user_money_info as a ON haoidcn_user_gam.phone=a.phone")->join("haoidcn_user_work as b ON haoidcn_user_gam.phone=b.phone")->where("$where")->order('haoidcn_user_gam.id desc')->select();
    	$this->ajaxReturn($info);
    }
    //用户银行卡信息
    public function bank_info(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$user_limits = $user->where("userid='$userid'")->find();
    	$bank_info = D('bank_info');        //实例化用户银行卡信息表
    	$user_money_info = D('user_money_info');//借款详情表
    	if($user_limits['limits'] == '1'){
    		$count = $bank_info->count();       //计算这个表有多少记录
    		$Page = new \Think\Page($count,10);   //创建分页类，设置一个页面显示10条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();           //show()组织分页的链接
    		$this->assign('page',$show);
    		//list获取用户银行卡信息列表分页的语句
    		$list = $bank_info->limit($Page->firstRow. ',' . $Page->listRows)->order('haoidcn_bank_info.id desc')->select();	
    	}else if($user_limits['limits'] == '2'){
    		$list = $bank_info->where("loan_people like '$userid%'")->order("id desc")->select();
    	}else if($user_limits['limits'] == '3'){
    		$city = $user_limits['city'];
    		$list = $bank_info->query("select * from haoidcn_bank_info as a left join haoidcn_user_work as b ON a.openid=b.openid  where b.city='$city' and loan_people like '$userid%'");
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_two' => "active",
    			'sh_block1' => " style='display:block';",
    			'sh_two07' => " class='active'"
    	);
    	foreach ($list as $key=>$value){
    		$money = $user_money_info->where("openid='{$list[$key]['openid']}'")->find();
    		$list[$key]['loan_people'] = $money['loan_people'];
    	}
		
    	$this->assign('list',$list);
    	$card_bank = D('card_bank');
    	$info = $card_bank->select();
    	$this->assign('info',$info);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    //搜索用户银行卡信息
    public function search_bank_info(){
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');//后台用户表
    	$result = $user->where("userid='$userid'")->find();//获取该账户的信息
    	$phone = I('phone');
    	$bank_name = I('bank_name');
    	$bank_info = D('bank_info');
    	$user_money_info = D('user_money_info');
    	if($result['limits'] == '1'){
    		$where = "haoidcn_bank_info.phone=c.phone ";
    	}else if($result['limits'] == '2'){
    		$where = "loan_people like '$userid%' ";
    	}else if($result['limits'] == '3'){
    		$where = "c.province='{$result['province']}' and c.city='{$result['city']}' ";
    	}
    	if($phone){
    		$info = $bank_info->where("haoidcn_bank_info.phone like '%$phone%'")->select();
    		foreach ($info as $key=>$value){
    			$money = $user_money_info->where("phone='{$info[$key]['phone']}'")->find();
    			$info[$key]['loan_people'] = $money['loan_people'];
    		}
    		$this->ajaxReturn($info);
    		exit;
    	}else if($bank_name){
    		$where .= "and bank_name like '%$bank_name%' ";
    	}
    	$info = $bank_info->join("haoidcn_user_work as c ON haoidcn_bank_info.phone=c.phone")->where("$where")->select();
    	foreach ($info as $key=>$value){
    		$money = $user_money_info->where("phone='{$info[$key]['phone']}'")->find();
    		$info[$key]['loan_people'] = $money['loan_people'];
    	}
    	$this->ajaxReturn($info);
    }
    
    //审核银行卡界面
    public function shenghe(){
    	$id = I('id');
    	$bank_info = D('bank_info');
    	$list = $bank_info->join("haoidcn_user_money_info as a ON haoidcn_bank_info.openid=a.openid")->where("haoidcn_bank_info.id='$id'")->find();
    	$this->assign('list',$list);
    	$this->assign('id',$id);
    	
    	
    	$this->display();
    }
    //确定银行卡号
    public function is_bank(){
     	$id = I('id');
     	$bank_info = D('bank_info');    //用户银行卡信息表
     	$bank_info->where("id='$id'")->setField('is_payment','1');
		
		$openid = M('bank_info')->where("id='$id'")->getField('openid');
		
     	$service = D('service');
		
     	$service->where("openid='$openid'")->setField("is_Loan",'0');
		
  
     	if($openid){
     	
     		$access_token = access_token();
     		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
     		$text = <<<json
	     	{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"恭喜您，您的银行卡信息验证成功，我们会尽快致电您，确认是您本人申请后将立即打款到您的银行卡上，请保持手机畅通",
			             "description":"您的银行卡信息验证成功，我们将尽快致电您，确认是您本人申请后将立即打款到您的银行卡上，请保持手机畅通，感谢您对学之友微额速达的支持和信任！",
			         }
			         ]
			    }
			}
json;
     		$this->https_request($url,$text);
     	}
     	$data = '验证成功';
     	$this->ajaxReturn($data);
    }
    
    
    //否定银行卡
    public function no_bank(){
    	$liyou = I('liyou');
    	$phone = I('phone');
    	$bank_info = D('bank_info');    //用户银行卡信息表
    	$bank_info->where("phone='$phone'")->setField('is_payment','2');
    	$bank_info->where("phone='$phone'")->setField('condition',1);
    	$res = $bank_info->where("phone='$phone'")->find();
    	if($res){
    		$openid = $res['openid'];
			$access_token = access_token();
    		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    		$text = <<<json
	     	{
			    "touser":"$openid",
			    "msgtype":"news",
			    "news":{
			        "articles": [
			         {
			             "title":"银行卡验证失败",
			             "description":"尊敬的用户您好，您的$liyou",
			             "url":"http://www.leeyears.com/index.php/Weixin/queren_loan?phone=".$phone."&openid=".$openid,
			         }
			         ]
			    }
			}
json;
    		$this->https_request($url,$text);
    	}
    	$data = '验证失败';
    	$this->ajaxReturn($data);
    }
    
    //用户持证自拍的信息
    public function user_img(){
    	$weixin_img = D('weixin_img');
    	$userid = strtolower(I("session.userid"));
    	$user = D('user');
    	$info = $user->where("userid='$userid'")->find();
    	if($info['limits'] == '1'){
    		$count = $weixin_img->count();       //计算这个表有多少记录
    		$Page = new \Think\Page($count,5);   //创建分页类，设置一个页面显示10条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();           //show()组织分页的链接
    		$this->assign('page',$show);
    		//list获取用户银行卡信息列表分页的语句
    		$list = $weixin_img->field("haoidcn_service.phone,haoidcn_weixin_img.openid,img_url,haoidcn_weixin_img.time,is_adopt")->join("haoidcn_service ON haoidcn_weixin_img.openid = haoidcn_service.openid")->limit($Page->firstRow. ',' . $Page->listRows)->order("haoidcn_weixin_img.time desc")->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '2'){
    		$count = $weixin_img->count();       //计算这个表有多少记录
    		$Page = new \Think\Page($count,5);   //创建分页类，设置一个页面显示10条记录
    		$Page->setConfig('prev',"上一页");
    		$Page->setConfig('next',"下一页");
    		$Page->setConfig('first',"首页");
    		$Page->setConfig('last',"尾页");
    		$show = $Page->show();           //show()组织分页的链接
    		$this->assign('page',$show);
    		$count = $user->where("limits=2")->order('id')->count();   //审核员人数
    		$result2 = $user->field('id')->where("limits=2")->select();
    		$i=0;
    		$result = $weixin_img->where("is_adopt=0")->order("time desc")->select(); //显示数据
    		foreach ($result as $value){
    			$id = $value['id'];
    			$uid=$result2[$i%count($result2)]['id'];
    			$weixin_img->where("is_adopt=0 and id='$id'")->setField('loan_people',$uid);
    			$i++;
    		}
    		$user_id = $user->field('id')->where("userid='$userid'")->find();
    		$loan_id = $user_id['id'];
    		$list = $weixin_img->limit($Page->firstRow. ',' . $Page->listRows)->where("loan_people=$loan_id")->order("time desc")->select();
    		$this->assign('list',$list);
    	}else if($info['limits'] == '3'){
    		$province = $info['province'];
    		$city = $info['city'];
    		$list = $weixin_img->query("select * from haoidcn_weixin_img as a left join haoidcn_user_work as b ON a.openid=b.openid where b.province='$province' and b.city='$city'");
    		$this->assign('list',$list);
    	}
    	$data = array(
    			'sh_two' => "active",
    			'sh_block1' => " style='display:block';",
    			'sh_two08' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    //搜索用户持证自拍资料
    public function search_user_img(){
    	$phone = I('phone');
    	$is_adopt = I('is_adopt');
    	
    }
    //持证自拍通过
    public function is_adopt(){
    	$id = I('id');
    	$weixin_img = D('weixin_img');
    	$weixin_img->where("openid='$id'")->setField('is_adopt','1');
    		$access_token = access_token();
    	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    	$text = <<<json
    	{
		    "touser":"$id",
		    "msgtype":"news",
		    "news":{
		        "articles": [
		         {
		             "title":"恭喜您，您的自拍审核已通过，我们会尽快致电您，确认是您本人申请后将立即打款到您的银行卡上，请保持手机畅通",
		             "description":"您的自拍照已审核通过，我们将尽快致电您，确认是您本人申请后将立即打款到您的银行卡上，请保持手机畅通，感谢您对e快金的支持和信任！",
		         }
		         ]
		    }
		}
json;
    	$this->https_request($url,$text);
    	$data = '已验证';
    	$this->ajaxReturn($data);
    }
    	
    //持证自拍不通过
    public function no_adopt(){
    	$id = I('id');
    	$weixin_img = D('weixin_img');
    	$weixin_img->where("openid='$id'")->setField('is_adopt','2');
    		$access_token = access_token();
    	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
    	$text = <<<json
    	{
		    "touser":"$id",
		    "msgtype":"news",
		    "news":{
		        "articles": [
		         {
		             "title":"尊敬的用户，您好，您的自拍审核未通过",
		             "description":"您的持证自拍未通过",
		         }
		         ]
		    }
		}
json;
    	$this->https_request($url,$text);
    	$data = '已验证';
    	$this->ajaxReturn($data);
    }
	//管理售后
	public function jihuomaguanli(){
		

		$jihuoma = D("jihuoma");
		$count  = $jihuoma->count();    //计算总数
		$Page   = new \Think\Page($count,30);
		$Page->setConfig('prev', "上一页");
		$Page->setConfig('next', '下一页');
		$Page->setConfig('first', '首页');
		$Page->setConfig('last', '尾页');
		$show 	= $Page->show();
		$this->assign("page",$show);

		$list = $jihuoma->limit($Page->firstRow. ',' . $Page->listRows)->select();
		$this->assign("list",$list);

		$data04 = array(
			'sh_two01' => " class='active'",
		);
		$this->assign("data04",$data04);
		$this->display();
	}

	//生成激活码
	public  function jihuomasc(){
		for($i=0;$i<20;$i++)
		{
			$jihuoma = rand(100000000,999999999);
				$Form   =   D('jihuoma');
			$data['jihuoma']  =   $jihuoma;
			$data['state']    =   0;
			$data['time']    =   time();
			$code = $Form->add($data);

		}
		$this->success('新增成功，即将返回列表页面', U('Admin/jihuomaguanli'));
	}
    
    //工作时间
    public function office(){
    	
    	$list = D('time')->find();
    	$this->assign('list',$list);
		if(IS_POST){
			$data = array(
				'begin_time'		=>	I('post.begin_time'),
				'end_time'			=>	I('post.end_time'),
				'begin_beputtime'	=>	strtotime(I('post.begin_beputtime')),
				'end_beputtime'		=>	strtotime(I('post.end_beputtime')),
				'pubtime'			=>	time(),
			);
			
			if(empty($list)){
				$result = D('time')->add($data);
			}else{
				$result = D('time')->where("id='".$list['id']."'")->save($data);
			}
			if($result){
				echo "<meta charset='utf-8' /><script>alert('更新成功'); location.href='office.html';</script>";
			}
			exit;
		}

		$list = D('time')->find();
		$this->assign('list',$list);
    	
    	$data02 = array(
    			'sh_one' => "active",
    			'sh_block' => " style='display:block';",
    			'sh_two01' => " class='active'",
    			'f_date' => time()
    	);
    	$this->assign("data02",$data02);
    	$this->display();
    }

	//图标管理
	public function tubiao(){

		$list = D('tubiao')->select();
		$this->assign('list',$list);


		$this->display();
	}

	public function zixun(){
		$Placard = D("zixun");

		$count  = $Placard->count("id");    //计算总数

		$Page   = new \Think\Page($count,10);
		$Page->setConfig('prev', "上一页");
		$Page->setConfig('next', '下一页');
		$Page->setConfig('first', '首页');
		$Page->setConfig('last', '尾页');
		$show 	= $Page->show();
		$this->assign("page",$show);

		$list = $Placard->order("id desc")->limit($Page->firstRow. ',' . $Page->listRows)->select();
		
		$this->assign("list",$list);

		$this->display();
	}
    
	//编辑图标
	public function edit($id){
		$tubiao = D("tubiao");

//         var_dump($_POST);
		//修改

		
		$rs = $tubiao->where('id='.(int)$id)->find();
		$this->assign("rs",$rs);

		$this->display();
	}

	//编辑图标
	public function edit1($id){
		$tubiao = D("tubiao");

//       var_dump($_GET);
		//修改
		if(1){


			$data['link'] = $_POST['link'];


			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
			$upload->savePath  =     ''; // 设置附件上传（子）目录

			$info   =   $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->error($upload->getError());
			}else{// 上传成功 获取上传文件信息
				foreach($info as $file){
					echo $file['savepath'].$file['savename'];
					$data['img'] = $file['savepath'].$file['savename'];
				}
			}

			$se = $tubiao->where('id='.(int)$id)->save($data);
			if($se)
			{
				$this->success('修改成功，即将返回列表页面', U('Admin/tubiao'));
				exit;
			}
			$this->success('修改失败，即将返回列表页面', U('Admin/tubiao'));
			exit;
		}
		
	}




	//基本配置
	public function sms(){
		$this->assign("data",array('setting' => " style='display:block';"));
//     	echo $mall_address = strtoupper('mall_address');
    	
    	$config = D("config");
    	$list = $config->find();
    	$this->assign("list",$list);
    	if(IS_POST){
    		
//     		$data = array(
//     			'mail_address'=>I("post.mail_address"),
//     			'mail_smtp'=>I("post.mail_smtp"),
//     			'mail_loginname'=>I("post.mail_loginname"),
//     			'mail_password'=>I("post.mail_password"),
//     			'mail_formname'=>I("post.mail_formname"),
//     			'phone_target'=>I("post.phone_target"),
//     			'phone_user'=>I("post.phone_user"),
//     			'phone_pass'=>I("post.phone_pass"),
//     		);
    		
    		
    		if($list){		//更新操作
    			$re = $config->where("id='".$list['id']."'")->save($_POST);
    		}else{			//添加操作
    			$re = $config->add($_POST);
    		}
			if($re){

				echo "<script>alert('更新成功'); location.href='sms.html';</script>";
				exit;
			}else{

				echo "<script>alert('更新成功'); history.go(-1);</script>";
				exit;
			}
    	}
    	
    	
		$data = array(
				'sh_seven' => "active",
				'sh_block6' => " style='display:block';",
				'sh_two21' => " class='active'"
		);
		$this->assign("data",$data);
    	$this->display();
    }   
    public function email(){
		$this->assign("data",array('setting' => " style='display:block';"));
//     	echo $mall_address = strtoupper('mall_address');
    	
    	$config = D("config");
    	$list = $config->find();
    	$this->assign("list",$list);
    	if(IS_POST){
    		
//     		$data = array(
//     			'mail_address'=>I("post.mail_address"),
//     			'mail_smtp'=>I("post.mail_smtp"),
//     			'mail_loginname'=>I("post.mail_loginname"),
//     			'mail_password'=>I("post.mail_password"),
//     			'mail_formname'=>I("post.mail_formname"),
//     			'phone_target'=>I("post.phone_target"),
//     			'phone_user'=>I("post.phone_user"),
//     			'phone_pass'=>I("post.phone_pass"),
//     		);
    		
    		
    		if($list){		//更新操作
    			$re = $config->where("id='".$list['id']."'")->save($_POST);
    		}else{			//添加操作
    			$re = $config->add($_POST);
    		}
			if($re){

				echo "<script>alert('更新成功'); location.href='email.html';</script>";
				exit;
			}else{

				echo "<script>alert('更新成功'); history.go(-1);</script>";
				exit;
			}
    	}
    	
    	
		$data03 = array(
    			'sh_two01' => " class='active'",
    	);
    	$this->assign("data03",$data03);
    	$this->display();
    }    
    
    
    //信贷配置页面
    public function money(){
    	$data = array(
    			'sh_seven' => "active",
    			'sh_block6' => " style='display:block';",
    			'sh_two22' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    //添加信贷信息到数据库的方法
    public function add_info(){
    	$info = I('info');
    	$info['sum'] = $info['money_num']+$info['letter']+$info['account_money']+$info['interest'];
    	$info['state'] = 1;
    	$loan_money = D('loan_money');
	    if(!$loan_money->create($info)){
				//如果创建失败，表示验证没有通过，输出错误提示信息
				exit($loan_money->getError());
		}else{
			$loan_money->add();
			$data = "配置成功";
			$this->ajaxReturn($data);
		}
    }
    
    //信贷信息页面
    public function money_manage(){
    	$loan_money = D('loan_money');
    	$list = $loan_money->order('time_length desc,money_num asc')->select();
    	$this->assign('list',$list);
    	$data = array(
    			'sh_seven' => "active",
    			'sh_block6' => " style='display:block';",
    			'sh_two23' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    public function update(){
    	$info = I('info');
    	$info['sum'] = $info['money_num']-$info['letter']-$info['account_money']-$info['interest'];
    	$info['state'] = 1;
    	$money_num = I('id');
    	$loan_money = D('loan_money');
    	$loan_money->where("money_num='$money_num'")->save($info);
    	$data = "更新成功";
    	$this->ajaxReturn($data);
    }
    //修改信贷信息
    public function edit_money(){
		
    	$id = I('id');
		if($id){
			$loan_money = D('loan_money');
			$list = $loan_money->where("id={$id}")->select();	
		}else{
			$list='';
		}
    	
    	$this->ajaxReturn($list);
    }
    
    //把修改的信息到数据里面更新
    public function edit_money_manage(){
    	$info = I('info');
    	$info['sum'] = $info['money_num']+$info['letter']+$info['account_money']+$info['interest'];
    	$loan_money = D('loan_money');
    	if(is_array($info)){
			if($info['id']){
				$loan_money->where("id=".$info['id'])->save($info);
				$data = '修改配置成功';
				$this->ajaxReturn($data);
			}else{
				$loan_money->add($info);
				$data = '添加配置成功';
				$this->ajaxReturn($data);
			}
    		
    		
    	}
    }

    //删除信贷信息
    public function delete_money_manage(){
    	$id = I('id');
    	$loan_money = D('loan_money');
    	$result = $loan_money->where('id='.$id)->delete();
    	if($result){
    		$data = '删除配置成功';
    		$this->ajaxReturn($data);
    	}
    }
    
    //逾期配置界面
    public function overdue(){
    	$user_overdue = D('user_overdue');    //用户逾期表
    	$result = $user_overdue->select();
    	$interest = $result[0]['interest'];  //逾期表的息费
    	$id = $result[0]['id'];
    	$this->assign('interest',$interest);  //把逾期的利息费发到页面上显示
    	$this->assign('id',$id);
    	$data = array(
    			'sh_seven' => "active",
    			'sh_block6' => " style='display:block';",
    			'sh_two24' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    
    //添加逾期费用
    public function add_overdue(){
    	$info = I('info');
    	$id = $info['id'];
    	if(is_array($info)){
    		$user_overdue = D('user_overdue');
    		$result = $user_overdue->where("id='$id'")->select();
    		if($result){
    			$user_overdue->where("id='$id'")->save($info);
    			$data = '更新配置成功';
    			$this->ajaxReturn($data);
    		}else{
    			$user_overdue->add($info);
    			$data = '更新配置成功';
    			$this->ajaxReturn($data);
    		}
    	}
    }
    //容时配置界面
    public function volume(){
  
    	$result = D('user_volume')->find();
    	$interest = $result['interest'];  
    
    	$this->assign('interest',$interest);  
    	
    	$data = array(
    			'sh_seven' => "active",
    			'sh_block6' => " style='display:block';",
    			'sh_two33' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    
    
    //添加容时费用
    public function add_volume(){
    	$info = I('info');
  
    	if(is_array($info)){
    		
    		$result = D('user_volume')->find();
    		if($result){
				$info['id'] = 1;
    			D('user_volume')->save($info);
    			$data = '更新配置成功';
    			$this->ajaxReturn($data);
    		}else{
    			D('user_volume')->add($info);
    			$data = '更新配置成功';
    			$this->ajaxReturn($data);
    		}
    	}
    }
    
    //续期配置界面
    public function xuqi(){
    	$xuqi = D('xuqi');    //续期表
    	$result = $xuqi->select();
    	$money = $result[0]['xuqi'];  //续期服务费
    	$id = $result[0]['id'];
    	$this->assign('money',$money);  //把逾期的利息费发到页面上显示
    	$this->assign('id',$id);
    	$data = array(
    			'sh_seven' => "active",
    			'sh_block6' => " style='display:block';",
    			'sh_two28' => " class='active'"
    	);
    	$this->assign("data",$data);
    	$this->display();
    }
    //添加续期配置数据
    public function add_xuqi(){
    	$info = I('info');
    	$id = $info['id'];
    	if(is_array($info)){
    		$xuqi = D('xuqi');
    		$result = $xuqi->where("id='$id'")->select();
    		if($result){
    			$xuqi->where("id='$id'")->save($info);
    			$data = '更新配置成功';
    			$this->ajaxReturn($data);
    		}else{
    			$xuqi->add($info);
    			$data = '更新配置成功';
    			$this->ajaxReturn($data);
    		}
    	}
    }
  	//查询 用户类型-负责人 查询
  	private function sely_f(){
  		
  		//显示用户类型
    	$data = D("status")->order("time desc")->select();
    	$this->assign("data",$data);
    	
    	//显示负责人
    	$data02 = D("service")->order("time desc")->select();
    	$this->assign("data02",$data02);
  	}
  	
  	public function xuexin(){
  		$xuexin = D('xuexin');
  		$list = $xuexin->select();
  		$this->assign('list',$list);
  		$this->display();
  	}
  	
  	public function xuexin_search(){
  		$phone = I('phone');
  		$xuexin = D('xuexin');
  		$list = $xuexin->where("phone='$phone'")->select();
  		$this->ajaxReturn($list);
  	}
  	
  
  	//后台管理员修改资料
  	public function admin_data(){
  		$admin_data = D('admin_data');
  		$info = $admin_data->find();
  		$this->assign('list',$info);
  		$this->assign('id',$info['id']);
  		$data = array(
  				'sh_seven' => "active",
  				'sh_block6' => " style='display:block';",
  				'sh_two29' => " class='active'"
  		);
  		$this->assign("data",$data);
  		$this->display();
  	}
  	
  	//更新管理员资料
  	public function edit_admin_data(){
  		$info = I('info');
  		$id = $info['id'];
  		if(is_array($info)){
  			$admin_data = D('admin_data');
  			$result = $admin_data->where("id='$id'")->select();
  			if($result){
  				$admin_data->where("id='$id'")->save($info);
  				$data = '更新配置成功';
  				$this->ajaxReturn($data);
  			}else{
  				$admin_data->add($info);
  				$data = '更新配置成功';
  				$this->ajaxReturn($data);
  			}
  		}
  	}
}