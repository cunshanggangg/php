<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/24
 * Time: 15:48
 */
//simplexml_load_string()第二个默认参数：SimpleXMLElement 改为其他的
class simple_xml_extended extends SimpleXMLElement
{
    public function Attribute($name)
    {
        foreach($this->Attributes() as $key=>$val)
        {
            if($key == $name)
                return (string)$val;
        }
    }
}

$xml = simplexml_load_string('<xml><dog type="poodle" owner="Mrs Smith">Rover</dog></xml>','simple_xml_extended');
echo $xml->dog->Attribute('type');