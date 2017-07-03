<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/20
 * Time: 9:23
 */
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');


if($_REQUEST['act'] == 'list') {
    $smarty->assign('admin_id',$_SESSION['supplier_id']);
    $supplier_id = $_SESSION['supplier_id'];
    $sql = "where supplier_id = $supplier_id";
    $result_orders = orders_info_list('','',$sql);//获取订单信息
    //订单状态
    $order_status = array("0"=>"未确认","1"=>"已取消","2"=>"无效","3"=>"退货","4"=>"已分单","5"=>"部分分单","6"=>"已确认");
    //委托代理出口协议状态
    $contract_status = array("40001" => "协议预录入","40002" => "协议已提交","40003" => "协议已驳回");
    //组货单状态
    $group_status = array("50001" => "组货预录入","50002" => "组货已提交");
    //装箱单状态
    $packing_status = array("60001" => "装箱预录入","60002" => "装箱已提交");
    //报关单状态
    $cus_status = array("80001" => "报关预录入","80002" => "报关已发送","80003" => "报关已结关");
    //报检单状态
    $ciq_status = array("90001" => "报检预录入","90002" => "报检已发送","90003" => "报检已结检");
    //代理出口货物证明状态
    $prove_status = array("70001" => "证明预录入","70002" => "证明已提交");

    foreach($result_orders['orders'] as $key=>$value) {
        $orders_list[$key]['order_id'] = $value['order_id'];//订单编号
        $orders_list[$key]['order_sn'] = $value['order_sn'];//收货人
        $orders_list[$key]['consignee'] = $value['consignee'];//总金额
        $orders_list[$key]['status'] = $order_status[$result_orders['orders'][$key]['order_status']];
        $orders_list[$key]['declare_status'] = $value['declare_status'];//提交中台备案状态 0:未提交 1:成功 2:失败'
        $orders_list[$key]['contract_status'] = $contract_status[$value['contract_status']];
        $orders_list[$key]['group_status'] = $group_status[$value['group_status']];
        $orders_list[$key]['packing_status'] = $packing_status[$value['packing_status']];
        $orders_list[$key]['cus_status'] = $cus_status[$value['cus_status']];
        $orders_list[$key]['ciq_status'] = $ciq_status[$value['ciq_status']];
        $orders_list[$key]['prove_status'] = $prove_status[$value['prove_status']];
        $orders_list[$key]['freetax_status'] = $value['freetax_status'];
        $orders_list[$key]['declare_msg'] = implode('|', json_decode($value['declare_msg'],true));
        $orders_list[$key]['declare_time'] = date('Y-m-d h:i:s',$value['declare_time']);
    }
    $smarty->assign('orders_list',$orders_list);
    $smarty->assign('filter',      $result_orders['filter']);
    $smarty->assign('record_count', $result_orders['filter']['record_count']);
    $smarty->assign('page_count',   $result_orders['filter']['page_count']);
    $smarty->assign('full_page',    1);

    $smarty->display('order_info_list.htm');
}elseif ($_REQUEST['act'] == 'query') {
 $supplier_id = $_SESSION['supplier_id'];
    $sql = "where supplier_id = $supplier_id";
    $result_orders = orders_info_list('','',$sql);//获取订单信息
    //订单状态
    $order_status = array("0"=>"未确认","1"=>"已取消","2"=>"无效","3"=>"退货","4"=>"已分单","5"=>"部分分单","6"=>"已确认");
    //委托代理出口协议状态
    $contract_status = array("40001" => "协议预录入","40002" => "协议已提交","40003" => "协议已驳回");
    //组货单状态
    $group_status = array("50001" => "组货预录入","50002" => "组货已提交");
    //装箱单状态
    $packing_status = array("60001" => "装箱预录入","60002" => "装箱已提交");
    //报关单状态
    $cus_status = array("80001" => "报关预录入","80002" => "报关已发送","80003" => "报关已结关");
    //报检单状态
    $ciq_status = array("90001" => "报检预录入","90002" => "报检已发送","90003" => "报检已结检");
    //代理出口货物证明状态
    $prove_status = array("70001" => "证明预录入","70002" => "证明已提交");
    foreach($result_orders['orders'] as $key=>$value) {
        $orders_list[$key]['order_id'] = $value['order_id'];//订单编号
        $orders_list[$key]['order_sn'] = $value['order_sn'];//收货人
        $orders_list[$key]['consignee'] = $value['consignee'];//总金额
        $orders_list[$key]['status'] = $order_status[$result_orders['orders'][$key]['order_status']];
        $orders_list[$key]['declare_status'] = $value['declare_status'];//提交中台备案状态 0:未提交 1:成功 2:失败'
        $orders_list[$key]['contract_status'] = $contract_status[$value['contract_status']];
        $orders_list[$key]['group_status'] = $group_status[$value['group_status']];
        $orders_list[$key]['packing_status'] = $packing_status[$value['packing_status']];
        $orders_list[$key]['cus_status'] = $cus_status[$value['cus_status']];
        $orders_list[$key]['ciq_status'] = $ciq_status[$value['ciq_status']];
        $orders_list[$key]['prove_status'] = $prove_status[$value['prove_status']];
        $orders_list[$key]['freetax_status'] = $value['freetax_status'];
        $orders_list[$key]['declare_msg'] = implode('|', json_decode($value['declare_msg'],true));
        $orders_list[$key]['declare_time'] = date('Y-m-d h:i:s',$value['declare_time']);
    }

    $smarty->assign('orders_list',$orders_list);
    $smarty->assign('filter',      $result_orders['filter']);
    $smarty->assign('record_count', $result_orders['filter']['record_count']);
    $smarty->assign('page_count',   $result_orders['filter']['page_count']);
    $smarty->assign('full_page',    1);

    /* 排序标记 */
    $sort_flag  = sort_flag($result['filter']);
       $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('order_info_list.htm'), '',
        array('filter' => $result_orders['filter'], 'page_count' =>$result_orders['page_count']));
}elseif ($_REQUEST['act'] == 'apply') {
    require_once(dirname(__FILE__) . '/includes/lib_data.php');
    $order_id = $_GET['id'];
    $soap_api = new smt_soap();
    // print_r($soap_api);
    $soap_api->debug = true;
    $BusCode = getInterfaceBusCode('order');
    $data= getOrderInfo(array('order_id'=>$order_id));
//    echo "<pre>";
//     print_r($data);die;
    $result = $soap_api->sendInterface($data,$BusCode,'checkOrderRes');
    if($result){
        echo "<script>alert('".$result['msg']."');window.location.href='?act=list';</script>";
    }else{
        echo "<script>alert('订单提交中台失败，请稍候重新提交');window.location.href='?act=list';</script>";
    }   
}elseif ($_REQUEST['act'] == 'view') {
    $order_id = $_GET['id'];
    $data = getOrderInfo(array('order_id'=>$order_id));

    $order_detail = array();

        $order_detail['order_sn'] = $data['smt_order'][0]['order_sn'];//订单编号
        $order_detail['create_by'] = $data['smt_order'][0]['create_by'];//供应商登录名称
        $order_detail['create_name'] = $data['smt_order'][0]['create_name'];//供应商名称
        $order_detail['order_amount'] = $data['smt_order_detail'][0]['total_amount'];//总价
        $order_detail['goods_number'] = $data['smt_order_detail'][0]['goods_num'];//数量
        $order_detail['goods_weight'] = $data['smt_order_detail'][0]['total_weight'];//总重量
        $order_detail['goods_price'] = $data['smt_order_detail'][0]['goods_price'];//单价
        $order_detail['goods_name'] = $data['smt_order_detail'][0]['goods_name'];//商品名称

    $smarty->assign('order_detail',$order_detail);
    $smarty->display('order_info_view.htm');
}


