<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController{
	//添加常见问题界面
	public function add_problem(){
		$data = array(
				'sh_six' => "active",
				'sh_block5' => " style='display:block';",
				'sh_two17' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	//添加常见问题的方法
	public function problem_method(){
		$info = I('info');
		$info['content'] = htmlspecialchars_decode($info['content']);
		$article_problem = D('article_problem');
		if(is_array($info)){
			if(!$article_problem->create($info)){
					//如果创建失败，表示验证没有通过，输出错误提示信息
					exit($article_problem->getError());
			}else{
				$article_problem->add();
				$data = "添加成功";
				$this->ajaxReturn($data);
			}
		}
	}
	//常见问题列表
	public function problem_list(){
		$article_problem = D('article_problem');
		$list = $article_problem->select();
		$this->assign('list',$list);
		$data = array(
				'sh_six' => "active",
				'sh_block5' => " style='display:block';",
				'sh_two18' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function edit(){
		$id = I('id');
		$article_problem = D('article_problem');
		$list = $article_problem->where("id='$id'")->select();
		$this->ajaxReturn($list);
	}
	public function edit_content(){
		$info = I('info');
		$info['content'] = htmlspecialchars($info['content']);
		$id = I('id');
		$article_problem = D('article_problem');
		$article_problem->where("id='$id'")->save($info);
		$data = "修改成功";
		$this->ajaxReturn($data);
	}
	//删除常见问题的方法
	public function delete_content(){
		$id = I('id');
		$article_problem = D('article_problem');
		$article_problem->where("id='$id'")->delete();
		$data = "删除成功";
		$this->ajaxReturn($data);
	}
	//置顶
	public function top(){
		$id = I('id');
		$article_problem = D('article_problem');
		$article_problem->where("id='$id'")->setField('top','1');
		$data = "置顶成功";
		$this->ajaxReturn($data);
	}
	
	//协议
	public function agreement(){
		$agreement = D('agreement');
		$list = $agreement->select();
		$id = $list[0]['id'];
		$content = htmlspecialchars_decode($list[0]['content']);
		$content = htmlspecialchars_decode($content);
		$this->assign('id',$id);
		$this->assign('content',$content);
		$data = array(
				'sh_six' => "active",
				'sh_block5' => " style='display:block';",
				'sh_two20' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function message_list(){
		$user_message = D('user_message');
		$list = $user_message->select();
		$this->assign('list',$list);
		$data = array(
				'sh_six' => "active",
				'sh_block5' => " style='display:block';",
				'sh_two19' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	
	public function edit_agreement(){
		$info = I('info');
		$id = I('id');
		$info['content'] = htmlspecialchars($info['content']);
		$agreement = D('agreement');
		$list = $agreement->where("id='$id'")->select();
		if($list){
			$agreement->where("id='$id'")->save($info);
			$data = '修改成功';
			$this->ajaxReturn($data);
		}else{
			$agreement->add($info);
			$data = '修改成功';
			$this->ajaxReturn($data);
		}
	}
	
	public function surver_list(){
		$survey = D('survey');
		$list = $survey->select();
		$this->assign('list',$list);
		$data = array(
				'sh_six' => "active",
				'sh_block5' => " style='display:block';",
				'sh' => " class='active'"
		);
		$this->assign("data",$data);
		$this->display();
	}
	
	public function xiangqing(){
		$phone = I('phone');
		$survey = D('survey');
		$list = $survey->where("phone='$phone'")->find();
		$this->assign('list',$list);
		$this->display();
	}
}