<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 11:16
 */
//date_default_timezone_set('PRC');
//$rateContent = file_get_contents("https://rate.tmall.com/list_detail_rate.htm?itemId=538921269672&sellerId=1714128138&order=1100&currentPage=1");
//$rateContent = iconv('GBK','UTF-8',$rateContent);
//file_put_contents('D:/www/htdocs/tmRateSpider/content.txt',$rateContent);
//echo $rateContent;
//echo $rateContent;
//json_decode($rateContent);
//$rateContent = substr($rateContent,17);
//var_dump(json_encode($rateContent,true));
//$a = "$rateContent";
//echo "<pre>";
//var_dump(json_decode($rateContent,true));
//echo "</pre>";
//json_encode($rateContent);
//preg_match_all('/\w+[(]{1}(.*)[)]{1}/',$rateContent,$json);
//$json_str = $json[1][0];
//$json_arr = json_decode((string)$json_str,true);

//if(preg_match_all('/\w+[(]{1}(.*)[)]{1}/',$rateContent,$json)){
//    $json_str = $json[1][0];
//    $json_arr = json_decode((string)$json_str,true);
//    echo "<pre>";
//    print_r($json_arr);
//    echo "</pre>";
//}

function addToFile($good_id,$seller_id=""){
    date_default_timezone_set('PRC');
    $strRemain = file_get_contents("https://rate.tmall.com/list_detail_rate.htm?itemId=$good_id&sellerId=$seller_id&order=1100&currentPage=1");
    $strRemain = stripslashes(trim(substr($strRemain, 17)));
    $strRemain = iconv('GBK', 'UTF-8', $strRemain);
    $file = 'tmRateSpide_' . date('ymdHis') . '.txt';
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
//        echo $key."=>".$val['rateContent'];
//        echo '<br>';
//        echo "<pre>";
//        print_r($arr);
//        echo print_r($val['rateContent']);
//        echo "</pre>";
//        echo $key;
//        echo $val['rateContent'];
//        echo "<br>";
        array_push($a,$val['rateContent']);

    }

    echo "<pre>";
    echo print_r($a);
    echo "</pre>";
//    return $arr['rateList'];
}

//parseStr(addToFile(538921269672,1714128138));
//parseStr(addToFile(527089823402,1718039157));
//parseStr(addToFile(520381409976,648476316));529460804269
parseStr(addToFile(529460804269,2838892713));
//echo $val;

