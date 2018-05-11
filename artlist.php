<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/7
 * Time: 18:12
 */

require('./lib/init.php');

$q = "select art_id,title,pubtime,comm,catname from art left join cat on art.cat_id=cat.cat_id";
$artlist = mGetAll($q);



//$q1 = "select * from cat ";
//$result1 = mQuery($q);
//$catlist = array();


//while($row = mysqli_fetch_assoc($result) ){
//    $artlist[] = $row;
//}
//while($row = mysqli_fetch_assoc($result1) ){
//    $catlist[] = $row;
//}
//var_dump($catlist);
//print_r($artlist);

require(ROOT .'/view/admin/artlist.html');