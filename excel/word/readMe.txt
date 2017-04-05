1、首先在windows的“服务”里面检查COM+服务是否已经启动。如果未启动，请启动它。
大概是该服务：Windows Management Instrumentation

2、检查php目录ext文件夹下面php_com_dotnet.dll是否存在。（顺便说一下，ext通常作为php程序的扩展目录，在安装php的时候一般已经设置好。否则就应该不仅仅报主题所说的错咯。）

3、如果没问题，在php.ini里面加入以下语句：

[PHP_COM_DOTNET]
extension=php_com_dotnet.dll

4、php.ini中设置
com.allow_dcom = true

5.PHP版本
PHP 5.4.5以前的版本，只需要在php.ini中把com.allow_dcom = true打开就可以了，但是5.4.5版本以后，PHP把com/dotnet 模块集成到了一个单独的扩展中，所以需要在php.ini中加一行扩展extension=php_com_dotnet.dll，是加一行，不是打开，默认配置文件中没有这一行的，然后重启IIS或Apache，再次运行就正常了！

http://lylgxy0704wht.blog.163.com/blog/static/570480392014824104435552/