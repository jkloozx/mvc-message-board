<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-30
 * Time: 下午4:47
 */
function myAutoload($className){
    $class_list = array(
        "Student" => "./Student.php",
        "MySqlDB" => "./MySqlDB.php",
        "Message" => "./Message.php"
    );
    require $class_list[$className];
}
spl_autoload_register("myAutoload");