<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-9
 * Time: 上午10:15
 */
class MessageBoardModel extends Model {

    /**
     * 添加商品
     * @param array $data 关联数组，下标为字段名，值对应的值
     * @return bool 执行结果
     */
    public function getAllMessages() {
        $sql = "select * from message";
        // 执行
        return $this->_dao->fetchAll($sql);
    }
    public function getSomeMessages($start=0,$end=1) {
        $escape_start = $this->_dao->escapeString($start);
        $escape_end = $this->_dao->escapeString($end);
        $sql = "select * from message order by id limit $escape_start,$escape_end";
        // 执行
        return $this->_dao->fetchAll($sql);
    }
}