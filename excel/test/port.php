<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/6
 * Time: 14:06
 */
//error_reporting(E_ALL);

date_default_timezone_set('Asia/ShangHai');

/* 注意：如果文件的大小超过了8M需要改php.ini文件
 * 以下是默认值：
 * post_max_size = 8M
 * upload_max_filesize = 2M
 * memory_limit = 128M
 * 修改对应的大小，最后需要重启apache或者nginx服务器
 * */
/** PHPExcel_IOFactory */
require_once '../Classes/PHPExcel/IOFactory.php';
require_once '../class/medoo.php';

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
echo "<pre>";
print_r($data);exit;
array_shift($data);
array_pop($data);
//echo "<pre>";
//print_r($data);
//echo "<hr>";
//echo $data[0]['E'];
//echo "<hr>";
//var_dump(substr($data[0]['E'],2));//空格无法消除
//echo "</pre>";exit;
//foreach($data as ) {}

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
foreach($data as $key => $value) {
    $database->insert("port",array(
        "port_cn" => $value['A'],
        "port_en" => $value['B'],
        "port_code" => $value['D'],
        "country_cn" => substr($value['E'],2),
        "country_en" => substr($value['F'],2),
        "country_code" => $value['C'],
    ));
}
//foreach($data as $key => $value) {
//    $sql ="insert into tp_port (port_cn,port_en,port_code,country_cn,country_en,country_code) VALUES ('{$value['A']}','{$value['B']}','{$value['D']}','{$value['E']}','{$value['F']}','{$value['C']}')";
////    echo $sql;
//    mysql_query($sql) or die(mysql_error());
//}
//mysql_close();
?>
