<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 15:31
 */
require_once 'class/medoo.php';
//获得数组中相同的元素
function repeat($array) {
    $len = count ( $array );
    $repeat_arr = array();
    for($i = 0; $i < $len; $i ++) {
        for($j = $i + 1; $j < $len; $j ++) {
            if ($array [$i] == $array [$j]) {
                $repeat_arr [] = $array [$i];
                break;
            }
        }
    }
    return $repeat_arr;
}
//$str = file_get_contents("data/Japanese.txt");//日本
//$str = file_get_contents("data/American.txt");//美国
//$str = file_get_contents("data/Malaysian.txt");//马来西亚
//$str = file_get_contents("data/Korean.txt");//韩国
//$str = file_get_contents("data/Australian.txt");//澳大利亚
//$str = file_get_contents("data/Indian.txt");//印度
//$str = file_get_contents("data/Russian.txt");//俄罗斯
//$str = file_get_contents("data/Canadian.txt");//加拿大
//$str = file_get_contents("data/Britisher.txt");//英国
//$str = file_get_contents("data/Singaporean.txt");//新加坡
//$str = file_get_contents("data/French.txt");//法国
//$str = file_get_contents("data/Vietnamese.txt");//越南
//$str = file_get_contents("data/Filipino.txt");//菲律宾
//$str = file_get_contents("data/German.txt");//德国
//$str = file_get_contents("data/Bengalese.txt");//孟加拉国
//$str = file_get_contents("data/Indonesian.txt");//印度尼西亚
//$str = file_get_contents("data/NewZealander.txt");//新西兰
//$str = file_get_contents("data/Italian.txt");//意大利
//$str = file_get_contents("data/Nepali.txt");//尼泊尔
//$str = file_get_contents("data/Spanish.txt");//西班牙
//$str = file_get_contents("data/Thai.txt");//泰国
//$str = file_get_contents("data/Brazilian.txt");//巴西
//$str = file_get_contents("data/Irani.txt");//伊朗
//$str = file_get_contents("data/Dutchman.txt");//荷兰
$str = file_get_contents("data/Mexican.txt");//墨西哥
//$str = file_get_contents("data/Burmese.txt");//缅甸






//echo "<pre>";
//echo $str;
$preg = "/(.*)\r\n/";
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result[1]);
//$res = array_slice($result[1],0,445);//日本：获取393条
//$res = array_slice($result[1],0,350);//美国：获取300条
//$res = array_slice($result[1],0,186);//马来西亚：获取186条
//$res = array_slice($result[1],0,139);//韩国：获取139条
//$res = array_slice($result[1],0,137);//澳大利亚：获取137条
//$res = array_slice($result[1],0,109);//印度：获取109条
//$res = array_slice($result[1],0,74);//俄罗斯：获取74条
//$res = array_slice($result[1],0,70);//加拿大：获取70条
//$res = array_slice($result[1],0,69);//英国：获取69条
//$res = array_slice($result[1],0,54);//新加坡：获取54条
//$res = array_slice($result[1],0,51);//法国：获取51条
//$res = array_slice($result[1],0,50);//越南：获取50条
//$res = array_slice($result[1],0,50);//菲律宾：获取50条
//$res = array_slice($result[1],0,48);//德国：获取48条
//$res = array_slice($result[1],0,46);//孟加拉国：获取46条
//$res = array_slice($result[1],0,43);//印度尼西亚：获取42条
//$res = array_slice($result[1],0,40);//新西兰：获取40条
//$res = array_slice($result[1],0,37);//意大利：获取37条
//$res = array_slice($result[1],0,31);//尼泊尔：获取28条
//$res = array_slice($result[1],0,27);//西班牙：获取27条
//$res = array_slice($result[1],0,24);//泰国：获取24条
//$res = array_slice($result[1],0,24);//巴西：获取24条
//$res = array_slice($result[1],0,19);//伊朗：获取19条
//$res = array_slice($result[1],0,19);//荷兰：获取19条
$res = array_slice($result[1],0,17);//墨西哥：获取17条
//$res = array_slice($result[1],0,16);//缅甸：获取16条

//echo "<pre>";
//print_r($res);
//去掉重复的值
$res1 = array_unique($res);
//echo "<pre>";
//print_r(array_values($res1));
$res2 = array_values($res1);
echo "<pre>";
print_r($res2);
//if(count($res) != count(array_unique($res))) {
//    echo "数组有重复";
//    echo count($res);
//    echo "<hr>";
//    echo count(array_unique($res));
//}
//输出重复的数组
//echo "<pre>";
//print_r(repeat($res));

//将数组打乱
//shuffle($res);
//echo "<pre>";
//print_r($res);
//连接数据库
$database = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'tp',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306,
    // [可选]表前缀
    'prefix'=>'tp_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);

//$country = $database->select("member","*",array("country" => "日本"));
//$country = $database->select("member",array("user_id"),array("country" => "美国"));
//$country = $database->select("member",array("user_id"),array("country" => "马来西亚"));
//$country = $database->select("member",array("user_id"),array("country" => "韩国"));
//$country = $database->select("member",array("user_id"),array("country" => "澳大利亚"));
//$country = $database->select("member",array("user_id"),array("country" => "印度"));
//$country = $database->select("member",array("user_id"),array("country" => "俄罗斯"));
//$country = $database->select("member",array("user_id"),array("country" => "加拿大"));
//$country = $database->select("member",array("user_id"),array("country" => "英国"));
//$country = $database->select("member",array("user_id"),array("country" => "新加坡"));
//$country = $database->select("member",array("user_id"),array("country" => "法国"));
//$country = $database->select("member",array("user_id"),array("country" => "越南"));
//$country = $database->select("member",array("user_id"),array("country" => "菲律宾"));
//$country = $database->select("member",array("user_id"),array("country" => "德国"));
//$country = $database->select("member",array("user_id"),array("country" => "孟加拉国"));
//$country = $database->select("member",array("user_id"),array("country" => "印度尼西亚"));
//$country = $database->select("member",array("user_id"),array("country" => "新西兰"));
//$country = $database->select("member",array("user_id"),array("country" => "意大利"));
//$country = $database->select("member",array("user_id"),array("country" => "尼泊尔"));
//$country = $database->select("member",array("user_id"),array("country" => "西班牙"));
//$country = $database->select("member",array("user_id"),array("country" => "泰国"));
//$country = $database->select("member",array("user_id"),array("country" => "巴西"));
//$country = $database->select("member",array("user_id"),array("country" => "伊朗"));
//$country = $database->select("member",array("user_id"),array("country" => "荷兰"));
$country = $database->select("member",array("user_id"),array("country" => "墨西哥"));
//$country = $database->select("member",array("user_id"),array("country" => "缅甸"));


echo "<pre>";
print_r($country);
//foreach($japan as $key => $value) {
//    echo $value['user_id'];
//    echo "<hr>";
//}
foreach($country as $key => $value) {
       $database->update("member",array("phone" => $res2[$key]),array("user_id" => $value['user_id']));
}