<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 11:13
 */
//单元素模式：创建一个而且只能创建一个对象的类
/*  某些应用程序资源是独占的，因为有且只有一个此类型的资源。
    例如，通过数据库句柄到数据库的连接是独占的。
    您希望在应用程序中共享数据库句柄，因为在保持连接打开或关闭时，
    它是一种开销，在获取单个页面的过程中更是如此。
 * */
//为什么需要单例模式
/*
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
*/
class Database
{
    // 声明$instance为私有静态类型，用于保存当前类实例化后的对象
    private static $instance = null;
    // 数据库连接句柄
    private $db = null;

    // 构造方法声明为私有方法，禁止外部程序使用new实例化，只能在内部new
    private function __construct($config = array())
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $config['db_host'], $config['db_name']);
        $this->db = new PDO($dsn, $config['db_user'], $config['db_pass']);
    }

    // 这是获取当前类对象的唯一方式
    public static function getInstance($config = array())
    {
        // 检查对象是否已经存在，不存在则实例化后保存到$instance属性
        if(self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    // 获取数据库句柄方法
    public function db()
    {
        return $this->db;
    }

    // 声明成私有方法，禁止克隆对象
    private function __clone(){}
    // 声明成私有方法，禁止重建对象
    private function __wakeup(){}
}

$config = array(
    'db_name' => 'tp',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => ''
);

$db1 = Database::getInstance($config);
var_dump($db1);
$db2 = Database::getInstance($config);
var_dump($db2);
$db3 = Database::getInstance($config);
var_dump($db3);