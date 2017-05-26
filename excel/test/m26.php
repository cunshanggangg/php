<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/26
 * Time: 9:28
 */
//error_reporting(E_ALL);

date_default_timezone_set('Asia/ShangHai');

/** PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';
//----------------------------------------------
// 解决的问题
// 1.导入的表格超过26列.
// 2.导入的表格有空的列和行.
//----------------------------------------------
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
//echo $allColumn;echo "<hr>";
/**取得一共有多少行*/
$allRow = $currentSheet->getHighestRow();
//echo $allRow;
$arr=array();
for($currentRow = 1;$currentRow <= $allRow;$currentRow++){
    /**从第A列开始输出*/
    $i=0;
    for($currentColumn = 'A'; $currentColumn !=$allColumn; $currentColumn++){//大于26列
        if($i>25){
            $num =ord($currentColumn)+$i;
        }else{
            $num =ord($currentColumn);
        }
        // echo $i.$currentColumn; echo "<br>";

        $val = $currentSheet->getCellByColumnAndRow($num - 65,$currentRow)->getValue(); /*ord()将字符转为十进制数*/


        /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
        // $arr[$currentRow][]=  iconv('utf-8','gb2312', $val)."＼t";
        $arr[$currentRow][] = trim($val);
        $i++;
    }
}
//删除为空的列
/*
foreach ($arr as $key=>$vals){
    $tmp = '';
    foreach($vals as $key2 => $v){
        trim($v);
        if(!$v) {
            unset($arr[$key][$key2]);
        }
    }
}
*/

//删除全部为空的行
/*
foreach ($arr as $key=>$vals){
    $tmp = '';
    foreach($vals as $v){
        $tmp .= $v;
    }
    if(!$tmp) unset($arr[$key]);
}
*/
//array_shift($data);
echo "<pre>";
print_r($arr);
echo "</pre>";
?>
