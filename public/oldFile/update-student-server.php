<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-1
 * Time: 下午7:08
 */
if(isset($_POST["name"])){
    require "auto_load.php";
    $id = $_POST["id"];
    $name = $_POST["name"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $favorite = $_POST["favorite"];
    $class = $_POST["class"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $tel = $_POST["tel"];
    $resume = $_POST["resume"];
    $address = $_POST["address"];
    $db = MySqlDB::getNewMySqlDB();
    $student = $db->getStudent($id);
    $student->setName($name);
    $student->setSex($sex);
    $student->setAge($age);
    $student->setAge($age);
    $student->setFavorite($favorite);
    $student->setClass($class);
    $student->setHeight($height);
    $student->setWeight($weight);
    $student->setTel($tel);
    $student->setAddress($address);
    $student->setResume($resume);
//    var_dump($student);
    if ($student->update()){
    }else{
    }
}else{
echo "找错地方了啊喂";
}