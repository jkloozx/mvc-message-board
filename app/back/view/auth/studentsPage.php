<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-10
 * Time: 上午9:07
 */
echo <<< EOP
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
        <th>编辑</th>
        <th>删除</th>
    </tr>
EOP;
$num = $start + 1;
foreach ($students as $student) {
    $userId = $student["id"];
    echo "<tr>";
    echo "<td>".$num++."</td>";
    echo "<td>".$student["id"]."</td>";
    echo "<td>".$student["name"]."</td>";
    echo "<td>".$student["sex"]."</td>";
    echo "<td>".mb_substr($student["create_time"],0,10,"utf-8")."</td>";
    echo "<td>".$student["age"]."</td>";
    echo "<td>".$student["favorite"]."</td>";
    echo "<td>".$student["class"]."</td>";
    echo "<td>".$student["height"]."</td>";
    echo "<td>".$student["weight"]."</td>";
    echo "<td>".$student["tel"]."</td>";
    echo "<td>".mb_substr($student["address"],0,10,"utf-8")."</td>";
    echo "<td>".mb_substr($student["resume"],0,10,"utf-8")."</td>";
    echo "<td>".substr($student["password"],0,10)."</td>";
    echo <<< EOP
            <td id="edit">
            <form action="index.php?m=back&c=Admin&a=showUpdate" method="post"/>
            <input type=hidden name="userId" value="$userId"/>
            <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#edit_$num">
            编辑
            </button>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="" tabindex="-1" >
            <form action="index.php?m=back&c=MessageBoard&a=update" method="post"/>
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">编辑您的留言</h4>
            </div>
            <div class="modal-body">
            <div class="input-group input-group-lg">
            <span class="input-group-addon">@</span>
            <input type="hidden" name="id" value="$userId">
            <textarea id="message" name="content" class="form-control input-group-lg" name="" id="" cols="50" rows="10">$messageContent</textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary">提交</button>
            </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            </form>
            </td>
EOP;
    echo <<< EOP
            <td class="delete">
            <form action="index.php?m=back&c=MessageBoard&a=delete" method="post">
            <input value="$userId" type="hidden" name="id">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_$num">
            删除
            </button>
            <!-- Modal -->
            <div class="modal fade" id="delete_$num" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">删除留言</h4>
            </div>
            <div class="modal-body">
            确认删除用户，删除后将不可恢复，确认继续？
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <input id="deleteId" type="hidden" name="deleteId">
            <button type="submit" class="btn btn-danger">删除</button>
            
            </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            </form>
            </td>
EOP;
    echo "</tr>";

}
echo "<tr style='text-align: center'><ul class='pagination'><td colspan='16'>$pagelist</td></ul></tr>";
echo "</table>";