<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 16:21
 */
function addToFile($good_id,$seller_id){
    date_default_timezone_set('PRC');
    $strRemain = file_get_contents("https://rate.tmall.com/list_detail_rate.htm?itemId=$good_id&sellerId=$seller_id&order=1100&currentPage=1");
    $strRemain = stripslashes(trim(substr($strRemain, 17)));
    $strRemain = iconv('GBK', 'UTF-8', $strRemain);
    $file = 'tmRateSpide_'.date('ymdHis').'.txt';
    $fp = fopen($file, 'a');
    fwrite($fp, $strRemain);
//		echo $strRemain;
    return $strRemain;
}


function parseStr($str){
    $arr = json_decode($str,true);
//    echo "<pre>";
//    print_r($arr);
//    echo "</pre>";
    $a = array();
//		echo json_encode($arr['rateList']);
    foreach($arr['rateList'] as $key=>$val){
        $a[$key][0]=$val['rateDate'];
        $a[$key][1]=$val['rateContent'];
    }

    echo "<pre>";
    echo print_r($a);
    echo "</pre>";
//    return $arr['rateList'];
}

//parseStr(addToFile(529460804269,2838892713));
parseStr(addToFile(537536530819,1714128138));

