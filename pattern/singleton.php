<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 11:13
 */
//单元素模式
/*  某些应用程序资源是独占的，因为有且只有一个此类型的资源。
    例如，通过数据库句柄到数据库的连接是独占的。
    您希望在应用程序中共享数据库句柄，因为在保持连接打开或关闭时，
    它是一种开销，在获取单个页面的过程中更是如此。
 * */
class Database
{
    public $db = null;
    public function __construct($config = array())
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $config['db_host'], $config['db_name']);
        $this->db = new PDO($dsn, $config['db_user'], $config['db_pass']);
    }
}

$config = array(
    'db_name' => 'tp',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => ''
);

$db1 = new Database($config);
echo "<pre>";
var_dump($db1);
$db2 = new Database($config);
var_dump($db2);
$db3 = new Database($config);
var_dump($db3);
echo "</pre>";
