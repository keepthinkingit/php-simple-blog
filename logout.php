<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/17
 * Time: 11:15
 */

// setcookie('name',null,1,'','blog.com');
setcookie('name','',1);
setcookie('scode', null, 3);
header("Location: login.php");

//you can use setcookie's value:null or '' to delete cookie.

