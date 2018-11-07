<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/10/4
 * Time: 22:50
 */
//$arr = ['name' => 'test'];
//$obj = json_encode($arr);
//
//echo "<pre>";
//var_dump(is_object($obj));

function get_subjects($obj_name)
{
    if(!is_object($obj_name))
    {
        return(false);
    }
    return($obj_name->subjects);
}
$obj_name = new stdClass;
$obj_name->test = Array('Google', 'Codes365', 'Facebook');
var_dump(is_object($obj_name));
//var_dump(get_subjects(NULL));
//var_dump(get_subjects($obj_name));