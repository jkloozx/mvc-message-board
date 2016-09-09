<?php

/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-29
 * Time: 上午10:59
 */
class MySqlDB{
    public $host;
    public $port;
    public $username;
    public $password;
    public $database;
    public $charset;
    public $link;
    private static $MySqlDB;
//    public function MySqlDB(){
//        $this->link = new mysqli('localhost', 'root', 'root', 'test');
//        if ($this->link){
//        }else{
//            echo "连接失败";
//        }
//        mysqli_query($this->link,"set names utf8");
//}
    private function __construct($config = array()){
        header("Content-type:text/html;charset=UTF-8");
        $this->host = isset($config["host"])?$config["host"]:"localhost";
        $this->port = isset($config["port"])?$config["port"]:"3306";
        $this->username = isset($config["username"])?$config["username"]:"root";
        $this->password = isset($config["password"])?$config["password"]:"root";
        $this->database = isset($config["database"])?$config["database"]:"test";
        $this->charset = isset($config["charset"])?$config["charset"]:"UTF8";
        $this->connectServer();
        $this->setCharset();
    }
    private function __clone(){

    }
    public function connectServer(){
        $mysql_connect = mysqli_connect($this->host,$this->username,$this->password,$this->database,$this->port);
        if ($mysql_connect != null){
            $this->link = $mysql_connect;
        }else{
            echo "数据库链接失败，请检查您的配置信息";
            die;
        }
    }

    public static function getNewMySqlDB(){
        if (!isset(static::$MySqlDB)) {
            static::$MySqlDB = new MySqlDB();
            return static::$MySqlDB;
        }
        return static::$MySqlDB;
    }


        public function setCharset(){
        $sql = " set names ".$this->charset;
        $this->query($sql);
    }

    public function query($sql){
        $result = mysqli_query($this->link,$sql);
        if ($result){
            return $result;
        }else{
            echo "SQL执行失败<br>";
            echo "错误的SQL语句：".$sql."<br>";
            echo "错误信息：".mysqli_error($this->link)."<br>";
            die;
        }
    }

    public function getStudent($id){
        $id = addslashes(sprintf("%s",$id));
        $id = substr($id,0,40); //最大长度为40
        $sql = "select * from student where id = '$id'";
        $result = mysqli_query($this->link,$sql);
        $row = mysqli_fetch_assoc($result);
        $student = new Student();
        $student->setId($row["id"]);
        $student->setName($row["name"]);
        $student->setSex($row["sex"]);
        $student->setCreateTime($row["create_time"]);
        $student->setAge($row["age"]);
        $student->setFavorite($row["favorite"]);
        $student->setClass($row["class"]);
        $student->setHeight($row["height"]);
        $student->setWeight($row["weight"]);
        $student->setTel($row["tel"]);
        $student->setAddress($row["address"]);
        $student->setResume($row["resume"]);
        $student->setSno($row["sno"]);
        $student->setPassword($row["password"]);
        return $student;
    }
public function getStudentBySno($sno){
        $sno = addslashes(sprintf("%s",$sno));
        $sno = substr($sno,0,40); //最大长度为40
        $sql = "select * from student where sno = '$sno'";
        $result = mysqli_query($this->link,$sql);
        $row = mysqli_fetch_assoc($result);
        $student = new Student();
        $student->setId($row["id"]);
        $student->setName($row["name"]);
        $student->setSex($row["sex"]);
        $student->setCreateTime($row["create_time"]);
        $student->setAge($row["age"]);
        $student->setFavorite($row["favorite"]);
        $student->setClass($row["class"]);
        $student->setHeight($row["height"]);
        $student->setWeight($row["weight"]);
        $student->setTel($row["tel"]);
        $student->setAddress($row["address"]);
        $student->setResume($row["resume"]);
        $student->setSno($row["sno"]);
        $student->setPassword($row["password"]);
        return $student;
    }

    public function getSomeStudent($offset,$per){
        $off = ($offset-1)*$per;
        $sql = "select * from student order by id desc limit $off,$per";
        $result = $this->query($sql);
        $arrStu = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $student = new Student();
            $student->setId($row["id"]);
            $student->setName($row["name"]);
            $student->setSex($row["sex"]);
            $student->setCreateTime($row["create_time"]);
            $student->setAge($row["age"]);
            $student->setFavorite($row["favorite"]);
            $student->setClass($row["class"]);
            $student->setHeight($row["height"]);
            $student->setWeight($row["weight"]);
            $student->setTel($row["tel"]);
            $student->setAddress($row["address"]);
            $student->setResume($row["resume"]);
            $student->setSno($row["sno"]);
            $student->setPassword($row["password"]);
            $arrStu[$i] = $student;
            $i++;
        }
        return $arrStu;
    }

    public function getStudentTotalRows(){
        $sql = "select count(*) from student";
        $result = mysqli_query($this->link,$sql);
        $arr = mysqli_fetch_array($result);
        $totalRows = $arr[0];
        return $totalRows;
    }

    public function insertStudent($student){
//        $sno = $student->sno;
//        $sno = addslashes(sprintf("%s",$sno));
//        $sno = substr($sno,0,15); //最大长度为40
//        $sql = "select sno from student where sno = '$sno'";
//        $result = mysqli_query($this->link,$sql);
//            (id,name,sex,create_time,age,favorite,class,height,weight,tel,address,resume,sno,password)
            $prepareSql = "INSERT INTO student (name,sex,create_time,age,favorite,class,height,weight,tel,address,resume,sno,password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $this->link->prepare($prepareSql)) {
                $sno = $student->sno;
                $name = $student->name;
                $sex = $student->sex;
                $create_time = date("y-m-d h:i:s");
                $age = $student->age;
                $favorite = $student->favorite;
                $class = $student->class;
                $height = $student->height;
                $weight = $student->weight;
                $tel = $student->tel;
                $address = $student->address;
                $resume = $student->resume;
                $password = $student->password;
                $stmt->bind_param("sbsisssssssss", $name, $sex, $create_time, $age, $favorite, $class, $height, $weight, $tel, $address, $resume, $sno, $password);
                $flag = $stmt->execute();
                if ($flag) {
                    header("location:./index.php");
                } else {
                    echo "用户名已存在";
                }
            } else {
                echo "error";
            }

    }
    public function updateStudent($student)
    {
        $id = $student->getId();
            $prepareSql = "update student set name = ?,sex = ?,age = ?,favorite = ?,class = ?,height = ?,weight = ?,tel = ?,address = ?,resume = ? where id='$id'";
            if ($stmt = $this->link->prepare($prepareSql)) {
                $name = $student->name;
                $sex = $student->sex;
                $age = $student->age;
                $favorite = $student->favorite;
                $class = $student->class;
                $height = $student->height;
                $weight = $student->weight;
                $tel = $student->tel;
                $address = $student->address;
                $resume = $student->resume;
                $stmt->bind_param("ssssssssss", $name, $sex, $age, $favorite, $class, $height, $weight, $tel, $address, $resume);
                $flag = $stmt->execute();
                if ($flag) {
//                    echo "update student set name = '$name',sex = '$sex',age = '$age',favorite = '$favorite',class = '$class',height = '$height',weight = '$weight',tel = '$tel',address = '$address',resume = '$resume' where id='$id'";
//                    var_dump($this->link);

//                    var_dump($student);
                    header("location:./test.php");
                } else {
                    echo "更新失败";
                }
            } else {
                echo "error";
            }

    }

    public function getMessage($id){
        $id = addslashes(sprintf("%s",$id));
        $id = substr($id,0,40); //最大长度为40
        $sql = "select * from message where id = '$id'";
        $result = $this->query($sql);
        $row = mysqli_fetch_assoc($result);
        $message = new Message();
        $message->setId($row["id"]);
        $message->setUserId($row["userId"]);
        $message->setContent($row["content"]);
        $message->setCreateTime($row["create_time"]);
        return $message;
    }

    public function getSomeMessage($offset,$per){
        $off = ($offset-1)*$per;
        $sql = "select * from message order by id desc limit $off,$per";
        $result = $this->query($sql);
        $arrMes = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $message = new Message();
            $message->setId($row["id"]);
            $message->setUserId($row["id"]);
            $message->setContent($row["content"]);
            $message->setCreateTime($row["create_time"]);
            $arrMes[$i] = $message;
            $i++;
        }
        return $arrMes;
    }
    public function getSomeMessageByUserId($offset,$per,$userId){
        $off = ($offset-1)*$per;
        $sql = "select * from message where userId='$userId' order by id desc limit $off,$per";
        $result = $this->query($sql);
        $arrMes = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $message = new Message();
            $message->setId($row["id"]);
            $message->setUserId($row["userId"]);
            $message->setContent($row["content"]);
            $message->setCreateTime($row["create_time"]);
            $arrMes[$i] = $message;
            $i++;
        }
        return $arrMes;
    }

    public function getAllMessage(){
        $sql = "select * from message order by id desc";
        $result = $this->query($sql);
        $arrMes = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $message = new Message();
            $message->setId($row["id"]);
            $message->setUserId($row["userId"]);
            $message->setContent($row["content"]);
            $message->setCreateTime($row["create_time"]);
            $arrMes[$i] = $message;
            $i++;
        }
        return $arrMes;
    }

    public function getMessageTotalRows(){
        $sql = "select count(*) from message";
        $result = $this->query($sql);
        $arr = mysqli_fetch_array($result);
        $totalRows = $arr[0];
        return $totalRows;
    }
    public function getTotalRowsByUserId($userId){
        $sql = "select count(*) from message where userId = '$userId'";
//        echo $sql;
        $result = $this->query($sql);
        $arr = mysqli_fetch_array($result);
        $totalRows = $arr[0];
        return $totalRows;
    }

    public function alterMessage($message,$type)
    {
        if ($type == 1){
            $prepareSql = "INSERT INTO message (id,userId,content,create_time) VALUES(?,?, ?, ?)";
            $id = null;
        }
        if ($type == 2){
            $id = $message->getId();
            $id = addslashes(sprintf("%s",$sno));
            $id = substr($id,0,15); //最大长度为15
            $prepareSql = "update message set content = ? where id='$id'";
        }
        if ($stmt = $this->link->prepare($prepareSql)) {
            if ($type == 1){
                $userId = $message->getUserId();
                $content = $message->getContent();
                $create_time = $message->getCreateTime();
                $stmt->bind_param("ssss",$id, $userId, $content, $create_time);
            }
            if ($type == 2){
                $content = $message->getContent();
                $stmt->bind_param("s",$content);
            }
            $flag = $stmt->execute();
            if ($flag) {
                header("location:./test.php");
            } else {
                echo $userId."内容".$content."时间".$create_time."id".$id;
                echo "发布留言失败";
            }
        } else {
            echo "写入语句失败";
        }

    }

    public function updateMessage($message){
            $id = $message->getId();
            $prepareSql = "update message set content = ? where id='$id'";
        if ($stmt = $this->link->prepare($prepareSql)) {
                $content = $message->getContent();
                $stmt->bind_param("s",$content);
            $flag = $stmt->execute();
            if ($flag) {
                header("location:./showMyMessage.php");
            } else {
                echo "发布留言失败";
            }
        } else {
            echo "写入语句失败";
        }

    }
    public function deleteMessage($id){
        $id = addslashes(sprintf("%s",$id));
        $id = substr($id,0,15); //最大长度为15
            $sql = "delete from message where id='$id'";
            $result = $this->query($sql);
            if ($result) {
                header("location:./showMyMessage.php");
            } else {
                echo $userId."内容".$content."时间".$create_time."id".$id;
                echo "发布留言失败";
            }
        }





}
function getStudent($sno){
    $link = new mysqli('localhost', 'root', 'root', 'test');
    if ($link){
    }else{
        echo "连接失败";
    }
    mysqli_query($link,"set names utf8");
    $sno = addslashes(sprintf("%s",$sno));
    $sno = substr($sno,0,40); //最大长度为40
    $sql = "select * from student where sno = '$sno'";
    echo $sql;
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $student = new Student();
    $student->setName($row["name"]);
    $student->setSex($row["sex"]);
    $student->setCreateTime($row["create_time"]);
    $student->setAge($row["age"]);
    $student->setFavorite($row["favorite"]);
    $student->setClass($row["class"]);
    $student->setHeight($row["height"]);
    $student->setWeight($row["weight"]);
    $student->setTel($row["tel"]);
    $student->setAddress($row["address"]);
    $student->setResume($row["resume"]);
    $student->setSno($row["sno"]);
    return $student;
}