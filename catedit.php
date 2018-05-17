<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/4/28
 * Time: 17:30
 */
require('./lib/init.php');

if(!access()){
    header("Location: login.php");
}

$cat_id = $_GET['cat_id'];
//echo $cat_id;

//$servername = 'localhost';
//$musername = 'root';
//$mpasswd = '389299';
//$dbname = "blog";
//
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

//check catname exists
if (empty($_POST)){
    $q = "select catname from cat where cat_id=$cat_id";
    $result = mQuery($q);
    $catn = mysqli_fetch_assoc($result);
    require(ROOT .'/view/admin/catedit.html');
}else {
    $q2 = "update cat set catname='$_POST[catname]' where cat_id=$cat_id";
    if (!mQuery($q2)) {
//        echo '栏目修改失败';
        succ('栏目修改失败');
    }else {
//        echo '栏目修改成功';
        error('栏目修改成功');
    }
}


