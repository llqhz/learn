<?php
/**
 * @Author: llqhz
 * @Date:   2017-09-30 21:14:11
 * @Last Modified by:   name
 * @Last Modified time: 2018-08-16 11:18:13
 */
 ali os 120.77.183.43

安装 screen
 yum install screen
 screen -S root  ( screen -r root )

 初始化环境 :
    yum install gcc automake autoconf libtool gcc-c++ cmake
    mv /etc/my.cnf /etc/my.cnf.bak
    mkdir nginx
    mkdir php
    mkdir nginx
[nginx]
1: yum install pcre pcre-devel  [pcre*] rewrite 重写模块
2: yum install zlib zlib-devel  [zlib*] 对 http 包的内容进行 gzip
3: yum install -y openssl openssl-devel 支持 https（即在ssl协议上传输http）
cd /usr/local/src/nginx
wget http://nginx.org/download/nginx-1.12.1.tar.gz

4: ./configure --prefix=/usr/local/nginx --with-http_stub_status_module --with-http_ssl_module #支持https
5: make && make install
6: ./sbin/nginx

[mysql]
mysql的安装:
mirrors: http://mirrors.sohu.com/mysql/MySQL-5.7/
reference:  http://www.cnblogs.com/gaojupeng/p/5727069.html

0: yum install libaio-devel.i686 glibc.i686 libstdc++-devel.i686 ncurses-devel.i686
    cd /usr/local/src
1: wget http://mirrors.sohu.com/mysql/MySQL-5.7/mysql-5.7.18-linux-glibc2.5-i686.tar.gz
2: tar xfvz mysql-5.7.18-linux-glibc2.5-i686.tar.gz
3: cp mysql-5.7.18-linux-glibc2.5-i686 /usr/local/mysql -R
   mkdir /usr/local/mysql/data
4: userdel mysql    groupdel mysql   groupadd mysql
   useradd -g mysql mysql -M -s /sbin/nologin    ( -M 没有家目录, -s 禁止登录)
5: ./bin/mysqld --user=mysql --basedir=/usr/local/mysql --datadir=/usr/local/mysql/data --initialize
   note:
   A temporary password is generated for root@localhost: Ze-s3tfzDlk%
   # A temporary password is generated for root@localhost: Dl8WRvW4Qe*9
6: vim /etc/my.cnf
    [mysqld]
    basedir=/usr/local/mysql
    datadir=/usr/local/mysql/data
    socket=/tmp/mysql.sock 改变所有者及权限
    character_set_server=utf8
    init_connect='SET NAMES utf8'

    [mysqld_safe]
    log-error=/usr/local/mysql/data/iZwz97l4xqujlrmia5wmo6Z.err
    pid-file=/usr/local/mysql/data/iZwz97l4xqujlrmia5wmo6Z.pid

    [client]
    default-character-set=utf8

    # include all files from the config directory
    #!includedir /etc/my.cnf.d
6: 第二种方法
    vim support-files/mysql.server
    basedir=/usr/local/mysql
    datadir=/usr/local/mysql/data


7: chown -R mysql:mysql /usr/local/mysql
   chmod 755 -R /usr/local/mysql
   ./support-files/mysql.server start

8: cp /usr/local/mysql/support-files/mysql.server /etc/init.d/mysqld
   chmod 755 /etc/init.d/mysqld
   检查开机启动项: systemctl list-unit-files
9: service mysqld restart重启
   service mysqld start  开启
   service mysqld stop   关闭
10: 软连接: ln -s /usr/local/mysql/bin/mysql /usr/bin
    mysql -u root -p
    SET PASSWORD = PASSWORD('llqhz');  flush privileges;
    // 新版： alter user 'root'@'localhost' identified with mysql_native_password by 'llqhz';
 tips: 查看mysqld socket
            ps -aux | grep mysql
11: 授权:
    grant all privileges on *.* to llqhz@'%' identified by 'llqhz' with grant option;
    flush privileges;

    # 8.0 版本mysql采用以下方法
    create user llqhz@"%" identified by "llqhz"; 
    grant all privileges on *.* to "llqhz"@"%" with grant option; 
    flush privileges;

12: 设置编码
    show variables like 'character%';
    SET character_set_database = utf8;
    \s 查看mysql sock default:/tmp/mysql.sock
13: 配置当前my.cnf
    1: ps -aux|grep mysql 查看mysql使用配置
    2: mysql --help|grep 'my.cnf' 查看加载的my.cnf顺序
12: 测试pdo
    ref: http://www.cnblogs.com/xiaochaohuashengmi/archive/2010/08/12/1797753.html
    <?php
        $dsn = "mysql:host=localhost;dbname=llqhz";
        $db = new PDO($dsn, 'llqhz', 'llqhz');
        $count = $db->exec("INSERT INTO user SET name = 'llqhz'");
        echo $count;
        $db = null;
    ?>

[php]
mirrors: http://am1.php.net/distributions/php-7.1.10.tar.gz
安装php: [php5/7]

0: yum install gd zlib zlib-devel openssl openssl-devel libxml2 libxml2-devel libjpeg libjpeg-devel libpng libpng-devel libtool libtool-devel pear pear-devel curl curl-devel libcurl libcurl-devel
1: wget http://am1.php.net/distributions/php-7.1.10.tar.gz
2:  ./configure --prefix=/usr/local/php \
    --with-gd \                         #gd绘图库
    --enable-gd-native-ttf \            #支持字体
    --with-jpeg-dir=lib                 #gd支持jpeg
    --enable-mysqlnd \                  #mysql连接支持
    --with-mysqli=mysqlnd \             # mysql_connect => mysqli_connect
    --with-pdo-mysql=mysqlnd \
    --with-openssl \
    --enable-mbstring \
    --with-curl \
    --with-freetype \
    --enable-fpm                        # php作为独立进程运行

./configure --prefix=/usr/local/php --with-gd --enable-gd-native-ttf --with-jpeg-dir=lib --enable-mysqlnd --with-mysqli=mysqlnd --with-pdo-mysql=mysqlnd --with-openssl --enable-mbstring --with-curl --with-freetype --enable-fpm

# php7.4
./configure --prefix=/usr/local/php --enable-gd --enable-mysqlnd --with-mysqli=mysqlnd --with-pdo-mysql=mysqlnd --with-openssl --enable-mbstring --with-curl --with-freetype --enable-fpm

3: make && make install
    You may want to add: /usr/local/php/lib/php to your php.ini include_path
4: ./sbin/php-fpm 启动  {报错：FPM initialization failed 请执行第5步后即可}

5: cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf
   {vim ./etc/php-fpm.conf     -> set nu  ->125}
   cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf
6  ./bin/php -v        #查看版本


[nginx => php]
配置nginx 解释 php
0:  cd /usr/local/nginx   配置站点根目录
1:  vim ./conf/nginx.conf
2:  : set nu   ->   65-71 fastcgi_param -> $DOCUMENT_ROOT{+...}
    配置php.ini
3:  cp /usr/local/src/php-7.1.10/php.ini-development /usr/local/php/lib/php.ini
4:  ./sbin/nginx -s reload        #重启nginx
5:  pkill -9 php  -> (php:)./sbin/php-fpm  #重启php

[phpmyadmin]
reference: http://www.jb51.net/article/71208.htm
mirrors: https://files.phpmyadmin.net/phpMyAdmin/4.7.4/phpMyAdmin-4.7.4-all-languages.tar.gz

0:  php.ini => 1355行 session.save_path = "/tmp"
    pkill -9 php ./sbin/php-fpm
1: wget https://files.phpmyadmin.net/phpMyAdmin/4.7.4/phpMyAdmin-4.7.4-all-languages.tar.gz
2: tar xfzv phpMyAdmin-4.7.4-all-languages.tar.gz
3: cp phpMyAdmin-4.7.4-all-languages /usr/local/nginx/html/phpmyadmin -R
4: cd phpmyadmin
   cp config.sample.inc.php config.inc.php
   vim config.inc.php17行 => $cfg['blowfish_secret'] = 'www.llqhz.cn';
5: 配置Nignx下的站点访问 120.77.183.43:8081
    vim /usr/local/nginx/conf/nginx.conf

    server {
        listen 8081;
        server_name localhost;
        #access_log logs/phpmyadmin.access.log  main;

        location / {
            root html/phpmyadmin;
            index index.php index.html;
        }

        location ~ \.php$ {
            root           html/phpmyadmin;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }

        location ~ /\.ht {
            deny all;
        }

    }
6: 加速访问:  vim phpmyadmin/version_check.php
 26 if (empty($versionDetails)) {
 27     echo json_encode(array());
 28 } else {
 29     echo json_encode(array());   //
 30     die();                       // 禁止检测更新



备注:
[nginx]
    nginx path prefix: "/usr/local/nginx"
    nginx binary file: "/usr/local/nginx/sbin/nginx"
    nginx modules path: "/usr/local/nginx/modules"
    nginx configuration prefix: "/usr/local/nginx/conf"
    nginx configuration file: "/usr/local/nginx/conf/nginx.conf"
    nginx pid file: "/usr/local/nginx/logs/nginx.pid"
    nginx error log file: "/usr/local/nginx/logs/error.log"
    nginx http access log file: "/usr/local/nginx/logs/access.log"
    nginx http client request body temporary files: "client_body_temp"
    nginx http proxy temporary files: "proxy_temp"
    nginx http fastcgi temporary files: "fastcgi_temp"
    nginx http uwsgi temporary files: "uwsgi_temp"
    nginx http scgi temporary files: "scgi_temp"


php安装扩展:

phpize 方式:
 wget http://pecl.php.net/get/xdebug-2.4.0RC4.tgz

 tar xfzv xdebug-2.4.0RC4.tgz
 cd xdebug-2.4.0RC4/

 phpize
 find / | grep php-config

 ./configure --with-php-config=/usr/bin/php-config
 sudo make
 sudo make install

 [php.ini]    869行
 sudo find / | grep php.ini        =>   /etc/php5/cli/php.ini        cli客户端模式的php.ini
                                   =>   /etc/php5/apache2/php.ini    apache端模式的php.ini

重启apache  ubuntu:apache  sudo /etc/init.d/apache2 restart


pecl方式  pecl install xdebug     =>   add extension.so to php.ini



xdebug 安装:
(1) 在https://xdebug.org/wizard.php上粘贴phpinfo的html源码 下载推荐的xdebug并解压
(2) phpize
(3) ./configure --with-php-config=/usr/local/php/bin/php-config
(4) add to ini : zend_extension = /usr/local/php/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so


自带库安装方式
cd /usr/local/src/php/php7.2.3/ext/zli
find / | grep php-config    => -php-config
 cp config0.m4 config.m4
 phpize
./configure --with-zlib --with-php-config=/usr/local/php/bin/php-config
make && make install
=== >   add extension.so to php.ini  # php -d foo=bar
# php -d extension=swoole.so





