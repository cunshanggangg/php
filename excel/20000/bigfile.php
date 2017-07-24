<?php

/*
  phpexcel读取大文件demo
  Author:陈杰斌
  Author URI: http://www.01happy.com
 */

//echo memory_get_usage();

include_once __DIR__ . '/PHPExcel.php';

/**
 * 读取excel过滤器
 */
class PHPExcelReadFilter implements PHPExcel_Reader_IReadFilter {

    public $startRow = 1;
    public $endRow;

    public function readCell($column, $row, $worksheetName = '') {
        //如果endRow没有设置表示读取全部
        if (!$this->endRow) {
            return true;
        }
        //只读取指定的行
        if ($row >= $this->startRow && $row <= $this->endRow) {
            return true;
        }

        return false;
    }

}

$startRow  = 1;
$endRow    = null;
$excelFile = __DIR__ . '/data/payment2.xlsx';

$data = readFromExcel($excelFile, null, $startRow, $endRow);
//echo "<pre>";
//echo '总数：'.count($data);
//print_r(array_slice($data,38568,4995,true));
//echo "</pre>";
//echo "<br />";
//echo "<pre>";
//print_r(array_shift($data));
//echo "</pre>";//exit;
echo "<pre>";
print_r($data);

require_once '../class/medoo.php';
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
array_shift($data);
$result = array();
foreach ($data as $k=>$v){
    //!$database->has("order_import",array("im_order_sn"=>$v['B']))
    if(!$database->has("ypl_orders",array("order_sn"=>$v['1'])) && !$database->has("order_import",array("im_order_sn"=>$v['1']))){
        $result[]=$data[$k];
    }
}

//echo "<pre>";
//print_r($result);
echo count($result);
echo "<hr>";
foreach($result as $v1) {
    echo "'".$v1['1'].'<br />';
}
//echo memory_get_usage();

/**
 * 读取excel转换成数组
 * 
 * @param string $excelFile 文件路径
 * @param string $excelType excel后缀格式
 * @param int $startRow 开始读取的行数
 * @param int $endRow 结束读取的行数
 * @retunr array
 */
function readFromExcel($excelFile, $excelType = null, $startRow = 1, $endRow = null) {
    include_once __DIR__ . '/PHPExcel.php';

    $excelReader = \PHPExcel_IOFactory::createReader("Excel2007");
    $excelReader->setReadDataOnly(true);

    //如果有指定行数，则设置过滤器
    if ($startRow && $endRow) {
        $perf           = new PHPExcelReadFilter();
        $perf->startRow = $startRow;
        $perf->endRow   = $endRow;
        $excelReader->setReadFilter($perf);
    }

    $phpexcel    = $excelReader->load($excelFile);
    $activeSheet = $phpexcel->getActiveSheet();
    if (!$endRow) {
        $endRow = $activeSheet->getHighestRow(); //总行数
    }

    $highestColumn      = $activeSheet->getHighestColumn(); //最后列数所对应的字母，例如第2行就是B
    $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //总列数

    $data = array();
    for ($row = $startRow; $row <= $endRow; $row++) {
        for ($col = 0; $col < $highestColumnIndex; $col++) {
            $data[$row][] = (string) $activeSheet->getCellByColumnAndRow($col, $row)->getValue();
        }
    }
    return $data;
}
