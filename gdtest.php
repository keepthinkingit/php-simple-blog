<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/13
 * Time: 16:36
 */

// print_r(gd_info());
//创建空白画布,制定宽高
$pic = imagecreatetruecolor(800, 600);

//创建颜料
$red = imagecolorallocate($pic, 255, 0, 0);
$blue = imagecolorallocate($pic, 0, 0, 211);

//填充背景色
imagefill($pic, 0, 0, $blue);

//画图形或写字
imageellipse($pic, 400, 300, 400, 300, $red);

//输出/保存图像
imagepng($pic, './t1.png');

//销毁画布
imagedestroy($pic);

