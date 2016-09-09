<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-1
 * Time: 下午3:48
 */
header("content-type:text/html;charset=utf-8");
if (isset($_POST["deleteId"])){
    require "auto_load.php";
    $db = MySqlDB::getNewMySqlDB();
    $deleteId = $_POST["deleteId"];
    if ($db->deleteMessage($deleteId)){

    }else{
        echo "出错了";
    }

}else{
    echo "迷路了吧小子";
}