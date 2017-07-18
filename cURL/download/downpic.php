<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/18
 * Time: 14:57
 */

function test() {
//    $url = 'https://img.alicdn.com/imgextra/i1/202250993/TB2CfoDcpXXXXa1XpXXXXXXXXXX-202250993.jpg';
$url = 'http://www.sd020.com/data/upload/shop/store/goods/1/2015/09/17/1_04958027754911027.jpg';
    $header = array("Connection: Keep-Alive", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Pragma: no-cache", "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3", "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:29.0) Gecko/20100101 Firefox/29.0");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);  //nobody是关键
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

    $content = curl_exec($ch);
    $curlinfo = curl_getinfo($ch);
//    echo "string";
    echo "<pre>";
    print_r($curlinfo);
//关闭连接
    curl_close($ch);

    if ($curlinfo['http_code'] == 200) {
        if ($curlinfo['content_type'] == 'image/jpeg') {
            $exf = '.jpg';
        } else if ($curlinfo['content_type'] == 'image/png') {
            $exf = '.png';
        } else if ($curlinfo['content_type'] == 'image/gif') {
            $exf = '.gif';
        }
//存放图片的路径及图片名称  *****这里注意 你的文件夹是否有创建文件的权限 chomd -R 777 mywenjian
        $filename = date("YmdHis") . uniqid() . $exf;//这里默认是当前文件夹，可以加路径的 可以改为$filepath = '../'.$filename
        $res = file_put_contents($filename, $content);//同样这里就可以改为$res = file_put_contents($filepath, $content);
//        echo $res;
    }
}
test();
