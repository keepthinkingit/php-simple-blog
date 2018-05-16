<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/16
 * Time: 14:46
 */

$originpic = './images/female.jpg';
$logo = './images/mark.png';
$origin = imagecreatefromjpeg($originpic);
$mark = imagecreatefrompng($logo);

list($ow, $oh) = getimagesize($originpic);
list($mw, $mh) = getimagesize($logo);

imagecopymerge($origin, $mark, $ow-$mw, $oh-$mh, 0,0, $mw, $oh, 50);

imagepng($origin, 'test.png');

imagedestroy($origin);
imagedestroy($mark);

