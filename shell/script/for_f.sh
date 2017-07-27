#!/bin/bash
#for /f "tokens=* delims=" %%i in (/var/www/html/csg/data/data.txt) do echo %%i %%j
#for /f "tokens=2,3 delims= " %%i in (/var/www/html/csg/data/data.txt) do echo %%i %%j
while read line
do
echo "File:${line}"
done < /var/www/html/csg/data/data.txt
