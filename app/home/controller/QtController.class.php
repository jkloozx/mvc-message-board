<?php

/**
 * 前台的控制器，作为默认控制器用
 */
class QtController extends Controller {

	/**
	 * 首页方法
	 */
    public function indexAction() {
        $m_message = Factory::M("MessageBoard");
        $m_admin = Factory::M("Admin");
        $students = $m_admin->getSomeStudents(0,3);
        $messages = $m_message->getAllMessages();
        // 载入留言板模板
        require './app/home/view/MessageBoard/index.php';
    }
}