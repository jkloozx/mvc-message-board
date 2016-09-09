<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-29
 * Time: 下午8:31
 */
header("Content-type:text/html;charset=UTF-8");
if (isset($_POST["sno"])){
    $sno = trim($_POST["sno"]);
    $password = trim(sha1($_POST["password"]));
    require "auto_load.php";
    $db = MySqlDB::getNewMySqlDB();
    $student = $db->getStudentBySno($sno);
    if ($student->sno != null){
        $pass = $student->password;
        if ($password == $pass){
            session_start();
            $_SESSION['username'] = $student->name;
            $_SESSION['userId'] = $student->id;
            header("location:./test.php");
        }else{
            echo "密码错误";
        }
    }else{
        echo "用户名不存在";
    }

}