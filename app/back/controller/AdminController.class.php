<?php

/**
 * 后台管理员相关功能控制器类，例如，登陆，退出，注册，权限管理，找回密码，管理增删改查
 */
class AdminController extends ModuleController {
	/**
	 * 管理员登录表单展示
	 */
	public function loginAction() {
        // 载入表单视图页面
		require './app/home/view/auth/login.php';
	}
	public function registerAction() {
//        var_dump(isset($no_check[CONTROLLER]) && in_array(ACTION, $no_check[CONTROLLER]));
//        die;
        // 载入表单视图页面
		require './app/home/view/auth/register.php';
	}
	public function logoutAction() {
		// 注销用户
		unset($_SESSION["admin"]);
        $this->_jumpNow('index.php?m=home&c=Qt&a=index');
	}

	/**
	 * 生成管理员登录验证码动作
	 */
	public function captchaAction() {
		// 利用验证码工具类生成
		$t_captcha = new Captcha();
		$t_captcha->makeImage(2);
	}

	/**
	 * 管理员合法性校验
	 */
	public function checkAction() {
		// 验证码校验
		$t_captcha = new Captcha();
		if (! $t_captcha->checkCode($_POST['captcha'])) {
			// 验证未通过，不正确的验证码
			$this->_jumpWait('index.php?m=back&c=Admin&a=login', '验证码错误', 2);
		}


		// 收集请求表单数据
		$admin_name = $_POST['username'];
		$admin_password = $_POST['password'];

		// 利用模型处理，校验是否合法
		$m_admin = Factory::M('Admin');
		// $result 两种可能性，管理员信息数组表示合法 和 false表示非法
		$result = $m_admin->checkLogin($admin_name, $admin_password);

		// 利用判断结果，做出处理
		if ($result) {
			// 结果合法
			// 分配登陆凭证
			$_SESSION['admin'] = $result;

			// 记录登陆状态
			// 是否需要
			if (isset($_POST['remember'])) {
				// 需要
				setcookie('admin_id', md5($result['id'].'SALT'), time()+30*24*3600, '/');
				setcookie('admin_password', md5($result['password'].'SALT'), time()+30*24*3600, '/');
			}
			// 立即跳转，目标为管理后台首页
			$this->_jumpNow('index.php?m=back&c=Manage&a=index');
		} else {
			// 结果非法
			// 输出提示信息，并跳转到登陆
			$this->_jumpWait('index.php?m=back&c=Admin&a=login', '管理员信息非法', 2);
		}
	}
	public function checkRegisterAction(){
        $t_captcha = new Captcha();
        if (! $t_captcha->checkCode($_POST['captcha'])) {
            // 验证未通过，不正确的验证码
            $this->_jumpWait('index.php?m=back&c=Admin&a=register', '验证码错误', 2);
        }
	    $sno = $_POST["sno"];
	    $name = $_POST["name"];
	    $sex = $_POST["sex"];
	    $password = $_POST["password"];
        // 利用模型处理，插入用户数据到数据库
        $m_admin = Factory::M('Admin');
        $result = $m_admin->register($sno,$name,$sex,$password);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Admin&a=login');
        }else{
            $this->_jumpWait('index.php?m=back&c=Admin&a=register', '注册失败', 2);
        }
    }

    public function showUpdateAction(){
        $m_admin = Factory::M('Admin');
        $student = $m_admin->getStudent($_SESSION["admin"]["id"]);
        require './app/back/view/auth/update-student.php';
    }

    public function updateAction() {
        // 收集表单数据
        $data['name'] = $_POST['name'];
        $data['sex'] = $_POST['sex'];
        $data['age'] = $_POST['age'];
        $data['favorite'] = $_POST['favorite'];
        $data['class'] = $_POST['class'];
        $data['height'] = $_POST['height'];
        $data['weight'] = $_POST['weight'];
        $data['tel'] = $_POST['tel'];
        $data['address'] = $_POST['address'];
        $data['resume'] = $_POST['resume'];
        // 利用模型完成处理
        $m_admin = Factory::M('Admin');
        $userId = $_SESSION["admin"]["id"];
        $update_result = $m_admin->updateStudent($userId,$data);
        // 根据处理结果，做出操作
        if ($update_result) {
            // 插入成功
            $this->_jumpNow('index.php?m=back&c=MessageBoard&a=index');
        } else {
            // 插入失败
            $this->_jumpWait('index.php?m=back&c=Admin&a=showUpdate', '修改失败',2);
        }
    }

}