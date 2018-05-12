<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/12
 * Time: 12:12
 */
require('./lib/init.php');

// print_r($_FILES);
//获取临时文件位置
$origin = $_FILES['fileupload']['tmp_name'];

//获取上传文件名称
$name = $_FILES['fileupload']['name'];

//生成随机文件名
$fname = date('Ymd') . rand(10,19);//取当前日期作为文件名再加上随机一位数

//根据文件名称获取文件后缀
$ext = strrchr($name, '.'); //from a.jpg get jpg

//创建文件上传目录
$path = ROOT .'\\upload\\'.date('Y\\\m\\\d');   //this is windows dir pattern
if(!is_dir($path)){
    mkdir($path, 0777, true);
}

//最终文件夹 文件存储名称
$dest = $path . '\\' . $fname . $ext;

//创建文件上传目录  *unix版本请用此方法
// $path = ROOT .'/upload/'.date('Y/m/d');   //this is linux dir pattern
// if(!is_dir($path)){
//     mkdir($path, 0777, true);
// }
// $dest = $path . '/' . $fname . $ext;


//将临时文件 移动到upload下相应的日期文件夹

echo move_uploaded_file($origin, $dest)?'success upload':'fail to upload';

