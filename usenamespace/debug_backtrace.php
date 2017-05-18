<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18
 * Time: 14:02
 */
function a($v) {
    b("yaoMing");
}

function b($v) {
    c("liNa");
}

function c($v) {
    echo "<pre>";
    print_r(debug_backtrace());
    echo "</pre>";
}

a("test");

