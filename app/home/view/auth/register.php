<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-29
 * Time: 下午8:27
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
    <link href="public/assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="public/assets/bootstrap-3.3.5-dist/js/npm.js"></script>

</head>
<body>
<?php require "./app/home/view/layout/nav.php";?>
<form style="margin:100px auto;" action="index.php?m=back&c=Admin&a=checkRegister" method="post" class="form-horizontal" role="form">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">用户名</label>
        <div id="pusername" class="col-sm-10 col-lg-3">
            <input onblur="checkUsername()" name="sno" type="number" class="form-control" id="username" placeholder="用户名">
            <!--                <span class="glyphicon glyphicon-circle-arrow-left form-control-feedback"></span>-->
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10 col-lg-3">
            <input name="name" type="text" class="form-control" id="name" placeholder="姓名">
        </div>
    </div>
<div class="form-group">
        <label for="" class="col-sm-2 control-label">性别</label>
        <div id="psex" class="col-sm-10 col-lg-3">
<!--            <input name="age" type="number" class="form-control" id="age" placeholder="年龄">-->
            男<input name="sex" type="radio" id="" value="男">
            女<input name="sex" type="radio" id="" value="女">
            保密<input name="sex" type="radio" id="" value="保密" checked>
        </div>
    </div>
<div class="form-group">
        <label for="password" class="col-sm-2 control-label">密码</label>
        <div id="ppassword" class="col-sm-10 col-lg-3">
            <input name="password" type="password" class="form-control" id="password" placeholder="密码">
        </div>
    </div>
    <div class="form-group">
        <label for="captcha" class="col-sm-2 control-label">验证码</label>
        <div id="" class="col-sm-10 col-lg-3">
            <input name="captcha" type="text" class="form-control" id="captcha" placeholder="验证码">
        </div>
    </div>
    <div class="form-group">
        <label for="captcha" class="col-sm-2 control-label"></label>
        <div id="" class="col-sm-10 col-lg-3">
            <img width="145" height="20" border="1" title="看不清？点击更换另一个验证码。" style="cursor: pointer;" alt="CAPTCHA" src="index.php?m=back&c=Admin&a=captcha" onclick="this.src='index.php?m=back&c=Admin&a=captcha&'+Math.random()">
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
            <button type="submit" class="btn btn-info">注册新用户</button>
            <a href="index.php"><button type="button" class="btn btn-info">登陆</button></a>
        </div>
    </div>
</form>
<script src="public/assets/bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="public/assets/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
<!--<script src="bootstrap-3.3.5-dist/js/holder.min.js"></script>-->

</body>
</html>
