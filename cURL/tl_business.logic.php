<?php
defined('InShopNC') or exit('Access Invalid!');
/**
 * 通联业务类
 * 包含会员注册，充值，订单支付，订单查询。。。。。
 * 所有的通联业务接口类都写在这
 */
class tl_businessLogic{

	/**
	 * [crosscustregister 客户注册(虚拟卡)]
	 * @param  array  $data [description]
	 * @return array       [description]
	 */
	public function crosscustregister(array $data){
		$data['timestamp']= date('YmdHis');
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.crosscustregister.execute');
		$result = $this->_sendTlData($post_url);
		return $result;
	}

	/**
	 * [cardsingletopup 充值,此接口为卡对应的账户充值]
	 * @param  array  $data [description]
	 * @return array       [description]
	 */
	public function cardsingletopup(array $data){
		$data['timestamp']= date('YmdHis');
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.cardsingletopup.add');
		$result = $this->_sendTlData($post_url);
		return $result;
	}

	/**
	 * [crossmulaccpaynew 报关消费(支持卡号或身份证)]
	 * @param  array  $data [description]
	 * @return array       [description]
	 */
	public function crossmulaccpaynew(array $data){
		$time = date('YmdHis');
		$key16 = 'b029083d'; //测试数据密钥：fdb552df  正式数据密钥：b029083d
		$des_obj = new des($key16);
		$data['password']	= $des_obj->encrypt($time.'aop000000');
		$data['timestamp']= $time;
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.crossmulaccpaynew.execute');	 
		$result = $this->_sendTlData($post_url);
		return $result;
	}

	/**
	  * 【crossmulaccrevokenew 报关消费撤销(支持卡号或身份证)】支持当天订单冲正退款
	  *  @param array $data [description]
	  *  @return array [description]
	  */
	public function crossmulaccrevokenew(array $data){
		$time = date('YmdHis');
		$data['timestamp']= $time;
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.crossmulaccrevokenew.execute');
		$result = $this->_sendTlData($post_url);
		return $result;
	}

	/**
	  * 【mulaccconsumeback 消费退回(支持多种账户类型)】支持几天前的订单冲正退款
	  *  @param array $data [description]
	  *  @return array [description]
	  */
	public function mulaccconsumeback(array $data){
		$time = date('YmdHis');
		$data['timestamp']= $time;
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.mulaccconsumeback.execute');
		$result = $this->_sendTlData1($post_url);
		return $result;
	}

	/**
	 * [cardinfo 账户信息查询]
	 * @param  array  $data [description]
	 * @return array       [description]
	 */
	public function cardinfo(array $data){
		$data['timestamp']= date('YmdHis');
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.cardinfo.get');
		$result = $this->_sendTlData($post_url);
		return $result;
	}

	/**
	 * [cardedit 账户信息修改]
	 * @param array $data [description]
	 * @return array [description]
	 */
	public function cardedit(array $data){
		$data['brh_id'] = '0258100008'; //发卡机构号
		$time = date('YmdHis');
		$key16 = 'b029083d'; //测试数据密钥：fdb552df  正式数据密钥：b029083d
		$des_obj = new des($key16);
		$data['password']	= $des_obj->encrypt($time.'aop000000');
		$data['timestamp'] = $time;		
        $post_url = $this->_getSendUrl($data,'allinpay.ppcs.custedit.execute');
        print_r($post_url);
        $result = $this->_sendTlData($post_url);
        print_r($result);
        return $result;
	}

	/**
	 * [txnlog 交易信息查询]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function txnlog(array $data){
		$data['timestamp']= date('YmdHis');
		$post_url = $this->_getSendUrl($data,'allinpay.ppcs.txnlog.search');
		$result = $this->_sendTlData($post_url);
		return $result;
	}

	/**
	 * [_getSendUrl 拼接发送所需的url]
	 * @param  [type] $data [description]
	 * @param  [type] $fun  [方法]
	 * @return string      [description]
	 */
	private function _getSendUrl($data,$fun){
//		$data['app_key'] = 'sd020'; //测试APP_KEY：wwcom  正式APP_KEY：sd020
        $data['app_key'] = 'wwcom';#修改
		$data['format']  = 'json';
		$data['method']  = $fun;
		$data['sign_v']  = '1';
		$data['v']       = '1.0';
		ksort($data);//对数组进行排序
		$data['sign'] = $this->_getSign($data);
		ksort($data);
		 $post_url = 'http://wxtest.ulinkpay.com/aop/rest?'; //#测试网址
//		$post_url = 'https://www.allinpaycard.com/aop/rest?'; //正式环境
		foreach($data as $col=>$item){
			if(preg_match("/[\x{4e00}-\x{9fa5}]+/u",$item) || $col=='password'){
				$post_url.=$col.'='.urlencode($item).'&';
			}else{
				$post_url.=$col.'='.$item.'&';
			}
		}
		$post_url = trim($post_url,'&');
		return $post_url;
	}

	/**
	 * [_getSign 生成签名]
	 * @param  [type] $data [description]
	 * @return string       [大写md5签名]
	 */
	private function _getSign($data){
		$app_secret='sd0201aopreq20160713165910vZm3GYhW';//测试请求密钥:wwcom1aopreq20160530173918a0Mu09gd 正式请求密钥:sd0201aopreq20160713165910vZm3GYhW
		$str = $app_secret;
		foreach($data as $k => $v){
			if(trim($v) !=''){
		        $str.=$k.$v;
		    }
		}
		return strtoupper(md5($str.$app_secret));
	}

	/**
	 * [sendTlData 发送接口]
	 * @param  [type] $data [description]
	 * @return array       [description]
	 */
	private function _sendTlData($post_url){
		$chjk = curl_init ('http://404.php.net/');   // 初始化一个curl会话
		curl_setopt ( $chjk, CURLOPT_URL, $post_url  );   //设置curl会话的接口地址
		curl_setopt ( $chjk, CURLOPT_CUSTOMREQUEST, "GET"  );   //设置请求方式为POST
		curl_setopt ( $chjk, CURLOPT_RETURNTRANSFER, 1 );
        // 设置CURLOPT_RETURNTRANSFER为1，表示如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE
		$ret = curl_exec ( $chjk  );
		$row = json_decode($ret,true);
		return $row;
	}

	/**
	  * [sendTlTohg 触发通联发海关]
	  * @param [type] $data [description]
	  * @return string [description]
	  **/
	public function sendTlTohg($xml_data){
		$URL = "http://113.108.182.4:8090/vnbcustoms/CustomsServlet";
//		$URL = "http://121.8.157.114:17080/vnbapiweb/VnbApiServlet";  //测试URL
//        $URL = "http://121.8.157.114:17090/vnbcustoms/CustomsServlet";  //测试URL
		$ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		// var_dump($output);
		curl_close($ch);
		return $output;
	}

	/**
	 * [payByGateway 通联网关支付]
	 * @param  array  $order [订单数据]
	 * @param  string $modal [数据类型]
	 * @return [type]        [description]
	 */
	public function payByGateway($order,$modal='orders'){
		require_once(BASE_PATH.'/'.ADMIN_MODULES_GATHER.'/api/payment/tonglonlin/tonglonlin.php');
		$pay_data['orders'] = array(
			'order_sn'=>'order_sn',
			'add_time'=>'create_time',
			'order_amount'=>'order_amount',
			'member_idcard'=>'cert_id',
			'member_truename'=>'cust_name',
			'member_email' => 'email',
			'member_mobile' => 'mob_no',
		);

		$pay_data['import'] = array(
			'order_sn'=>'im_order_sn',
			'add_time'=>'create_time',
			'order_amount'=>'order_amount',
			'member_idcard'=>'idcard',
			'member_truename'=>'true_name',
			'member_mobile' => 'tel',
		);
		$data = $this->_getOrderPay($pay_data[$modal],$order);
		$customs = $this->_getCustomsInfo($order);
		$data['ext'] = $modal;
		$data['cus_code'] 		= $customs['cus_code'];
		$data['hg_area_code'] 	= $customs['hg_area_code'];
		$tl_obj = new tonglonlin($data);
		$tl_obj->submit();
	}

	/**
	 * [_getOrderPay 转换成支付需要的数据]
	 * @param  [type] $pay_data [description]
	 * @param  [type] $order    [description]
	 * @return [type]           [description]
	 */
    private function _getOrderPay($pay_data,$order){
        foreach($pay_data as $key=>$val){
            $data[$key] = $order[$val];
        }
        return $data;
    }

	/**
	 * [_getCustomsInfo] [description]
	 * @param $order
	 * @return array
	 */
	private function _getCustomsInfo($order){
		$data = array();
		// 机场关区 5141
		if($order['hg_area_code'] == '5141'){
			$data['cus_code'] 		= $order['hg_area_code'];
			$data['hg_area_code'] 	= '442302';
			if($order['is_collect'] == '1'){
				$data['hg_area_code'] 	= '442301';
			}
		}

		// 罗岗关区 5133
		if($order['hg_area_code'] == '5133'){
			$data['cus_code'] 		= $order['hg_area_code'];
			$data['hg_area_code']	= '440110';
		}

		// 黄埔关区 5208
		if($order['hg_area_code'] == '5208'){
			$data['cus_code'] 		= $order['hg_area_code'];
			$data['hg_area_code']	= '442100';
		}
		return $data;
	}

	/**
	 * [checkBalance 查询会员虚拟卡余额]
	 * @param  array  $cardList [多个会员虚拟卡]
	 * @return [type]           [description]
	 */
	public function checkBalance(array $cardList){
		foreach($cardList['card_no'] as $col=>$item){
			$row = $this->cardinfo(array('card_id'=>$item));
			if(isset($row['error_response'])) showMessage($row['error_response']['sub_msg']);
			$data[$item] = $row['ppcs_cardinfo_get_response']['card_info']['card_product_info_arrays']['card_product_info'][0]['valid_balance'];
			//$data[$item] = '3.00';
		}
		return $data;
	}

	/**
     * [lt_send_xml 发通联海关支付凭证 公共方法]
     * @param  array $order_info [订单信息含报关通道类型]
     * @return true/false
     */
   	public function  lt_send_xml($im_order_sn, $passageway){
   		$order_info = Model('order_import')->getOrderInfo(array('im_order_sn'=>$im_order_sn)); 		
        if ($passageway == 1) {
            $xml_data = $this->getxml_zs($order_info);//走总署版
        }else{
            $xml_data = $this->getxml($order_info); //报关走老广州版
        }
   		  		
   	 
   		$URL = "http://113.108.182.4:8090/vnbcustoms/CustomsServlet";
   		//$URL = "http://121.8.157.114:17080/vnbapiweb/VnbApiServlet";  //测试URL
   		$ch = curl_init($URL);
   		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   		curl_setopt($ch, CURLOPT_POST, 1);
   		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
   		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
   		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   		$ret = curl_exec($ch);  	   	
   	 	 $msg = json_decode(json_encode(simplexml_load_string($ret)),TRUE);
   	 	// print_r($msg);
   	 	// 此处不用改return_status状态，改为发接口成功后再改。2016-08-08
        //     if ($msg['MessageHead']['BizStatus']=='BZ0001') {
        //         $data['return_status'] = '1';    
                         
        //      }else{
        //         $data['return_status'] = '3';
        //         $data['note'] = $msg['MessageBodyList']['MessageBody']['retInfo'];
        //         print_r($xml_data);
        //         print_r($msg);
        //         die();
           
        //     }       
             
	       // $model_import->where(array('im_order_sn'=>$im_order_sn))->update($data); 
	       
            curl_close($ch);
            return  true;
   		
   	}
   	
    //推通联老广州关海关支付报文
   	public function getxml($order_info){ 		
   		$messageid = date("YmdHis").'0001';
   		$sendid = 'S020'; // 测试sendid TEST
   		$sendtime = date('Y-m-d H:i:s',time());
   		$customICP ='PTE51001412220000002'; //$order_info['goods_hs_filing'];   //电商对海关接入企业备案号    
   	    $paytime = date('Y-m-d H:i:s',$order_info['payment_time']);   	  
   	    $paychnlid='08';
		$reurl = ADMIN_SITE_URL."/modules/shop/control/async_tl.php?modal=import";
   		$xml_data_s = '<VnbMessage>' .
   				'<MessageHead>' .
   				'<MessageCode>VNB3PARTY_PAYVOUCHER</MessageCode>' .
   				'<MessageID>'.$messageid.'</MessageID>' .
   				'<SenderID>'.$sendid.'</SenderID>' .
   				'<SendTime>'.$sendtime.'</SendTime>' .
   				'<ReceiptUrl>'.$reurl.'</ReceiptUrl>'.
   				'<Sign></Sign>' .
   				'</MessageHead>' .
   				'<MessageBodyList>' .
   				'<MessageBody>' .
   				'<customICP>'.$customICP.'</customICP>' .
   				'<orderNo>'. $order_info['im_order_sn'].'</orderNo>' .
   				'<payTransactionNo>'. $order_info['pay_no'].'</payTransactionNo>' .   			
   				'<payChnlID>'.$paychnlid.'</payChnlID>' .
   				'<payTime>'.$paytime.'</payTime>' .
   				'<payGoodsAmount>'.$order_info['order_amount'].'</payGoodsAmount>' .
   				'<payTaxAmount>0</payTaxAmount>' .
   				'<freight>0</freight>' .
   				'<payCurrency>142</payCurrency>' .
   				'<payerName>'.$order_info['true_name'].'</payerName>' .
   				'<payerDocumentType>01</payerDocumentType>' .
   				'<payerDocumentNumber>'.$order_info['idcard'].'</payerDocumentNumber>' .
   				'</MessageBody>' .
   				'</MessageBodyList>' .
   				'</VnbMessage>6ADE6061B485456C960A240FA3D76C51'; //测试key:2CB6A4BD056242078EE28B540CD48297
   				$sign = strtoupper(md5($xml_data_s));

   		$xml_data = '<?xml version="1.0" encoding="utf-8"?>' .
   						'<VnbMessage>' .
   						'<MessageHead>' .
   						'<MessageCode>VNB3PARTY_PAYVOUCHER</MessageCode>' .
   						'<MessageID>'.$messageid.'</MessageID>' .
   						'<SenderID>'.$sendid.'</SenderID>' .
   						'<SendTime>'.$sendtime.'</SendTime>' .
   						'<ReceiptUrl>'.$reurl.'</ReceiptUrl>'.
   						'<Sign>'.$sign.'</Sign>' .
   						'</MessageHead>' .
   						'<MessageBodyList>' .
   						'<MessageBody>' .
   						'<customICP>'.$customICP.'</customICP>' .
   						'<orderNo>'. $order_info['im_order_sn'].'</orderNo>' .
   						'<payTransactionNo>'.$order_info['pay_no'].'</payTransactionNo>' .   						
   						'<payChnlID>'.$paychnlid.'</payChnlID>' .
   						'<payTime>'.$paytime.'</payTime>' .
   						'<payGoodsAmount>'.$order_info['order_amount'].'</payGoodsAmount>' .
   						'<payTaxAmount>0</payTaxAmount>' .
   						'<freight>0</freight>' .
   						'<payCurrency>142</payCurrency>' .
   						'<payerName>'.$order_info['true_name'].'</payerName>' .
   						'<payerDocumentType>01</payerDocumentType>' .
   						'<payerDocumentNumber>'.$order_info['idcard'].'</payerDocumentNumber>' .
   						'</MessageBody>' .
   						'</MessageBodyList>' .
   						'</VnbMessage>';
   		return $xml_data;   				
   	}
    
    //推通联总署版海关支付报文 zmerrygo 2016-08-29
    public function getxml_zs($order_info){        
        $messageid = date("YmdHis").'0001';
        $sendid = 'S020'; // 测试sendid TEST
        $sendtime = date('Y-m-d H:i:s',time());
        $customICP ='PTE51001412220000002'; //$order_info['goods_hs_filing'];   //电商对海关接入企业备案号
        $customName = '广州圣地林贰林电子商务有限公司';   //电商平台在海关的备案名称 
        $ciqType = '00'; //国检组织机构类型，南沙国检-01，机场国检-02，不申报国检-00
        $paytime = date('Y-m-d H:i:s',$order_info['payment_time']);       
        $paychnlid='08';
        $xml_data_s = '<VnbMessage>' .
                '<MessageHead>' .
                '<MessageCode>VNB3PARTY_GZEPORT</MessageCode>' .
                '<MessageID>'.$messageid.'</MessageID>' .
                '<SenderID>'.$sendid.'</SenderID>' .
                '<SendTime>'.$sendtime.'</SendTime>' .
                '<Sign></Sign>' .
                '</MessageHead>' .
                '<MessageBodyList>' .
                '<MessageBody>' .
                '<customICP>'.$customICP.'</customICP>' .
                '<customName>'.$customName.'</customName>' .
                '<ciqType>'.$ciqType.'</ciqType>' .
                '<cbepComCode>'.$cbeComCode.'</cbepComCode>' .
                '<orderNo>'. $order_info['im_order_sn'].'</orderNo>' . //电商平台订单编号
                '<payTransactionNo>'. $order_info['pay_no'].'</payTransactionNo>' . //通联支付流水号            
                '<payChnlID>'.$paychnlid.'</payChnlID>' .
                '<payTime>'.$paytime.'</payTime>' .
                '<payGoodsAmount>'.$order_info['order_amount'].'</payGoodsAmount>' . //支付货款，单位(元, 保留2位小数)
                '<payTaxAmount>0</payTaxAmount>' .
                '<freight>0</freight>' .
                '<payCurrency>142</payCurrency>' .
                '<payerName>'.$order_info['true_name'].'</payerName>' . //电商订单注册人姓名
                '<payerDocumentType>01</payerDocumentType>' .
                '<payerDocumentNumber>'.$order_info['idcard'].'</payerDocumentNumber>' . //注册人证件号码
                '</MessageBody>' .
                '</MessageBodyList>' .
                '</VnbMessage>6ADE6061B485456C960A240FA3D76C51'; //测试key:2CB6A4BD056242078EE28B540CD48297
                $sign = strtoupper(md5($xml_data_s));

        $xml_data = '<?xml version="1.0" encoding="utf-8"?>' .
                        '<VnbMessage>' .
                        '<MessageHead>' .
                        '<MessageCode>VNB3PARTY_PAYVOUCHER</MessageCode>' .
                        '<MessageID>'.$messageid.'</MessageID>' .
                        '<SenderID>'.$sendid.'</SenderID>' .
                        '<SendTime>'.$sendtime.'</SendTime>' .
                        '<Sign>'.$sign.'</Sign>' .
                        '</MessageHead>' .
                        '<MessageBodyList>' .
                        '<MessageBody>' .
                        '<customICP>'.$customICP.'</customICP>' .
                        '<customName>'.$customName.'</customName>' .
                        '<ciqType>'.$ciqType.'</ciqType>' .
                        '<cbepComCode>'.$cbeComCode.'</cbepComCode>' .
                        '<orderNo>'. $order_info['im_order_sn'].'</orderNo>' .
                        '<payTransactionNo>'.$order_info['pay_no'].'</payTransactionNo>' .                          
                        '<payChnlID>'.$paychnlid.'</payChnlID>' .
                        '<payTime>'.$paytime.'</payTime>' .
                        '<payGoodsAmount>'.$order_info['order_amount'].'</payGoodsAmount>' .
                        '<payTaxAmount>0</payTaxAmount>' .
                        '<freight>0</freight>' .
                        '<payCurrency>142</payCurrency>' .
                        '<payerName>'.$order_info['true_name'].'</payerName>' .
                        '<payerDocumentType>01</payerDocumentType>' .
                        '<payerDocumentNumber>'.$order_info['idcard'].'</payerDocumentNumber>' .
                        '</MessageBody>' .
                        '</MessageBodyList>' .
                        '</VnbMessage>';
        return $xml_data;                   
    }   

	/**
     * [sendTlData1 退款专用发送接口]
     * @param  [type] $data [description]
     * @return array       [description]
     */
    private function _sendTlData1($post_url){
        $chjk = curl_init ('http://404.php.net/');// 初始化一个curl会话
        curl_setopt($chjk,CURLOPT_URL,$post_url); //设置curl会话的接口地址
        curl_setopt($chjk,CURLOPT_CUSTOMREQUEST,"GET");//设置请求方式为POST
        curl_setopt($chjk,CURLOPT_RETURNTRANSFER,1);// 设置CURLOPT_RETURNTRANSFER为1，表示如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE
        curl_setopt_array(
            $chjk,
            array(
                CURLOPT_URL => $post_url,
                CURLOPT_REFERER => $post_url,
                CURLOPT_AUTOREFERER => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_CONNECTTIMEOUT => 1,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36'
            )
        );

        $ret = curl_exec($chjk);
        $row = json_decode($ret,true);

        curl_close($chjk);

        return $row;
    }	
}