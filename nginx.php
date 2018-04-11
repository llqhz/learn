开源协议:
    GPL 开源 => 开源
    BSD 开源 => 闭源(商业)

nginx BSD开源协议

目录结构: /usr/local/nginx
    conf 配置文件
    html 网页文件
    logs 日志文件
    sbin 主要二进制程序

启动:
    ./sbin/nginx

查看进程:
    ps aux | grep nginx

快速重启:
    kill -USR2 `cat /usr/local/nginx/logs/nginx.pid`

nginx重启操作: kill也有对应操作
    nginx -t 测试配置是否正确
    nginx -s reload 重新加载配置 重启新子进程以加载新配置
    nginx -s stop 立即停止  结束当前所有解析
    nginx -s quit 优雅停止  解析完当前页面后退出
    nginx -s reopen 重新打开日志
nginx logs为引用访问,改变文件名依然指向原日志读写,故须reopen


nginx conf:
    worker_processes 1;工作进程数 cpu数量*核数
    worker_connections  1024; 每个work支持的连接数

虚拟主机:
    server {
        listen       80;
        server_name  localhost;

        #charset koi8-r;

        #access_log  logs/host.access.log  main;

        location / {
            root   html;
            index  index.html index.htm;
        }

        #error_page  404              /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
        #
        #location ~ \.php$ {
        #    proxy_pass   http://127.0.0.1;
        #}
        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        location ~ \.php$ {
            root           html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
            include        fastcgi_params;
        }

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #    deny  all;
        #}
    }

    配置新虚拟主机:
    server {
        listen       80;
        server_name  llqhz.cn;
        location / {
            root   html/llqhz;
            index  index.html index.htm;
        }
        location ~ \.php$ {
            root           html/llqhz;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
            include        fastcgi_params;
        }
    }

    虚拟主机:(支持pathinfo+rewrite)
    server {
        listen       80;
        server_name  shop.llqhz.cn;

        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        #location / {
        #    root           html/aishop/public;
        #    fastcgi_pass   127.0.0.1:9000;
        #    fastcgi_index  index.php;
        #    try_files $uri /index.php?$uri;
        #}
        #########   seccess   ################
        location / {
            root   html/aishop/public;
            index  index.html index.htm;
            try_files $uri /index.php/$uri;
        }
        location ~ \.php(.*)$ {
            root           html/aishop/public;
            fastcgi_pass   127.0.0.1:9000;
            #fastcgi_index  index.php;  与try_files不共存
            fastcgi_param  SCRIPT_FILENAME $DOCUMENT_ROOT$fastcgi_script_name;
            fastcgi_param  PATH_INFO $1;
            include        fastcgi_params;
        }
        ########    success    ##################
    }


nginx日志:
    106.120.162.109 - - [25/Aug/2017:23:30:42 +0800] "GET / HTTP/1.1" 200(状态码) 612(length) "-" "Mozilla/5.0 (Windows NT6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"

    定义日志格式:
    access_log  logs/llqhz.access.log  simple;

    http_x_forwarded_for  --代理服务器帮用户访问时附带的http头信息->用户ip

nginx支持path/info
    location ~ \.php(.*)$ {
        root           html/llqhz;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $DOCUMENT_ROOT$fastcgi_script_name;
    =>  fastcgi_param  PATH_INFO $1;  #捕捉.php后面的内容并赋值给http头的pathinfo
        include        fastcgi_params;
    }

nginx url重写:隐藏index.php
    location / {
        root   html/llqhz;
        index  index.html index.htm;
        if ( !-e $request_filename ) {
            rewrite (.*)$ /index.php/$1        #php请求重写 img不需重写
        }
    }

nginx try_files  PATH_INFO+隐藏index.php 与上面等价 去掉pathinfo+rewrite

    location / {
        root   html/llqhz;
        index  index.html index.htm;
        try_files $uri /index.php?$uri;
    }

nginx反向代理 (附带ip)将图片转发给apache处理
    location ~ \.(jpeg|jpg|png|gif)$ {
        proxy_pass http://192.168.2.42:80;
        proxy_set_header X_Forwarded_For $remote_addr;
    }

    http://192.168.2.42服务器显示声明access log为main

nginx集群与负载均衡  反向代理+集群+负载均衡
    upstream imgserver {
        server 192.168.2.101:80 whight=1 max_fails=2 fail_timeout=30s;
        server 192.168.2.102:80 whight=1 max_fails=2 fail_timeout=30s;
    }
    location ~ \.(jpeg|jpg|png|gif)$ {
        proxy_pass http://imgserver;    #nginx集群
        proxy_set_header X_Forwarded_For $remote_addr;
    }



负载均衡算法:(多服务器参数共享)
    默认的负载均衡的算法:
    是设置计数器,轮流请求N台服务器.

    可以安装第3方模式,来利用不同参数把请求均衡到不同服务器去
如基于cookie值区别用户   (nginx sticky)
  基于URI利用一致性哈希算法(NginxHttpUpstreamConsistentHash模块)
  基于IP做负载均衡等.



mysql的安装:
mirrors: http://mirrors.sohu.com/mysql/MySQL-5.7/
reference:  http://www.cnblogs.com/gaojupeng/p/5727069.html

0: yum install libaio libaio.devel
    cd /usr/local/src
1: wget http://mirrors.sohu.com/mysql/MySQL-5.7/mysql-5.7.18-linux-glibc2.5-i686.tar.gz
2: tar xfvz mysql-5.7.18-linux-glibc2.5-i686.tar.gz
3: cp mysql-5.7.18-linux-glibc2.5-i686 /usr/local/mysql
   mkdir /usr/local/mysql/data
4: userdel mysql    groupdel mysql   useradd mysql  userdel mysql
5: ./bin/mysqld --user=mysql --basedir=/usr/local/mysql --datadir=/usr/local/mysql/data --initialize
   note:
   A temporary password is generated for root@localhost: EWMi/8lV8xM%
6: vim /etc/my.cnf
    [mysqld]
    basedir=/usr/local/mysql
    datadir=/usr/local/mysql/data
    socket=/var/lib/mysql/mysql.sock 改变所有者及权限
    character_set_server=utf8
    init_connect='SET NAMES utf8'

    [mysqld_safe]
    log-error=/usr/local/mysql/log/mysql.log
    pid-file=/usr/local/mysql/mysql.pid

    [client]
    default-character-set=utf8

    # include all files from the config directory
    !includedir /etc/my.cnf.d


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
 tips: 查看mysqld socket
            ps -aux | grep mysql
11: 授权:
    grant all privileges on *.* to llqhz@'%' identified by 'llqhz' with grant option;
    flush privileges;
12: 测试pdo
    ref: http://www.cnblogs.com/xiaochaohuashengmi/archive/2010/08/12/1797753.html
    <?php
        $dsn = "mysql:host=localhost;dbname=test";
        $db = new PDO($dsn, 'root', '');
        $count = $db->exec("INSERT INTO foo SET name = 'heiyeluren',gender='男',time=NOW()");
        echo $count;
        $db = null;
    ?>
