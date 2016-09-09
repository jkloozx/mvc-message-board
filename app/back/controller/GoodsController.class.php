<?php

/**
 * 后台商品管理相关功能控制器类
 */
class GoodsController extends ModuleController {


	public function addAction() {
		// 载入添加模板即可
		require './app/back/view/goods_add.html';
	}


	/**
	 * 完成插入商品信息到数据库
	 */
	public function insertAction() {
		// 收集表单数据
		$data['goods_name'] = $_POST['goods_name'];
		$data['shop_price'] = $_POST['shop_price'];
		$data['goods_desc'] = $_POST['goods_desc'];
		$data['goods_number'] = $_POST['goods_number'];
		// 通过是否选择来确定值
		$data['is_best'] = isset($_POST['is_best']) ? '1' : '0';
		$data['is_new'] = isset($_POST['is_new']) ? '1' : '0';
		$data['is_hot'] = isset($_POST['is_hot']) ? '1' : '0';
		$data['is_on_sale'] = isset($_POST['is_on_sale']) ? '1' : '0';

		// 先为商品图片增加默认数据
		$data['image_ori'] = '';
		$data['goods_image'] = '';

		// 上传商品图片
		$t_upload = new Upload();
		// 设置商品图片的上传路径
		$t_upload->setUploadPath('./public/upload/goods/');
		// 开始上传
		$upload_result = $t_upload->uploadFile($_FILES['image_ori']);
		if ($upload_result) {
			// 上传成功
			$data['image_ori'] = $upload_result;
		} else {
			// 上传失败
			$this->_jumpWait('index.php?m=back&c=Goods&a=add', '上传图片失败，原因为：' . $t_upload->getErrorInfo());
		}

		// 利用模型完成处理
		$m_goods = Factory::M('Goods');
		$insert_result = $m_goods->insertGoods($data);

		// 根据处理结果，做出操作
		if ($insert_result) {
			// 插入成功
			$this->_jumpNow('index.php?m=back&c=Goods&a=list');
		} else {
			// 插入失败
			$this->_jumpWait('index.php?m=back&c=Goods&a=add', '添加失败：失败原因');
		}
	}


	public function listAction() {
		echo '商品列表欢迎你';
	}
}