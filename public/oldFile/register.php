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
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.3.5-dist/js/npm.js"></script>

    <script type="text/javascript">
        function checkUsername() {
            var xhr = new XMLHttpRequest();
            var username = document.getElementById("username");
            var pusername = document.getElementById("pusername");
//            var de = dialog({
//                quickClose: true,
//                align: 'right'
//            });
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (username.value != ""){
                        if (xhr.responseText == false){
//                            de.content("用户名已存在").show(username);
                            pusername.className = "col-sm-10 col-lg-3 has-success";
                        }else {
//                        document.getElementById("pusername").class = "col-sm-10 col-lg-3 has-success";
                            document.getElementById("pusername").className = "col-sm-10 col-lg-3 has-error";
                        }
                    }else{
//                        de.content("用户名已存在").show(username);
                        document.getElementById("pusername").className = "col-sm-10 col-lg-3 has-error";
                    }
                }
            }
            xhr.open('get', "checkUsername.php?username="+username.value+"");
            xhr.send(null);
        }
    </script>

</head>
<body>
<?php require "nav.php";?>
<!--<form style="text-align: center" action="login-server.php" method="post">-->
<!--    用户名：<input name="sno" type="text"><br>-->
<!--    密&nbsp;&nbsp;码：<input name="password" type="password"><br>-->
<!--    <input type="submit"><a href="register.php"><input type="button" value="注册" ></a>-->
<!--</form>-->
<form style="margin:100px auto;" action="register-server.php" method="post" class="form-horizontal" role="form">
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
        <label for="age" class="col-sm-2 control-label">年龄</label>
        <div id="ppassword" class="col-sm-10 col-lg-3">
            <input name="age" type="number" class="form-control" id="age" placeholder="年龄">
        </div>
    </div>
<div class="form-group">
        <label for="password" class="col-sm-2 control-label">密码</label>
        <div id="ppassword" class="col-sm-10 col-lg-3">
            <input name="password" type="password" class="form-control" id="password" placeholder="密码">
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
<script src="bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="bootstrap-3.3.5-dist/js/bootstrap.js"></script>
<!--<script src="bootstrap-3.3.5-dist/js/holder.min.js"></script>-->

</body>
</html>
