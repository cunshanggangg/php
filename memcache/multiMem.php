<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/19
 * Time: 23:33
 */
//$m = new Memcache();
$m = new Memcache;

//一台电脑上有两个memcache的服务，端口号分别为：11211,9999
$m->addServer('localhost','11211');
$m->addServer('localhost','9999');

if($m->add('sport','tennis',MEMCACHE_COMPRESSED,200)) {
    echo "Add successfully...";
}

if($m->set('major','computer',MEMCACHE_COMPRESSED,200)) {
    echo "Set successfully...";
}

if($m->set('hobby','calligraphy',MEMCACHE_COMPRESSED,200)) {
    echo "Set successfully...";
}
echo "<hr>";
echo $m->get('sport');
echo "<hr>";
echo $m->get('major');
echo "<hr>";
echo $m->get('hobby');

//结论：memcached会自动计算保存到那个服务器中去，而取出来的时候，也会自动获取键值一致的值