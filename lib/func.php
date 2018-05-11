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







?>


