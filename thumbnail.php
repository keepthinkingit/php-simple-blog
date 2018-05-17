<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/16
 * Time: 15:06
 */

$originpic = './images/female.jpg';
$origin = imagecreatefromjpeg($originpic);
list($w, $h) = getimagesize($originpic);

$thumb = imagecreatetruecolor($w/2, $h/2);

imagecopyresampled($thumb, $origin, 0,0,0,0,$w/2,$h/2,$w, $h);

imagepng($thumb, './thumb.png');
