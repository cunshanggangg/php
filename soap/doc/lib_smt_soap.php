<?php

/**
 * Created by PhpStorm.
 * User: wtf
 * Date: 17-4-25
 * Time: 下午6:57
 *      |\___/|
 *     ( -. -  )
 */
class smt_soap
{
    /**
     * [$_sign_key description]
     * @var string
     */
    private $_sign_key = '32F72780372E84B6CFAED6F7B19139CC47B1912B6CAED753';

    /**
     * [$_http_url description]
     * @var string
     */
    // private $_soap_url = 'http://localhost:8080/jeecg/cxf/SmtCompanyServiceI?wsdl';
    private $_soap_url = 'http://192.168.17.218:9090/jeecg/cxf/SmtCompanyServiceI?wsdl'; //'http://www.i1039.com:8080/smt/cxf/SmtCompanyServiceI?wsdl';

    /**
     * @var string
     */
    private $_method = '';

    /**
     * @var bool
     */
    public $debug = false;

    /**
     * [_createMd5Sign] [description]
     * @param $str
     * @return string
     */
    private function _createMd5Sign($str){
        return strtoupper(md5($str));
    }

    /**
     * [_getData description]
     * @return string [description]
     */
    private function _getData(){
        $data 			= array();
        $data['data'] 	= array();
        $data['method'] = $this->_method;
        ksort($data);
        $data['key'] 	= $this->_sign_key;
        return $data;
    }

    /**
     * [_toUrlParams] [description]
     * @param $data
     * @return string
     */
    private function _toUrlParams($data){
        $buff = '';
        foreach($data as $col => $item){
            if($col != 'sign' && $item != '' && !is_array($item)){
                $buff .= $col .'='. $item .'&';
            }
        }
        $buff = trim($buff,'&');
        return $buff;
    }

    /**
     * [sendInterface] [description]
     * @param $data_arr
     * @param $method
     * @param $callBack
     * @return bool
     */
    public function sendInterface($data_arr,$method,$callBack){
        date_default_timezone_set("PRC");
        if(empty($method) || !$data_arr){
            return false;
        }
        $this->_method  = $method;
        $data 			= $this->_getData();
        $data['data']   = json_encode($data_arr);
        $data_string    = $this->_toUrlParams($data);
        $sign 			= $this->_createMd5Sign($data_string);
        $data['sign'] 	= $sign;

        if($this->debug){
            $msg = ' Sign: ' . $data['sign'];
            $msg .= "\n\t\tmethod: " . $method;
            $msg .= "\n\t\tdata: " . $data['data'];
            self::log($msg);
        }
//        echo $data;
//        exit;
        $res = $this->_sendDataBySoap($data,'cxfService');
        // print_r($res);
        // var_dump($this->debug);die;
        return $callBack($res,$data_arr);
    }

    /**
     * To中台会员单点登录
     * [sendLoginInterface] [description]
     * @param $data_arr
     * @return bool
     * zm 2017-05-25
     */
    public function sendLoginInterface($data_str,$fun){
        $data_string = 'userName='.$data_str.'&'.'key='.$this->_sign_key;
        $sign           = $this->_createMd5Sign($data_string);
        $data['sign'] = $sign;
        $data['userName'] = $data_str;
        $soap_obj = new SoapClient($this->_soap_url,array('cache_wsdl'=>0,'compression'=>true));
        $re = $soap_obj->$fun($data);
        $re_back = json_decode(json_encode($re),true);
        $re_return = json_decode($re_back['return'],true);
        self::log('TO=>ztlogin:'.$data['userName'].'||token:'.$re_return['token']);
        if ($re_return['status'] == '1') {
            return $re_return['token'];
        }
        return false;
    }

    /**
     * [_sendDataBySoap description]
     * @param  [type] $data [description]
     * @param  [type] $fun  [description]
     * @return bool|mix|mixed [description]
     */
    private function _sendDataBySoap($data,$fun){
        try {
            $soap_obj = new SoapClient($this->_soap_url,array('cache_wsdl'=>0,'compression'=>true));
            $result = $soap_obj->$fun($data);
            self::log(' reocrd_log: '.(string)$result->return);
            if($result){
                return json_decode($result->return,true);
            }
        } catch (Exception $e){
            $err['status'] = 2;
            $err['msg']    = '请求备案超时，请联系管理员';
            self::log($e->getMessage());
            return $err;
        }
    }

    private static function log($msg){
        $log = new logs();
        $log->setLog($msg);
    }
}