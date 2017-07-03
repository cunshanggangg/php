<?php
header("Content-type:text/html;charset=utf8");
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

	public $res = '';
	/**
	 * [__construct description]
	 */
	public function __construct($goods_id='522916293606',$store='tb'){
		//伪造cookie
//		$cookie_file = 'cookie.wangjh.txt';
//		$this->_cookie = file_get_contents($cookie_file);
		$cip = '123.125.68.'.mt_rand(0,254);
		$xip = '125.90.88.'.mt_rand(0,254);

		$this->_goods_info['id'] = $goods_id;
		$this->_goods_info['store'] = $store;
		//伪造请求头
		$this->_header = array(
		        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
		        'Accept-Encoding:gzip,deflate,sdch',
		        'Accept-Language:zh-CN,zh;q=0.8,en;q-0.6,zh-TW;q=0.4',
				'cache-control:no-cache',
				'pragma:no-cache',
//		        'CLIENT-IP:'.$cip,
				'upgrade-insecure-requests:1',
//		        'X-FORWARDED-FOR:'.$xip,
		        //'Accept-Charset:GBK;q=0.7,*;q=0.3',
		        //'Connection:keep-alive',
		        'Content-Type:application/x-www-form-urlencoded;charset=UTF-8',
		        //模拟浏览器
		        'user-agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36'
		        //'CLIENT-IP:'.$ip, 
		        //'X-FORWARDED-FOR:'.$ip,
		    );
		$this->_base_url ='https://rate.tmall.com/list_detail_rate.htm?itemId=522916293606&sellerId=725677994';

		$res = stripslashes(file_get_contents($this->_base_url));
		$this->res = trim($res, "\xEF\xBB\xBF");
		/*
		$url_arr = explode("\n",file_get_contents('url.txt'));

		$this->_base_url = $url_arr[0];
		if($store == 'tm'){
			$this->_base_url = $url_arr[1];
		}*/
	}

	/**
	 * [send_request description]
	 * @return [type] [description]
	 */
	public function send_request(){
		$goods_id = $this->_goods_info['id'];
		$page_num = '1';

//		$url = str_replace(array('{$goods_id}','{$page_num}'),array($goods_id,$page_num),$this->_base_url);
		$url = $this->_base_url;
//		$maxPage = $this->_get_max_page($url);
//		if(!$maxPage) die('cookie error');
//		if($maxPage<5)
		$maxPage=1;
		$this->_send($this->_base_url);

		exit;
		if(!file_exists($goods_id.'_content.txt')) @fopen($goods_id.'_content.txt','w');
		$handle = @fopen($goods_id.'_content.txt','a+');

		for($i=0; $i < $maxPage; $i++){
			$url = str_replace(array('{$goods_id}','{$page_num}'),array($goods_id,$i+1),$this->_base_url);
			$row = $this->_send($url);

			//保存评论
			$contents = $this->_get_contnet($row);

			$content_str = implode("\n",$contents)."\n";
			@fwrite($handle,$content_str);

			//刷新最大页数
			if($this->_goods_info['store'] == 'tm'){
				echo "now max page:".$row['rateDetail']['paginator']['lastPage']."\n";
				$maxPage = $row['rateDetail']['paginator']['lastPage'];
			}else{
				$maxPage = 1;
			}
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
		$url ='https://rate.tmall.com/list_detail_rate.htm';
		$url = 'https://www.baidu.com';
		$url ='https://rate.tmall.com/list_detail_rate.htm?itemId=522916293606&sellerIds=725677994';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//		curl_setopt($ch, CURLOPT_SSLVERSION, 1);
//		curl_setopt($ch, CURLOPT_HEADER,true);
//		curl_setopt($ch, CURLOPT_ENCODING, "gzip" );
//		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_header);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); //连接结束后保存cookie信息的文件。
		//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch,CURLOPT_COOKIE, $this->_cookie);

		$content = curl_exec($ch);
		var_dump($content);
		$content = iconv('GBK','UTF-8',$content);
		print_r($content);
		curl_close($ch);
		exit;
		if(preg_match_all('/\w+[(]{1}(.*)[)]{1}/',$content,$json)){
			$json_str = $json[1][0];
			$json_arr = json_decode((string)$json_str,true);
			return $json_arr;
		}
		return array();
	}

	public function addToFile(){
		$str = $this->res;
		$strRemain = stripslashes(trim(substr($str,17)));
		$strRemain = iconv('GBK','UTF-8',$strRemain);
		$file = 'res_'.rand(10,200).'.txt';
		$fp = fopen($file,'a');
		fwrite($fp,$strRemain);
//		echo $strRemain;
		return $strRemain;
	}


	public function parseStr($str){
		$arr = json_decode($str,true);
//		echo json_encode($arr['rateList']);
		foreach($arr['rateList'] as $key=>$val){
			echo $val['rateContent'];
			echo '<br>';
		}
		return $arr['rateList'];

	}

}

$spider = New spider_taobao();
$res = $spider->addToFile();
$spider->parseStr($res);


