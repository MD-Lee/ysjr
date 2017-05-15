<?php
namespace Admin\Controller;
use Think\Controller;

class CrontabController extends Controller {
    public function index(){
	remind();//定时执行任务
	$time = date('Y-m-d',time());
	file_put_contents("test.txt","Hello World. Testing!".$time);
    	
    }
    
   
  
   
}