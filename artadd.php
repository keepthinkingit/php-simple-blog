<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/7
 * Time: 15:20
 */
require('./lib/init.php');

$sql = "select * from cat";
$cats = mGetAll($sql);
//print_r($cats);
//exit();

if(empty($_POST)){
    //无数据则打开文章添加页
    include(ROOT .'/view/admin/artadd.html');
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

    //收集tag
    $art['arttag'] = trim($_POST['tag']);

    //插入发布时间
    $art['pubtime'] = time();

    //插入内容到文章表
    if(!mExe('art', $art)){
        error('文章发布失败，请重试！');
    }else{
        //判断是否有tag
        $art['tag'] = trim($_POST['tag']);
        if($art['tag'] == ''){
            //发布成功后,添加栏目文章数
            $sql = "update cat set num=num+1 where cat_id=".$art['cat_id'];
            mQuery($sql);
            succ('文章发布成功！');
        }else{
            //获取上次操作产生的主键ID
            $art_id = getLastId();
            //把本次提交的标签插入tag表
            $tag = explode(',', $art['tag']);
            $sql = "insert into tag(art_id,tag) values ";
            foreach($tag as $v) {
                $sql = $sql . "(" . $art_id.",'" . $v . "') ,";
            }
            $sql = rtrim($sql, ",");
            if(mQuery($sql)) {
                //发布成功后,添加栏目文章数
                $sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
                mQuery($sql);
                succ("文章添加成功");
            }else {
                //tag添加失败,可以删除原文章或者取空,此处暂定为添加标签失败需要重新编辑文章
                $sql = "delete from art where art_id=$art_id";
                if(mQuery($sql)){
                    //发布失败后,栏目文章数-1
                    $sql = "update cat set num=num-1 where cat_id=$art[cat_id]";
                    mQuery($sql);
                    error("文章发布失败");
                }
            }
        }

    }


}


