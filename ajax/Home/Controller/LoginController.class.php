<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function login(){
        $mobile = $_POST['mobile'];
        $password = md5($_POST['password']);
        $Model = new Model() // 实例化一个model对象 没有对应任何数据表
        $list = $Model->query("select * from user ");
        var_dump($list);



    }
}