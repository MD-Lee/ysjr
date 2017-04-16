<?php
namespace Admin\Controller;

use Think\Controller;

class CardController extends CommonController {
    public function index(){
		$data = array(
    			'sh_one' => "",
    			'sh_block' => " style='display:block';",
    			'sh_two02' => " class='active'"
    	);
    	$this->assign("data",$data);
		
		$Card = D("card");
		$count  = $Card->count("id");    //计算总数
		
		
    	$Page   = new \Think\Page($count,10);
		$Page->setConfig('prev', "上一页");
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('first', '首页');
    	$Page->setConfig('last', '尾页');
    	$show 	= $Page->show();
    	$this->assign("page",$show);
    	
    	$list = $Card->order("id desc")->limit($Page->firstRow. ',' . $Page->listRows)->select();
    	$this->assign("list",$list);
		
		$this->display();
    }  
}