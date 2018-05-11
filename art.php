<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/9
 * Time: 11:17
 */
require('./lib/init.php');

$art_id=$_GET['art_id'];

//判断art_id是否合法
//if(!is_numeric($art_id)){
//    header('Location: index.php');
//}

//如果文章不存在，跳转到首页
$sql = "select * from art where art_id=$art_id";
if(!mGetRow($sql)){
    header('Location: index.php');
}

//查询所有分类名称
$sql = "select * from cat";
$catlist = mGetAll($sql);

//查询所有评论内容
$sql = "select * from comment where art_id=$art_id";
$commlist = mGetAll($sql);
//print_r($commlist);
//var_dump($commlist);

//查询文章内容
$sql = "select art_id,title,content,pubtime,catname,nick,comm from art inner join cat on art.cat_id=cat.cat_id where art_id=$art_id";
$art = mGetRow($sql);

//判断是否有新留言
if(!empty($_POST)){
    if(empty($_POST['nick'])){
        errorf("请填写昵称～");
    }
    $newcomm['nick']=trim($_POST['nick']);
    if(empty($_POST['email'])){
        errorf("请填写邮箱～");
    }
    $newcomm['email']=trim($_POST['email']);
    if(empty($_POST['content'])){
        errorf("留言内容不能为空～");
    }
    $newcomm['content']=trim($_POST['content']);
    $newcomm['art_id']=$art_id;
    $newcomm['pubtime']=time();
    $newcomm['ip'] = sprintf('%u', ip2long(getRealIp()));
    $result = mExe('comment',$newcomm);
    if($result){
        //评论发布成功后增加一个计数
        $addcomm = "update art set comm=comm+1 where art_id=$art_id";
        mQuery($addcomm);
        //提交表单后刷新本页(跳转到上一个页面
        $ref = $_SERVER['HTTP_REFERER'];
        header("Location: $ref");
    }
}

require(ROOT .'/view/front/art.html');
