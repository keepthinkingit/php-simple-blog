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
$sql = "select * from comment where art_id=$art_id";

