<?php


/**
 * 后台模块基础控制器类
 */
class IsAdminController extends ModuleController {

	public function __construct() {
		// 由于重写了父类（基础控制器类中）的构造方法，但是还需要其功能，因此强制调用
		parent::__construct();

		// 校验是否具有具有管理员权限
		$this->_isAdmin();
	}

	/**
	 * 检测当前是否有管理员权限
	 */
	protected function _isAdmin() {
        $no_check = array(
            'Admin' => array('login', 'check', 'captcha','register')
            // 控制器名 => 动作名列表
        );
        // 判断是否处于特例列表
        // 以当前控制器名为下标的元素是否存在 && 当前动作是否存在于当前控制器的特例动作列表中
        if (isset($no_check[CONTROLLER]) && in_array(ACTION, $no_check[CONTROLLER])) {
            // 是特例，不需要执行后边的校验了
            return ;
        }
		// 特例列表，校检是否是管理员
		$admin_list = array(4,5,6);
        $userId = $_SESSION["admin"]["id"];
		// 判断是否处于特例列表
		if (in_array($userId, $admin_list)) {
			// 是管理员，跳转到管理员界面
			return ;
		}else{
            $this->_jumpNow('index.php?m=back&c=MessageBoard&a=index');
        }
	}
}