<?php

class spider_taobao{

	/**
	 * [$_cookie description]
	 * @var string
	 */
	private $_cookie = '';

	/**
	 * [$_header description]
	 * @var string
	 */
	private $_header = '';

	private $_base_url = '';

	/**
	 * [__construct description]
	 */
	public function __construct(){
		//伪造cookie
		$cookie_file = 'cookie.txt';
		$this->_cookie = file_get_contents($cookie_file); 
		$cip = '123.125.68.'.mt_rand(0,254);
		$xip = '125.90.88.'.mt_rand(0,254);
		//伪造请求头
		$this->_header = array(
		        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
		        'Accept-Encoding:gzip,deflate,sdch',
		        'Accept-Language:zh-CN,zh;q=0.8',
		        'CLIENT-IP:'.$cip,
		        'X-FORWARDED-FOR:'.$xip,  
		        //'Accept-Charset:GBK;q=0.7,*;q=0.3',
		        //'Connection:keep-alive',
		        'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
		        //模拟浏览器
		        'user-agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2618.8 Safari/537.36' 
		        //'CLIENT-IP:'.$ip, 
		        //'X-FORWARDED-FOR:'.$ip,
		    );
		$this->_base_url = file_get_contents('url.txt');
	}

	/**
	 * [send_request description]
	 * @return [type] [description]
	 */
	public function send_request(){
		$goods_id = '522045860193';
		$page_num = '1';

		$url = str_replace(array('{$goods_id}','{$page_num}'),array($goods_id,$page_num),$this->_base_url);
		$maxPage = $this->_get_max_page($url);
		if(!$maxPage) die('cookie error');
		if(!file_exists($goods_id.'_content.txt')) @fopen($goods_id.'_content.txt','w');
		$handle = @fopen($goods_id.'_content.txt','a+');

		for($i=0; $i < $maxPage; $i++){
			echo $maxPage."\n";
			echo ($i+1)."\n";
			$url = str_replace(array('{$goods_id}','{$page_num}'),array($goods_id,$i+1),$this->_base_url);
			$row = $this->_send($url);

			//保存评论
			foreach($row['comments'] as $key => $val){
				@fwrite($handle,$val['content']."\n");
			}
			//刷新最大页数
			$maxPage = $row['maxPage'];
			sleep(9);
		}
		@fclose($handle);
		exit('done');
	}

	/**
	 * [_get_max_page description]
	 * @return [type] [description]
	 */
	private function _get_max_page($url){
		$result = $this->_send($url);
		return isset($result['maxPage']) ? $result['maxPage'] : '';
	}

	/**
	 * [_send description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	private function _send($url){
		$ch = curl_init('http://php.net');
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
		curl_setopt($ch, CURLOPT_HEADER,true);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_header);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); //连接结束后保存cookie信息的文件。
		//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch,CURLOPT_COOKIE, $this->_cookie);
		curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com/ ");   //构造来路

		$content = curl_exec($ch);
		print_r(curl_getinfo($ch));
		curl_close($ch);
		if(preg_match_all('/\w+[(]{1}(.*)[)]{1}/',$content,$json)){
			$json_array = $json[1][0];
			$json_str = iconv('GBK','UTF-8',$json_array);
			$json_arr = json_decode($json_str,true);
			return $json_arr;
		}
		return array();
	}
}

$spider = New spider_taobao();
$spider->send_request();
