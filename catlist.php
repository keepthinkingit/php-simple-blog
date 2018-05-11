<meta charset="UTF-8">
<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/4/28
 * Time: 16:55
 */
require('./lib/init.php');

//$servername = 'localhost';
//$musername = 'root';
//$mpasswd = '389299';
//$dbname = "blog";
//
//$conn = mysqli_connect($servername, $musername, $mpasswd, $dbname);
//mysqli_query($conn,'set names utf8');
$q1 = "select * from cat";
$result1 = mQuery($q1);
$catlist = array();

while($row = mysqli_fetch_assoc($result1) ){
    $catlist[] = $row;
}
//print_r($catlist);

require(ROOT .'/view/admin/catlist.html');
