<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 15:53
 */

//error_reporting(E_ALL);

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
    $reg = "/(.*?(省|区|市))(.*?(市|州))(.*?(区|县|市))/";
    preg_match_all($reg,$str1,$match);
    $match[7] = $v['A'];
    $total[] = $match;

//    echo "<pre>";
//    print_r($match);
//    echo "</pre>";
}
echo "<pre>";
print_r($total);
echo "</pre>";

$user_id = array();
foreach($total as $k1 => $v1) {
    if(empty($v1[0])) {
        $user_id[] = $v1[5];
    }
}

//错误地址的编号
//echo "<pre>";
//print_r($user_id);
foreach($user_id as $k2=>$v2) {
    echo $v2;
    echo "<br>";
}


?>