<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/17
 * Time: 14:23
 */
require('./lib/init.php');

if (empty($_POST)){
    require(ROOT . '/view/front/reg.html');
}else{
    $user['name'] = trim($_POST['username']);
    if(empty($user['name'])){
        errorl("用户名不能为空!");
    }

    $user['pw'] = trim($_POST['password']);
    $user['pwd_again'] = trim($_POST['pwd_again']);
    if(empty($user['pw'])){
        errorl("密码不能为空!");
    }else if($user['pw'] != $user['pwd_again']){
        errorl("两次输入的密码不相同!");
    }

    $sql = "select password from user where name='$user[name]'";
    // var_dump($sql);exit();
    // $rpw = mGetRow($sql);
    // var_dump($rpw);exit();
    if(mGetRow($sql) && mGetRow($sql)['password'] == $user['pw']){
        setcookie('name', $user['name'],strtotime( '+30 days' ));
        succ("登录成功!");
    }else{
        errorl("登录失败,请核对用户名和密码!");
    }


}

