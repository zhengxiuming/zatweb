<?php
require_once 'db_mysqli.php';

/**
 * 新增
 * @author aaron
 * @param object  $db           数据库连接
 * @param string  $table_name   表名
 * @param array   $params       array('列名'=》'value')
 * @param bool    $boo          默认false返回操作是否成功 true返回新增ID 
 * @return $boo=true 返回新增ID  $boo=false 返回新增是否成功
 */
function db_insert($db, $table_name, $params, $boo=FALSE)
{
    // 列名
    $fileds = array();
    // 值
    $values = array();
    foreach ($params as $key => $value) {
        $fileds[] = "`".$key."`";
        $values[] = "'".$value."'";
    }

    $str_fileds = implode(',', $fileds);
    $str_values = implode(',', $values);
    $sql = "insert into `".$table_name."` (".$str_fileds.") values(".$str_values.")";
    $result = $db->runSql($sql);
    
    if($boo){
        // 获取新增后的ID
        $result = $db->lastId();
    }

    return $result;
}


/**
 * 修改
 * @author aaron
 * @param object    $db             数据库连接
 * @param string    $table_name     表名
 * @param array     $params         array('列名'=》$value)
 * @param array     $conditions     array('列名'=》$value)
 * @return bool true 修改成功； false 修改失败
 */
function db_update($db, $table_name, $params, $conditions)
{    
    // 更改的值
    $arr_params = array();
    foreach ($params as $key => $value) {
        if(is_null($value)){
            $arr_params[] = "`".$key."` = NULL";
        }else{
            $arr_params[] = "`".$key."` = '".$value."'";
        }
    }
    // 更改条件
    $arr_conditions = array();
    foreach ($conditions as $key => $value) {
        $arr_conditions[] = "`".$key."` = '".$value."'";
    }
    
    $str_fileds = implode(',', $arr_params);
    $str_where = implode(' and ', $arr_conditions);

    $sql = "update `".$table_name."` set ".$str_fileds." where ".$str_where;
    $res = $db->runSql($sql);

    return $res;
}

/**
 * 删除
 * @author aaron
 * @param object    $db             数据库连接
 * @param string    $table_name     表名
 * @param array     $conditions     array('列名'=》$value)
 * @return bool 操作是否成功
 */
function db_delete($db, $table_name, $conditions)
{    
    // 更改条件
    $arr_conditions = array();
    foreach ($conditions as $key => $value) {
        $arr_conditions[] = "`".$key."` = '".$value."'";
    }
    $str_where = implode(' and ', $arr_conditions);
    
    $sql = "delete from `".$table_name."` where ".$str_where;
    $res = $db->runSql($sql);

    return $res;
}
