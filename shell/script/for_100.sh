#!/bin/bash
#用for循环输出1-100数字
# 1.不换行输出，并且停1秒再输出数字
#for((i=1;i<=100;i++)) do echo -n ${i} ;sleep 1;done
# 2.换行输出，并且停1秒再输出数字
#for((i=1;i<=100;i++)) do echo ${i};sleep 1;done
# 3.直接输出1-100，C语言风格
for((i=1;i<=100;i++)) do echo ${i};done
