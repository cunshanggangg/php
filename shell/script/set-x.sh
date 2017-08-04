#!/bin/bash
#set -x
echo -n "Can you write device driver?"
read answer
answer=$(echo $answer | tr [a-z] [A-Z])
if [ $answer = Y ]
then 
	echo "Wow,you must be very skilled"
else
	echo "Neither can I,I am just an example shell script"
fi	
