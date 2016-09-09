<?php

/**
 * 后台的，admin表的操作模型类
 */
class AdminModel extends Model
{

    /**
     * 通过登陆时的管理员名和密码，检测管理员是否合法
     * @param  string $admin_name 姓名
     * @param  string $admin_password 密码
     * @return mixed                    合法，管理员信息数组。非法，false
     */
    public function checkLogin($admin_name = '', $admin_password = '')
    {
        // 管理员姓名和都匹配的管理员存在，就是合法。否则即为非法
        $escape_name = $this->_dao->escapeString($admin_name);
        $escape_password = $this->_dao->escapeString($admin_password);
        $sql = "SELECT * FROM `student` WHERE `sno`=$escape_name AND `password`=sha1($escape_password)";
        // die($sql);
        // 执行
        return $this->_dao->fetchRow($sql);
    }

    public function register($sno = '', $name = '', $sex = '', $password = '')
    {
        // 向student表中插入数据，返回一个标志
        $escape_sno = $this->_dao->escapeString($sno);
        $escape_name = $this->_dao->escapeString($name);
        $escape_sex = $this->_dao->escapeString($sex);
        $escape_password = $this->_dao->escapeString($password);
        $resume = "这家伙很懒，什么也没有留下...";
        $sql = <<<EOP
        insert into `student` 
        (`sno`,`name`,`sex`,`password`,`resume`)
        values($escape_sno,$escape_name,$escape_sex,sha1($escape_password),'$resume');
EOP;
        return $this->_dao->query($sql);
    }

    /**
     * 通过记录的ID和密码对，校验是否合法
     * @param  string $md5_id 加密之后的ID
     * @param  string $md5_2_password 两次加密之后的密码
     * @return mixed                 合法，管理员信息数组。非法，false
     */
    public function checkRemember($md5_id = '', $md5_2_password = '')
    {
        // 连接只有再加密
        // concat 连接，md5 加密
        $sql = "SELECT * FROM `student` WHERE md5(concat(`id`, 'SALT'))='$md5_id' AND md5(concat(`password`, 'SALT')) = '$md5_2_password'";
        return $this->_dao->fetchRow($sql);
    }

    public function getSomeStudents($start = 0, $end = 1){
//        $escape_start = $this->_dao->escapeString($start);
//        $escape_end = $this->_dao->escapeString($end);
        $sql = "select * from student order by id desc limit $start,$end ";
        // 执行
        return $this->_dao->fetchAll($sql);
    }
    public function getStudent($id){
//        $escape_start = $this->_dao->escapeString($start);
//        $escape_end = $this->_dao->escapeString($end);
        $sql = "select * from student where id=$id ";
        // 执行
        return $this->_dao->fetchRow($sql);
    }

    public function updateStudent($userId, $data = array()){
        // 拼凑SQL，update语法
        $prepareSql = "update student set name = ?,sex = ?,age = ?,favorite = ?,class = ?,height = ?,weight = ?,tel = ?,address = ?,resume = ? where id='$userId'";
        if ($stmt = $this->_dao->prepare($prepareSql)) {
            var_dump($prepareSql);
            $name = $data["name"];
            $sex = $data["sex"];
            $age = $data["age"];
            $favorite = $data["favorite"];
            $class = $data["class"];
            $height = $data["height"];
            $weight = $data["weight"];
            $tel = $data["tel"];
            $address = $data["address"];
            $resume = $data["resume"];
            $stmt->bind_param("ssssssssss", $name, $sex, $age, $favorite, $class, $height, $weight, $tel, $address, $resume);
            return $stmt->execute();
        }else{
            var_dump("出错了");
        }

    }
}