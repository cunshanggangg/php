<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/24
 * Time: 16:56
 */

require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Cell.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';
require_once '../Classes/PHPExcel/Writer/Excel5.php';
include_once '../Classes/PHPExcel/IOFactory.php';

$fileName = "test_excel";
$headArr = array("序号","姓名","年龄","性别");
$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("jdpt1",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");

$sql = "select * from shopnc_order_import";
$result = mysql_query($sql) or die(mysql_error());
$student = array();
$i = 0;
$row_keys = mysql_fetch_assoc($result);
$k26 = array_keys($row_keys);
$all_keys = array_splice($k26,0,30);
$student = array();
$i = 0;
    while($row = mysql_fetch_array($result)) {
//        foreach($row_keys as $value) {
//        $student[$i][$value] = $row[$value];
//        }
        for($j=0;$j<count($all_keys);$j++) {
            $student[$i][$all_keys[$j]] = $row[$all_keys[$j]];
        }
        $i++;
    }

//echo "<pre>";
//print_r($student);
//echo "</pre>";
//$data = array(array(1,2),array(1,3),array(5,7));
getExcel($fileName,$all_keys,$student);


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
    //设置font
//    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
//    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setBold(true);
//    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
//    //水平居中===垂直居中
//    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//    $objPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//    $objSheet = $objPHPExcel->getActiveSheet();
//    $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
//        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //设置水平垂直居中
//    $objSheet->getDefaultStyle()->getFont()->setName("微软雅黑")->setSize(12); //设置默认字体大小
//    $objSheet->getStyle("A1:D1")->getFont()->setSize(16)->setBold(false); //标题字体
//    $objSheet->getStyle('A1:D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//        ->getStartColor()->setARGB('0000000'); //设置标题背景颜色
//    $objSheet->getStyle("A1:F1")->applyFromArray(getBorderStyle("#66FF99")); //设置标题边框
    //设置表头 超过26列
    $key = 0;
    foreach($headArr as $v){
        //注意，不能少了。将列数字转换为字母\
        $colum = PHPExcel_Cell::stringFromColumnIndex($key);
        PHPExcel_Cell::columnIndexFromString('AA');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $key += 1;
    }
    /*
    //设置表头
    $key = ord("A");
    foreach ($headArr as $v) {
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $key += 1;
    }
    */
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

/*
*获得不同颜色的边框
*/
function getBorderStyle($color){
    $styleArray = array(
        'borders' => array(
            'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THICK,
                'color' => array('rgb' => $color),
            ),
        ),
    );
    return $styleArray;
}