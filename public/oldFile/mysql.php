<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-29
 * Time: 上午10:47
 */
//$link = mysql_connect("localhost","root","root");
//mysql_select_db("test");
//mysql_query("set names utf8");
//if ($link){
////    echo "数据库连接成功！";
//    $sql = <<<eop
//create table student(
//sno int not null auto_increment primary key,
//name varchar(10) not null,
//sex bit,
//create_time date
//)charset="utf8";
//eop;
//    if (mysql_query($sql)){
//        echo "数据表创建成功！";
//    }else{
//        echo "数据表创建失败！";
//    }
//}else{
//    echo "数据库链接失败！";
//}
//$stu1 = getStudent("1");
//$stu1 = $db->getStudent("1");
//$stu2 = new Student("英雄联盟","20","222888555");
//$db->insert($stu2);
//$stu2->insert();
//var_dump($db->getSomeStudent(1,2));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.3.5-dist/js/npm.js"></script>
</head>
<body>
<?php session_start(); if($_SESSION['userId'] == 4 ||$_SESSION['userId'] == 5 ||$_SESSION['userId'] == 6){ ?>
<?php require "nav.php";?>
<h2 style="text-align: center">Welcome Back <?php echo $_SESSION["username"];?></h2>
<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>编号</th>
        <th>学号</th>
        <th>姓名</th>
        <th>性别</th>
        <th>创建日期</th>
        <th>年龄</th>
        <th>爱好</th>
        <th>班级</th>
        <th>身高</th>
        <th>体重</th>
        <th>电话</th>
        <th>地址</th>
        <th>个人简介</th>
        <th>密码（已加密）</th>
    </tr>

    <?php
    require "./auto_load.php";
    $db = MySqlDB::getNewMySqlDB();
    $per = 3;
    $totalPage = ceil($db->getStudentTotalRows()/$per);

    if (isset($_GET["page"])){
        $page = $_GET["page"];
        if ($page <= 0){
            $page = 1;
        }
        if ($page > $totalPage){
            $page = $totalPage;
        }
    }else{
        $page = 1;
    }
    $num = ($page-1)*$per+1;
    $thisPage = $db->getSomeStudent($page,$per);
    foreach ($thisPage as $student){
        echo "<tr>";
        echo "<td>".$num++."</td>";
        echo "<td>".$student->sno."</td>";
        echo "<td>".$student->name."</td>";
        echo "<td>".$student->sex."</td>";
        echo "<td>".mb_substr($student->create_time,0,10,"utf-8")."</td>";
        echo "<td>".$student->age."</td>";
        echo "<td>".$student->favorite."</td>";
        echo "<td>".$student->class."</td>";
        echo "<td>".$student->height."</td>";
        echo "<td>".$student->weight."</td>";
        echo "<td>".$student->tel."</td>";
        echo "<td>".mb_substr($student->address,0,10,"utf-8")."</td>";
        echo "<td>".mb_substr($student->resume,0,10,"utf-8")."</td>";
        echo "<td>".substr($student->password,0,10)."</td>";
        echo "</tr>";
    }
    ?>
    <tr><td colspan="14" style="text-align: center">
            总页数：<?php echo $totalPage?>
            <a href="mysql.php?page=1">首页</a>
            <a href="mysql.php?page=<?php echo $page-1;?>">上一页</a>
            <a href="mysql.php?page=<?php echo $page+1;?>">下一页</a>
            <a href="mysql.php?page=<?php echo $totalPage;?>">尾页</a>
        </td>
    </tr>
</table>
<h1 style="text-align: center"><a href="register.php">添加用户</a><a href="logout.php">注销</a></h1>
<?php }else{ ?>
    <h1 style="text-align: center;text-decoration: none;"><a href="test.php">这不是你该来的地方呦～</a></h1>
<?php } ?>
<script src="bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="bootstrap-3.3.5-dist/js/bootstrap.js"></script>
<script src="bootstrap-3.3.5-dist/js/holder.min.js"></script>
</body>
</html>
