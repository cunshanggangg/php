<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23
 * Time: 15:40
 */
namespace fub;
include 'file1.php';
include 'file2.php';
include 'file3.php';
use foo as feline;
use bar as canine;
use animate;
echo feline\Cat::says(), "<br />\n";
echo canine\Dog::says(), "<br />\n";
echo animate\Animal::breathes(), "<br />\n";
echo feline\csg;//访问常量
?>