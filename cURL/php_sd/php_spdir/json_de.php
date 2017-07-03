<?php

$content = file_get_contents('json_data.txt');
echo "<pre>";
print_r(json_decode($content,true));
echo "</pre>";

//header("Content-type:text/html;Charset=GBK");  
// $url = 'https://rate.taobao.com/feedRateList.htm?auctionNumId=537860486220&userNumId=2880260946&currentPageNum=2&pageSize=30&rateType=&orderType=sort_weight&attribute=&sku=&hasSku=false&folded=0&ua=102UW5TcyMNYQwiAiwQRHhBfEF8QXtHcklnMWc%3D%7CUm5OcktxSn9EekB5QHxBey0%3D%7CU2xMHDJ7G2AHYg8hAS8WIgwsAkQlQz9OYDZg%7CVGhXd1llXGZdaFNtV25Xa1ZsW2ZEek9zTnpOcE51T3dIcE14R2k%2F%7CVWldfS0RMQ4wECwVNRtqVDkMJRgkHiIIMwciByl%2FKQ%3D%3D%7CVmJCbEIU%7CV2lJGSYfPwQ8HCAeJRg4Az8GMxMvFi8SMgY7BiYaJB4mBjMJMmQy%7CWGFcYUF8XGNDf0Z6WmRcZkZ8R2dZDw%3D%3D&_ksTS=1476863744367_1009&callback=jsonp_tbcrate_reviews_list';


// //伪造请求头
// $header = array(
//         'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
//         'Accept-Encoding:gzip,deflate,sdch',
//         'Accept-Language:zh-CN,zh;q=0.8',
//         //'Accept-Charset:GBK;q=0.7,*;q=0.3',
//         //'Connection:keep-alive',
//         'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
//         //模拟浏览器
//         'user-agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2618.8 Safari/537.36' 
//         //'CLIENT-IP:'.$ip, 
//         //'X-FORWARDED-FOR:'.$ip,
//     );

//伪造cookie
// $cookie='thw=cn; cna=aewdD2TklG8CAQ4XlfrNblaT; miid=8466090906901989338; x=e%3D1%26p%3D*%26s%3D0%26c%3D0%26f%3D0%26g%3D0%26t%3D0%26__ll%3D-1%26_ato%3D0; v=0; _tb_token_=PDJdL8sXzp; linezing_session=XAka2BjirnEjnntKqlSzOb5l_1476864199004nwtn_1; _mw_us_time_=1476866951761; uc3=sg2=Vq1Fxq68%2FpyMvlATNaSbp%2FumC1VenLuFVBtFtopOiWU%3D&nk2=Ghzb%2Bqhe4Tpk&id2=W8t3v0S1TS7V&vt3=F8dAS18yzVcucUJve0E%3D&lg2=W5iHLLyFOGW7aA%3D%3D; existShop=MTQ3Njg2Njk4MA%3D%3D; uss=URoubvpWqTTKkOLxVf3XU24WnkRVwddUfw4sfr18yIvI3WaQSyllkYSKWg%3D%3D; lgc=ywend2954; tracknick=ywend2954; cookie2=1ccc9a8449498e9745ed587da4f1e6cd; sg=42b; cookie1=Vv12EZodM5Tgmho5GFe2gDV7TB%2FwenTBV6Nw0z90I2c%3D; unb=823186042; skt=d1abce6a0e02bb79; t=3279b60ede77808667e2ac19272394d6; publishItemObj=Ng%3D%3D; _cc_=WqG3DMC9EA%3D%3D; tg=0; _l_g_=Ug%3D%3D; _nk_=ywend2954; cookie17=W8t3v0S1TS7V; mt=ci=0_1; uc1=cookie14=UoWwIqdww%2FHJtQ%3D%3D&lng=zh_CN&cookie16=UtASsssmPlP%2Ff1IHDsDaPRu%2BPw%3D%3D&existShop=false&cookie21=U%2BGCWk%2F7pY%2FF&tag=2&cookie15=WqG3DMC9VAQiUQ%3D%3D&pas=0; l=AqKiH3sngyV-VTYDWJ4mgsObciIFuaYA; isg=AhgYsdha9Py94dcJG8e54Hqu6U9j-1PlokcUOlIILtML7bvX-xCoG6KLQ5Kn';

// $ch = curl_init('http://php.net');
// curl_setopt($ch , CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSLVERSION, 1);
// curl_setopt($ch, CURLOPT_HEADER,true);
// curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
// curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
// //curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); //连接结束后保存cookie信息的文件。
// //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
// curl_setopt($ch,CURLOPT_COOKIE, $cookie);

// $content = curl_exec($ch);
// if(preg_match_all('/\w+[(]{1}(.*)[)]{1}/',$content,$json)){
// 	$json_array = $json[1][0];
// 	$json_str = iconv('GBK','UTF-8',$json_array);
// 	$json_arr = json_decode($json_str,true);
// 	$con = $json_arr['comments'];
// 	foreach($con as $key=>$val){
// 		echo $val['content']."\n";
// 	}
// }else{
// 	'no content';
// }
// 
// //echo "<pre> 错误信息：";print_r(curl_error($ch));echo "</pre>";  
//echo "<pre> curl_info:";print_r(curl_getinfo($ch));echo "</pre>";  
//echo "</br>",$content; 

/*$submit_url = "https://sitename/process.php"; 

$curl = curl_init(); 

curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ; 
curl_setopt($curl, CURLOPT_USERPWD, "username:password"); 
curl_setopt($curl, CURLOPT_SSLVERSION,3); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($curl, CURLOPT_HEADER, true); 
curl_setopt($curl, CURLOPT_POST, true); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $params ); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
curl_setopt($curl, CURLOPT_URL, $submit_url); 

$data = split("text/html", curl_exec($curl) ); 
$temp = split("\r\n", $data[1]) ; 

$result = unserialize( $temp[2] ) ; 

print_r($result); 
curl_close($curl); */