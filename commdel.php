<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/11
 * Time: 20:15
 */

require('./lib/init.php');

$comment_id = $_GET['comment_id'];


//判断地址栏传来的comment_id是否合法
if(!is_numeric($comment_id)){
    error('评论编号不合法');
}

//判断评论是否存在
$sql = "select * from comment where comment_id=$comment_id";
if(!mGetRow($sql)){
    error('评论不存在!');
}

//获取art_id
$sql = "select art_id from comment where comment_id=$comment_id";
$art_id = mGetOne($sql);

//删除评论
$del = "delete from comment where comment_id=$comment_id";
if(!mQuery($del)){
    error('评论删除失败');
}else {
    $sql = "update art set comm=comm-1 where art_id=" . $art_id;
    mQuery($sql);
    // succ('评论删除成功');
    $ref = $_SERVER['HTTP_REFERER'];
    // echo "评论删除成功";
    // header("refresh:3;$ref");
    header("Location:$ref");

}