<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/22
 * Time: 16:44
 */
//$data = "{jform_le_main:[{id=\"402813815398698b015398698b710000\",name:\"ceshi111111\",sex:1,remark:\"javadeveloper\"}],jform_le_subone:[{main_id=\"402813815398698b015398698b710000\",name:\"ceshi111111\",sex:1,remark:\"java developer\"}],jform_le_submany:[{main_id=\"402813815398698b015398698b710000\",name:\"ceshi111111\",sex:1,remark:\"java developer\"},{name:\"ceshi111111\",sex:1,remark:\"java developer\"}]}";
//echo $data;
$data = "735CE07A2AB9C1872983B09C85A770D9";
$key = "32F72780372E84B6CFAED6F7B19139CC47B1912B6CAED753";

$result = strtoupper(hash_hmac('MD5',$data,$key));

echo "<pre>";
print_r($result);
echo "</pre>";