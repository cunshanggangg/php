<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 11:18
 */
require_once '../class/database.php';
class Test {
//    public function db() {
//        require_once '../class/database.php';
//        return $database;
//    }
    public function test() {
//        $database = $this->db();
        $result = $GLOBALS['database']->select("news","*",["LIMIT"=>10]);
//        error_reporting(0);
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        return $result;
//        return "csg";
    }

    public function show() {
//        require_once '../class/database.php';
//        $result = $d->select("news","*",["LIMIT"=>10]);
////        error_reporting(0);
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        echo "YaoMing";
    }
}

$result = new Test();
$r = $result->test();
echo "<pre>";
print_r($r);
echo "</pre>";
//echo "<hr>";
//$result->show();