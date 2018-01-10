<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/10
 * Time: 14:45
 */
$postStr = "<xml><ToUserName><![CDATA[gh_6035e65ca645]]></ToUserName>
<FromUserName><![CDATA[ocvlH1WfcWaJ-UWmV90-PM4ZNHCw]]></FromUserName>
<CreateTime>1515565643</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[123]]></Content>
<MsgId>6509304872072387770</MsgId>
</xml>";
libxml_disable_entity_loader(true);
$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
$fromUsername = $postObj->FromUserName;
$toUsername = $postObj->ToUserName;
$keyword = trim($postObj->Content);
echo $fromUsername;
echo $toUsername;
echo $keyword;