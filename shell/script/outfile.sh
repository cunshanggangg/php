#! /bin/bash
#文件名称为时间
DATE=$(date +%Y%m%d%H%M)
#连接数据库并查询数据，保存查询数据
mysql -uroot -p123456 <<EOF
use test;
select * from csg_student limit 0,10 into outfile'/var/www/html/csg/sql/${DATE}.xls';
EOF

