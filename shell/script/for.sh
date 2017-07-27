#! /bin/bash
for line in $(cat /var/www/html/csg/data/data.txt)
do
#echo "File:${line}"
for line in ${line}
do 
	echo "${line}"
done
done
