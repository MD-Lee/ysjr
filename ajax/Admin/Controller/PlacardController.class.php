<?php
namespace Admin\Controller;
use Think\Controller;
class PlacardController extends Controller {
    public function index(){
		$Placard = D("placard");		
		
		$count  = $Placard->count("id");    //计算总数
		
		if($count<1){
			$state["code"] 	= 1;
			$state["msg"] 	= "无数据";	
		}else{			
			$Page   = new \Think\Page($count,10);
    	
			$list = $Placard->field('id,title,times')
							->order("id desc")
							->limit($Page->firstRow. ',' . $Page->listRows)
							->select();			
			
			$state["code"] 	= 0;
			$state["msg"] 	= "";
			$state["data"] 	= $list;
			$state["page"] = ceil($count / $Page->listRows);
		}		
		echo json_encode($state);
    }
	
	public function detail(){
		$Placard = D("placard");		
		
		$id=$_POST['id'];
		//$id=$_GET['id'];
		
		$rs = $Placard->where('id='.(int)$id)->find();
		
		if(empty($rs)){
			$state["code"] 	= 1;
			$state["msg"] 	= "ID错误";	
		}else{
			$rs['content']=htmlspecialchars_decode(htmlspecialchars_decode($rs['content']));

			$state["code"] 	= 0;
			$state["msg"] 	= "";
			$state["data"] 	= $rs;
		}
		echo json_encode($state);
    }	
}