<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/7
 * Time: 18:12
 */

require('./lib/init.php');

if(!access()){
    header("Location: login.php");
}

//判断地址栏是否传入cat_id
if(isset($_GET['cat_id'])){
    $where = " and art.cat_id=$_GET[cat_id]";
}else{
    $where = '';
}

//分页代码
$sql = "select count(*) from art where 1" . $where ;//获取文章总数
$all = mGetOne($sql);//文章总数
$curr = isset($_GET['page']) ? $_GET['page'] :1;   //当前页码
$num = 10;        //每页显示页面数量
$page = getPage($all, $curr, $num);

$sql = "select art_id,title,pubtime,comm,catname from art inner join cat on art.cat_id=cat.cat_id where 1 " . $where . "order by art_id desc limit " . ($curr-1)*$num . ',' . $num;
$artlist = mGetAll($sql);

// print_r($artlist);

require(ROOT .'/view/admin/artlist.html');