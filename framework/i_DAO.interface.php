<?php


/**
 * 所有DAO层的接口
 */
interface i_DAO {
	// 获取当前DAO对象的接口方法
	public static function getInstance($config=array());
	// 执行SQL的方法
	public function query($sql='');
	// 获取全部数据
	public function fetchAll($sql='');
	// 获取一行记录
	public function fetchRow($sql='');
	// 获取一个数据
	public function fetchOne($sql='');
	// 转义SQL，防止注入
	public function escapeString($str='');
}