<?php

/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-9
 * Time: 上午10:08
 */
class MessageBoardController extends ModuleController{
    private $per = 5;

    /**
     * 首页方法
     */
    public function indexAction()
    {
        $m_message = Factory::M("MessageBoard");
        $m_admin = Factory::M("Admin");
        $students = $m_admin->getSomeStudents(0, 3);
        $messages = $m_message->getAllMessages();
        // 载入留言板模板
        require './app/back/view/MessageBoard/index.php';
    }

    public function publishAction(){
        $content = $_POST["content"];
        $userId = $_SESSION["admin"]["id"];
        $create_time = date("Y-m-d H:i:s");
        $username = $_SESSION["admin"]["name"];
        $m_message = Factory::M("MessageBoard");
        $result = $m_message->addMessage($content, $userId, $username, $create_time);
        // 载入留言板模板
        if ($result) {
            $this->_jumpNow('index.php?m=back&c=MessageBoard&a=index');
        } else {
            $this->_jumpWait('index.php?m=back&c=MessageBoard&a=index', '留言发表失败', 2);

        }
        require './app/back/view/MessageBoard/index.php';
    }

    public function deleteAction(){
        $m_message = Factory::M("MessageBoard");
        $id = $_POST["id"];
        $result = $m_message->deleteMessage($id);
        // 载入留言板模板
        if ($result){
            $this->_jumpNow('index.php?m=back&c=MessageBoard&a=showMyMessages');
        }else{
            $this->_jumpWait('index.php?m=back&c=MessageBoard&a=showMyMessages', '删除留言失败', 2);
        }
    }

    public function updateAction(){
        $m_message = Factory::M("MessageBoard");
        $id = $_POST["id"];
        $content = $_POST["content"];
        $result = $m_message->updateMessage($id,$content);
        // 载入留言板模板
        if ($result){
            $this->_jumpNow('index.php?m=back&c=MessageBoard&a=showMyMessages');
        }else{
            $this->_jumpWait('index.php?m=back&c=MessageBoard&a=showMyMessages', '留言修改失败', 2);
        }
    }

    public function getMyMessagesAction(){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $userId = $_SESSION["admin"]["id"];
        $m_message = Factory::M("MessageBoard");
        $total = $m_message->getMessagesTotal($userId);
        $page_obj = new Page($total, $this->per);
        $pagelist = $page_obj->fpage(array( 0, 1, 2, 3, 4, 5, 6, 7, 8));
        $totalPage = ceil($total / $this->per);
        if ($page <= 0){
            $page = 1;
        }
        if ($page > $totalPage){
            $page = $totalPage;
        }
        $start = ($page - 1) * $this->per;
        $end = $this->per;
        $myMessages = $m_message->getMyMessages($start, $end, $userId);
//        var_dump($total, $myMessages);
        echo <<< EOP
        <table class="table table-striped table-hover table-bordered">
        <tr>
        <th>序号</th>
        <th>留言信息</th>
        <th>创建时间</th>
        <th>修改</th>
        <th>删除</th>
        </tr>
EOP;
        $num = $start + 1;
        foreach ($myMessages as $message) {
            $messageId = $message["id"];
            $messageContent = $message["content"];
            echo "<tr>";
            echo "<td>" . $num++ . "</td>";
            echo "<td>" . $message["content"] . "</td>";
            echo "<td>" . $message["create_time"] . "</td>";
            echo <<< EOP
            <td id="edit">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit_$num">
            编辑
            </button>
            <!-- Modal -->
            <form action="index.php?m=back&c=MessageBoard&a=update" method="post"/>
            <div class="modal fade" id="edit_$num" tabindex="-1" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">编辑您的留言</h4>
            </div>
            <div class="modal-body">
            <div class="input-group input-group-lg">
            <span class="input-group-addon">@</span>
            <input type="hidden" name="id" value="$messageId">
            <textarea id="message" name="content" class="form-control input-group-lg" name="" id="" cols="50" rows="10"></textarea>
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
            <input value="$messageId" type="hidden" name="id">
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
            确认删除您的留言，删除后将不可恢复，确认继续？
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
        echo "<tr style='text-align: center'><ul class='pagination'><td colspan='11'>$pagelist</td></ul></tr>";
        echo "</table>";
        // 载入留言板模板
//        require './app/back/view/MessageBoard/index.php';
    }

    /**
     * @return int
     */
    public function showMyMessagesAction(){
        require "./app/back/view/MessageBoard/showMyMessages.php";
    }

}