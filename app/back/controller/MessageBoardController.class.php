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
        require "./app/back/view/MessageBoard/myMessagePage.php";
        // 载入留言板模板
//        require './app/back/view/MessageBoard/index.php';
    }

    public function showMyMessagesAction(){
        require "./app/back/view/MessageBoard/showMyMessages.php";
    }

}