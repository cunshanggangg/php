<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/22
 * Time: 10:51
 */

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$data['userName'] = $_POST['username'];
$data['password'] = $_POST['password'];

//echo json_encode($data);
exit(json_encode($data));