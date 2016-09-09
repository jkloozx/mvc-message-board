<?php


class Factory {

	/**
	 * 获得模型的单例对象
	 * 针对于所有模型
	 * @param $model_name 需要得到单例对象的模型的名字，例如 "Player" 表示 PlayerModel模型。
	 * @return object 该模型类的单例对象
	 */
	public static function M($model_name='') {
		// 存储所有的模型对象
		static $model_list = array();// 'Player' => Object(PlayerModel)
		// 判断该模型类是否已经实例化对象
		if (!isset($model_list[$model_name])) {
			// 该模型类对象不存在，则实例化
			$model_class_name = $model_name . 'Model';// 'Player' . 'Model'
			$model_list[$model_name] = new $model_class_name();//new PlayerModel()
		}
		// 返回获取的 模型对象
		return $model_list[$model_name];
	}
}