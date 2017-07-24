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
//$filePath = 'payment.xlsx';
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
//echo "<pre>";
//print_r($data);exit;
//array_shift($data);
//array_pop($data);
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
    'database_name'=>'jdpt1',      //数据库名称
    'server'=>'192.168.17.39',       //数据库连接地址
    'username'=>'root',  //用户名
    'password'=>'123456',  //密码
    'charset'=>'utf8',            //数据库编码
    // [可选的] 数据库连接端口
    'port'=> 3306,
    // [可选]表前缀
    'prefix'=>'shopnc_',
    // [可选]用于连接的driver_option，阅读更多从http://www.php.net/manual/zh/pdo.setattribute.php
    'option'=> [PDO :: ATTR_CASE => PDO :: CASE_NATURAL]
]);
$result = array();
foreach ($data as $k=>$v){
    //!$database->has("order_import",array("im_order_sn"=>$v['B']))
    if(!$database->has("ypl_orders",array("order_sn"=>$v['B'])) && !$database->has("order_import",array("im_order_sn"=>$v['B']))){
        $result[]=$data[$k];
    }
}

//echo "<pre>";
//print_r($result);
echo count($result);
echo "<hr>";
foreach($result as $v1) {
    echo "'".$v1['B'].'<br />';
}
?>
