<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/16
 * Time: 17:46
 */


setcookie("cookie[name]", 'admins');

//count access number in cookies
if (!isset($_COOKIE['num'])) {
    $num = 1;
    setcookie('num' , $num);
}else {
    $num = $_COOKIE['num'] + 1;
    setcookie('num', $num);
}

echo $num;

//cookie avaliable acces time
setcookie('name', 'admins', time()+60);

//set cookie