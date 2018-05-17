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
    ;
}