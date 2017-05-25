<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/25
 * Time: 15:20
 */
require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Cell.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';
require_once '../Classes/PHPExcel/Writer/Excel5.php';
include_once '../Classes/PHPExcel/IOFactory.php';
//php导出excel表格应该注意的两个问题
//-------------------------------------
// 1.表格的列超出 26的，即大于A-Z
// 2.表格的数据有一连串的数字并会迫使excel使用科学计数法
//-------------------------------------
//ini_set("memory_limit","700M");//设定内存的大小,但无效
//文件名称
$fileName = "test_excel";
//连接数据库
$conn = mysql_connect("localhost","root","") or die("MySQL连接不上！");
$db = mysql_select_db("jdpt",$conn) or die("数据库连接失败！");
mysql_query("set names 'utf8'");
//获得数据
$sql = "select * from shopnc_order_import";
$result = mysql_query($sql) or die(mysql_error());
//保存数据
$data = array();
$i = 0;
//获得第一条数据
$row_keys = mysql_fetch_assoc($result);
//获得数组的键值，即后面excel表格的第一行的字段值
$headArr = array_keys($row_keys);
//切割数组的键值，是否要全部输出
//$all_keys = array_splice($k26,0,90);
$i = 0;
//遍历结果集
while($row = mysql_fetch_array($result)) {
    for($j=0;$j<count($headArr);$j++) {
        $data[$i][$headArr[$j]] = $row[$headArr[$j]];
    }
    $i++;
}

getExcel($fileName,$headArr,$data);


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
    $objSheet = $objPHPExcel->getActiveSheet();
//    $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
//        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //设置水平垂直居中
//    $objSheet->getDefaultStyle()->getFont()->setName("微软雅黑")->setSize(12); //设置默认字体大小
    $objSheet->getStyle("A1:CF1")->getFont()->setSize(16)->setBold(false); //标题字体，必须加上1，否则不显示
//    $objSheet->getStyle('A1:D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
//        ->getStartColor()->setARGB('0000000'); //设置标题背景颜色
//    $objSheet->getStyle("A1:F1")->applyFromArray(getBorderStyle("#66FF99")); //设置标题边框

    //————————————————————————————————设置表头 超过26列 start ——————————————————————————————————————————
    $key = 0;
    foreach($headArr as $v){
        //注意，不能少了。将列数字转换为字母\
        $colum = PHPExcel_Cell::stringFromColumnIndex($key);
//        $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit(($key).'1', $v,PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        //将所有的格式改为文本格式，用途：身份证的号码在excel里保存为科学计数法，后面四位全是0
        $objPHPExcel->getActiveSheet()->getStyle($key)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        //受到由该样例的启发修改而来
        // J列为文本
//    $objPHPExcel->getActiveSheet()->getStyle('J')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $key += 1;
    }

    $column = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();
    foreach($data as $key => $rows){ //行写入
        $span = 0;
        foreach($rows as $keyName=>$value){// 列写入
            $j = PHPExcel_Cell::stringFromColumnIndex($span);
            $objActSheet->setCellValue($j.$column, $value);
            //以下方法无效，但值得思考
//            $objPHPExcel->getActiveSheet()->setCellValueExplicit($j.$column,$value,PHPExcel_Cell_DataType::TYPE_STRING);
//            $objPHPExcel->getActiveSheet()->getStyle('B'.$j)->getNumberFormat()->setFormatCode("@");
            $span++;
        }
        $column++;
    }
    //————————————————————————————————设置表头 超过26列 end —————————————————————————————————————————————
    /*
    //————————————————————————————————设置表头 不大于26列 start —————————————————————————————————————————————
    $key = ord("A");
    foreach ($headArr as $v) {
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $key += 1;
    }
    */
    /*
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
    */
    //————————————————————————————————设置表头 不大于26列 end—————————————————————————————————————————————
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