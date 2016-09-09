<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
<!--        <meta charset="UTF-8">-->
<!--        <meta name="viewport"-->
<!--              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--        <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
        <title>我的留言</title>
        <link href="public/assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="public/assetsbootstrap-3.3.5-dist/js/npm.js"></script>
        <script src="public/assets/bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
        //制作函数(ajax去获得分页信息)
        function showpage(url){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if(xhr.readyState==4){
                    document.getElementById('result').innerHTML = xhr.responseText;
                }
            }
            xhr.open('get',url);
            xhr.send(null);
        }
        window.onload = function(){
            showpage('index.php?m=back&c=MessageBoard&a=getMyMessages');
        }
        </script>
    </head>
    <body>
    <?php require "./app/back/view/layout/nav.php";?>
        <h2 align="center">用户管理系统</h2>
        <div id="result"></div>
    <script type="text/javascript">
        $(function () {
            $("#nav>li").click(function () {
                this.addClass('active').siblings().removeClass('active');
            });
//            alert("hello");
            $("#edit>button").click(function () {
                $("#message").val(this.value);
                $("#messageId").val(this.name);
            });
            $(".delete>button").click(function () {
//                $("#deleteId").val(this.value);
//                $("#input").val(this.value);
                alert("hello");
            });
            $("#result").click(function () {
//                alert(this.innerHTML);
            });
        })
    </script>
    <script src="public/assets/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
    </body>
</html>