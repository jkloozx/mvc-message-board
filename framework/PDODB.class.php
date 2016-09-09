<?php

/**
 * DAO层，使用pdo扩展封装实现
 */
class PDODB implements i_DAO {
	private $_host;
	private $_port;
	private $_user;
	private $_password;
	private $_charset;
	private $_dbname;
	// 运行时的属性
	private $_dsn;
	private $_options;
	private $_pdo;

	private function __construct($config=array()) {
		$this->_initServer($config);// 初始化配置
		$this->_newPDO();// 实例化PDO对象
	}
	private function __clone() {

	}
	private static $_instance;
	// 获取当前DAO对象的接口方法
	public static function getInstance($config=array()) {
		if (! static::$_instance instanceof static) {
			static::$_instance = new static($config);
		}
		return static::$_instance;
	}


	/**
	 * 初始化服务器配置信息的方法
	 * @param  array $config 格式如下：$config = array('host' => 'localhost', 'port' => '3306', 'user' => 'root', //... );
	 */
	private function _initServer($config) {
		// 在初始化属性时，如果实例化时没有制定，则设置属性的默认值
		// isset判断用户是否设置，如果设置了则使用用户的，否则使用我们指定的默认的。
		$this->_host = isset($config['host']) ? $config['host'] : 'localhost';
		$this->_port = isset($config['port']) ? $config['port'] : '3306';
		$this->_user = isset($config['user']) ? $config['user'] : '';// '' 表示匿名账户
		$this->_password = isset($config['password']) ? $config['password'] : '';
		$this->_charset = isset($config['charset']) ? $config['charset'] : 'UTF8';
		$this->_dbname = isset($config['dbname']) ? $config['dbname'] : 'test';
	}
	/**
	 * 获取PDO对象的操作
	 * @return [type] [description]
	 */
	private function _newPDO() {
		// 设置参数
		$this->_setDSN();// 设置DSN，数据源名称
		$this->_setOptions();// 设置选项
		$this->_getPDO();// 得到PDO对象
	}
	private function _setDSN() {
		$this->_dsn = "mysql:host=$this->_host;port=$this->_port;dbname=$this->_dbname";
	}
	private function _setOptions() {
		$this->_options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $this->_charset",
			);
	}
	private function _getPDO() {
		try {
			$this->_pdo = new PDO($this->_dsn, $this->_user, $this->_password, $this->_options);
		}
		catch(PDOException $e) {
			echo '数据库连接失败，请确认服务器信息';
			die; // 停止，比较暴力的处理错误的方法！
		}
	}

	// 执行SQL的方法
	public function query($sql='') {
		// 对于 查询类，返回结果对象。忽略大小写比较
		$sql = ltrim($sql);// 去掉左边空白字符
		if (strtolower(substr($sql, 0, 6))=='select' || strtolower(substr($sql, 0, 4))=='show' || strtolower(substr($sql, 0, 4))=='desc') {
			$result = $this->_pdo->query($sql);
		}
		else {
			// 对于 非查询类，返回布尔值（与MySQLDB一致）
			$result = $this->_pdo->exec($sql);// false !== false
		}

		// 如果执行失败，报告错误信息，并停止脚本执行（与MySQLDB一致）
		if ($result === false) {
			// 执行失败。结果就是false
			$error_info = $this->_pdo->errorInfo();
			echo 'SQL执行失败:', '<br>';
			echo '错误的SQL:', '<br>', $sql, '<br>';
			echo '错误的消息为:', '<br>', $error_info[2], '<br>';
			die;
		} else {	// 成功
			return $result;
		}
	}
	// 获取全部数据
	public function fetchAll($sql='') {
		$result = $this->query($sql);// 统一执行
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);// 获取数据
		$result->closeCursor();// 释放结果集光标
		return $rows;
	}
	// 获取一行记录
	public function fetchRow($sql='') {
		$result = $this->query($sql);// 统一执行
		$row = $result->fetch(PDO::FETCH_ASSOC);// 获取数据
		$result->closeCursor();// 释放结果集光标
		return $row;
	}
	// 获取一个数据
	public function fetchOne($sql='') {
		$result = $this->query($sql);// 统一执行
		$string = $result->fetchColumn();// 获取数据
		$result->closeCursor();// 释放结果集光标
		return $string;
	}
	public function prepare($sql='') {
		// 统一执行
		return $this->prepare($sql);
	}
	// 转义SQL，防止注入
	public function escapeString($str='') {
		return $this->_pdo->quote($str);
	}
}