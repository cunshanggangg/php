#!/bin/sh  
#本脚本负责dump远程的mysql数据库备份和还原  
IPADDR=192.168.0.139  
DATABASENAME="test"  
USERNAME=root  
USERPWD=123456  
#mysql的工具文件  
MYSQLDUMP=mysqldump
MYSQLRUN=mysql  
#要备份的数据库存放路径  
OUTPUT_DIR=/var/www/html/csg/data  
DATE=$(date +%Y%m%d%H%M)  
#生成主机IP_数据库名_日期.sql  
	DBFILENAME=${OUTPUT_DIR}/${IPADDR}_${DATABASENAME}_$DATE.sql  
#导入数据库的IP地址,用户名，密码  
	INADDRESS=192.168.17.39  
	INUSERNAME=root  
	INPWD=123456  
	  
	  
	  
	if [ ! -d $OUTPUT_DIR ]; then  
	  echo "folder do not exist,now create it!"  
	    mkdir $OUTPUT_DIR  
		  echo "folder ${OUTPUT_DIR} had created!"  
		  fi  
#备份数据库  
		  ${MYSQLDUMP} -h ${IPADDR}  -u${USERNAME} -p${USERPWD} --databases ${DATABASENAME} --set-gtid-purged=OFF > ${DBFILENAME}  
		    
		  if [ $? -eq 0 ]  
		  then  
		      echo "backup database success!"  
			      echo ${DBFILENAME}  
				  else  
				      echo "backup database failed!"  
					      echo ${DBFILENAME}  
						      exit 1  
							  fi  
							    
							  echo ""  
							  echo "starting to import file of sql to mysql server_${INADDRESS}"  
							  echo "..."  
#导入数据库  
							  ${MYSQLRUN} -h ${INADDRESS}  -u${INUSERNAME} -p${INPWD} < ${DBFILENAME}  
#${MYSQLRUN} -h ${IPADDR}  -uroot -p${USERPWD} < /data/mysqlbk/lg_test_20151130205149.sql  
							    
							  if [ $? -eq 0 ]  
							  then  
							      echo ""  
								      echo "import database success!"  
									  else  
									      echo ""  
										      echo "import database failed!"  
											      exit 1  
												  fi  
