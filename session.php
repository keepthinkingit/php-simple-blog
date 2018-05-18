<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/17
 * Time: 14:58
 */

require('./lib/init.php');

session_start();
$_SESSION['name'] = 'nanana';
$_SESSION['age'] = '18';

