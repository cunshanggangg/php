#! /bin/bash
#连接数据库
mysql -uroot -p123456 <<EOF
show databases;
use test;
insert into csg_student(name,age,sex) value("村上岗5",24,0);
EOF

