<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 15:53
 */

error_reporting(0);

/*--------------------------------------------------------------------------------------

   注意：改程序用到的数据在：data/address目录下的address.xlsx. 要用上传的方式，upload.html

 ---------------------------------------------------------------------------------------
*/
date_default_timezone_set('Asia/ShangHai');

/** PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';
//echo "<pre>";
//print_r($_FILES);
//echo "</pre>";exit;

//$filePath = 'tp_info_resource.xlsx';
$filePath = $_FILES['excelData']['tmp_name'];

$PHPExcel = new PHPExcel();

/**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
$PHPReader = new PHPExcel_Reader_Excel2007();
if(!$PHPReader->canRead($filePath)){
    $PHPReader = new PHPExcel_Reader_Excel5();
    if(!$PHPReader->canRead($filePath)){
        echo 'no Excel';
        return ;
    }
}

$PHPExcel = $PHPReader->load($filePath);
/**读取excel文件中的第一个工作表*/
$currentSheet = $PHPExcel->getSheet(0);

/**取得最大的列号*/
$allColumn = $currentSheet->getHighestColumn();
/**取得一共有多少行*/
$allRow = $currentSheet->getHighestRow();
$data = array();
/**从第二行开始输出，因为excel表中第一行为列名*/
for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){//循环读取每个单元格的内容。注意行从1开始，列从A开始
    for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
        $addr = $colIndex.$rowIndex;
//        echo $addr;
//        echo "<hr>";
        $cell = $currentSheet->getCell($addr)->getValue();
//        echo "<pre>";
//        print_r($cell);
//        echo "</pre>";//exit;
        if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
            $cell = $cell->__toString();
        }
        $data[$rowIndex][$colIndex] = $cell;
    }
}
//
//array_shift($data);
//echo count($data);
//echo "<hr>";
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//foreach($data as $k=>$v) {
//    echo "'".$v['B']."'".",";
////    echo $v['A'].",";
//}

//$str = $data[0]['B'];
//echo $str;
//
//$reg = "/(.*?)(省|区|市)(.*?市)(.*?区)/";
//preg_match_all($reg,$str,$match);
//echo "<pre>";
//print_r($match);
//echo "</pre>";
//echo count($data);
//echo "<pre>";
//print_r($data);
//echo "</pre>";
$total = array();
foreach($data as $k => $v ) {
    $str1 = $v['B'];
    $reg = "/(.*?(省|区|市))(.*?(市))(.*?(区|县|市))/";
    preg_match_all($reg,$str1,$match);
    $match[7][0] = $v['A'];//编号
    $match[8][0] = $v['B'];//完整地址
    $total[] = $match;

//    echo "<pre>";
//    print_r($match);
//    echo "</pre>";
}
echo "<pre>";
//print_r($total);
echo "</pre>";

$corr_addr = array();
foreach($total as $k1 => $v1) {
    if(!empty($v1[0])) {
//        $user_id[] = $v1[7];
        $corr_addr[] = $v1;
    }
}

//正确的地址
//echo "<pre>";
//print_r($corr_addr);
//echo "<hr>";
////总数
//echo count($corr_addr);
//刷新省市区
$arr = array();
foreach($corr_addr as $k2=>$v2) {
//    $arr[$k2][0] = $v2[0][0];//省(区，市)市(州)区(市，县)
//    $arr[$k2][1] = $v2[1][0];//省(区，市)
//    $arr[$k2][2] = $v2[3][0];//市(州)
//    $arr[$k2][3] = $v2[5][0];//区(市，县)
//    $arr[$k2][4] = $v2[8][0];//完整地址

    $arr[$k2][0] = $v2[1][0];//省(区，市)
    $arr[$k2][1] = $v2[3][0];//市(州)
    $arr[$k2][2] = $v2[5][0];//区(市，县)
    $arr[$k2][3] = $v2[8][0];//完整地址
}

//echo "<pre>";
//var_dump($arr);

//查询数据库对应的省市区代码
require_once '../class/medoo.php';
$db = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'020',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306, //3629
    // [可选]表前缀
//    'prefix'=>'tb_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
$id = array();
foreach ($arr as $k3 => $v3) {
    $p = $db->select("t_base_citycode",["citycode"],["cityname"=>$v3[0]]);
    $c = $db->select("t_base_citycode",["citycode"],["cityname"=>$v3[1]]);
    $a = $db->select("t_base_citycode",["citycode"],["cityname"=>$v3[2]]);
    if(empty($p) || empty($c)|| empty($a)) {
        $id[] = $k3;
    }
//    echo "<pre>";
//    print_r($p[0]['citycode']);
//    print_r($c[0]['citycode']);
//    print_r($a[0]['citycode']);
    $pca = $p[0]['citycode'].'|'.$c[0]['citycode'].'|'.$a[0]['citycode'];
    $arr[$k3][4] = $pca;
}
//echo "<pre>";
//print_r($arr);
//echo "<hr>";
//echo "<pre>";
//print_r($id);

//删除不符合标准的地址
foreach($id as $k4=>$v4) {
   unset($arr[$v4]);
}

echo count($arr);
$arr_order = array_values($arr);
echo "<pre>";
//print_r(array_values($arr));
//print_r($arr_order);
//测试 start
//$str = "吉林省吉林市昌邑区049乡道和石桦段的交叉口附近";
//echo "<hr>";
//$msg = preg_replace("/(附近)/","",$str);
//echo $msg;
//测试 end
//去除“附近”这两个关键字
foreach($arr_order as $k5=>$v5) {
    $msg = preg_replace("/(附近)/","",$v5[3]);
//    echo $k5.$msg;
//    echo "<pre>";
//    print_r($msg);
//    echo "<br>";
    if(!empty($msg)) {
        $arr_order[$k5][3] = $msg;
    }else{
        $arr_order[$k5][3] = $v5[3];
    }
}

//echo "<pre>";
//print_r($arr_order);

//获取1678条
$arr_s = array_slice($arr_order,1,1678);
//echo "\n";
//echo count($arr_s);
//echo "<pre>";
//print_r($arr_s);

//获取对应的user_id
$user_id = file_get_contents("user_id.txt");
$reg = "/(.*?)\r\n/";
preg_match_all($reg,$user_id,$match);
$result = $match[0];
//echo "<pre>";
//print_r($match[0]);
//echo "</pre>";

//将user_id 插入到数组中
foreach($arr_s as $k6 => $v6) {
    $arr_s[$k6][5] = trim($result[$k6]);
}

//echo "<pre>";
//print_r($arr_s);

//重新组合数组
$address = array();
foreach($arr_s as $k7=>$v7) {
    $address[$k7][0] = $v7[5];
    $address[$k7][1] = $v7[3];
    $address[$k7][2] = $v7[4];
}
//echo "<pre>";
//print_r($address);
//echo "</pre>";

//插入数据库
foreach($address as $k8=>$v8) {
//    $db->insert("tb_address",["user_id"=>$v8[0],"address"=>$v8[1],"addr_code"=>$v8[2]]);
    echo "update shopnc_ypl_member set addr='{$v8[1]}' and addr_code= '{$v8[2]}' where user_id='{$v8[0]}'".';';
    echo "\n";
}
?>