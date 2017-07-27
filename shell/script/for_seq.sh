#!/bin/bash
#使用 seq 命令
#seq 1 10

#使用 seq for in循环出1-100数字
#shell 注释用:<<' ',不止一种。
:<<'
for i in `seq 1 10`
do
	echo ${i}
done
'

