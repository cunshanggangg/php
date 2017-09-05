<?php

function ReplaceScript(&$txt)
{
      $str="/<script[^>]*?>.*?</script>/si":

     //[^>]*?表示匹配任意次除">"以外任意字符，但尽可能少重复

//.*? 表示匹配任意次任意字符

     preg_replace("$str","",$txt);
}

$txt="<script language='javascript'> var preFrameW = '160,*'; </script>";

$txt.="hello world";

echo $txt;

ReplaceScript($txt);

echo   $txt;

?>

预想结果为 连续两次输出 hello world，且查看html源代码时只有第一次会输出JavaScript代码。

但结果如下：

hello world

Warning : preg_replace() [function.preg-replace ]: Unknown modifier 'c' in ~~~


hello world

除了这个问题很纠结外，打开html看其源代码，依然有两次JavaScript代码输出。说明JavaScript代码并没有被取代为空格。

后面经过几次修改函数中的$str变量，依次出现了 Warning : preg_replace() [function.preg-replace ]: Unknown modifier '/' in ~~~ 等稀奇八怪的提示。JavaScript代码也依旧没有被替换

郁闷啊，于是又改回到最初的函数，找出PHP5帮助文档，查看preg_replace() 说明。修改ReplaceScript（）函数为

function ReplaceScript(&$txt)
{
      $str="/<script[^>]*?>.*?</script>/si":

      print preg_replace("$str","",$txt);
}

结果是输出了三次JavaScript代码，看来还是$str问题。于是乎，奈着性子看了大量的例子。觉得没有错啊，一般匹配字符都是这么写，开始结尾均有个" / "。但是这个时候，其实我并不知道这个 /   有什么作用。 呵呵，还是觉得没有错。只好百度之，在百度里看到了例外，有人居然不是用 " / "放在开头结尾，而是用 " ' "字符代替。莫非PHP默认这个字符 / 的用处仅仅就是帮助PHP界定匹配字符串的区间，在这个区间外就不匹配。 而实际只要用另外的一个字符分别放在匹配字符串的开头和结尾也可以达到同样的目的。于是果断把$str换为     $str="' <script[^>]*?>.*?</script>' ": 编译again 。

呵呵，万能的神，Warning : preg_replace() [function.preg-replace ]: Unknown modifier 'c' in ~~~这个问题终于没有了。查看生成的htm源代码，输出了三次helloworld，输出了两次JavaScript(用print函数输出的没有)。看来是识别成功了,只是$txt没有替换。于是再次修改

function ReplaceScript(&$txt)
{
      $str="' <script[^>]*?>.*?</script>'si ":

      print $txt=preg_replace("$str","",$txt);
}

查看结果，这次是输出了三次helloworld，只在第一次输出helloworld前输出了JavaScript，后面两次都被替换掉了。呵呵，OK，问题搞定。

总结，我犯的错误在
$str="/<script[^>]*?>.*?</script>/si":
这里面的</script>已经有一个" / "了，所以开头的 " / "就和这个 " / "形成了匹配区间，
而把这个" / "之后的" script>/ " 当成了模式修正符。但实际模式修正符只有i，m，s，x，e等少数几个，
而"script>/ "里面的c，r，p，> ，/ 都不是模式修正符，
所以才出了Unknown modifier 'c‘   Unknown modifier '/ ’ 等问题
(没有出现 Unknown modifier 's‘ ，是因为 s 是模式匹配符啊）。