<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 22:01
 */
//session_start();
//$_SESSION['name'] = 'yaoMing';//保存的位置在：D:software/xampp/tmp下，可以打开，主要看php.ini:save.session_path
//echo $_SESSION['name'];

//将 session 的值保存到memcache中

//1.启动memcache并连接
$m = new Memcache;
$m->connect('localhost','11211');

//2.设置php保存session到memcache中，初始化设置
ini_set("session.save_handler","memcache");
ini_set("session.save_path","tcp://127.0.0.1:11211");

//3.将session值插入到memcache中
session_start();
$_SESSION['name'] = 'yaoMing';
echo session_id();

//获取session的值
$val = $m->get("6je1efh9315rr8nfl6papkcsh5");//这样取值是序列化的session值
echo "<hr>";
//怎么保存就怎么取
echo $_SESSION['name'];

//总结：session还是原来的session，只是保存的位置不一样，一个是磁盘上文件，一个是memcache











