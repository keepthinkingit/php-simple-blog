<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/17
 * Time: 14:12
 */

require('./lib/init.php');

if(!access()){
    header("Location: login.php");
}

if (empty($_POST)){
    require(ROOT . '/view/front/pwedit.html');
}else{
    $user['name'] = trim($_POST['username']);
    $sql = "select name from user where name='$user[name]'";

    if(empty($user['name'])){
        errorl("用户名不能为空!");
    }else if(!mGetRow($sql)){
        errorl("用户名输入错误");
    }

    $user['password'] = trim($_POST['password']);
    $user['pwd_again'] = trim($_POST['pwd_again']);
    if(empty($user['password'])){
        errorl("密码不能为空!");
    }else if($user['password'] != $user['pwd_again']){
        errorl("两次输入的密码不相同!");
    }

    unset($user['pwd_again']);
    if(mExe('user', $user, 'update')){
        setcookie('name', $user['name'],strtotime( '+30 days' ));
        succ("修改密码成功!");
    }else{
        errorl("修改密码失败,请核对相关信息!");
    }
}