#! /bin/bash
#连接数据库
mysql -uroot -p123456 <<EOF
use test;
insert into csg_student(name,age,sex) value("$1","$2","$3");
EOF
echo "Insert data success!"
