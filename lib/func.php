<?php 

/**
* 后台管理成功的提示信息
*/

function succ($message) {
	$result = 'succ';
	require(ROOT . '/view/admin/info.html');
	exit();
}

/**
* 后台管理失败返回的报错信息
*/

function error($message) {
	$result = 'fail';
	require(ROOT . '/view/admin/info.html');
	exit();
}

/**
 * 前台成功的提示信息
 */

function succf($message) {
    $result = 'succf';
    require(ROOT . '/view/front/frontinfo.html');
    exit();
}

/**
 * 前台失败返回的报错信息
 */

function errorf($message) {
    $result = 'errorf';
    require(ROOT . '/view/front/frontinfo.html');
    exit();
}



/**
* 获取客户端ip信息
*/

function getRealIp(){
    static $realip = null;
    if ($realip !== null){
        return $realip;
    }

    if(getenv('HTTP_X_FORWARD_FOR')) {
        $realip = getenv('HTTP_X_FORWARD_FOR');
    }else if(getenv('HTTP_CLIENT_IP')){
        $realip = getenv('HTTP_CLIENT_IP');
    }else if(getenv('REMOTE_ADDR')){
        $realip = getenv('REMOTE_ADDR');
    }
    return $realip;
}

/**
 * 生成分页代码
 * @param int $ 文章总数
 * @param int $curr 当前显示的页面数    $curr-2 $curr-1 $curr $curr-1 $curr-2
 * @param int $num 每页显示的条数
 */

function getPage($all,$curr,$num)
{
    //最大的页码数
    $max = ceil($all/$num);
    //最左侧页码
    $left = max(1, $curr-2);
    //最右侧页码
    $right = min($left+4, $max);
    $left = max(1, $right-4); //1234(5(6789) 取出56789,保证每次显示都为5个页码出现
    $page = array();
    for ($i = $left; $i <= $right; $i = $i + 1) {
        $_GET['page'] = $i;
        $page[$i] = http_build_query($_GET);
    }
    return $page;
}

// print_r(getPage(100,5,5));

/*
 * 生成随机字符串
 * @param int $length 生成随机字符串的长度
 * @param string $char 组成随机字符串的字符串
 * @return string $string 生成的随机字符串
 */
function strRand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    if(!is_int($length) || $length <= 0) {
        return false;
    }

    $string = '';
    for($i = $length; $i > 0; $i=$i-1) {
        $string .= $char[mt_rand(0, strlen($char) - 1)];
    }
    return $string;
}
//生成随机字符串第二种思路
// function strRand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
//     if(!is_int($length) || $length <= 0) {
//         return false;
//     }
//
//     $string = str_shuffle($char);
//     $string .= substr($char, 0, $length);
//     return $string;
// }

//生成唯一字符串,使用md5
// $uniqid = md5(uniqid(microtime(true),true));
// echo $uniqid;

/**
 * 创建目录,从网站根目录存取文件  ROOT .'/upload/2018/01/01/2018010100.jpg'
 *
 */
function createDir(){
    $path = '/upload/'.date('Y/m/d');
    $fpath = ROOT .$path;
    if(is_dir($fpath) || mkdir($fpath , 0777, true)){
        return $path;
    }else {
        return false;
    }
}

/**
 * 获取文件后缀
 * @param string $filename
 * @return string $ext
 */
function getExt($filename){
    $ext = strrchr($filename, '.');
    return $ext;
}


?>


