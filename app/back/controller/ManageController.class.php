<?php
/**
 * 后台管理中心控制器
 */
class ManageController extends ModuleController {
	/**
	 * 首页动作
	 */
	public function indexAction() {
		// 载入后台首页模板
		require './app/back/view/index.html';
	}
	public function topAction() {
		require './app/back/view/top.html';
	}
	public function menuAction() {
		require './app/back/view/menu.html';
	}
	public function dragAction() {
		require './app/back/view/drag.html';
	}
	public function mainAction() {
		require './app/back/view/main.html';
	}
	public function changeAction() {
		require './app/home/view/index.html';
	}

}