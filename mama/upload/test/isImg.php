<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/10/11
 * Time: 23:00
 */
include 'url.php';
foreach ($home_riji as $k => $v) {
    $url = $v['icon'];
    if( @fopen( $url, 'r' ) ) {
        echo 'File Exits';
    } else {
        echo '<hr>';
        echo 'File Do Not Exits';
        echo '<br>';
        echo $url;
        echo '<hr>';
    }
}
