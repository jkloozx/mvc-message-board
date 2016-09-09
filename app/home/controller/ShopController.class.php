<?php

/**
 * 前台的控制器，作为默认控制器用
 */
class ShopController extends Controller {

	/**
	 * 首页方法
	 */
	public function indexAction() {
		// 载入前台首页模板
		require './app/home/view/index.html';
	}
}