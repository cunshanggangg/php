<?php
$str = 'https://www.mama.cn';

preg_match('/\\/(q|z)\\//', $str,$match);
echo "<pre>";
print_r($match);