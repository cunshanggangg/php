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

	/**
	 * [$_base_url description]
	 * @var string
	 */
	private $_base_url = '';

	/**
	 * [$_goods_info description]
	 * @var array
	 */
	private $_goods_info = array();

	/**
	 * [__construct description]
	 */
	public function __construct($goods_id='522916293606',$store='tm'){
		//伪造cookie
		$cookie_file = 'cookie.txt';
		$this->_cookie = file_get_contents($cookie_file);
		//echo $this->_cookie;
		$cip = '123.125.68.'.mt_rand(0,254);
		$xip = '125.90.88.'.mt_rand(0,254);

		$this->_goods_info['id'] = $goods_id;
		$this->_goods_info['store'] = $store;
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
		$url_arr = explode("\n",file_get_contents('url.txt'));
		$this->_base_url = $url_arr[0];
		if($store == 'tm'){
			$this->_base_url = $url_arr[1];
		}
		//print_r($goods_id);
//		echo "<pre>";
//		print_r($url_arr);
//		echo "</pre>";
	}

	/**
	 * [send_request description]
	 * @return [type] [description]
	 */
	public function send_request(){
		$goods_id = $this->_goods_info['id'];
		//print_r($goods_id);
		$page_num = '1';

		$url = str_replace(array('{$goods_id}','{$page_num}'),array($goods_id,$page_num),$this->_base_url);
		//print_r($url);
		$maxPage = $this->_get_max_page($url);
		//print_r($maxPage);
//		if(!$maxPage) die('cookie error');
		//$maxPage = 1;
		if($maxPage<5) $maxPage=1;
		if(!file_exists($goods_id.'_content.txt')) @fopen($goods_id.'_content.txt','w');
		$handle = @fopen($goods_id.'_content.txt','a+');

		for($i=0; $i < $maxPage; $i++){
			echo $maxPage."\n";
			echo ($i+1)."\n";
			$url = str_replace(array('{$goods_id}','{$page_num}'),array($goods_id,$i+1),$this->_base_url);
			$row = $this->_send($url);
//			print_r($row);

			//保存评论
			$contents = $this->_get_contnet($row);
			$content_str = implode("\n",$contents)."\n";
			@fwrite($handle,$content_str);

			//刷新最大页数
			if($this->_goods_info['store'] == 'tm'){
				echo "now max page:".$row['rateDetail']['paginator']['lastPage']."\n";
				$maxPage = $row['rateDetail']['paginator']['lastPage'];
			}else{
				$maxPage = $row['maxPage'];
			}
			sleep(60);
		}
		@fclose($handle);
		exit('done');
	}

	/**
	 * [_get_max_page description]
	 * @return [type] [description]
	 */
	private function _get_max_page($url){
		//print_r($url);
		$result = $this->_send($url);
		if($this->_goods_info['store'] == 'tm'){
			return isset($result['rateDetail']['paginator']['lastPage']) ? $result['rateDetail']['paginator']['lastPage'] : '';
		}
		return isset($result['maxPage']) ? $result['maxPage'] : '';
	}

	/**
	 * [_get_contnet description]
	 * @return [type] [description]
	 */
	public function _get_contnet($comments){
		if(!$comments) return false;
		//淘宝
		if($this->_goods_info['store'] == 'tb'){
			foreach($comments['comments'] as $key=> $val){
				$content[] = stripslashes($val['content']);
			}
		}else{
			//天猫
			$data = $comments['rateDetail']['rateList'];
			foreach($data as $key=> $val){
				$content[] = stripslashes($val['appendComment']['content']);
			}
		}
		return $content;
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
//		print_r(curl_errno($ch));
//		print_r(curl_getinfo($ch));
		print_r($content);
		$content = iconv('GBK','UTF-8',$content);
		curl_close($ch);
		if(preg_match_all('/\w+[(]{1}(.*)[)]{1}/',$content,$json)){
			$json_str = $json[1][0];
			$json_arr = json_decode((string)$json_str,true);
			return $json_arr;
		}
		return array();
	}
}


//$spider = New spider_taobao($_SERVER['argv'][1],$_SERVER['argv'][2]);
$spider = New spider_taobao();
$spider->send_request();
