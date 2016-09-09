<?php

/**
 * 上传类
 */
class Upload {

	private $_ext_list = array('.jpeg', '.jpg', '.png', '.gif');// 后缀列表
	private $_max_size = 1048576;// 1M,最大尺寸
	private $_upload_path = './'; // 上传路径
	private $_prefix = '';// 文件名前缀


	private $_error_info;// 错误信息

	/**
	 * 获取错误消息的方法
	 * @return string 消息内容
	 */
	public function getErrorInfo() {
		return $this->_error_info;
	}

	/**
	 * 修改属性的方法
	 */
	public function setExtList($ext_list=array()) {
		$this->_ext_list = $ext_list;
	}
	public function setMaxSize($max_size=0) {
		$this->_max_size = $max_size;
	}
	/**
	 * 设置上传路径
	 * @param string $upload_path 新的上传路径
	 */
	public function setUploadPath($upload_path='./') {
		// 判断路径是否存在，存在则设置为新的上传路径
		if (is_dir($upload_path)) {
			$this->_upload_path = $upload_path;
		}else{
		    echo "上传路径不存在，请设置之后再进行上传";
            die;
        }
	}
	public function setPrefix($prefix='') {
		$this->_prefix = $prefix;
	}

	/**
	 * 上传单个文件
	 * @param  array  $file_info 某个上传的临时文件信息，5个元素的数组，
	 * @return [type]            成功，string，上传文件地址。失败，false。
	 */
	public function uploadFile($file_info=array()) {
		// 判断是否有错误
		if ($file_info['error'] != 0) {
			$this->_error_info = '上传出现错误';
			return false;
		}

		// 判断类型是否合适
		// 1后缀名的判断
		// 获取当前文件后缀名
		$ext = strrchr($file_info['name'], '.');
		if (! in_array(strtolower($ext), $this->_ext_list)) {
			$this->_error_info = '文件[后缀名]类型错误';
			return false;
		}

		// 2mime的判断
		$mime_list = $this->_ext2Mime($this->_ext_list);
		if (! in_array($file_info['type'], $mime_list)) {
			$this->_error_info = '文件[MIME]类型错误';
			return false;
		}
		// PHP获取真实类型
		// 实例化一个可以获取文件MIME_TYPE的对象。
		$finfo = new Finfo(FILEINFO_MIME_TYPE);
		// finfo对象的file方法，可以检测某个文件的信息。
		$real_mime = $finfo->file($file_info['tmp_name']);
		if (! in_array($real_mime, $mime_list)) {
			$this->_error_info = '文件[真实MIME]类型错误';
			return false;
		}


		// 大小是否在限制之内
		if ($file_info['size'] > $this->_max_size) {
			$this->_error_info = '文件过大';
			return false;
		}

		// 生成目标文件名
		$upload_filename = uniqid($this->_prefix, true) . $ext;

		// 指定上传目录
		$upload_path = $this->_upload_path;
		// 依据天，划分子目录存储
		// 子目录名
		$sub_dir = date('Ymd') . '/';//20151022
		// 判断上传路径下的子目录是否存在
		if (! is_dir($upload_path . $sub_dir)) {
			// 不存在，创建
			mkdir($upload_path . $sub_dir);
		}

		// 检测该临时文件是否为上传的文件
		if (! is_uploaded_file($file_info['tmp_name'])) {
			$this->_error_info = '上传文件被破坏';
			return false;
		}

		// 移动到项目指定目录
		$result = move_uploaded_file($file_info['tmp_name'], $upload_path . $sub_dir . $upload_filename);
		// 判断移动结果
		if ($result) {
			// 移动成功，返回上传文件名
			return $sub_dir . $upload_filename;
		} else {
			$this->_error_info = '移动失败';
			return false;
		}
	}
	/**
	 * 将后缀转成MIME
	 * @param  array  $ext_list 后缀列表
	 * @return array          	MIME列表
	 */
	private function _ext2Mime($ext_list=array()) {
		// 获得列表映射
		$ext2mime_list = require './framework/tool/ext2mime.php';
		foreach($ext_list as $ext) {// 依次获得每个后缀
			// 通过映射表，获得该后缀对应的mime
			$mime_list[] = $ext2mime_list[$ext];
		}
		// 返回MIME列表
		return $mime_list;
	}
}