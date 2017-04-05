<?php
namespace Admin\Controller;

use Think\Controller;

class ZixunController extends CommonController {

    public function __construct(){
        parent::__construct();
        $this->assign("data",array('setting' => " style='display:block';"));
    }

    public function index(){
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
    public function add(){
        //添加
        if($_POST){
            $data = array(
                'title'			=>	I("title"),
                'content'		=>	htmlspecialchars(I("content"))
            );

            $se = D("zixun")->add($data);

            $this->success('新增成功，即将返回列表页面', U('Zixun/index'));
            exit;
        }
        $this->display();
    }
    public function edit($id){
        $Placard = D("zixun");

        //修改
        if($_POST){

            $data = array(
                'title'			=>	I("title"),
                'content'		=>	htmlspecialchars(I("content"))
            );

            //var_dump($data);exit;
            $Placard->where('id='.(int)$id)->save($data);
            $this->success('修改成功，即将返回列表页面', U('Zixun/index'));
            exit;
        }

        $rs = $Placard->where('id='.(int)$id)->find();
        $rs['content']=htmlspecialchars_decode($rs['content']);
        $this->assign("rs",$rs);

        $this->display();
    }
    public function del($id){
        $New = D("zixun");
        $rs = $New->where('id='.(int)$id)->delete();
        $this->success('删除成功，即将返回列表页面', U('Zixun/index'));
    }
}