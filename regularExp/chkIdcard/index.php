<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 14:55
 */
//矫正身份证最后一位的号码
//最后一位有专门的计算公式

/* http://jingyan.baidu.com/article/ff4116259e0a7112e48237b9.html

校验码是识别一个身份证号码是否真实存在的重要的依据。那我们要如何通过校验码来判断一个身份证号码是否真实的呢？

校验码如何判断身份证号码真伪呢？我们来看看具体计划过程。

第一步：将身份证号码的第1位数字与7相乘；将身份证号码的第2位数字与9相乘；将身份证号码的第3位数字与10相乘；将身份证号码的第4位数字与5相乘；将身份证号码的第5位数字与8相乘；将身份证号码的第6位数字与4相乘；将身份证号码的第7位数字与2相乘；将身份证号码的第8位数字与1相乘；将身份证号码的第9位数字与6相乘；将身份证号码的第10位数字与3相乘；将身份证号码的第11位数字与7相乘；将身份证号码的第12位数字与9相乘；将身份证号码的第13位数字与10相乘；将身份证号码的第14位数字与5相乘；将身份证号码的第15位数字与8相乘；将身份证号码的第16位数字与4相乘；将身份证号码的第17位数字与2相乘。

第二步：将第一步身份证号码1~17位相乘的结果求和，全部加起来。

第三步：用第二步计算出来的结果除以11，这样就会出现余数为0，余数为1，余数为2，余数为3，余数为4，余数为5，余数为6，余数为7，余数为8，余数为9，余数为10共11种可能性。

第四步：如果余数为0，那对应的最后一位身份证的号码为1；如果余数为1，那对应的最后一位身份证的号码为0；如果余数为2，那对应的最后一位身份证的号码为X；如果余数为3，那对应的最后一位身份证的号码为9；如果余数为4，那对应的最后一位身份证的号码为8；如果余数为5，那对应的最后一位身份证的号码为7；如果余数为6，那对应的最后一位身份证的号码为6；如果余数为7，那对应的最后一位身份证的号码为5；如果余数为8，那对应的最后一位身份证的号码为4；如果余数为9，那对应的最后一位身份证的号码为3；如果余数为10，那对应的最后一位身份证的号码为2。

比如： 身份证号码 432831196411150810  这个身份证是否是有效身份证号码呢？请看校验码分析。

校验码是0，身份证号码 432831196411150810中最后一位是0，所以这是一个有效的身份证号码。

*/
require_once 'class/medoo.php';
$db = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'tp',      //数据库名称
    'sermatcher'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306, //
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的drimatcher_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
$r = $db->select("tp_address",["id","id_card"]);
//echo "<pre>";
//print_r($r);
//echo "</pre>";
$data = array();
foreach ($r as $k=>$v) {
    $preg = "/\d/";
    preg_match_all($preg,$v['id_card'],$match);
    $sum = $match[0][0]*7+$match[0][1]*9+$match[0][2]*10+$match[0][3]*5+$match[0][4]*8+$match[0][5]*4+$match[0][6]*2+$match[0][7]*1+$match[0][8]*6+$match[0][9]*3+$match[0][10]*7+$match[0][11]*9+$match[0][12]*10+$match[0][13]*5+$match[0][14]*8+$match[0][15]*4+$match[0][16]*2;
    $mod = $sum%11;
//    echo $mod;
    switch($mod) {
        case 0:
            $mod = 1;
            break;
        case 1:
            $mod = 0;
            break;
        case 2:
            $mod = 'X';//如果是小写x，则会出错
            break;
        case 3:
            $mod = 9;
            break;
        case 4:
            $mod = 8;
            break;
        case 5:
            $mod = 7;
            break;
        case 6:
            $mod = 6;
            break;
        case 7:
            $mod = 5;
            break;
        case 8:
            $mod = 4;
            break;
        case 9:
            $mod = 3;
            break;
        case 10:
            $mod = 2;
            break;
    }
    $id_card = substr($v['id_card'],0,-1);
    $id_card = $id_card.$mod;
    $data[$k]['id'] = $v['id'];
    $data[$k]['id_card'] = $id_card;
}
//echo "<pre>";
//print_r($data);
//echo "</pre>";
foreach($data as $k=>$v) {
    $res = $db->update("tp_address",["id_card"=>$v['id_card']],["id"=>$v['id']]);
    echo $res;
}
