<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $mobile = $_POST['mobile'];
        $password = md5($_POST['password']);
        $condition1['phone'] = $mobile;
        $user = M("service")->where($condition1)->select();
        if(!$user)
        {
            $state[code] = 1;
            $state[msg] = "用户名不存在";
            $state[user] = "";
        }
        $condition2['phone'] = $mobile;
        $condition2['password'] = $password;
        $user = M("service")->where($condition2)->select();
        if($user)
        {
            $state[code] = 0;
            $state[msg] = "登陆成功";
            $state[user] = $user;
        }
        else
        {
            $state[code] = 2;
            $state[msg] = "密码不正确";
            $state[user] = "";
        }
        echo json_encode($state);
    }

    public function register(){
        $mobile = $_POST['mobile'];
//        $mobile = 15980770590;
        $code = $_POST['code'];
        $jihuoma = $_POST['jihuoma'];
        $password = md5($_POST['password']);
        $password1 = md5($_POST['password1']);
        $where['phone'] = $mobile;
        $user = M("service")->where($where)->select();

        if($user)
        {
            $state[code] = 4;
            $state[msg] = "用户已注册";
            echo json_encode($state);
            exit;
        }
        if($password!=$password1)
        {
            $state[code] = 2;
            $state[msg] = "两次密码不一样";
            echo json_encode($state);
            exit;
        }
        $condition['code'] = $code;
        $yanzheng = M("code")->where($condition)->order('id desc')->limit(1)->select();
        if(!$yanzheng)
        {
            $state[code] = 1;
            $state[msg] = "验证码不正确";
            echo json_encode($state);
            exit;
        }
        $condition1['jihuoma'] = $jihuoma;
        $condition1['status'] = 0;
        $jihuoyz = M("jihuoma")->where($condition1)->select();

        if(!$jihuoyz)
        {
            $state[code] = 3;
            $state[msg] = "激活码不正确";
            echo json_encode($state);
            exit;
        }
        $Form   =   D('service');
        $data['phone']  =   $mobile;
        $data['password']    =   $password;
        $data['time']    =   time();
        $return = $Form->add($data);
        $Form   =   D('jihuoma');
        $condition2['jihuoma']  =  $jihuoma;
        $data2['status'] = 1;
        $code = $Form->where($condition2)->save($data2);

        if($return)
        {
            $state[code] = 0;
            $state[msg] = "注册成功";
            echo json_encode($state);
            exit;
        }

    }

    public function validate(){
        $mobile = $_POST['mobile'];
//        $mobile = '15980770590';
        $checkcodes=rand(100000,999999);//验证码
        $content =  "您的验证码是:".strtolower($checkcodes[0])."。请不要把验证码泄露给其他人。";
        $Form   =   D('code');
        $data['code']  =   $checkcodes;
        $data['mobile']    =   $mobile;
        $data['time']    =   time();
        $code = $Form->add($data);
        $user = 'cf_wtxinxi';
        $password = '688ab4dde5f07652eee94eb94305a086';
        $post_data = "account={$user}&password={$password}&mobile=".$mobile."&content=您的验证码是：".$checkcodes."。请不要把验证码泄露给其他人。";
        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
//        $url = "http://106.ihuyi.cn/webservice/sms.php?method=Submit&account=$user&password=$password&mobile=$mobile&content=$content";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $target);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $return_str = curl_exec($curl);
        curl_close($curl);
        /*curl*/

        echo json_encode($return_str);

    }

    public function changepassword(){
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $password1 = md5($_POST['password1']);
        $password2 = md5($_POST['password2']);
        if($password1 !== $password2)
        {
            $state[code] = 1;
            $state[msg] = "2次密码不一样";
            echo json_encode($state);
            exit;
        }
        $condition2['id'] = $id;
        $condition2['password'] = $password;
        $user = M("service")->where($condition2)->select();
        if(!user)
        {
            $state[code] = 2;
            $state[msg] = "原密码不正确";
            echo json_encode($state);
            exit;
        }
        $Form = M("service");
        // 要修改的数据对象属性赋值
        $condition['id'] = $id;
        $data['password'] = $password1;

        $code = $Form->where($condition)->save($data);
        if($code)
        {
            $state[code] = 0;
            $state[msg] = "修改成功";
            echo json_encode($state);
            exit;
        }

//

    }

    public function findpassword(){

    }

    public function yingyong(){

    $list = M("tubiao")->limit(8)->select();
    echo json_encode($list);
}



    public function zixunlist(){
        $Placard = D("zixun");

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
        $Placard = D("zixun");

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