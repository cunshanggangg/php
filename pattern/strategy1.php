<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 14:27
 */
/*  策略模式定义了一族相同类型的算法，算法之间独立封装，并且可以互换代替。

    这些算法是同一类型问题的多种处理方式，他们具体行为有差别。

    每一个算法、或说每一种处理方式称为一个策略。

    在应用中，就可以根据环境的不同，选择不同的策略来处理问题。

    以数组输出为例。

    数组的输出有序列化输出、JSON字符串输出和数组格式输出等方式。

    每种输出方式都可以独立封装起来，作为一个策略。
 * */
/**
 * 策略接口
 */
interface OutputStrategy
{
    public function render($array);
}

/**
 * 策略类1：返回序列化字符串
 */
class SerializeStrategy implements OutputStrategy
{
    public function render($array)
    {
        return serialize($array);
    }
}

/**
 * 策略类2：返回JSON编码后的字符串
 */
class JsonStrategy implements OutputStrategy
{
    public function render($array)
    {
        return json_encode($array,JSON_UNESCAPED_UNICODE);
    }
}

/**
 * 策略类3：直接返回数组
 */
class ArrayStrategy implements OutputStrategy
{
    public function render($array)
    {
        return $array;
    }
}
$arr = array("姚明","村上岗","林书豪");
$r = JsonStrategy::render($arr);
echo "<pre>";
print_r($r);
echo "</pre>";