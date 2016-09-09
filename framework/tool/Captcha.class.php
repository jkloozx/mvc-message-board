<?php

/**
 * 验证码工具类
 */
class Captcha {

	/**
	 * 生成验证码图像，直接输出到浏览器
	 * @param int $code_length 码值的长度
	 * @return void
	 */
	public function makeImage($code_length=4) {
		// 生成码值
		// 所有可能的字符集合！
		$char_list = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
		$list_length = strlen($char_list);// 字符集合的长度
		$code = '';// 初始化码值字符串为空
		for($i=1; $i<=$code_length; ++$i) {
			// 随机的下标 0 到 长度-1
			$rand_index = mt_rand(0, $list_length-1);
			// 随机的字符
			$code .= $char_list[$rand_index];// 字符串的下标操作
		}
		// 存储于session
		@session_start();// 保证一定开启，同时，重复开启不会报错
		$_SESSION['captcha_code'] = $code;


		// 确定随机的背景图
		$bg_file = './framework/tool/captcha/captcha_bg' . mt_rand(1, 5) . '.jpg';
		// 依据图片，创建画布
		$image = imagecreatefromjpeg($bg_file);


		// 分配颜色
		// if (mt_rand(1, 2)==1) {// 50%概率执行某段代码
		// if (mt_rand(1, 100)<=97) {// 97%概率执行某段代码
		if (mt_rand(1, 3)>=2) {// 2/3概率执行某段代码
			$code_color = imagecolorallocate($image, 0, 0, 0);// 黑
		} else {// 1/3概率执行某段代码
			$code_color = imagecolorallocate($image, 255, 255, 255);// 白
		}

		// 字体大小
		$font = 5;

		// 计算位置
		// 画布的宽高
		$image_w = imagesx($image);
		$image_h = imagesy($image);
		// 字体的宽高
		$font_w = imagefontwidth($font);
		$font_h = imagefontheight($font);
		// 字符串宽高
		$code_w = $font_w * $code_length;
		$code_h = $font_h;
		// 位置X
		$str_x = ($image_w-$code_w) / 2;
		// 位置Y
		$str_y = ($image_h-$code_h) / 2;
		// 写字符串
		imagestring($image, $font, $str_x, $str_y, $code, $code_color);

		// 输出到浏览器端
		header('Content-Type: image/jpeg');
		imagejpeg($image);

		// 销毁画布
		imagedestroy($image);

	}

	/**
	 * 验证码是否正确的校验
	 * @param  string $request_code 提交表单时，填写的验证码
	 * @return bool               	是否匹配相等
	 */
	public function checkCode($request_code='') {
		@session_start();
		// 用户填写的是否存在 && Session中是否存在 && 相等
		// 通常忽略大小写比较
		$result = isset($request_code) && isset($_SESSION['captcha_code']) && strtoupper($request_code)==strtoupper($_SESSION['captcha_code']);
		// 删除 session中的存储从验证码，不论正确与否。
		if (isset($_SESSION['captcha_code'])) {// 存在则删除
			unset($_SESSION['captcha_code']);
		}

		return $result;
	}

}
