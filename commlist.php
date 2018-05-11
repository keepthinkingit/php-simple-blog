<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/11
 * Time: 17:46
 */

require ('./lib/init.php');

//获取当前文章ID
$art_id = $_GET['art_id'];

//获取文章所有评论
$sql = "select nick,email,content,ip,pubtime,comment_id from comment where art_id=$art_id order by pubtime desc";
$commlist = mGetAll($sql);

// print_r($commlist);exit();

//判断地址栏是否传入cat_id
//$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id']: '';
if(isset($_GET['cat_id'])){
    $where = " and art.cat_id=$_GET[cat_id]";
}else{
    $where = '';
}

//分页代码
$sql = "select count(*) from art where 1" . $where ;//获取评论总数
$all = mGetOne($sql);//评论总数
$curr = isset($_GET['page']) ? $_GET['page'] :1;   //当前页码
$num = 20;        //每页显示评论数量
$page = getPage($all, $curr, $num);
// print_r($page);

require(ROOT .'/view/admin/commlist.html');