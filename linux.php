阿里云  服务器
    120.77.183.43(公)
    172.18.139.57(私有)
    name: root
    pwd:  llqhz..123456
    登录密码: 044717
    mysql : llqhz : llqhz
    mysql : root  : 12345678
腾讯云  服务器
    119.29.119.219
    name: ubuntu
    pwd:  llqhz123456
    mysql : xiaoguai : ll605382289
    1:防火墙:ubuntu
    sudo ufw disable
    2:mysql监听:
    ~# netstat -an | grep 3306
    tcp        0      0 127.0.0.1:3306          0.0.0.0:*               LISTEN
    3:/etc/mysql/my.cnf bind-address  = 127.0.0.1=> #
    4: sudo pkill -9 mysqld => sudo /usr/sbin/mysqld
grant all privileges on *.* to 'admin'@'%' identified by 'll605382289' with grant option;
 flush privileges;



文件目录:
home    主目录
lib     :libary 库文件 .so
bin     配置文件
media   光盘挂载
opt     option 第三方软件安装目录
root    超级管理员root的home主目录
selinux 安全加强 secutity enhance
sys     系统运行环境
usr     用户安装软件目录
etc     所有软件的配置
lost+found 回收站
mnt     U盘挂载目录
proc    proccess 进程 正在运行的内存里的
srv     service 服务
var     变量 log 常变化的
tmp     临时目录

文件夹命令:
ls 查看目录 [list]
    -a 包括隐藏文件  -l 详细信息  -d 查看目录属性
ll 查看详细信息
cd 进入目录 [change directory]

pwd 查看当前活动目录 [print working directory]
mkdir newdir    创建新目录
cp [copy]       复制新目录
    cp -R dir1 dir2
    cp file1 cpfile dir
mv [move]       移动文件(夹)
    mv file dir
    mv file newfile 重命名
rm [remove]     删除
    rm file         文件
    rm -r dir       目录
mkdir -p /mp4/mp3


文件命令:
touch newfile  创建空文件
more a.txt      读取
more a.txt >> b.txt    读取并重定向

    ctrl+f[forword] 向前
    ctrl+b[before]  向后
    上下箭头滚动
    q 退出
less a.txt
cat a.txt b.txt 合并查看

grep nobady filename  文字匹配

文件打包解压
打包,压缩,解压
|-------|-------|-------|
|       |  创建 |       |
|       |   C   |       |
|-------|-------|-------|
|   j   |压缩包 |   z   |
|bz压缩 |tar vf |gz压缩 |
|       | f文件 |       |
|-------|-------|-------|
|       |   x   |       |
|       | 解压  |       |
|-------|-------|-------|








定位方式:
绝对定位: ls /usr/local/bin     从更目录开始
相对定位: ls ./   ../           相对当前活动目录

文件查找:
find ./ -name '*txt'
find -amin 100  100分钟内活动的
    a(活动) m(修改) empty(空的文件(夹))
    min(分钟) time(天)

find . -name '*php' | grep aa.php 管道  找aa.php
find . -name '*php' | xargs grep funname
        find传过来的每一个 文件 作为grep的参数来寻找fun
find ./ -name '*txt' | grep a  | xargs grep ali
ls /dev | more


系统命令:
Ctrl+C 停止当前命令
whoami 用户
who 查看谁在线
su - root 切换用户
free  显示内存     -h详细信息
free

top (任务管理器)
ps (列出进程)  ps -aux
    ps -aux | grep nginx
kill 1102
pkill apache  关闭所有 *apache* 进程

一切皆文件 内存/网络

文件挂载:
mount /dev/cdrom /mnt  将光盘挂载到 /mnt 目录
mount /dev/sdc /mnt 挂载U盘
卸载: umout /dev/cdrom

文件编辑器 vim emacs
vim t.txt
            esc
    编辑模式 <=> 命令模式 <=> 尾行模式
          i o a s          :
                dd x hljk     w写 q退 !强制

    编辑指令 (edit)

            a -> 在光表后插入 (append after cursor)
            A -> 在一行的结尾插入 (append at end of the line)
            i -> 在光标前插入 (insert before cursor)


        复制与粘贴 (copy & paste)
            v 视图模式  y复制 d剪切 p粘贴
            y -> 复制 (yank line)
            yy -> 复制当前行 (yank current line)



linux 用户和组
su username 切换
/etc/group文件包含所有组
group_name:passwd:GID:user_list

/etc/shadow和/etc/passwd系统存在的所有用户名

user     add del mod
group    add del mod

useradd xiaoguai -g(grp) llqhz -p(pwd) llqhz

1、添加普通用户
[root@server ~]# useradd chenjiafa   //添加一个名为chenjiafa的用户
[root@server ~]# passwd chenjiafa    //修改密码
Changing password for user chenjiafa.
New UNIX password:                   //在这里输入新密码
Retype new UNIX password:            //再次输入新密码



文件权限
    r->4 w->2 x->1  r-x -> 5
用户u 同组g 其他o
 rwx   r-x   r-x
  7     5     5

权限: ll(查看)

权限修改 change mod(模式)
chmod u+x t.txt   user + execute
chmod 755 t.txt

修改用户: owner
chown xiaoguai t.txt
chgrp llqhz t.txt


软件安装:
    1: rpm    2: yum   3:编译安装

1: rpm:     .rpm   .deb
    安装i   卸载e  升级U  查询q  验证-V
  install
  vh 进度条
    名称 软件名 第几次修改 适用系统版本 cpu类型

    eg: rpm -ivh vsftp...
        rpm -e vsftp
        rpm -Uvh vsftp
        rpm -qa | grep ftp   rpm -ql vsftp

2: yum 软件管理器(解决依赖)  ubuntu -> apt-get
    安装i   卸载e  升级U  查询q  验证-ql

    eg: 安装 yum install httpd
        验证 yum list installed | grep httpd
        卸载 yum remove httpd   [匹配httpd-*]

选择: 基础性质(编译器),库,通用的便于被调用 -> yum
      memcached apache nginx 专用 编译

示例: yum 安装 gcc 编译环境,为编译 lnmp 做准备
(同时装多个:)
yum install gcc automake autoconf libtool gcc-c++


3: 编译安装:
以 memcached 为例,来编译,到 memcached.org 下载源码 到 /usr/local/src 下
编译软件分为 3 步---
1: configure --prefix=/安装/路径  yum install libevent-devel
如果还有其他选项,./configure --help 来查看
2: make 编译 [生成 2 进制]
3: make install [把生成的 2 进制复制到 prefix 指定的安装路径里]
其中 2,3 两步,可以合写为 make && make install

0: yum install libevent-devel
1: wget http://www.memcached.org/files/memcached-1.5.0.tar.gz
2: tar xfvz memcached-1.5.0.tar.gz
3: ./configure --prefix=/usr/local/memcached
4: make & make install





编译安装 nginx centos7.2
0: yum install gcc-c++
1: yum install pcre pcre-devel  [pcre*] rewrite 重写模块
2: yum install zlib zlib-devel  [zlib*] 对 http 包的内容进行 gzip
3: yum install -y openssl openssl-devel 支持 https（即在ssl协议上传输http）
  wget http://nginx.org/download/nginx-1.12.1.tar.gz

4: ./configure --prefix=/usr/local/nginx
5: make && make install
6: ./sbin/nginx
编译安装:memcached
0: yum install libevent-devel
1: configure --prefix=/usr/local/memcached
2: make && make install

关闭防火墙:
service iptables stop   cent6.+
systemctl stop firewalld.service
    启动停止重启查看: systemctl start/stop/restart/status firewalld.service
    操作:
    add : firewall-cmd --permanent --zone=public --add-port=80/tcp
    remove : firewall-cmd --permanent --zone=public --remove-port=80/tcp
    reload : firewall-cmd --reload



安装php: [php5/7]
0: yum install gd zlib zlib-devel openssl openssl-devel libxml2 libxml2-devel libjpeg libjpeg-devel libpng libpng-devel libtool libtool-devel pear pear-devel
1: wget http://uk1.php.net/distributions/php-5.6.31.tar.gz
2:  ./configure --prefix=/usr/local/php \
    --with-gd \                         #gd绘图库
    --enable-gd-native-ttf \            #支持字体
    --enable-mysqlnd \                  #mysql连接支持
    --with-mysqli=mysqlnd \              # mysql_connect => mysqli_connect
    --with-pdo-mysql=mysqlnd \
    --with-openssl \
    --enable-mbstring \
    --enable-fpm                       # php作为独立进程运行

./configure --prefix=/usr/local/php --with-gd --enable-gd-native-ttf  --enable-mysqlnd --with-mysqli=mysqlnd --with-pdo-mysql=mysqlnd --with-openssl --enable-mbstring --enable-fpm --with-curl

3: make && make install

4: ./sbin/php-fpm 启动

5: cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf
   {vim ./etc/php-fpm.conf     -> set nu  ->125}
   cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf
6  ./bin/php -v        #查看版本

配置nginx 解释 php
0:  cd /usr/local/nginx
    配置站点根目录
1:  vim ./conf/nginx.conf
2:  : set nu   ->   65-71 fastcgi_param -> $DOCUMENT_ROOT{+...}
    配置php.ini
3:  cp /usr/local/src/php-5.6.31/php.ini-development /usr/local/php/lib/php.ini
4:  ./sbin/nginx -s reload        #重启nginx
5:  pkill -9 php  -> (php:)./sbin/php-fpm  #重启php

更目录:  /usr/local/src/nginx-1.12.1/html

mysql:
1: 下载解压mysql: community
centos7
http://mirrors.sohu.com/mysql/MySQL-5.7/mysql-community-5.7.18-1.el7.src.rpm

1-1: rpm -ivh mysql-community-5.7.18-1.el7.src.rpm
1-2: cp /root/rpmbuild/ *  /usr/local/src/mysql
1-2-1: find / | grep mysql
1-2-2: cp SPACE+SOURCE (*) /usr/local/src/mysql (在source里编译)

Generic Linux (Architecture Independent), Compressed TAR Archive  (mysql-5.7.19.tar.gz) 49.3M
2: 安装依赖
  sudo yum install cmake gcc-c++ ncurses-devel perl-Data-Dumper /*boost boost-doc boost-devel*/
3: mysql配置   重新配置: make clean rm CMakeCache.txt
  cmake
    cmake . -DCMAKE_INSTALL_PREFIX=/usr/local/mysql
    -DMYSQL_DATADIR=/usr/local/mysql/data
    -DSYSCONFDIR=/etc
    -DWITH_INNOBASE_STORAGE_ENGINE=1
    -DWITH_ARCHIVE_STORAGE_ENGINE=1
    -DWITH_BLACKHOLE_STORAGE_ENGINE=1
    -DWITH_PARTITION_STORAGE_ENGINE=1
    -DWITH_PERFSCHEMA_STORAGE_ENGINE=1
    -DWITHOUT_EXAMPLE_STORAGE_ENGINE=1
    -DWITHOUT_FEDERATED_STORAGE_ENGINE=1

    -DDEFAULT_CHARSET=utf8
    -DDEFAULT_COLLATION=utf8_general_ci
    -DWITH_EXTRA_CHARSETS=all
    -DENABLED_LOCAL_INFILE=1
    -DMYSQL_UNIX_ADDR=/usr/local/mysql/mysql.sock
    -DMYSQL_TCP_PORT=3306
    -DCOMPILATION_COMMENT="lq-edition"
    -DENABLE_DTRACE=1
    -DWITH_DEBUG=1
    -DWITH_READLINE=1

cmake . -DCMAKE_INSTALL_PREFIX=/usr/local/mysql -DMYSQL_DATADIR=/usr/local/mysql/data -DSYSCONFDIR=/etc -DWITH_INNOBASE_STORAGE_ENGINE=1 -DWITH_ARCHIVE_STORAGE_ENGINE=1 -DWITH_BLACKHOLE_STORAGE_ENGINE=1 -DWITH_PARTITION_STORAGE_ENGINE=1 -DWITH_PERFSCHEMA_STORAGE_ENGINE=1 -DWITHOUT_EXAMPLE_STORAGE_ENGINE=1 -DWITHOUT_FEDERATED_STORAGE_ENGINE=1 -DDEFAULT_CHARSET=utf8 -DDEFAULT_COLLATION=utf8_general_ci -DWITH_EXTRA_CHARSETS=all -DENABLED_LOCAL_INFILE=1  -DMYSQL_UNIX_ADDR=/usr/local/mysql/mysql.sock -DMYSQL_TCP_PORT=3306 -DCOMPILATION_COMMENT="lq-edition" -DWITH_DEBUG=1  -DDOWNLOAD_BOOST=1 -DWITH_BOOST=/usr/local/src/boost -DWITH_READLINE=1

可用命令:
cmake \
-DCMAKE_INSTALL_PREFIX=/usr/local/mysql \
-DMYSQL_DATADIR=/usr/local/mysql/data \
-DSYSCONFDIR=/etc \
-DMYSQL_USER=mysql \
-DWITH_MYISAM_STORAGE_ENGINE=1 \
-DWITH_INNOBASE_STORAGE_ENGINE=1 \
-DWITH_ARCHIVE_STORAGE_ENGINE=1 \
-DWITH_MEMORY_STORAGE_ENGINE=1 \
-DWITH_PARTITION_STORAGE_ENGINE=1 \
-DWITH_READLINE=1 \
-DMYSQL_UNIX_ADDR=/var/run/mysql/mysql.sock \
-DMYSQL_TCP_PORT=3306 \
-DENABLED_LOCAL_INFILE=1 \
-DENABLE_DOWNLOADS=1 \
-DEXTRA_CHARSETS=all \
-DDEFAULT_CHARSET=utf8 \
-DDEFAULT_COLLATION=utf8_general_ci \
-DENABLE_DTRACE=0 \
-DMYSQL_MAINTAINER_MODE=0 \
-DWITH_SSL:STRING=bundled \
-DWITH_ZLIB:STRING=bundled \
-DDOWNLOAD_BOOST=1 \
-DWITH_BOOST=/usr/local/src/boost

g++: internal compiler error: Killed (program cc1plus)
Please submit a full bug report,

查了很多资料，最后发现主要原因是内存不足, 临时使用交换分区来解决吧

sudo dd if=/dev/zero of=/swapfile bs=256M count=64
sudo mkswap /swapfile
sudo swapon /swapfile

After compiling, you may wish to

Code:
sudo swapoff /swapfile
sudo rm /swapfile

作者：ittony
链接：http://www.jianshu.com/p/d7682a1a5eb9
來源：简书
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。





启用swap分区，确实可以降低内存的使用压力，但并不是长久之计，如果云主机上运行的应用确实需要较高的内存，建议还是购买更多的内存。

如何启用swap分区？

步骤如下：

1.查看当前系统中是否已经启用swap分区

1
2
cat /proc/swaps
top
2.如果没有启用swap分区功能，则新建一个专门的文件用于swap分区

1
dd if=/dev/zero of=/swapfile bs=512 count=8388616
注：此文件的大小是count的大小乘以bs大小，上面命令的大小是4294971392，即4GB

3.通过mkswap命令将上面新建出的文件做成swap分区

1
mkswap /data/swap
4.查看内核参数vm.swappiness中的数值是否为0，如果为0则根据实际需要调整成30或者60

1
2
3
cat /proc/sys/vm/swappiness
sysctl -a | grep swappiness
sysctl -w vm.swappiness=60
注：若想永久修改，则编辑/etc/sysctl.conf文件

5.启用此交换分区的交换功能

1
2
swapon /data/swap
echo "/data/swap swap swap defaults    0  0" >> /etc/fstab
如何关闭swap分区？

1
2
swapoff /data/swap
swapoff -a >/dev/null





mysql启动:
   ./support-files/mysql.server start
 /usr/local/mysql/support-files/mysql.server start

/var/log/mariadb/mariadb.log














3，源码编译
（安装编译方式有点改变，配置过程无太大变动，所以后面不详细介绍各个步骤了）
若想在5.0系列的红帽系统上进行源码编译安装MySQL必须借助一个跨平台编译器cmake
所以：
(1)首先安装cmake
安装cmake需要用make
# tar xf cmake-2.8.8.tar.gz

# cd cmake-2.8.8

# ./bootstrap      使用此脚本来检测编译环境

# make

# make install
(2)编译安装mysql-5.5.28
使用cmake编译mysql-5.5.28,选项的方式有所改变简单介绍一下。。。
cmake指定编译选项的方式不同于make，其实现方式如下：
cmake .

cmake . -LH 或 ccmake .        查找可以使用的相关选项
指定安装文件的安装路径时常用的选项：
-DCMAKE_INSTALL_PREFIX=/usr/local/mysql         指定安装路径

-DMYSQL_DATADIR=/data/mysql                     数据安装路径

-DSYSCONFDIR=/etc                               配置文件的安装路径
由于MySQL支持很多的存储引擎而默认编译的存储引擎包括：csv、myisam、myisammrg和heap。若要安装其它存储引擎，可以使用类似如下编译选项：
-DWITH_INNOBASE_STORAGE_ENGINE=1          安装INNOBASE存储引擎

-DWITH_ARCHIVE_STORAGE_ENGINE=1           安装ARCHIVE存储引擎

-DWITH_BLACKHOLE_STORAGE_ENGINE=1         安装BLACKHOLE存储引擎

-DWITH_FEDERATED_STORAGE_ENGINE=1         安装FEDERATED存储引擎

若要明确指定不编译某存储引擎，可以使用类似如下的选项：
-DWITHOUT_<ENGINE>_STORAGE_ENGINE=1
比如：
-DWITHOUT_EXAMPLE_STORAGE_ENGINE=1        不启用或不编译EXAMPLE存储引擎

-DWITHOUT_FEDERATED_STORAGE_ENGINE=1

-DWITHOUT_PARTITION_STORAGE_ENGINE=1
如若要编译进其它功能，如SSL等，则可使用类似如下选项来实现编译时使用某库或不使用某库：
-DWITH_READLINE=1

-DWITH_SSL=system           表示使用系统上的自带的SSL库

-DWITH_ZLIB=system

-DWITH_LIBWRAP=0
其它常用的选项：
-DMYSQL_TCP_PORT=3306                       设置默认端口的

-DMYSQL_UNIX_ADDR=/tmp/mysql.sock           MySQL进程间通信的套接字的位置

-DENABLED_LOCAL_INFILE=1                    是否启动本地的LOCAL_INFILE

-DEXTRA_CHARSETS=all                        支持哪些额外的字符集

-DDEFAULT_CHARSET=utf8                      默认字符集

-DDEFAULT_COLLATION=utf8_general_ci         默认的字符集排序规则

-DWITH_DEBUG=0                              是否启动DEBUG功能

-DENABLE_PROFILING=1                        是否启用性能分析功能
如果想清理此前的编译所生成的文件，则需要使用如下命令：
make clean

rm CMakeCache.txt
编译安装
# tar xf mysql-5.5.28.tar.gz

# cd mysql-5.5.28

# groupadd -r mysql

# useradd -g -r mysql mysql

# mkdir -pv /data/mydata

# chown -R mysql:mysql /data/mydata

# cmake . -DCMAKE_INSTALL_PREFIX=/usr/local/mysql -DMYSQL_DATADIR=/data/mydata -DSYSCONFDIR=/etc -DWITH_INNOBASE_STORAGE_ENGINE=1 -DWITH_ARCHIVE_STORAGE_ENGINE=1 -DWITH_BLACKHOLE_STORAGE_ENGINE=1 -DWITH_READLINE=1 -DWITH_SSL=system -DWITH_ZLIB=system -DWITH_LIBWRAP=0 -DMYSQL_UNIX_ADDR=/tmp/mysql.sock -DDEFAULT_CHARSET=utf8 -DDEFAULT_COLLATION=utf8_general_ci

# make

# make install

# cd /usr/local/mysql

# chown -R :mysql .   更改属组

# scripts/mysql_install_db --user=mysql --datadir=/data/mydata/  指定数据存放位置

# cp support-files/my-large.cnf /etc/my.cnf     创建配置文件

编辑配置文件
#vim /etc/my.cnf
添加如下行指定mysql数据文件的存放位置：

datadir = /mydata/data

创建执行脚本和启动服务
# cp support-files/mysql.server  /etc/rc.d/init.d/mysqld    复制脚本

# chmod +x /etc/rc.d/init.d/mysqld    执行权限

# chkconfig -add mysql    添加到服务列表中

# service mysqld start     启动服务

# bin/mysql               启动mysql








mysql安装: yum安装:
wget https://repo.mysql.com//mysql57-community-release-el7-11.noarch.rpm
rpm -ivh mysql57-community-release-el7-11.noarch.rpm
yum install mysql-server


sudo systemctl start mysqld
sudo systemctl status mysqld
sudo grep 'temporary password' /var/log/mysqld.log
Output
2016-12-01T00:22:31.416107Z 1 [Note] A temporary password is generated for root@localhost: qi*QYgPF,9aq

mysql -p
    uninstall plugin validate_password; 卸载password_policy
 set global validate_password_policy=0;
 ALTER USER USER() IDENTIFIED BY '12345678';

 GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'llqhz' WITH GRANT OPTION;
FLUSH   PRIVILEGES;




shell编程:
#!/bin/bash
运行: bash a.sh
自定义变量:
    存: name=xiaoguai age=18
    取: echo $name $age
系统变量:
    $USER 当前登录用户名
    $HOME 当前用户家目录
命令返回值:
    mydir=ls /usr/local
    echo $mydir

表达式+控制结构

表达式 : 命令 数学 字符串 文件判断
控制结构: if/else elif
    if true
    then
        echo hello
    else
        echo welcome
    fi

          判断
    if [ -d ./test ]     文件
    if [ $age1 -gt $age2 ]  数学

 表达式

 数学表达式:
    sum=$[ $age1+$age2 ]
 字符串判断:
    if [ $USER = root ]

控制结构: for循环

for name in a b c d xg
do
    echo $name
done

eg: tdir=/usr/local/src
    for file in ls $tdir
    do
        if [ -d $tdir ]
        then
            rm -rf $tdir/$file
            echo remove $tdir/$file ok
        if
    done

    for((i=1;$i<10;i++))
    do
        echo $i
    done

shell脚本接受参数:
    $1 $2 $3 ... 在shell中直接使用$n就可以取第n个参数的值


命令行执行php:
    1: 配置变量:
    ln /usr/local/php/bin/php /bin/php
    2: php -v
  接受参数: $argv 0=>file.php 1=>arg1 2=>arg2




linux 定时任务:
    corntab -e :
         *  *  *  *  *  命令
        分 时 日 月 周   定时执行命令
        */2 */3 2         在2号的每
        分 时 日 月 周   定时执行命令
    mkdir dira >> /dev/null 2>&1


    mysql 数据库备份:
        cd /usr/bin/
        mkdir -p /usr/local/llqhz/data/mysql/llqhz
        mysqldump -uroot -p12345678 -B llqhz > /usr/local/llqhz/data/mysql/llqhz/llqhz.sql
    数据压缩:
        cd /usr/local/llqhz/data/mysql/llqhz
        tar cfz 20160525.sql.tar.gz llqhz.sql

    日期格式化:  date +%Y%m%d%H%M 设置时间: date -s '2017-08-24 20:49:23' -d '-1 day'


        mkdir -p /usr/local/llqhz/bin/mysql/
        cd /usr/local/llqhz/bin/mysql/

        vim llqhz.bak

        #!/bin/bash
        cd /usr/bin/
        datadir=/usr/local/llqhz/data/mysql/llqhz
        year=date +%Y
        day=date +%m%d
        if [ -d $datadir/$year ]
        then
        tmp1=1
        else
        mkdir -p $datadir/$year
        fi
        mysqldump -uroot -p12345678 -B llqhz >  $datadir/$year/$day.sql
        cd $datadir/$year
        tar cfz $day.sql.tar.gz $day.sql
        oldday=date -d '-3 day'  +%m%d
        olddata=$datadir/$year/$oldday.sql.tar.gz
        if [ -f $olddata ]
        then
        rm -f $olddata
        fi

#!/bin/bash
cd /usr/bin/
datadir=/usr/local/llqhz/data/mysql/llqhz
year=`date +%Y`
day=`date +%m%d%H%M`
if [ -d $datadir/$year ]
then
tmp1=1
else
mkdir -p $datadir/$year
fi
mysqldump -uroot -p12345678 -B llqhz >  $datadir/$year/$day.sql
cd $datadir/$year
tar cfz $day.sql.tar.gz $day.sql
rm -f $day.sql
oldday=`date +%m%d%H%M -d '-7 minutes'`
olddata=$datadir/$year/$oldday.sql.tar.gz
if [ -f $olddata ]
then
rm -f $olddata
fi

crontab -e
*/1 * * * * bash /usr/local/llqhz/shell/llqhz.bak.sh >> /dev/null 2>&1


yum install screen
screen -S myweb 建立
screen -r myweb 恢复

/usr/local/php/lib/php/extensions/no-debug-non-zts-20131226/




PHP 接受 linux命令方式运行参数
php demo.php hello world


// 用 $argv 或者 $argc 接收
print_r($argv);  // print_r($argc);
接收到3个参数Array
(
    [0] => demo.php
    [1] => hello
    [2] => world
)



   寻找php.ini的位置 :
    1 sudo find / | grep php.ini

   安装phpize
    2 whereis phpize


    libmemcached-dev

    重启apache2

