<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 16:11
 */
interface I {
    const c=12;
    public function test();
    public function test1();
}

class C implements I {
    public function test()
    {
        // TODO: Implement test() method.
        echo "test";
    }

    public function test1()
    {
        // TODO: Implement test1() method.
        echo "test1";
    }
}
C::test();
echo "<hr>";
C::test1();
echo "<hr>";
echo "访问常量变量<br />";
echo C::c;