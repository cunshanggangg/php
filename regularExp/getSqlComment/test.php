<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/27
 * Time: 17:36
 */
$str = file_get_contents('data/sql.txt');
//echo "<pre>";
//echo $str;
//echo "</pre>";

//preg_match_all("/(?!COMMENT)'[^\r\n]+',/",$str,$result);
preg_match_all("/(?!COMMENT)'(.+?)'/",$str,$result);
echo "<pre>";
print_r($result[0]);
echo "</pre>";
//echo $result[0][0];
//echo "<br>";
//echo str_replace("'",'',$result[0][0]);//将单引号去掉，

//foreach($result[0] as $key => $value) {
//    $result[0][$key] = str_replace("'",'',$result[0][$key]);
//}
//echo "<pre>";
//print_r($result[0]);
//echo "</pre>";
//结果
/*
array
(
    [0] => '自增编号',
    [1] => '订单编号',
    [2] => '订单日期',
    [3] => '商家名称',
    [4] => '电商商户企业名称',
    [5] => '业务摘要代码',
    [6] => '电商商户企业备案号',
    [7] => '销售网址',
    [8] => '订单(收件)人姓名',
    [9] => '订单(收件)人证件号',
    [10] => '订单(收件)人电话',
    [11] => '订单(收件)人详细地址',
    [12] => '城市',
    [13] => '省份',
    [14] => '地区代码',
    [15] => '邮编',
    [16] => '商品名称',
    [17] => '商品货号(国检)',
    [18] => '商品备案编号(国检)',
    [19] => '商品海关HS编码(国检)',
    [20] => '商品海关备案号(海关)',
    [21] => '商品品牌',
    [22] => '商品规格型号',
    [23] => '商品产地',
    [24] => '商品产地企业代码',
    [25] => '0' COMMENT '商品数量',
    [26] => '商品条形码',
    [27] => '商品计量单位',
    [28] => '计量单位代码',
    [29] => '0.00' COMMENT '商品单价(元)',
    [30] => '0.00' COMMENT '商品总价(元)',
    [31] => '币制',
    [32] => '0.00' COMMENT '税款（元）',
    [33] => '税款币制',
    [34] => '0.00' COMMENT '运费',
    [35] => '进出口标识',
    [36] => '0' COMMENT '订单状态(0:未支付,1:已支付)',
    [37] => '0' COMMENT '0未充值,1已充值,2已消费',
    [38] => '0' COMMENT '注册状态',
    [39] => '0' COMMENT '0正常1表示已推送到正式',
    [40] => '0' COMMENT '充值状态',
    [41] => '0' COMMENT '会员ID',
    [42] => '支付单号',
    [43] => '易票联支付单号',
    [44] => '商户ID',
    [45] => '买家邮箱',
    [46] => '创建支付订单时间',
    [47] => '0.00' COMMENT '订单总价格（元）',
    [48] => '支付方式',
    [49] => '支付时间',
    [50] => '小批次号',
    [51] => '订单批次号',
    [52] => '0' COMMENT '走货模式,0：集货(BC)  1：备货(BBC)',
    [53] => ' 运单号',
    [54] => '0' COMMENT '订单通关状态：0：未提交；1：成功；3：失败；7:报关正常;8:报关失败',
    [55] => '0' COMMENT '有会员订单0,无会员订单1,3表示已分配会员,4表示需要支付的订单,5表示附属商品信息订单无需支付,8易票联批量订单,9表示关闭与取消',
    [56] => '支付点击时间',
    [57] => '上次支付订单号',
    [58] => '0' COMMENT '0:单订单,1:多订单,2.归属订单',
    [59] => '快递公司',
    [60] => '快递单号',
    [61] => '物流企业代码',
    [62] => '净重',
    [63] => '毛重',
    [64] => '运输方式代码',
    [65] => '发货人姓名',
    [66] => '发件人地址',
    [67] => '发件人城市名称',
    [68] => '发件人城市代码',
    [69] => '发件人国家代码',
    [70] => '第一计量数量',
    [71] => '第一计量单位代码',
    [72] => '1' COMMENT '1表示A卡,2:B卡,3:C卡;4:D卡',
    [73] => '大类',
    [74] => '通联商户交易流水号',
    [75] => '0' COMMENT '会员检测状态(0:未检测, 1:已检测修改)',
    [76] => '0' COMMENT '0:订单身份证，电话正常，大于0为不正常 ',
    [77] => '0' COMMENT '0:未发送,未上送'',
    [78] => ''上送中'',
    [79] => ''上送完成'',
    [80] => ''已获取回执'',
    [81] => ''反馈成功'',
    [82] => ''反馈失败'',
    [83] => ''上送失败'',
    [84] => ''订单不存在',
    [85] => '海关入库状态码',
    [86] => '海关入库状态信息',
    [87] => '海关关区代码',
    [88] => '0' COMMENT '海关报送通道 0,1为新窗口',
    [89] => '0' COMMENT '国检报送通道0,1为3.0',
    [90] => ' 0海猫岛 1 林贰林',
    [91] => '物流公司',
    [92] => '物流公司代码',
    [93] => '抵扣数据',
    [94] => '订单备注信息'
)
*/