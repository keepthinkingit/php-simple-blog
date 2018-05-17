<?php

//$servername = 'localhost';
//$musername = 'root';
//$mpasswd = '389299';
//$dbname = "blog";

require('./lib/init.php');

if(!access()){
    header("Location: login.php");
}

if (empty($_POST)) {
	include(ROOT .'/view/admin/catadd.html');
}else  {
    //check catname
//    $conn = mysqli_connect($servername, $musername, $mpasswd, $dbname);
//    mysqli_query($conn,'set names utf8');
    $cat['catname'] = trim($_POST['catname']);
    if (empty($cat['catname'])) {
        echo 'category name can not be empty or blank';
    }

    //check the catname existing
    $sql1 = "select count(*) from cat where catname='$cat[catname]'";
    $result1 = mQuery($sql1);
    if (mysqli_fetch_row($result1)[0] !=0) {
        error('栏目名称已经存在！');
        exit();
    }

    //add catname to mysql
//    $sql2 = "insert into cat(catname) values('$cat[catname]')";
    if (!mExe('cat',$cat)) {
        echo 'catname insert failed!';
    }else {
//        echo 'Ok, the catname insert sucess!';
        succ('栏目插入成功！');
    }
}
