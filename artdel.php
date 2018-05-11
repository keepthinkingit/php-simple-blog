<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/7
 * Time: 21:38
 */
require('./lib/init.php');

$art_id = $_GET['art_id'];

//判断地址栏传来的art_id是否合法
if(!is_numeric($art_id)){
    error('文章编号不合法');
}

//判断文章是否存在
$sql = "select * from art where art_id=$art_id";
if(!mGetRow($sql)){
    error('文章不存在!');
}

//删除文章
$del = "delete from art where art_id=$art_id";
if(!mQuery($del)){
    error('文章删除失败');
}else {
    succ('文章删除成功');
    header("refresh:3;url=./artlist.php");


}