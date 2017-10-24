<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24
 * Time: 11:01
 */
$note=<<<XML
<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>
XML;
//结尾要顶格
$xml=simplexml_load_string($note);

echo $xml->getName() . "<br>";//获取最外一层标签
//遍历所有的节点名称和值
foreach($xml->children() as $child)
{
    echo $child->getName() . ": " . $child . "<br>";
}