<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-31
 * Time: 下午5:45
 */
?>
<!--<script src="bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>-->
<div class="navbar-wrapper">
    <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?m=back&c=MessageBoard&a=index">留言板</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul id="nav" class="nav navbar-nav">
                        <li class="active"><a href="test.php">首页</a></li>
                            <li><a href="index.php?m=back&c=MessageBoard&a=showMyMessages">查看我的留言</a></li>
                            <?php if($_SESSION['admin']["id"] == 4 ||$_SESSION['admin']["id"] == 5 ||$_SESSION['admin']["id"] == 6){ ?>
                                <li><a href="index.php?m=back&c=Admin&a=showStudents">管理用户</a></li>
                            <?php } ?>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">个人中心 <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">发表留言</a></li>
                                <li><a href="index.php?m=back&c=MessageBoard&a=showMyMessage">查看留言</a></li>
                                <li class="divider"></li>
                                <li><a href="index.php?m=back&c=Admin&a=showUpdate">修改个人信息</a></li>
                                <li><a href="index.php?m=back&c=Admin&a=logout">注销</a></li>
                                <li><a href="index.php?m=back&c=Admin&a=login">切换用户</a></li>
                                <li><a href="#">赞助我们</a></li>
                            </ul>
                        </li>
                            <li><a href="">欢迎回来<?php echo $_SESSION["admin"]["name"];?></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
