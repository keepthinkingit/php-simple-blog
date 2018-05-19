<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/17
 * Time: 9:50
 */

require('./lib/init.php');


if (empty($_POST)){
    require(ROOT . '/view/front/login.html');
}else{
    $user['name'] = trim($_POST['username']);
    if(empty($user['name'])){
        errorl("用户名不能为空!");
    }

    $user['pw'] = trim($_POST['password']);
    if(empty($user['pw'])){
        errorl("密码不能为空!");
    }

    $sql = "select password,salt from user where name='$user[name]'";
    $result = mGetRow($sql);
    if(!$result){
        errorl("登录失败,请核对用户名和密码!");
    }else{
        if(md5($user['pw'] . $result['salt']) ===  $result['password']){
            setcookie('name', $user['name'],strtotime( '+30 days' ));
            setcookie('scode', addSalt($user['name']));
            // succ("登录成功!");
            header("Location:artlist.php");
        }else{
            errorl("密码错误!");
        }
    }
}






