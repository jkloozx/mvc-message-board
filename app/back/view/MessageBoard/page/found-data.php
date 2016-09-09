<?php
header("content-type:text/html;charset=utf-8");
//制作传统分页效果,连接数据库、获得数据、分页显示
$link = mysql_connect('localhost', 'root', 'root');
mysql_select_db('mydb', $link);
mysql_query('set names utf8');

//实现数据分页
//① 引入分页类
include("./page.class.php");

//② 获得总记录条数
$username = $_COOKIE["username"];
$sql = "select * from found where username='$username'";
$qry = mysql_query($sql);
$total = mysql_num_rows($qry);
$per = 6;

//③ 实例化分页类对象
$page_obj = new Page($total, $per);

//④ 制作sql语句，获得每页信息
//$page_obj->limit: 分页类会根据当前的页码把"limit 偏移量,长度" 给制作好
$sql3 = "select id,title,wupin,thanks,address,email,tel,content,create_time  from found where username='$username' order by id desc " . $page_obj->limit;
$qry3 = mysql_query($sql3);

//⑤ 获得页码列表
$pagelist = $page_obj->fpage(array(3, 4, 5, 6, 7, 8));

echo <<<eof
<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>序号</th>
        <th>标题</th>
        <th>物品</th>
        <th>酬谢方式</th>
        <th>联系地址</th>
        <th>电子邮箱</th>
        <th>电话</th>
        <th>留言内容</th>
        <th>创建时间</th>
        <th>显示全部</th>
        <th>修改与删除</th>
    </tr>
eof;
$p = isset($_GET['page']) ? $_GET['page'] : 1;
$num = ($p - 1) * $per;
while ($rst3 = mysql_fetch_assoc($qry3)) {
    $id2 = $rst3['id'];
    echo "<tr>";
    echo "<td>" . ++$num . "</td>";
    echo "<td>" . $rst3['title'] . "</td>";
    echo "<td>" . $rst3['wupin'] . "</td>";
    echo "<td>" . $rst3['thanks'] . "</td>";
    echo "<td>" . mb_substr($rst3['address'],0,12,"utf-8") . "</td>";
    echo "<td>" . $rst3['email'] . "</td>";
    echo "<td>" . $rst3['tel'] . "</td>";
    echo "<td>" . mb_substr($rst3['content'],0,12,"utf-8") . "</td>";
    echo "<td>" . mb_substr($rst3['create_time'],0,11,"utf-8") . "</td>";
//mb_substr(,0,12,"utf-8");
    echo "";
    echo <<<eof
    <td>
    <a href="found-detail.php?detail=$id2">
    <button type='button' class='btn btn-success btn-sm' '>
    查看更多
    </button>
    </a>
    </td>
    <td>
    <a href='found-update.php?updater=$id2&table=found'>
    <button type='button' class='btn btn-info btn-sm' '>
    修改
    </button>
    </a>
    <!-- Button trigger modal -->
<a href='delete.php?delete=$id2&table=found'>
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
    删除
</button>
</a>
    </td>
eof;
    echo "</tr>";
}
echo "<tr style='text-align: center'><ul class='pagination'><td colspan='11'>$pagelist</td></ul></tr>";
echo "</table>";