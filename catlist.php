<meta charset="UTF-8">
<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/4/28
 * Time: 16:55
 */

require('./lib/init.php');



//判断地址栏是否传入cat_id
// if(isset($_GET['cat_id'])){
//     $where = " and art.cat_id=$_GET[cat_id]";
// }else{
//     $where = '';
// }

//分页代码
$sql = "select count(*) from cat where 1 "  ;//获取文章总数
$all = mGetOne($sql);//文章总数
$curr = isset($_GET['page']) ? $_GET['page'] :1;   //当前页码
$num = 20;        //每页显示页面数量
$page = getPage($all, $curr, $num);

//取出所有分类
$sql = "select * from cat where 1 " . "order by cat_id asc limit " . ($curr-1)*$num . ',' . $num;
$catlist = mGetAll($sql);

//print_r($catlist);

require(ROOT .'/view/admin/catlist.html');
