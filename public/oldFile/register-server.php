<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-29
 * Time: 下午9:10
 */
if (isset($_POST["sno"])){
    require "auto_load.php";
    $sno = $_POST["sno"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $password = sha1($_POST["password"]);
    $db = MySqlDB::getNewMySqlDB();
    $student = new Student($name,$age,$sno,$password);
//    var_dump($student);
    if ($student->insert()){
    }else{
    }

}