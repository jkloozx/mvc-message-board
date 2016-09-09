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
    <title>LOGIN</title>
    <link href="public/assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="public/assets/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/ui-dialog.css">
    <script src="public/assets/dist/dialog-min.js"></script>
</head>
<body>
<?php require "./app/home/view/layout/nav.php";?>
<form style="margin:100px auto;" action="index.php?m=back&c=Admin&a=check" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名</label>
            <div id="pusername" class="col-sm-10 col-lg-3">
                <input onblur="checkUsername()" name="username" type="number" class="form-control" id="username" placeholder="用户名">
<!--                <span class="glyphicon glyphicon-circle-arrow-left form-control-feedback"></span>-->
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
                        <input name="remember" type="checkbox"> 记住我
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">登陆</button>
                <a href="register.php"><button type="button" class="btn btn-info">注册</button></a>
            </div>
        </div>
</form>
<script src="public/assets/bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="public/assets/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
</body>
</html>
