<?php
/**
 * Created by PhpStorm.
 * User: JustThinkIt
 * Date: 2018/5/7
 * Time: 8:45
 */



/**
 * mysqli function manage
 */

/*
 * @return mixed data
 */
function mConn() {
    static $conn = null;
    //check connection
    // if (!$conn) {
    //     die("connection failed:" . mysqli_connect_error());
    // }
    if($conn === null){
        $cfg = require(ROOT .'/lib/config.php');
        $conn = mysqli_connect($cfg['host'], $cfg['user'], $cfg['pwd'], $cfg['db']);
        mysqli_query($conn,'set names '. $cfg['charset']);
    }
    return $conn;
}

/*
 * 待查询的sql语句
 * @return mixed or bool
 */
function mQuery($sql) {
    $query = mysqli_query(mConn(),$sql);
    if ($query){
        mLog($sql);
    }else {
        mLog($sql. "\n" . mysqli_error(mConn()));
    }
    return $query;
}

/*
 * log 日志记录功能
 * @param str $str 待记录的字符串
 */
function mLog($str) {
    $filename = ROOT .'/log/' .date('Ymd') .'.txt';
    $log = "-----------------------------------------\n".date('Y/m/d H:i:s') . "\n" . $str . "\n" . "-----------------------------------------\n\n";
    return file_put_contents($filename, $log , FILE_APPEND);
}
/*
 * select 查询多行数据并返回结果
 * @param str $sql 待查询的sql语句
 * @return mixed  查询成功，返回二维数组；查询失败，返回false
 */

function mGetAll($sql){
    $result = mQuery($sql);
    if(!$result){
        return false;
    }
    $data = array();
    while ($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}

//$sql = 'select * from cat';
//print_r(mGetAll($sql));

/*
 *取出单行数据
 * @param str $sql 待查询的sql语句
 * @return  array or false 查询成功，返回一维数组；查询失败，返回false
 */
function mGetRow($sql){
    $result = mQuery($sql);
    if (!$result) {
        return false;
    }
    return mysqli_fetch_assoc($result);
}

//$sql = "select * from cat where cat_id = 1";
//print_r(mGetRow($sql));

/*
 * 返回查询语句的第一个结果
 * @param str $sql
 * @return mixed or false
 */
function mGetOne($sql){
    $result = mQuery($sql);
    if (!$result) {
        return false;
    }
    return mysqli_fetch_row($result)[0];
}

//$sql ="select count(*) from art where cat_id =1";
//echo mGetOne($sql);

/*
 * 自动拼接insert and update sql语句,并且调用mQuery() 执行
 * @param str $table 表名
 * @param str $data 接收到的数据，一维数组
 * @param str $act 数据操作动作，默认为insert
 * @param str $where 防止update 变更数据时缺少where条件
 * @return bool
 */
function mExe($table, $data, $act='insert', $where='0'){
    if($act == 'insert'){
        $sql = "insert into $table(";
        $sql = $sql . implode(',', array_keys($data)) .") values('";
        $sql .= implode("','",array_values($data)) ."')";
        return mQuery($sql);
    }else if ($act == 'update'){
        $sql = "update $table set ";
        foreach($data as $k=>$v) {
            $sql .= $k ."='" .$v ."',";
        }
        $sql =rtrim($sql, ',') ." where ".$where;
        return mQuery($sql);
    }
}

//$data = array('title'=>'今天的空气' , 'content'=>'空气质量优' , 'pubtime'=>12345678,'author'=>'baibai');
//insert into art (title,content,pubtime,author) values ('今天的空气','空气质量优','12345678','baibai');
//update art set title='今天的空气',conte='空气质量优',pubtime='12345678',author='baibai' where art_id=1;
//echo mExe('art' , $data );
//echo mExe('art' , $data ,'update','art_id=1');
//insert into cat (id,catname) values (5 , 'test');
//$data = array('catname'=>'games');
//echo mExe('cat',$data);

/*
 * 获取上次insert操作产生的主键id
 * @return number
 */
function getLastId(){
    return mysqli_insert_id(mConn());
}


?>