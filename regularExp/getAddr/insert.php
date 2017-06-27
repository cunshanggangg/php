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
//$str = file_get_contents("data/USA.txt");//美国
//$str = file_get_contents("data/Malaysian.txt");//马来西亚
//$str = file_get_contents("data/Korean.txt");//韩国
//$str = file_get_contents("data/Australian.txt");//澳大利亚
//$str = file_get_contents("data/Indian.txt");//印度
//$str = file_get_contents("data/Russian.txt");//俄罗斯
//$str = file_get_contents("data/Canada.txt");//加拿大
//$str = file_get_contents("data/UK.txt");//英国
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
//$str = file_get_contents("data/Iranian.txt");//伊朗
//$str = file_get_contents("data/Burmese.txt");//缅甸
//$str = file_get_contents("data/Polish.txt");//波兰
//$str = file_get_contents("data/Turk.txt");//土耳其
//$str = file_get_contents("data/Pakistani.txt");//巴基斯坦
//$str = file_get_contents("data/Switzer.txt");//瑞士
//$str = file_get_contents("data/Dutch.txt");//荷兰
//$str = file_get_contents("data/Mexican.txt");//墨西哥
//$str = file_get_contents("data/Panamanian.txt");//巴拿马
//$str = file_get_contents("data/Belgian.txt");//比利时
//$str = file_get_contents("data/Portuguese.txt");//葡萄牙
//$str = file_get_contents("data/Kampuchean.txt");//柬埔寨
//$str = file_get_contents("data/Chilean.txt");//智利
//$str = file_get_contents("data/Belarusian.txt");//白俄罗斯
//$str = file_get_contents("data/Argentinean.txt");//阿根廷
//$str = file_get_contents("data/Hungarian.txt");//匈牙利
//$str = file_get_contents("data/Austrian.txt");//奥地利
//$str = file_get_contents("data/Peruvian.txt");//秘鲁
//$str = file_get_contents("data/Egyptian.txt");//埃及
//$str = file_get_contents("data/Kenyan.txt");//肯尼亚
$str = file_get_contents("data/SriLankan.txt");//斯里兰卡










//echo "<pre>";
//echo $str;
$preg = "/(.*)\r\n/";
preg_match_all($preg,$str,$result);
//echo "<pre>";
//print_r($result[1]);
//$res = array_slice($result[1],0,439);//日本：获取393条
//$res = array_slice($result[1],0,300);//美国：获取300条
//$res = array_slice($result[1],0,212);//马来西亚：获取186条
//$res = array_slice($result[1],0,149);//韩国：获取139条
//$res = array_slice($result[1],0,137);//澳大利亚：获取137条
//$res = array_slice($result[1],0,110);//印度：获取109条
//$res = array_slice($result[1],0,75);//俄罗斯：获取74条
//$res = array_slice($result[1],0,70);//加拿大：获取70条
//$res = array_slice($result[1],0,69);//英国：获取69条
//$res = array_slice($result[1],0,56);//新加坡：获取54条
//$res = array_slice($result[1],0,51);//法国：获取51条
//$res = array_slice($result[1],0,50);//越南：获取50条
//$res = array_slice($result[1],0,50);//菲律宾：获取50条
//$res = array_slice($result[1],0,48);//德国：获取48条
//$res = array_slice($result[1],0,47);//孟加拉国：获取46条
//$res = array_slice($result[1],0,42);//印度尼西亚：获取42条
//$res = array_slice($result[1],0,40);//新西兰：获取40条
//$res = array_slice($result[1],0,37);//意大利：获取37条
//$res = array_slice($result[1],0,31);//尼泊尔：获取28条
//$res = array_slice($result[1],0,27);//尼泊尔：获取27条
//$res = array_slice($result[1],0,24);//泰国：获取24条
//$res = array_slice($result[1],0,24);//巴西：获取24条
//$res = array_slice($result[1],0,19);//伊朗：获取19条
//$res = array_slice($result[1],0,16);//缅甸：获取16条
//$res = array_slice($result[1],0,14);//波兰：获取14条
//$res = array_slice($result[1],0,10);//土耳其：获取10条
//$res = array_slice($result[1],0,9);//巴基斯坦：获取9条
//$res = array_slice($result[1],0,8);//瑞士：获取9条
//$res = array_slice($result[1],0,33);//荷兰：获取19条
//$res = array_slice($result[1],0,17);//墨西哥：获取17条
//$res = array_slice($result[1],0,8);//巴拿马：获取8条
//$res = array_slice($result[1],0,7);//比利时：获取7条
//$res = array_slice($result[1],0,7);//葡萄牙：获取7条
//$res = array_slice($result[1],0,7);//柬埔寨：获取7条
//$res = array_slice($result[1],0,7);//智利：获取7条
//$res = array_slice($result[1],0,6);//白俄罗斯：获取6条
//$res = array_slice($result[1],0,6);//阿根廷：获取6条
//$res = array_slice($result[1],0,6);//匈牙利：获取6条
//$res = array_slice($result[1],0,5);//奥地利：获取5条
//$res = array_slice($result[1],0,5);//秘鲁：获取5条
//$res = array_slice($result[1],0,5);//埃及：获取5条
//$res = array_slice($result[1],0,4);//肯尼亚：获取4条
$res = array_slice($result[1],0,4);//斯里兰卡：获取4条

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

//$country = $database->debug()->select("member","*",array("country" => "日本"));
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
//$country = $database->select("member",array("user_id"),array("country" => "缅甸"));
//$country = $database->select("member",array("user_id"),array("country" => "波兰"));
//$country = $database->select("member",array("user_id"),array("country" => "土耳其"));
//$country = $database->select("member",array("user_id"),array("country" => "巴基斯坦"));
//$country = $database->select("member",array("user_id"),array("country" => "瑞士"));
//$country = $database->select("member",array("user_id"),array("country" => "荷兰"));
//$country = $database->select("member",array("user_id"),array("country" => "墨西哥"));
//$country = $database->select("member",array("user_id"),array("country" => "巴拿马"));
//$country = $database->select("member",array("user_id"),array("country" => "比利时"));
//$country = $database->select("member",array("user_id"),array("country" => "葡萄牙"));
//$country = $database->select("member",array("user_id"),array("country" => "柬埔寨"));
//$country = $database->select("member",array("user_id"),array("country" => "智利"));
//$country = $database->select("member",array("user_id"),array("country" => "白俄罗斯"));
//$country = $database->select("member",array("user_id"),array("country" => "阿根廷"));
//$country = $database->select("member",array("user_id"),array("country" => "匈牙利"));
//$country = $database->select("member",array("user_id"),array("country" => "奥地利"));
//$country = $database->select("member",array("user_id"),array("country" => "秘鲁"));
//$country = $database->select("member",array("user_id"),array("country" => "埃及"));
//$country = $database->select("member",array("user_id"),array("country" => "肯尼亚"));
$country = $database->select("member",array("user_id"),array("country" => "斯里兰卡"));



//echo "<pre>";
//print_r($japan);
//foreach($japan as $key => $value) {
//    echo $value['user_id'];
//    echo "<hr>";
//}
foreach($country as $key => $value) {
       $database->update("member",array("address" => $res2[$key]),array("user_id" => $value['user_id']));
}