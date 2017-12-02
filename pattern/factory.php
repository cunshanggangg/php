<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 10:31
 */
//工厂模式，就是负责生成其他对象的类或方法。
/*
 * 工厂模式是一种类，它具有为您创建对象的某些方法。
 * 您可以使用工厂类创建对象，而不直接使用 new。
 * 这样，如果您想要更改所创建的对象类型，只需更改该工厂即可。
 * 使用该工厂的所有代码会自动更改。
 * */

interface Vehicle
{
    public function drive();
}

class Car implements Vehicle
{
    public function drive()
    {
        echo '汽车靠四个轮子滚动行走。';
    }
}

class Ship implements Vehicle
{
    public function drive()
    {
        echo '轮船靠螺旋桨划水前进。';
    }
}

class Aircraft implements Vehicle
{
    public function drive()
    {
        echo '飞机靠螺旋桨和机翼的升力飞行。';
    }
}
class VehicleFactory
{
    public static function build($className = null)
    {
        $className = ucfirst($className);
        if ($className && class_exists($className)) {
            return new $className();
        }
        return null;
    }
}
VehicleFactory::build('Car')->drive();
echo "<br />";
VehicleFactory::build('Ship')->drive();
echo "<br />";
VehicleFactory::build('Aircraft')->drive();