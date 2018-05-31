<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/26
 * Time: 14:54
 */
//验证数组array与对象object的区别：
/*
1.数组：有序的数据集合，对象：无序的数据集合

2.数组中有key（键值），对象中有name（属性）

3.访问数组是直接加键值，访问对象直接是->
*/
$arr = array('foo'=>'bar','bar'=>'foo');

class Foo{
    //构造函数，无参数
//    public function __construct() {
//        echo "hello";
//    }

    //构造函数，有参数
//    public function __construct($name) {
//        echo "hello ".$name;
//    }
    public function do_foo() {
        echo "do foo";
    }
}
//构造函数没有参数：new Foo()与new Foo一样
#$obj = new Foo();
#echo $obj->do_foo();//输出：hello foo

//构造函数有参数的：必须new Foo()
#$obj1 = new Foo("Yaoming");
#echo $obj1->do_foo();//输出：hello Yaomingdo foo

//测试 数组和对象
$obj2 = new Foo();
echo "<pre>";
print_r(serialize($arr));
echo "</pre>";
echo "<hr>";
echo "<pre>";
print_r(serialize($obj2));
echo "</pre>";