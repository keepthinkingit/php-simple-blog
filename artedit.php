<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/8
 * Time: 11:26
 */
require('./lib/init.php');

$art_id = $_GET['art_id'];

//判断栏目ID是否为数字
if (!is_numeric($art_id)) {
    echo '栏目ID不合法';
    exit();
}

//检查文章内容是否存在
$sql1 = "select * from art where art_id=$art_id";
if(!mGetRow($sql1)){
    error("文章内容不存在！");
}

//查询出所有栏目
$sql2 = "select * from cat";
$cats = mGetAll($sql2);

if(empty($_POST)){
    $sql3 = "select title,content,cat_id from art where art_id=$art_id";
    $art = mGetRow($sql3);
    $tags = "select tag from tag where art_id=$art_id";
    $art['tag'] = mGetAll($tags);
    include(ROOT .'/view/admin/artedit.html');
}else {
    //检测标题是否为空
    $art['title'] = trim($_POST['title']);
    if($art['title'] == ''){
        error('标题不能为空');
    }

    //检测栏目是否合法
    $art['cat_id'] = $_POST['cat_id'];
    if(!is_numeric($art['cat_id'])){
        error('栏目不合法，请重新输入');
    }

    //检测内容是否为空
    $art['content'] = trim($_POST['content']);
    if(empty($art['content'])){
        error('内容不能为空');
    }

    $art['lastup'] = time();


    if(!mExe('art', $art, 'update',"art_id=$art_id")){
        error('文章修改失败');
    }else {
        //删除本文所有标签,然后重新插入新tag
        $deltag = "delete tag from tag where art_id=$art_id";
        mQuery($deltag);//删除原文在tag表存放的tag
        //插入修改后新提交的tag到tag表
        $art['tag'] = trim($_POST['tag']);
//        print_r($art['tag']);
        $tag = explode(',', $art['tag']);
        $sql = "insert into tag(art_id,tag) values ";
        foreach($tag as $v) {
            $sql = $sql . "(" . $art_id.",'" . $v . "') ,";
        }
        $sql = rtrim($sql, ",");
//        print_r($sql);
        mQuery($sql);
        succ('文章修改成功');
    }
}


