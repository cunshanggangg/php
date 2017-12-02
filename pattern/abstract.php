<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 15:02
 */
abstract class A
{
    /** 抽象类中可以定义变量 */
    protected $value1 = 0;
    private $value2 = 1;
    public $value3 = 2;
    /** 也可以定义非抽象方法 */
    public function my_print()
    {
        echo "hello,world/n";
//        echo "<hr>";
//        echo $this->value2;
    }
    /**
     * 大多数情况下，抽象类至少含有一个抽象方法。抽象方法用abstract关键字声明，其中不能有具体内容。
     * 可以像声明普通类方法那样声明抽象方法，但是要以分号而不是方法体结束。也就是说抽象方法在抽象类中不能被实现，也就是没有函数体“{some codes}”。
     */
    abstract protected function abstract_func1();
    abstract protected function abstract_func2();
}
abstract class B extends A
{
    public function abstract_func1()
    {
//        echo $value3;
        echo "implement the abstract_func1 in class A \n";
    }
    /** 这么写在zend studio 8中会报错*/
    //abstract protected function abstract_func2();
}
class C extends B
{
    public function abstract_func2()
    {
        echo "implement the abstract_func2 in class A \n";
    }
}
//$obj = new C();
//$obj::abstract_func1();
//$obj::abstract_func2();

//echo "<hr>";
//$obj->my_print();
//抽象类不用实例化
echo "<pre>";
C::abstract_func1();
echo "</pre>";