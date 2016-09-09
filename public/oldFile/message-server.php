<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-31
 * Time: 下午6:39
 */
header("content-type:text/html;charset=utf-8");
session_start();
var_dump($_SESSION);
if(isset($_POST["content"]) && isset($_SESSION["userId"])){
require "auto_load.php";
$content = $_POST["content"];
$userId = $_SESSION["userId"];
$create_time = date("Y-m-d H:i:s");
    $message = new Message(null,$userId,$content,$create_time);
    if ($message->insert()){
        echo "应该成功了吧";
    }else{
        echo "出错了";
    }

}else{
echo "找错地方了啊喂";
}