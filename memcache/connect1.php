<?php
/**
 * Created by PhpStorm.
 * User: linjiabei
 * Date: 2018/5/10
 * Time: 19:12
 */
$m = new Memcache();
//与 new Memcache 的区别：new Memcache()表示有构造函数：__construct()，而new Memcache没有构造函数
if(!$m->connect('localhost','11211')) {
    die("连接失败!");
}

//添加数据
//add 是向服务器添加一个缓存的数据，当该键已存在会返回一个false，否则返回一个true
//if($m->add('key1','beijing',MEMCACHE_COMPRESSED,60)) {
//    echo '添加成功!';
//}

//replace 是向服务器内一个替换一个缓存的数据，当该键不存在时返回一个false，否则返回 true
//if($m->replace('key1','beijing01',MEMCACHE_COMPRESSED,60)) {
//    echo  '替换成功!';
//}

//set 不管键值是否存在，都添加进去
//if($m->set('key2','wuzhou',MEMCACHE_COMPRESSED,60)) {
//    echo "set 成功！";
//}

//添加数组
//$arr = array('yaoming','lina','zhuting','sunyang');
//if($m->set('key3',$arr,MEMCACHE_COMPRESSED)) {
//    echo 'add an array successfully!';
//}
//没有设定时间，
//$val3 = $m->get('key3');
//echo "<pre>";
//print_r($val3);
//echo "</pre>";

//删除数据
//if($m->delete('key3')) {
// echo 'delete successfully!';
//}

//删除所有的数据
//if($m->flush()) {
//    echo "Delete all successfully!";
//}

//添加一个对象
//新建一个类
class Dog {
    public $name;
    public $age;

    public function __construct($name,$age) {
        $this->name = $name;
        $this->age = $age;
    }
}
//实例化一个类
$dog = new Dog('xiaoHuang',15);
if($m->set('key4',$dog,MEMCACHE_COMPRESSED,60)) {
    echo "Add an object successfully...";
}
//获取该对象
$d = $m->get('key4');
echo "<pre>";
print_r($d);
echo "</pre>";


//关闭连接
$m->close();

