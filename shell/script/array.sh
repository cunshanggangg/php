#! /bin/bash
arr=(cunshanggang 1 2 3 4 5 6)
echo "输出数组的第一个元素："${arr[0]}""
echo "输出数组的所有的元素："${arr[@]}""
echo "输出数组的元素的个数："${#arr[*]} or ${#arr[@]}""
