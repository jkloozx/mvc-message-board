<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-1
 * Time: 上午9:12
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的留言</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-3.3.5-dist/js/npm.js"></script>
    <script src="bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#nav>li").click(function () {
                this.addClass('active').siblings().removeClass('active');
            });
//            alert("hello");
            $("#edit>button").click(function () {
                $("#message").val(this.value);
                $("#messageId").val(this.name);
            })
            $("#delete>button").click(function () {
                $("#deleteId").val(this.value);
//                $("#input").val(this.value);
            })
        })
    </script>
</head>
<body>
<?php session_start(); if(isset($_SESSION['username'])){ ?>
    <?php require "nav.php";?>
    <h2 style="text-align: center">Welcome Back <?php echo $_SESSION["username"];?></h2>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>序号</th>
            <th>留言内容</th>
            <th>发表时间</th>
            <th>编辑</th>
            <th>删除</th>
        </tr>
        <?php
        require "./auto_load.php";
        $db = MySqlDB::getNewMySqlDB();
        $userId = $_SESSION["userId"];
        $per = 3;
        $totalPage = ceil($db->getTotalRowsByUserId($userId)/$per);
//        $totalPage = 2;
//        var_dump($db->getUserTotalRows());
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
        $messages = $db->getSomeMessageByUserId($page,$per,$userId);
        foreach ($messages as $message){
            $messageId = $message->getId();
            $messageContent = $message->getContent();
            echo "<tr>";
            echo "<td>".$num++."</td>";
            echo "<td>".$message->getContent()."</td>";
            echo "<td>".$message->getCreateTime()."</td>";
            echo <<<eop
            <td id="edit">
<button name=$messageId value=$messageContent class="btn btn-info" data-toggle="modal" data-target="#myModal">
  编辑
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" >

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">编辑您的留言</h4>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-lg">
                        <span class="input-group-addon">@</span>
                        <form action="update-message.php" method="post"/>
                        <input id="messageId" name="messageId" type="hidden">
                            <textarea id="message" name="message" class="form-control input-group-lg" name="" id="" cols="50" rows="10"></textarea>
                        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">提交</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</td>
eop;

            echo <<<eop
            <td id="delete">
<button value=$messageId id="delete" class="btn btn-danger" data-toggle="modal" data-target="#myModal2">
  删除
</button>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">删除留言</h4>
      </div>
      <div class="modal-body">
      <form action="delete.php" method="post">
        确认删除您的留言，删除后将不可恢复，确认继续？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
       
        <input id="deleteId" type="hidden" name="deleteId">
        <button type="submit" class="btn btn-danger">删除</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</td>
eop;
            echo "</tr>";
        }
        ?>
        <tr><td colspan="5" style="text-align: center">
                总页数：<?php echo $totalPage?>
                <a href="showMyMessage.php?page=1">首页</a>
                <a href="showMyMessage.php?page=<?php echo $page-1;?>">上一页</a>
                <a href="showMyMessage.php?page=<?php echo $page+1;?>">下一页</a>
                <a href="showMyMessage.php?page=<?php echo $totalPage;?>">尾页</a>
            </td>
        </tr>
    </table>
    <h1 style="text-align: center"><a href="test.php">返回首页</a><a href="logout.php">注销</a></h1>
<?php }else{ ?>
    <h1 style="text-align: center"><a href="index.php">请先登陆</a></h1>
<?php } ?>
<script src="bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="bootstrap-3.3.5-dist/js/bootstrap.js"></script>
<script src="bootstrap-3.3.5-dist/js/holder.min.js"></script>
</body>
</html>

