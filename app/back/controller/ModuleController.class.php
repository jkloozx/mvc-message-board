<?php


/**
 * 后台模块基础控制器类
 */
class ModuleController extends Controller {

	public function __construct() {
		// 由于重写了父类（基础控制器类中）的构造方法，但是还需要其功能，因此强制调用
		parent::__construct();

		// 开启session
		$this->_startSession();
		// 校验是否具有登陆凭证
		$this->_isLogin();
	}

	/**
	 * 开启session，项目中不仅仅登陆校验需要session，很多功能都需要session。
	 * @return [type] [description]
	 */
	protected function _startSession() {
		// 开启session
		session_start();
	}

	/**
	 * 检测当前是否登陆凭证
	 */
	protected function _isLogin() {
		// 特例列表，不需要校验的动作
		// 哪个控制器的那个动作不需要校验
		$no_check = array(
			'Admin' => array('login', 'check', 'captcha','register'),
			'MessageBoard' => array('')
			// 控制器名 => 动作名列表
			);
		// 判断是否处于特例列表
		// 以当前控制器名为下标的元素是否存在 && 当前动作是否存在于当前控制器的特例动作列表中
		if (isset($no_check[CONTROLLER]) && in_array(ACTION, $no_check[CONTROLLER])) {
			// 是特例，不需要执行后边的校验了
			return ;
		}

		// 判断是否具有登录凭证
		if (!isset($_SESSION['admin'])) {
			// 登录标识不存在
			// 判断是否采用COOKIE记录的登陆状态
			// 判断是否存在 && 可以校验通过
			$m_admin = Factory::M('Admin');
			if (isset($_COOKIE['admin_id']) && isset($_COOKIE['admin_password']) && $result = $m_admin->checkRemember($_COOKIE['admin_id'], $_COOKIE['admin_password'])) {
				// 记录了登陆状态
				$_SESSION['admin'] = $result;
			} else {
				// 没有通过记录登陆状态的验证
				$this->_jumpNow('index.php?m=home&c=Qt&a=index');
			}
		}
	}
}