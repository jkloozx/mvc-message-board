<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-1
 * Time: 下午3:56
 */
header("content-type:text/html;charset=utf-8");
if (isset($_POST["message"]) && isset($_POST["messageId"])){
    require "auto_load.php";
    $db = MySqlDB::getNewMySqlDB();
    $content = $_POST["message"];
    $messageId = $_POST["messageId"];
    $create_time = date("Y-m-d H:i:s");
    $message = $db->getMessage($messageId);
    $message->setContent($content);
//    var_dump($message);
    if ($message->update()){

    }else{
        echo "出错了";
    }

}else{
    echo "迷路了吧小子";
}