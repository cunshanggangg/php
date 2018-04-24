<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 15:46
 */
date_default_timezone_set('Asia/ShangHai');

/** PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';
require_once '../class/medoo.php';
$database = new medoo([
    //必需
    'database_type'=>'mysql',
    'database_name'=>'thinkcmf5',      //数据库名称
    'server'=>'localhost',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306,
    // [可选]表前缀
    'prefix'=>'',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
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
array_shift($data);//去掉第一行
//echo "<pre>";
//print_r($data);
//echo "</pre>";exit;
$d = array();
foreach($data as $k=>$v) {
    $d['goods_code'] = $v['A'];
    $d['add_code'] = $v['B'];
    $d['goods_add'] = $v["A"].$v["B"];
    $d['name'] = $v["C"];
    $d['attribute'] = $v["D"];
    $d['unit_one'] = $v["E"];
    $d['unit_two'] = $v["F"];
    $d['import_rate_d'] = $v["G"];
    $d['import_rate_n'] = $v["H"];
    $d['add_tax'] = $v["I"];
    $d['excise_tax'] = $v["J"];
    $d['supervision'] = $v["K"];

//    $a = $v['A'];
//    $b = $v['B'];
//    $c = $v["A"].$v["B"];
//    $d = $v["C"];
//    $e = $v["D"];
//    $f = $v["E"];
//    $g = $v["F"];
//    $h = $v["G"];
//    $i = $v["H"];
//    $j = $v["I"];
//    $k = $v["J"];
//    $l = $v["K"];
//    echo "<pre>";
//    print_r($d);
//    echo "</pre>";exit;
    $database->insert("cmf_hs_code",$d);
}
//array_pop($data);
//echo "<pre>";
//print_r($data);
//echo "</pre>";//exit;

?>