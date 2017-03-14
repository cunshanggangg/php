<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 9:10
 */
use Shopnc\Tpl;
use Shopnc\Log;//要使用日志类，必须引入Log类

defined('InShopNC') or exit('Access Invalid!');

class goods_storageControl {

    public function indexOp() {
        $model = Model("goods");
        $res = $model->getStoreIdGoodsSn();

        //发送的条数
        $sum = count($res);
        //json_encode(),参数：JSON_UNESCAPED_UNICODE；为了更好显示中文，不乱码，转码
        $res_json = json_encode((object)$res,JSON_UNESCAPED_UNICODE);

        //接收返回来的状态：0：成功，其他的为出错
        $status = $this->_sendOp($res_json);
        //日志记录发送成功的总数及发送状态
        Log::record('商品库存同步发送总条数：'.$sum."\n".'发送状态：'.$status."\n",Log::RUN);
        Tpl::showpage('goods_storage.index');
    }

    //发送数据
    public function _sendOp($post_data) {
        $chjk = curl_init('http://404.php.net/');//初始化一个curl会话
//        $url = 'http://192.168.17.50:8080/api/ws/orderService/transmitAllowSaleNumber';//本地测试的路径,测试时修改为自己的IP地址
        $url = 'http://112.74.206.84:8080/api/ws/orderService/transmitAllowSaleNumber';
        curl_setopt($chjk,CURLOPT_URL, $url);//设置curl会话的接口地址
        curl_setopt($chjk,CURLOPT_CUSTOMREQUEST,"POST");//设置请求方式为POST
        curl_setopt($chjk,CURLOPT_RETURNTRANSFER,1);//设置CURLOPT_RETURNTRANSFER为1，表示如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE
        curl_setopt($chjk,CURLOPT_POSTFIELDS,$post_data);
        //发送json数据格式必需要定义json格式
        curl_setopt($chjk,CURLOPT_HTTPHEADER,array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($post_data))
        );
        curl_exec($chjk);
        //发送数据的状态：0：success
        $status = curl_errno($chjk);
        curl_close($chjk);

        //返回发送数据的状态：0：成功，其他的数值为出错
        return $status;
    }

    //接收数据
    public function receiveOp() {
        //将接收过来的json格式转义：htmlspeicalchar_decode();并用json_decode()转换成数组，带参数：true，否则为对象。
        $json_data = json_decode(htmlspecialchars_decode($_POST['json_data']),true);
        //统计接收的总条数
        $count = count($json_data);
        //日志保存接收回来的json格式数据
        Log::record('接收的json数据'."\n".htmlspecialchars_decode($_POST['json_data'])."\n"."接收总数:".$count."\n",Log::RUN);//exit;
        //更新数据库的s商品库存：goods_storage
        $model = Model('goods');

        foreach($json_data as $key=>$value) {
            $condition['store_id'] = $value['store_id'];//商家id
            $condition['goods_sn'] = $value['goods_sn'];//商品备案
            $data['goods_storage'] = $value['goods_storage'];//商品库存
            $model->updateGoodsStorage($condition,$data);
        }

        //返回 1：更新完毕，与物流系统接收结果的字段保持一致：resBody
        $respBody = 1;

        echo $respBody;
    }

}