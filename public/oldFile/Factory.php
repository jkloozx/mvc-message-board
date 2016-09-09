<?php

/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-2
 * Time: 下午2:54
 */
class Factory{
    public static function getInstance($className){
        static $instance_list = array();
        if (isset($instance_list[$className])){
            return $instance_list[$className];
        }else{
            $instance_list[$className] = new $className();
            return $instance_list[$className];
        }
    }

}