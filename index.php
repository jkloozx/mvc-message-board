<?php
// 前端控制器 – 请求分发器 – 入口文件
//
// ***自动加载实现***
spl_autoload_register('kangAutoload');
/**
 * 定义自的自动记载
 * @param  string $name 名字，类名或接口名
 * @return [type]       [description]
 */
// 类与类文件地址映射列表，定义在方法外，保证仅定义一次。因为autoload会被多次调用
$class_list = array(
	'Factory' 	=> './framework/Factory.class.php',
	'Model'			=> './framework/Model.class.php',
	'Controller'=> './framework/Controller.class.php',
	'i_DAO'			=> './framework/i_DAO.interface.php',
	'MySQLDB'		=> './framework/MySQLDB.class.php',
	'PDODB'			=> './framework/PDODB.class.php',
	'Captcha'		=> './framework/tool/Captcha.class.php',
	'Upload'		=> './framework/tool/Upload.class.php',
	'Page'		=> './framework/tool/Page.class.php'
	);
function kangAutoload($name='') {
	// var_dump($name);
	// 映射表加载	// $GLOBALS['class_list'];//global $class_list
	$class_list = $GLOBALS['class_list'];
	if (isset($class_list[$name])) {
		// 映射表中存在，直接加载即可
		require $class_list[$name];
	}
	// 规则加载
	// 模型类
	elseif ('Model' == substr($name, -5)) {
		// 以Model结尾，模型类，当前模块下model子目录中加载
		require './app/' . MODULE . '/model/' . $name . '.class.php';
	}
	// 控制器类
	elseif ('Controller' == substr($name, -10)) {
		require './app/' . MODULE . '/controller/' . $name . '.class.php';
	}
}

// ***确定当前的分发参数***
// 获得当前的模块名
$default_module = 'home';
$current_module = isset($_GET['m']) ? $_GET['m'] : $default_module;
define('MODULE', $current_module);
// 获得当前的控制器名
$default_controller = 'Qt';// 义：默认的控制器名
// 判断URL中是否存在get参数c，如果存在则使用，否则使用默认的
$current_controller = isset($_GET['c']) ? $_GET['c'] : $default_controller;// 义：当前控制器
// 通常会，定义常量，存储当前的控制器名（没有Controller部分）
define('CONTROLLER', $current_controller);
// 获得当前动作名
$default_action = 'index';// 义：默认动作
$current_action = isset($_GET['a']) ? $_GET['a'] : $default_action;
define('ACTION', $current_action);



// ***实例化控制器类，调用其方法动作***
$controller_class_name = CONTROLLER . 'Controller';// 义：控制器类名
$controller = new $controller_class_name();//可变类。义：比赛控制器
// 调换用动作方法
$action_method_name = ACTION . 'Action';// 义：动作方法名
$controller->$action_method_name();//可变方法。 义：列表动作


