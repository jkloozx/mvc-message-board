<?php

/**
 * 基础模型类
 */
class Model {
	protected $_dao; // 存储实例化好的数据操作对象

	/**
	 * 构造方法
	 */
	public function __construct() {
		// 初始化DAO
		$this->_initDAO();
	}
	/**
	 * DAO: Data Access Object 数据[库]操作对象。
	 * 初始化 数据库操作对象
	 */
	protected function _initDAO() {
		// 载入mysqldb
		// require_once './framework/MySQLDB.class.php';
		$config = array(
			'host' => '127.0.0.1',
			'port' => '3306',
			'user' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'dbname' => 'test',
			);
		// $this->_dao = MySQLDB::getInstance($config);
		$this->_dao = PDODB::getInstance($config);
	}

	/**
	 * 转义数组内所有元素
	 * @param  array  $data 待转义的数组
	 * @return array     	  转移后的数组，key与之前相同
	 */
	protected function _escapeArray($data=array()) {
		$escape_data = array();// 用于存储转义后数据的数组
		// 遍历所有的待转义数据
		foreach($data as $key => $value) {
			// 转义后，存储
			$escape_data[$key] = $this->_dao->escapeString($value);
		}
		// 返回
		return $escape_data;
	}
}