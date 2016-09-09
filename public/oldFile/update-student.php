<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-1
 * Time: 下午6:51
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTER</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.3.5-dist/js/npm.js"></script>


</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])){
require "nav.php";
require "auto_load.php";
$userId = $_SESSION["userId"];
    $db = MySqlDB::getNewMySqlDB();
    $student = $db->getStudent($userId);
?>
<!--<form style="text-align: center" action="login-server.php" method="post">-->
<!--    用户名：<input name="sno" type="text"><br>-->
<!--    密&nbsp;&nbsp;码：<input name="password" type="password"><br>-->
<!--    <input type="submit"><a href="register.php"><input type="button" value="注册" ></a>-->
<!--</form>-->
<form style="margin:100px auto;" action="update-student-server.php" method="post" class="form-horizontal" role="form">
    <input type="hidden" name="id" value="<?php echo $student->getId();?>">
    <div style="" class="form-group">
        <label for="name" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getName();?>" name="name" type="text" class="form-control" id="name" placeholder="姓名">
        </div>
    </div>
    <div style="" class="form-group">
        <label for="sex" class="col-sm-2 control-label">性别</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getSex();?>" name="sex" type="text" class="form-control" id="sex" placeholder="性别">
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getAge();?>"  name="age" type="text" class="form-control" id="age" placeholder="年龄">
        </div>
    </div>
    <div class="form-group">
        <label for="favorite" class="col-sm-2 control-label">爱好</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getFavorite();?>" name="favorite" type="text" class="form-control" id="favorite" placeholder="爱好">
        </div>
    </div>
    <div class="form-group">
        <label for="class" class="col-sm-2 control-label">班级</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getClass();?>" name="class" type="text" class="form-control" id="class" placeholder="班级">
        </div>
    </div>
    <div class="form-group">
        <label for="height" class="col-sm-2 control-label">身高</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getHeight();?>" name="height" type="text" class="form-control" id="height" placeholder="身高">
        </div>
    </div>
    <div class="form-group">
        <label for="weight" class="col-sm-2 control-label">体重</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getWeight();?>" name="weight" type="text" class="form-control" id="weight" placeholder="体重">
        </div>
    </div>
    <div class="form-group">
        <label for="tel" class="col-sm-2 control-label">联系方式</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getTel();?>" name="tel" type="text" class="form-control" id="tel" placeholder="联系方式">
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="col-sm-2 control-label">联系地址</label>
        <div class="col-sm-10 col-lg-3">
            <input value="<?php echo $student->getAddress();?>" name="address" type="text" class="form-control" id="address" placeholder="联系地址">
        </div>
    </div>
    <div class="form-group">
        <label for="resume" class="col-sm-2 control-label">个人简介</label>
        <div class="col-sm-10 col-lg-3">
<!--            <input value="--><?php //echo $student->getResume();?><!--" name="resume" type="text" class="form-control" id="resume" placeholder="个人简介">-->
            <textarea class="form-control input-group-lg" name="resume" id="resume" cols="30" rows="10"><?php echo $student->getResume();?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> 点击同意用户许可协议
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-info">确认修改</button>
            <a href="test.php"><button type="button" class="btn btn-info">返回首页</button></a>
        </div>
    </div>
</form>
<?php }else{ ?>
    <center><h1>你想干什么，小伙子，我在看着你呢</h1></center>
<?php } ?>
<script src="bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="bootstrap-3.3.5-dist/js/bootstrap.js"></script>
<!--<script src="bootstrap-3.3.5-dist/js/holder.min.js"></script>-->

</body>
</html>

