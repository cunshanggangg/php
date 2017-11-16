<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/16
 * Time: 17:09
 */
$arr = array("姚明","李娜","刘翔");
foreach($arr as &$v) {
    echo $v;
    echo "<hr>";
}

//自PHP5起,可以很容易地通过在 $value之前加上&来修改数组的元素。
//此方法将以引用赋值而不是拷贝一个值。
$a = array(1,2,3,4);
foreach ($a as &$value) {
    $value = $value * 2;
}
echo "<pre>";
print_r($a);//数组的结果:array(2,4,6,8);
echo "</pre>";
/* 引用是什么
在 PHP 中引用意味着用不同的名字访问同一个变量内容。这并不像 C 的指针，它们是符号表别名。
注意在 PHP 中，变量名和变量内容是不一样的，因此同样的内容可以有不同的名字。
最接近的比喻是 Unix 的文件名和文件本身 － 变量名是目录条目，而变量内容则是文件本身。
引用可以被看作是 Unix 文件系统中的紧密连接。

引用做什么
PHP 的引用允许你用两个变量来指向同一个内容
 * */
