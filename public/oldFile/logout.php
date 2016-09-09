<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-8-31
 * Time: 上午10:26
 */
session_start();
session_destroy();
header("location:index.php");