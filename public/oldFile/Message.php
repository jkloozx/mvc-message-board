<?php

/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-31
 * Time: 下午6:49
 */
class Message{
    private $id;
    private $userId;
    private $content;
    private $create_time;

    public function __construct($id,$userId,$content,$create_time){
            $this->id = $id;
            $this->userId = $userId;
            $this->content = $content;
            $this->create_time = $create_time;
//        echo "你好，我是".$name."我来了。";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $sno
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $create_time
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
    }
    public function insert(){
        MySqlDB::getNewMySqlDB()->alterMessage($this,1);

    }
    public function update(){
        MySqlDB::getNewMySqlDB()->updateMessage($this);
    }
}
