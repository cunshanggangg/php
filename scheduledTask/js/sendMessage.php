<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/2
 * Time: 17:33
 */
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
//exit($_POST);

//$sum = $_POST['num']+10;
//echo $sum;
//exit($sum);
//return $sum;
//echo $_POST['num'];
//echo $_POST['name'];
//echo $_POST['num']+10;
//$arr = array("linn","dddddddddd");
//exit(print_r($arr));

//if($_POST['num'] == '') {

//}
if($_POST['num'] == ''){
    $_POST['num'] = 158;
}else{
    $_POST['num'] = $_POST['num']+10;
}
exit(json_encode($_POST));
//exit(print_r($_POST));
//print_r($_POST);