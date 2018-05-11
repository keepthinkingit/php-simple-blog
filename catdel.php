<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/4/28
 * Time: 17:29
 */
require('./lib/init.php');

$cat_id = $_GET['cat_id'];
//echo $cat_id;

//$servername = 'localhost';
//$musername = 'root';
//$mpasswd = '389299';
//$dbname = "blog";

//$conn = mysqli_connect($servername, $musername, $mpasswd, $dbname);
//mysqli_query($conn,'set names utf8');

if (!is_numeric($cat_id)) {
    echo '栏目ID不合法';
    exit();
}

//check cat existing
$q1 = "select count(*) from cat where cat_id = $cat_id";
$result1 = mQuery($q1);
if (mysqli_fetch_row($result1)[0] ==0) {
    echo '栏目不存在';
    exit();
}

//check if it has article in category.
$q2 = "select count(*)from art where cat_id = $cat_id";
$result2 = mQuery($q2);
if (mysqli_fetch_row($result2)[0] !=0) {
    echo '栏目下存在文章，不能删除';
    exit();
}

//delete category
$q3 = "delete from cat where cat_id=$cat_id";
if (!mQuery($q3)) {
    echo '栏目删除失败';
}else {
    echo '栏目删除成功';
}

