<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/9/26
 * Time: 16:27
 */
//$data = [
//    "user_id" => 123456, # 网站用户id
//    "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
//    "ip_address" => '127.0.0.1' # 请在此处传输用户请求验证时所携带的IP
//];
//
//echo json_encode($data);

$data = '{"user_id":123456,"client_type":"web","ip_address":"127.0.0.1"}';
$result = json_decode($data,true);
echo "<pre>";
print_r($result);