<?php

/**
 * 后台商品表操作模型
 */
class GoodsModel extends Model {

	/**
	 * 添加商品
	 * @param array $data 关联数组，下标为字段名，值对应的值
	 * @return bool 执行结果
	 */
	public function insertGoods($data=array()) {
		// 拼凑SQL，insert语法
		$sql = "INSERT INTO `kang_goods` VALUES (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)";
		// 转义所有的数据 并 使用单引号包裹
		$escape_data = $this->_escapeArray($data);
		$sql = sprintf($sql, $escape_data['goods_name'], $escape_data['shop_price'], $escape_data['image_ori'], $escape_data['goods_image'], $escape_data['goods_desc'], $escape_data['goods_number'], $escape_data['is_best'], $escape_data['is_new'], $escape_data['is_hot'], $escape_data['is_on_sale']);

		// 执行
		return $this->_dao->query($sql);
	}
}