<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-30
 * Time: 上午10:12
 */
if (isset($_GET["username"])) {
        require "./Student.php";
        require "./MySqlDB.php";
        $db = MySqlDB::getNewMySqlDB();
        $sno = $_GET["username"];
        $student = $db->getStudentBySno($sno);
        if ($student->sno){
            echo true;
        }else{
            echo false;
        }

} else {
    echo "找错地方了啊喂";
}