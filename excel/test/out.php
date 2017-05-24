<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/24
 * Time: 16:56
 */

require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';
require_once '../Classes/PHPExcel/Writer/Excel5.php';
include_once '../Classes/PHPExcel/IOFactory.php';

$fileName = "test_excel";
$headArr = array("序号","姓名","年龄","性别");
$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("tp",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select * from tp_student";
$result = mysql_query($sql) or die(mysql_error());
$student = array();
$i = 0;
while($row = mysql_fetch_array($result)) {
    $student[$i]['id'] = $row['id'];
    $student[$i]['name'] = $row['name'];
    $student[$i]['age'] = $row['age'];
    $student[$i]['sex'] = $row['sex'];
    $i++;
}
//$data = array(array(1,2),array(1,3),array(5,7));
getExcel($fileName,$headArr,$student);


function getExcel($fileName,$headArr,$data)
{
    if (empty($data) || !is_array($data)) {
        die("data must be a array");
    }
    if (empty($fileName)) {
        exit;
    }
    $date = date("Y_m_d", time());
    $fileName .= "_{$date}.xlsx";

    //创建新的PHPExcel对象
    $objPHPExcel = new PHPExcel();
    $objProps = $objPHPExcel->getProperties();

    //设置表头
    $key = ord("A");
    foreach ($headArr as $v) {
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $key += 1;
    }

    $column = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();
    foreach ($data as $key => $rows) { //行写入
        $span = ord("A");
        foreach ($rows as $keyName => $value) {// 列写入
            $j = chr($span);
            $objActSheet->setCellValue($j . $column, $value);
            $span++;
        }
        $column++;
    }

    $fileName = iconv("utf-8", "gb2312", $fileName);
    //重命名表
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    //设置活动单指数到第一个表,所以Excel打开这是第一个表
    $objPHPExcel->setActiveSheetIndex(0);
    //将输出重定向到一个客户端web浏览器(Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//    if (!empty($_GET['excel'])) {
//        $objWriter->save('php://output'); //文件通过浏览器下载
//    } else {
//          $objWriter->save($fileName); //脚本方式运行，保存在当前目录
//    }

    $objWriter->save('php://output'); //文件通过浏览器下载
    exit;
}