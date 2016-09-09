<?php

/**
 * 所有控制器的基础类，被功能控制器继承
 */
class Controller {

	public function __construct() {
		$this->_setContentType();
	}

	/**
	 * 设置响应内容类型，字符集编码
	 */
	protected function _setContentType() {
		header('Content-Type: text/html; charset=utf-8');
	}


	/**
	 * 立即跳转
	 * @param string $url 目标URL
	 */
	protected function _jumpNow($url='') {
		header('Location: ' . $url);
		die;
	}

	/**
	 * 提示后跳转
	 * @param  string  $url     目标URL
	 * @param  string  $message 提示信息
	 * @param  integer $wait    等待时间
	 * @return [type]           [description]
	 */
	protected function _jumpWait($url='', $message='', $wait=3) {
		header("Refresh: $wait; URL=$url");
		echo $message;
		die;
	}
}

