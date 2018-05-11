<?php
require('./lib/init.php');

//lookup all catname in this page
$sql = "select * from cat";
$catlist = mGetAll($sql);

//判断地址栏是否传入cat_id
//$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id']: '';
if(isset($_GET['cat_id'])){
    $where = " and art.cat_id=$_GET[cat_id]";
}else{
    $where = '';
}

//分页代码
$sql = "select count(*) from art where 1" . $where ;//获取文章总数
$all = mGetOne($sql);//文章总数
$curr = isset($_GET['page']) ? $_GET['page'] :1;   //当前页码
$num = 5;        //每页显示页面数量
$page = getPage($all, $curr, $num);
// print_r($page);


//查询所有文章
$sql = "select art_id,content,title,pubtime,nick,art.cat_id,catname,comm from art inner join cat on art.cat_id=cat.cat_id where 1 ".$where . " order by art_id desc limit " . ($curr-1)*$num . ',' . $num;
$artlist = mGetAll($sql);

//如果栏目页没有文章，提示此分类暂无文章
$sql = "select count(*) from art where 1 ".$where;
if(mGetRow($sql)['count(*)']==0) {
    errorf("此分类下暂无文章！");
}else{
    require(ROOT .'/view/front/index.html');
}
//header('Location:index.php');






































?>