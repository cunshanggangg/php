<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 10:20
 */
/*
缩水随机生成国内ip地址
总共有1600多个网段，只取了其中10个确定是国内的网段
使用了2个php函数

ip2long($ip)把ip转为int

long2ip($int_ip)把int转回ip
*/

$ip_long = array(

    array('607649792', '608174079'), //36.56.0.0-36.63.255.255

    array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255

    array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255

    array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255

    array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255

    array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255

    array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255

    array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255

    array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255

    array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255

);

$rand_key = mt_rand(0, 9);

$ip= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));

echo $ip;

