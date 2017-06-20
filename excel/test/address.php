<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 14:06
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
array_shift($data);
array_pop($data);
echo "<pre>";
print_r($data);
echo "</pre>";exit;
//foreach($data as ) {}

$conn = mysql_connect("localhost","root","") or die("MySQL连接失败!");
$db = mysql_select_db("tp",$conn) or die("数据库连接失败!");
mysql_query("set names utf8");

foreach($data as $key => $value) {
    $value['D'] = ($value['D'] == '男') ? 0 : 1;
    $sql ="insert into tp_member (first_name,last_name,birthday,sex,country,id_card,deadline,sign_type,sign_num,sign_org,come_from,to_go,note) VALUES ('{$value['A']}','{$value['B']}','{$value['C']}','{$value['D']}','{$value['E']}','{$value['F']}','{$value['G']}','{$value['H']}','{$value['I']}','{$value['J']}','{$value['K']}','{$value['L']}','{$value['M']}')";
//    echo $sql;
    mysql_query($sql) or die(mysql_error());
}
mysql_close();
?>
