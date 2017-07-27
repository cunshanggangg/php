#!/bin/bash
#利用for循环生成100个文件夹
for ((i=1;i<=100;i++))
do 
`mkdir /var/www/html/csg/shell/csg_${i}`;
done
