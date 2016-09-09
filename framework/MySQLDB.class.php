<?php

/**
 * 项目中使用的数据库操作工具类
 */
class MySQLDB implements i_DAO {

	// 数据库信息属性
	private $_host;
	private $_port;
	private $_user;
	private $_password;
	private $_charset;// 连接字符集
	private $_dbname;// 默认操作的数据库

	// 运行时 需要的属性
	private $_link; // 连接资源

	/**
	 * 构造方法
	 * @param array $config 服务器配置信息
	 */
	private function __construct($config=array()) {
		// 初始化服务器信息
		$this->_initServer($config);
		// 连接
		$this->_connectServer();
		// 设置连接字符集
		$this->_setCharset();
		// 选择默认数据库
		$this->_selectDB();
	}
	private function __clone() {

	}
	private static $_instance;
	public static function getInstance($config=array()) {
		if (! (static::$_instance instanceof static)) {
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
	 * 连接mysql服务器
	 */
	private function _connectServer() {
		// ('localhost:3306', 'root', '1234abcd')
		// 双引号定义的字符串，也可以解析属性值
		$connect_result = mysql_connect("$this->_host:$this->_port", $this->_user, $this->_password);
		// 判断连接结果
		if ($connect_result) {
			// 将连接资源保存在当前对象的属性
			$this->_link = $connect_result;
		} else {
			// 连接失败
			echo '数据库连接失败，请确认服务器信息';
			die; // 停止，比较暴力的处理错误的方法！
		}
	}

	/**
	 * 设置连接字符集
	 */
	private function _setCharset() {
		// 设置字符集的SQL
		$sql = "SET NAMES $this->_charset";
		// 执行即可！ mysql_query()的第二个参数表示为，使用哪台服务器连接执行该SQL。在同时连接多台服务器时使用！
		// mysql_query($sql, $this->link);
		// 由封装好的执行SQL的方法，完成该SQL的执行
		$this->query($sql);
	}

	/**
	 * 选择默认操作的数据库
	 */
	private function _selectDB() {
		// 选择默认数据库的SQL
		// 实际中，建议将 mysql中的标识符（库名，表名，字段名，XX名），使用反引号``包裹！
		$sql = "USE `$this->_dbname`";// use `dbanme`
		// mysql_query($sql, $this->link);
		// 由封装好的执行SQL的方法，完成该SQL的执行
		$this->query($sql);
	}

	/**
	 * 执行SQL
	 * @param  string $sql 待执行的SQl
	 * @return mixed 执行结果。查询类的SQL(select, show, desc)，成功返回结果集资源，失败返回false。非查询类(insert, delete, update)，成功返回true，失败false。
	 */
	public function query($sql='') {
		// 执行
		$query_result = mysql_query($sql, $this->_link);
		// 如果存在，则处理错误
		if (false == $query_result) {
			// 执行失败，处理错误，暴力的处理方式，报告错误信息，并停止脚本执行
			echo 'SQL执行失败:', '<br>';
			echo '错误的SQL:', '<br>', $sql, '<br>';
			echo '错误的消息为:', '<br>', mysql_error($this->_link), '<br>';
			die;
		} else {
			// 成功
			return $query_result;
		}
	}

	/**
	 * 执行SQL获取一条记录
	 * @param  string $sql 待执行的查询类SQL，通常为：select * from `match` where m_id=23;
	 * @return array      包含查询信息一维数组
	 */
	public function fetchRow($sql='') {
		// 执行
		$result = $this->query($sql);
		// fetch结果
		$row = mysql_fetch_assoc($result);
		// 释放掉结果集
		mysql_free_result($result);
		// 返回结果
		return $row;
	}

	/**
	 * 执行SQL，获得一个值
	 * @param  sql $sql 待执行的查询类的SQL，类似于：select count(*) from table-name where ;
	 * @return string      获得的一个值,如果没有获取到，返回null
	 */
	public function fetchOne($sql='') {
		// 执行
		$result = $this->query($sql);
		// fetch
		$row = mysql_fetch_row($result);// 如果$result内没有数据，则fentch的结果为false
		mysql_free_result($result);
		// 如果执行SQL的没有获得数据，$row 就是false
		if ($row) {
			return $row[0];
		} else {
			return NULL;
		}
	}
	/**
	 * 执行SQL，获得多行数据
	 * @param  string $sql 待执行的SQL，类似为：select * from table-name where name like 'han%';
	 * @return array      二维数组
	 */
	public function fetchAll($sql='') {
		$result = $this->query($sql);
		$rows = array();
		while($row = mysql_fetch_assoc($result)) {
			$rows[] = $row;
		}
		mysql_free_result($result);
		return $rows;
	}

	/**
	 * [escapeString description]
	 * @param  string $str 待转义的字符串
	 * @return [type]      转义后的字符串
	 */
	public function escapeString($str='') {//义：转义字符串
		return "'" . mysql_real_escape_string($str, $this->_link) . "'";
	}
}