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
        $sql = "select * from message order by id desc";
        // 执行
        return $this->_dao->fetchAll($sql);
    }
    public function getMessagesTotal($userId) {
        $sql = "select count(*) from message where userId=$userId";
        // 执行
        return $this->_dao->fetchOne($sql);
    }
    public function getMyMessages($start=0,$end=1,$userId=0) {
        $sql = <<< heredoc
        select * from message
        where userId=$userId
        order by id
        desc
        limit $start,$end
heredoc;

        // 执行
        return $this->_dao->fetchAll($sql);
    }
    public function addMessage($content="",$userId="",$username,$create_time="") {
        $escape_content = $this->_dao->escapeString($content);
        $escape_userId = $this->_dao->escapeString($userId);
        $escape_username = $this->_dao->escapeString($_SESSION["admin"]["name"]);
        $escape_create_time = $this->_dao->escapeString($create_time);
        $sql = <<< EOP
        insert into message
        (`content`,`userId`,`username`,`create_time`)
        values($escape_content,$escape_userId,$escape_username,$escape_create_time);
EOP;
        // 执行
        return $this->_dao->query($sql);
    }
    public function deleteMessage($id) {
        $sql = "delete from `message` where id=$id";
        // 执行
        return $this->_dao->query($sql);
    }
    public function updateMessage($id,$content) {
        $escape_content = $this->_dao->escapeString($content);
        $sql = "update message set content=$escape_content where id=$id";
        // 执行
        return $this->_dao->query($sql);
    }
}