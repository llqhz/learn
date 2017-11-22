<?php

$str2 = <<<'EOF'
        /*1： php变量引用   结题方法，画图分析法，对比法  */

    1 写时复制 COW（copy on write）
    //php变量，数组，对象都是写时复制  COW（copy on write）机制
    $a = range(0,1000);
    var_dump( memory_get_usage() );

    $b = $a;   //没有复制，而是指向同一内存空间
    var_dump( memory_get_usage() );

    $a = range(0,1000); //修改了才会再复制
    var_dump( memory_get_usage() );

    2 函数传参
    值传递:    PHP的数组和标量都是值传递
    引用传递:  PHP的对象是引用传递,并且可以在函数内动态赋值和删值,里外同时更改

EOF;

$str = <<<'EOF'
            2-4 运算符知识点
    运算符
        运算符的错误控制符@
        运算符优先级 比较运算符 逻辑运算符 ++--运算符
        eg：foo()  和   @foo()    @屏蔽错误

        优先级 ：
        ++--  >  !  >  +-*/  >  <.==.>
        递增   取反   算数    比较  逻辑符 三目 赋值 逻辑字(最低)

        == 和 ===(大小和类型)
        null++ => 1  true++ => true

        逻辑运算符 短路作用


EOF;

$str = <<<'EOF'
            2-5 流程控制 分支考点

    1 php数组循环操作的语法
    for 循环 索引数组
    foreach 会自动reset而list不会

    while ( list($k,$v) = each($arr) ) {
        # code...
    }
    foreach ($arr as $key => $val) {
        # code...
    }
    for ($i=0; $i < count($arr); $i++) {
        # code...
    }

    2 分支考点
    if (condition) {   只会执行一个代码块
            成立可能性大的往前放
        # code...
    } elseif (condition) {
        # code...
    }

    switch (variable) {
        case 'value':   value=>数字和字符串
            # code...
            break;    continue => break     continue 2;
        default:
            # code...
            break;
    }

    优化：成立可能性大的往前放 如果可以，用switch case替换

EOF;

$str = <<<'EOF'
            2-6 + 2-7 函数，自定义函数 + 内置函数
    eg：作用域 静态变量 参数 引用传递 返回值 引用返回 文件包含 内置函数

    1 全局
        global $a;
        $GLOBALS['a'];

    2 静态变量
        只初始化一次，初始化需要赋值 static也有局部限制  可用于终止递归

    3 函数传参
        引用传递  fun($a,&$b,$c='')

    4 函数返回
        return $a++;  => return $a; $a++;
        return $arr | $obj;
        引用返回

    5 函数的引用返回
        声明和使用时，都必须同时加&
        function &fun()
        {
            return $s;
        }
        $a = &fun();   则$a与函数内部$s 为引用关系;

    6 外部文件导入
        1 路径 2 include_path 3 当前目录
        作用域继承与当前行
        include 警告 脚本继续执行
        require 致命错误 (核心类库引入)
        include_once require_once 只会引入以此 多次会忽略

    7 系统内置函数
        1 时间日期函数
            date() strtodate() mktime() time() microtime()
            date_default_timezone_set()

            getdate()
                array (size=11)
                  'seconds' => int 16
                  'minutes' => int 26
                  'hours' => int 9
                  'mday' => int 12
                  'wday' => int 4
                  'mon' => int 10
                  'year' => int 2017
                  'yday' => int 284
                  'weekday' => string 'Thursday' (length=8)
                  'month' => string 'October' (length=7)
                  0 => int 1507793176
            year mon mday hours minutes seconds
            yday mday wday weekday month time()

          eg：某两日期相差几天？
        2 ip处理
            ip2long()   long2ip()
            $ip = '192.168.1.1';
            $ip_long = sprintf( "%u",ip2long($ip))
            $ip = long2ip($ip_long)
        3 打印处理
            语言结构：print(一个变量) echo 多个变量
            函数：printf(格式化) sprintf(格式化后返回)
                  print_r(数组和对象) print_r($v,true)不打印而是返回
                  var_dump() 添加css样式后输出 var_export()作为语法结构
        4 序列化和反序列化
            serialize       unserialize
            json_encode     json_decode
            JSON.stringfy   JSON.parse
        5 字符串处理函数
            查找  替换  分割  过滤
        6 数组处理函数
            排序  过滤

            理解作用域，静态变量，函数引用    记忆字符串和数组处理函数



EOF;


$str = <<<'EOF'
             2-8 正则表达式
        作用：分割、查找、匹配、替换 （字符串）
        分隔符：正斜线 /   hash符号 #   取反符号 ~
        通用原子： \d  \D  \w  \W  \s  \S
                  数字 取反(除了数字0-9)
                  w关键字   s空格
        元字符：.[除了\n]  *{0,} +{1,} ?{0,1} /^.$/
                [或者]  (后向引用)  [-]范围  |或者
        模式修正符：i m e s U x A D u
                    i不区分大小写 m分行匹配 e语法preg_replace处理 s修.的换行 U取消模式 x忽略换行 A必须开头 D u编码为utf8匹配

    1 后向引用
        patt1 = /([a-z]+) \1/; 匹配两个相同单词同时出现
        preg_replace( /<b>(.*)</b>/, '\1', $str); 去掉<b>标签

    2 贪婪模式 限定个数的* + 等后加? 取消贪婪模式 执行最短匹配
        .*   .*会匹配尽量多的字符，即使已经匹配
        /<b>.*</b>/ 会匹配最外层 "<b>abc</b> <b>bcd</b>"
        .*? 取消贪婪模式  ->  '/<b>.*</b>/U'取消贪婪模式
    3 正则预判
        正则预判 /abc(?:de)/
        正向预判 abc(?=de)
        反向预判 abc(?!de)

    4 正则函数
        preg_match()     preg_match_all()
        preg_replace()   preg_split()

        preg_match()

    5 中文匹配
        1 utf8      preg_match("/[\x{4e00}-\x{9fa5}]+/u",$str,$match)
        2 gb2312    preg_match("/([x81-xfe][x40-xfe])/", $str, $match)
        2 gb2312    pattrn = '/[chr(0xb0)-chr(0xf7)][chr(0xa1)-chr(0xfe)]/'
  '/['.chr(0xb0).'-'.chr(0xf7).']['.chr(0xa1).'-'.chr(0xfe).']/'
            www.baidu.com join.llqhz.com.cn
            url:  '/^http:\/\/([a-z0-9]+\.){2,3}([a-z0-9]+)/'
            email '/[\w]+@/([a-z0-9]+\.){1,2}([a-z0-9]+)'
            ip:   '(\d+\.){3}(\d+)'
            phone '1[3568]\d{9}'
        取img里面的src值：（正则）
            <img src="snow.jpg" alt="flow" />
            $parttn = '<img.*?src="(.*?)".*?\/?>/'
            preg_match($parttn,$str,$match);

    6 notice ：
        正则匹配不认识中文：
            /\b\d+\b/ 可以匹配   "加加123呵呵 12321等家"  之类
        找出首尾相同的单词
            /\b(\w)\w*?\1\b/
EOF;



$str = <<<'EOF'
            2-9 文件及目录操作
        文件读写操作 目录操作函数 其他文件操作

    1 文件读写操作
        fopen   r/r+  读/读写
                w/w+  写/读写 清空 创建
                a/a+  追写/追读写 结尾 创建
                x/x+  写/读写 安全创建(存在返回false)
                b二进制   t
        写   fwrite   fputs
        读   fread    fgets()获取一行   fgetc获取一个字符
             file()读取到数组      readfile()读取输出到缓存区
        不需要fopen
             file_get_contents()
             file_put_contents()

        访问远程文件
        allow_url_fopen();
        http =>只读         ftp  =>只读/写

    2 目录操作函数
        1. 路径
            basename()
            dirname()
            pathinfo()=>path  parse_url()=>url
        2. 目录读取
            opendir()  readdir()   closedir()   rewinddir()
        3. 目录创建和删除
            mkdir()    rmdir()删除空目录
        4. 文件操作
            文件大小 filesize()
            目录大小 disk_free_space()   disk_total_space
            文件拷贝 copy()   删除  unlink()
            文件类型 filetype
            移动 rename
            截取 ftruncate()   截取到指定大小
            属性 file_exists() is_readable() is_writable()
                 is_executable() fileatime(访问访问) filectime(创建) filemtime(修改时间)
        5. 其他文件操作
            文件锁:   flock()
            文件指针: ftell()      fseek()      rewind()
    牢记文件操作函数及几种打开模式
    理解目录操作的步骤
    尝试联系完成目录的复制和删除函数的编写(注意./../)

        eg:
        function lists($dir='.',$lv=1)
        {
            if ( !is_dir($dir) ) {
                return;
            }
            $fp = opendir($dir);
            while ( false !== ($filename=readdir($fp)) ) {
                if ( $filename == '.' || $filename == '..' ) {
                    continue;
                }
                $nextdir = $dir.'/'.$filename;
                $prefix = str_repeat('  ',$lv);
                echo $prefix,$filename,"\n";
                if ( is_dir($nextdir) ) {
                    lists($nextdir,$lv+1);
                }
            }
            closedir($fp);
        }

EOF;

$str2 = <<<'EOF'
        2-10  会话控制技术
2：简述cookie和session的区别以及各自的工作机制，存储位置等，简述cookie的优缺点*/
考点：php的会话控制技术 cookie与session
作用： 允许服务器跟踪同一个客户端做出的连续请求
方式：  1 get参数传递   SID为sessionName和id的拼接，若cookie未禁用则为空
            <a href="index.php<?php echo session_name(),'=',session_id(); ?> "></a>
            <a href="index.php<?php echo SID; ?> "></a>
        2 cookie
            setcookie(name, value, expires, path, domain, secure, httponly)
            setcookie(变量名, 值, 过期时间(时间戳), 有效路径, 有效二级域名, 安全, httponly)
            $_COOKIE['name']   setcookie('a[key]',val);
            setcookie('name','',time()-1000)
        3 session
            session_start();
            $_SESSION['name'] = val;
            $_SESSION['name'] = null;
            session_destroy()  删除session文件
        session.auto_start
        session.cookie_domain 存储sessionid的cookie的有效域名
        session.cookie_lifetime
        session.cookie_path
        session.name = PHPSESSID  cookie中的session键名
        session.save_path session在服务器存储的目录
        session.use_cookie
        session.use_trans_sid

        session的垃圾回收机制 检查消耗性能 存储占用磁盘
        过期时间是1440秒，每100次session_start，固定一次检查所有session文件并删除过期
        session.gc_maxlifetime = 1440
        session.gc_divisor = 100
        session.gc_probability = 1

优缺点：优：1：存储在客户端，不占服务器资源
        缺：1：不安全，用户可禁用和修改
        优：1：安全
        缺：2：占用资源=>磁盘     分布式session共享(redis)
联系：session通过cookie来传递sessionid 通过sessionid来取服务端session文件信息

session的分布式解决方案
    session不再以文件存储，而是存入mysql，memcached
    session_set_save_handler()   所有服务器都向redis里面存取session

    session存储方式 文件(默认)，数据库，缓存
            遍历 ： $_SESSION[]数组遍历



EOF;


$str3 = <<<'EOF'
        2-11 面向对象考点  背和记忆
    写出php类控制权限修饰符   =>  封装、继承、多态 魔术方法 设计模式

    1 类权限修饰符
        public protected private 类外部，本类，子类
        单一继承 方法重写 parent::say()  self::

        抽象类可以没有抽象方法，有抽象方法一定得声明为抽象类
        接口，接口是抽象方法的集合interface
        抽象类是(抽象+普通)方法和常量属性 的集合

    2 魔术方法
        __construct __destruct __call __calStatic
        __get __set __isset __unset
        __sleep __wakeup __toString __clone

    3 设计模式 大话php设计模式
        常见设计模式
        工厂模式    根据传来的参数决定返回的对象类型
                    如 数据库mysql,oracle,sql server  统一SQL类来创建

        单例模式    程序只允许存在一个实例,一旦创建就会留于内存
                    比如购物车,一个用户只允许有一个购物车保存当前购物信息
                    数据库类sql 一次创建,只需一次连接,只需一个实例

        注册树模式

        观察者模式  观察者提供update方法,通知类增删观察者,并负责调用观察者update方法

        策略模式    将类的构造参数改为不同类的同一方法提供,这样根据传不同类来实现传不同参数
                    根据不同策略(类组合)来实现灵活功能

        适配器模式   新构造类处理结果为特定需要的结果
                    Weather getTemperature => 华氏度
                    CNWeather getTemperature => 摄氏度
        将一个类的接口转换成客户希望的另一个接口,适配器模式使得原本的由于接口不兼容而不能一起工作的那些类可以一起工作。



EOF;



$str4 = <<<'EOF'
         2-12 网络协议
    http/1.1 中状态码 200 301 304 403 404 500含义
    http协议状态码 => osi七层模型 http工作特点和原理 请求响应头和请求方法
                      https工作原理 常见网络协议及端口

    1 HTTP协议状态码
            描述请求结果状态信息
        五大类：
            1xx 信息类状态码 接收的请求正在处理
            2xx success 成功状态码 请求正常处理完毕
            3xx redirection 重定向 继续跳转处理
            4xx ClientError 客户端错误 请求错误，服务器无法处理请求
            5xx ServerError 服务器错误 服务器处理请求出错

            200 ok 成功
            204 no content 成功但没有响应正文
            206 part content 处理了部分请求

            301 moved permanently 永久性重定向
            302 not found 临时性重定向
            303 See Other 所请求的页面可在别的url下被找到。
            304 Not Modified 原来缓存的文档还可以继续使用。
            307 Temporary Redirect 被请求的页面已经临时移至新的url

            400 Bad Request 服务器未能理解请求。报头存在错误
            401 Unauthorized 被请求的页面需要用户名和密码。
            403 Forbidden 对被请求页面的访问被禁止。被服务器拒绝
            404 Not Found 服务器无法找到被请求的页面。

            500 Internal Server Error 服务器遇到不可预知的情况。执行代码出错
            503 Service Unavailable 请求未完成。服务器临时过载或宕机。

    2 osi七层模型
        物理层，数据链路层，网络层，传输层，会话层，表示层，应用层
            物理层 建立维护断开物理连接
            数据链路层 建立逻辑连接，硬件寻址，差错校验
            网络层 进行逻辑地址寻址，网络路径选择 ip
           *传输层 定义协议端口号，流控差错校验 TCP UDP，数据包离开网卡即传输
            会话层
            表示层 数据表示，安全和压缩
           *应用层 网络服务于最终用户的一个接口
                   HTTP HTTPS FTP TFTP SMTP POP3 DNS TELNET DHCP

    3 http工作特点和原理
        http协议工作特点
            基于B/S模式
            通信开销小 简单快速 传输成本低 (协议头信息)
            使用灵活 节省传输时间 无状态

        工作原理
            三次握手
    request
       *Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8
        Accept-Encoding:gzip, deflate, sdch
        Accept-Language:zh-CN,zh;q=0.8
       *Cache-Control:max-age=0 | public | private | no-cache
       *Connection:keep-alive
       *Cookie:PHPSESSID=ffuci3km0maj331411b3h0cv64
       *Host:119.29.119.219
       *Referer:http://119.29.119.219/llqhz/Music/index.html 上一个页面
        If-Modified-Since:Fri, 19 May 2017 09:07:18 GMT
        If-None-Match:"ed24d-54fdcd92b2a5b"
        Upgrade-Insecure-Requests:1
       *User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.3
    response
       *Cache-Control:private
       *Connection:Keep-Alive
       *Content-Encoding:gzip
        Content-Length:5767
       *Content-Type:text/html; charset=utf-8
        Date:Mon, 09 Oct 2017 03:17:55 GMT
        Expires:Thu, 19 Nov 1981 08:52:00 GMT
       *Keep-Alive:timeout=5, max=100
        Pragma:no-cache
        Server:Apache/2.4.7 (Ubuntu)
        Vary:Accept-Encoding
        X-Powered-By:ThinkPHP
       *X-Forwarded-For:119.29.119.219 真实ip
        Access-Control-Allow-Origin: * | http://www.client.com

    4 请求
        get post
        head 服务器只返回头信息 检测服务器状态
        options 查看服务器支持的请求方法 服务器只返回支持的请求方法
        put 上传新数据替换之前post提交的数据
        delete 和 trace

        get和post的区别
            1 请求数据提交
            2 get浏览器可缓存 post不可缓存
            3 multipart-formdata

    5 https工作原理
        https协议在http协议的基础上添加了ssl/tls握手以及数据加密传输，也属于应用层协议

    6 常见网络协议及端口
        HTTP    80
        HTTPS   443
        FTP     21  文件传输协议
        SMTP    25  邮件传输
        POP3    110 接收邮件
        TELNET  23  远程登录协议 dos
        DNS     53  域名解析服务






EOF;

$str4 = <<<'EOF'
      2-13开发环境极其配置
    版本控制
    php运行原理 常见配置项

    1 版本控制软件 集中式 分布式
    集中式：CVS SVN
    分布式：Git

    2 PHP运行原理
    Nginx+php-fpm
    cgi cgi协议 php解释器与web服务器通信协议
        效率低，每一个请求独占一个进程
    fastcgi 处理完请求后，不终止进程，继续处理下一个请求
    php-fpm (php fastcgi process manager) fastcgi的进程管理器
        是fastcgi的实现，并提供了进程管理的功能
        进程：master+N-worker
            master 监听端口，接受请求并返回
            worker 多个， 解析执行php代码

    3 PHP常见配置项
        safe_mode = On
            检查当前脚本的拥有者和被操作的文件的拥有者是否相同,启用会减慢执行效率
        register_globals= Off
            PHP在进程启动时，会根据register_globals的设置，判断是否将$_GET、$_POST、$_COOKIE、$_ENV、$_SERVER、$REQUEST等数组变量里的内容自动注册为全局变量。
        allow_url_fopen = Off
            是否允许打开远程文件。
        allow_url_include = Off
            是否允许通过include/require来执行一个远程文件。

        date.timezone = Asia/Shanghai | PRC
            设置时区。该设置影响PHP中所有的日期、时间函数。

        display_errors = on  （生产环境关闭）
            是否将任何错误信息包含在返回给Web服务器的数据流中。
        error_reporting
            设置PHP的报错级别。
            eg : Error_reporting = E_ALL & ~E_NOTICE   // 除提示外，显示所有错误
            E_ALL(所有)  E_PARSE(语法)   E_ERROR(错误)
            E_WARNING(警告)   E_NOTICE(提示)

        post_max_size = 8M post数据大小
        upload_max_filesize = 8M
        max_file_uploads = 20 一个请求允许上传的最大文件数量限制。

        max_execution_time = 30
            脚本所能够运行的最长时间，默认值是30秒

        session.cookie_lifetime：
            传递sessionid的cookie有效期，0表示仅在浏览器打开期间有效。

    理解php运行原理，牢记以上配置
        eg：cgi  fastcgi php-fpm



EOF;


$str = <<<'EOF'
            3-1 js考察知识点
        js基本语法 js内置对象 DOM对象  Jquery基础
    1 js基本语法
        变量定义 变量可以_$开头
        声明var => undefined
      数据类型 字符串,数字,布尔,数组,对象,null,undifined  变量均为对象
    2 创建对象
        new Object();
        function obj(){ this.key=val; } new obj()
        {} json对象
    3 数组 new Array(size/vals)
    4 常量 Math.PI
    5 正则对象 RegExp
    3 函数: 无默认值,作用域 外->内
    4 运算符: +连接字符串 流程控制: else if
    5 内置函数 字符串
    3 内置对象
        window navigator screen histroy location
    4 DOM对象
        [document] element attr event

    5 Jquery基础
        选择器(CSS3选择器)
            基本 层次 过滤(可见性,属性,子元素,表单属性)

        Jquery事件:  click hover
        Jquery效果:   显示,隐藏
        JqueryDom操作: [属性],值,节点,[CSS],尺寸
       结题方法，牢记基础 HTML操作 Jquery选择器,事件,操作



EOF;


$str = <<<'EOF'
           3-2 Ajax
        ajax 基本原理
            jquery ajax
    1 概念: asynchronous javascript and xml
        异步更新
    2 工作原理
        XMLHttpRequest对象

        请求:  方法
            请求: open('get/post','url','async')
            发送: send('string/null')

        响应: 属性
            responseText
            responseXML

        相关: onreadystatechange
            readyState    status=>httpCode
            0 初始化 1建立连接 2接收 3处理 4完成
    3 jquery ajax
        $(e).load()  $.ajax()  $.get() $.post()
        $.getJSON() $.getScript()

        解题: 理解原理 牢记JqueryAjax方法

EOF;


$str = <<<'EOF'
            4-1 linux基础
        linux常用命令
        定时任务  vim   shell基础
    1 系统安全
        sudo su chmod setfacl
    2 进程管理
        w top ps kill pkill pstree killall
    3 用户管理
        id usermod useradd groupadd userdel
    4 文件系统
        mount umount fsck df du
    5 关键重启
        shutdown reboot
    6 网络应用
        curl telnet mail elinks wget
    7 网络测试
         ping netstat host
    8 网络配置
        hostname ifconfig
    9 常用工具
        ssh screen clear who date
    10 软件包管理
        yum rpm apt-get
    11 文件操作
        locate find
    12 文件内容
        head tail less more
    13 文件处理
        touch unlink rename ln cat
    14 目录操作
        cd mv rm pwd tree cp ls
    15 文件权限
        setfacl chmod chown chgrp
    16 压缩解压
        bzip2/bunzip2 gzip/gunzip zip/unzip tar
    17 文件传输
        ftp scp
    18 定时任务 备份,日志
        crontab -e * * * * * * 分时日月周
        at =>   #at 2:00 tomorrow  一次性执行
            at> /home/shell.sh
            at> ctrl+D(结束)
    19 vim 编辑器
        编辑模式 命令模式 尾行模式
        移动光标: ctrl+f/b 0/home $/end G/gg N+enter
        查找和替换
            /word ?word :n1,n2s/word1/word2/g
            :1,$s/word1/word2/g
            :1,$s/word1/word2/gc
        删除复制粘贴
            x,X dd ndd yy nyy p P ctrl+r
        退出:
            q w !
        视图模式
            v V ctrl+v y d 剪切
            :setnu :setnonu

    20 shell基础
        1 chmod a+x test.sh      ./test.sh
        2 ./bin/bash ./test.sh

            解题方法:  牢记以上知识点
        真题: 每天0:00重启服务器
            crontab -e
            0 0 * * * /usr/local/sh/restart.sh



EOF;



$str = <<<EOF
            5-1 mysql基础
        数据类型 int char varchar datetime text
        mysql数据类型 基础操作 存储引擎 锁机制
            事务处理 存储过程 触发器
    1 数据类型
        int tinyint smallint mediumint int bigint
            int(11)  11代表显示宽度 不是限制大小 且必须配合zerofill才能起作用
                    int(5) + zerofill  =>   12->00012
        float float double decimal(精确的小数,当做字符串处理)
        char    char 定长 (填充空格)
                varchar(增加一个字节表示长度) 超过会截取 不会扩充
        enum  char集合
        text  大文本

        日期时间存取方式
        timestamp   'Y-m-d H:i:s'
        datetime    'Y-m-d H:i:s'
        date        'Y-m-d'
        year        'Y'

        列属性 auto_increment default not null zerofill

    2 mysql-client  mysql -u user -p pwd -h host -P port
        \G 垂直限制 \c取消执行 q退出 s status h help d dilimiter ;

    3 存储引擎
        innodb 默认事务型引擎 聚簇索引 行级锁 安全恢复
        myisam 5.1版本前默认引擎 非聚簇索引 全文索引 myd/myi

        其他引擎 Memory CSV

    4 锁机制
        并发读取 排他性
             共享锁(读)
             排他锁(写) 禁止其他人同时也在读或写
        锁粒度  表锁 行锁

    5 存储过程(in/inout)/存储函数(return)
        多条sql语句的集合

    6 触发器
        自动触发动作 before after  <=>  insert update

        真题:  innodb/myisam            char/varchar
            行锁 事务 共享表空间



EOF;



$str = <<<'EOF'
            5-2mysql索引
        简述mysql索引,主键,唯一索引,联合索引的区别 对数据库的性能有什么影响
            考点: mysql索引的基础和类型
            延伸: 索引原则 注意事项
    1 索引基础:
        引是一种数据结构，存储对应数据表行的指针,根据特定的顺序组织排序
        查询操作时,索引相当于目录,先在索引上找到指向数据行的指针,
        然后顺指针直接在数据表行上取数据,起查询目录的作用

    2 索引对性能的影响
        减少数据扫描
        避免排序和临时表
        随机i/o变顺序i/o
        提高查询速度,降低写速度(维护索引),占用空间

    3 适用场景
        中.大表
        特大表 => 分区分表

    4 索引类型
        普通索引 唯一索引 主键索引

        主键和唯一: 主键(1个) 非空 包含

        联合索引 章->节 (章,节)

    5 索引创建原则
        1 where条件列 条件-> 比较(id>3) 排序(order by) 分组(group by)
        2 索引列区分度
        3 前缀长度
        4 联合索引

    6 联合索引
        左前缀原则 (不能跨列)
        查找 分组 排序
        索引失效  like左前缀  'A%'
                    where id>1 and id<100   全表扫描
                    where name = 100    name varchar(3)

        左前缀顺序
EOF;


$str = <<<EOF
            5.3mysql语句多表查询
        关联查询 关联更新
    1 关联更新
        update A,B set A.c1=B.c1,A.c2=B.c2 where A.id=B.id
        update A inner join B on A.id=B.id set A.c1=B.c1,A.c2=B.c2 where ...
        eg:
        update A,B set A.c1=B.c1,A.c2=B.c2 where A.id=B.id and A.id<50
        update A inner join B on A.id=B.id set A.c1=B.c1,A.c2=B.c2 where A.id<50

    2 关联查询
        交叉连接 cross join
            select * from A,B,C
        内连接 -> 自连接
            select * from A,B where A.id=B.id
            select * from A inner join B on A.id=B.id
        左链接/右连接

        联合查询
            union(去重)   union all(不去重)
        全连接
            left join  union right join

    3 嵌套查询
        真题: 多关联查询 1<=>N
        select B.hostname,res,C.hostname,time from match A inner join team B on A.id=B.id, inner join team C and A.id=C.id

EOF;



$str = <<<'EOF'
                无限极分类
    /**
     * 获取所有数据集(无限极分类)
     * @Author   llqhz
     * @DateTime 2017-07-31
     * @return   array     当前pid的所有子集
     */
    public function getTree($pid=0,$lv=0)
    {
        $tree = array();
        $res = $this->select();
        foreach ($res as $key => $row) {
            //查找pid的子集
            if ( $row['parent_id'] == $pid ) {
                //查询当前行，并添加到tree上
                $row['lv'] = $lv;
                $tree[] = $row;
                //查询当前行子行,合并到当前行后面
                $tree = array_merge($tree,$this->getTree($row['cat_id'],($lv+1)));
            }
        }

        //返回当前pid的所有子集
        return $tree;
    }

  rowId    id  pid  lv
    1       1   0   1
    2       2   1   1
    3       3   1   1
    4       4   2   2
    5       5   2   2
    6       6   3   2
    7       7   3   2

select B.hostname,res,C.hostname,time from match A inner join team B on A.id=B.id, inner join team C and A.id=C.id

EOF;

$str = <<<'EOF'
            5-4mysql查询优化
        查询慢原因 数据访问 长句 难句
  查询慢原因
    1 慢查询日志
    2 show profile;
        set profiling=1;
        show profiles;
        show profile for query 2;

    3 show status;
      show processlist;
    4 explain => desc

  数据访问
    1 少取 *  limit
    定长与变长分离
    常用与不常用分离
    冗余字段
    联合索引 左前缀原则
    索引覆盖

    应用层分离 多次拆分
    group by 单表列
    limit 1000,5 => where id>1000 limit 5;
    union => union all

        定位 -> 原因 -> 特定优化

EOF;



$str = <<<'EOF'
                5-5mysql索引
        分区
        分库 分表
        mysql复制原理  及负载均衡  读写分离/分布式

    1 分区 list range hash key
        create table t5 (
            id int primary key,
            name char(10),
            age int
        ) partition by list (age)(      //age必须在下面()中
            partition p1 values in (1,4,7),
            partition p2 values in (2,5,8),
            partition p3 values in (3,6,9)
        )


        (.....)partition by range (age)(
            partition p1 values less than (10),
            partition p2 values less than (20),
            partition p3 values less than maxvalue
        )

        查询时: select * from t5 where age = 5  => (age=5)会定位分区取数据

        分区:
            优点: 历史数据隔离,备份与恢复,表锁
            限制: 1024个分区, 修改表结构



    2 分表 用PHP算法实现
        水平分表 union all
        t  => t1(store_id=1),t2(store_id=1),t3(store_id=1)
            php fun(col)=>store_id = > tn


        垂直分表 left/right join
        t( id, name, age, sex, address)
        ( id, name) + (age, sex, address)

    3 主从复制
        数据备份
        负载均衡
        故障切换
EOF;


$str = <<<'EOF'
                5-6mysql安全
            sql安全 安全设置
    1 pdo防止sql注入
    2 addslashes 添加转义
    3 屏蔽错误到日志
    4 定期备份数据
    5 合理分配权限
    6 关闭远程访问


EOF;




$str = <<<'EOF'
                6-1 小项目设计
        数据库设计 创建表 PHP连接数据库 编码能力
    1 数据库设计
        message(id,title,content,ctime,name)
    2
        create table message(
            id int unsigned not null auto_increment primary_key,
            title char(20),
            content char(30)
        )engine=innodb charset=utf8;

    3 pdo连接数据库
        1. dsn    $dsn="mysql:host=localhost;dbname=llqhz";
        2. pdo    $pdo = new POD($dsn,$user,$pwd);
        3. stmt   $stmt = $pdo->prepare($sql);
        4. res    $res = $stmt->fetchAll(POD::FETCH_ASSOC);

    4 无限极分类
        id  catname   pid      |   path
        1     手机     0       |    0-1
        2     3G机     1       |    0-1-2
        3     4G机     1       |    0-1-3
        4     3G直板   2       |    0-1-2-4
        5     3G翻盖   2       |    0-1-2-5

        public function getTree($pid=0,$lv=0)
        {
            $this->rows = $this->select();
            $tree = [];
            foreach ($this->rows as $key => $row) {
                if ( $row['pid'] = $pid ) {
                    $row['lv'] = $lv;
                    $tree[] = $row; //加入当前行
                    //以已经加入的当前行的id为pid递归查找
                    $subTree = $this->getTree($row['id'],$lv+1);
                    //合并结果集
                    $tree = array_merge($tree,$subTree);
                }
            }
            return $tree;
        }


EOF;



/*

try {
    $dsn = 'mysql:dbname=llqhz;host=localhost';
    $pdo = new PDO($dsn,'root','');

    $sql = 'select * from user where name=:name';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name'=>'lisi']);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);



} catch (PDOException $e) {
    $e->getMessage();
}*/



$str = <<<'EOF'
            7-1 谈谈你对MVC的认识
        MVC理解  +  认识的框架
        单一入口    模板引擎
    1  Model View Controller
    2 单一入口  安全控制
                url不美观->url重写
    3 模板引擎  最重要的视图层的分离 smarty
                smarty方法 正则表达式替换库
EOF;

$str = <<<'EOF'
            7-2 常见框架
        PHP框架有哪些,用过哪些,优缺点
    PHP框架的优缺点
    1.Yaf框架
        Yaf是用PHP扩展的形式写的一个PHP框架,也就是以C语言的编写,性能上要比PHP代码写的框架要快一个数量级。
        底层扩展实现,可读性差,开发相对困难
    2.Yii 简单优雅
        学习成本高
    3. 框架对比
        遇到用到哪些特性?哪些困难?
        如何实现自动验证
        rule validate

EOF;

$str = <<<'EOF'
            8-1 常见算法
        冒泡排序原理和实现
        算法的概念 时间复杂度,空间复杂度 常见排序查找算法
    1 基本概念
        解决问题的步骤:是一系列解决问题的清晰指令.
        特性: 有穷性 确切性 输入/输出 可执行

    2 算法评定
        时间复杂度   T(n) = O(n^2)
            时间复杂度是指执行算法所需要的计算工作量；多少次
        空间复杂度
            空间复杂度是指执行这个算法所需要的内存空间。(辅助变量)

    3 时间复杂度
            最好情况 最坏情况 平均情况
        计算方式
            常数用1替换
            1+2+3+...+n
            for($i=1;$sum=0;$i<=n;$i++){
                $sum += $i;             //计算了n次
            }
            return $sum;
        常数阶 O(1)
        平方阶 O(n^2) O(n^3)
        对数阶 O(log2n)
        线性对数阶 O(nlog2n)

    4 空间复杂度
        代码空间+输入空间+辅助空间
        空间换取时间
        交换临时变量 O(1) 最大临时变量


    5 排序算法
        冒泡排序 插入排序 选择排序 归并排序 快速排序 堆排序 希尔排序

        冒泡排序 两两相邻交换

        2 5 8 6 1 4
        function BobleSort

    6 查找算法
        顺序查找 二分查找

        实现+时间复杂度+空间复杂度计算


function BobleSort(&$a) {
    $len = count($arr);
    for( $i=$len-1; $i >= 0; $i-- ) {
        for( $j=0; $j < $i ; $j++ ) {
            if ( $a[$j] > $a[$j+1] ) {
                list( $a[$j], $a[$j+1] ) = array( $a[$j+1], $a[$j] );
            }
        }
    }

}

EOF;


$str = <<<'EOF'
            8-2 数据结构
        stack queue list doubly-linked-list heap array
        栈   队列   链表   双向链表
    1 常见数据结构特征
        array数组     连续内存 相同类型
        list   线性表-单链表 首尾相连 只有一个前驱和后继
                        顺序存储和链式存储
        stack         栈    先进后出
        queue         队列  先进先出
        heap          堆(又叫二叉堆) 近似 完全二叉树的数据结构
                        大根堆和小根堆
        doubly-linked-list
                双向链表 在单链表的基础上加了回溯的指针 next和prev
        set    集合 不重复,无顺序
        map    字典 关联数组
        graph  图   邻接矩阵和邻接表(链表)表示

    2 php实现双向队列
        array_pop       array_push
        array_unshift   array_shift

EOF;


$str = <<<'EOF'
            8-3 逻辑算法 + 内置函数
        逻辑思维能力
            数组/字符串函数 数据结构
    1 实现斐波那契数列
        1,1,2,3,5,8,13

        function fun($n=1)
        {
            $a = [0,1,1];
            if ( $n <= 2 ) {
                return $a[$n];
            }
            for ($i=3; $i <= $n; $i++) {
                $a[$i] = $a[$i-1]+$a[$i-2];
            }
            return $a[$n];
        }
    2 找到规律,说明后再编码
        open_id make_by_id

        function fun($str)
        {
            $arr = explode('_',$str);
            foreach ($arr as $key => $val) {
                $arr[$key] = ucfirst($val);
            }
            return implode('',$arr);
        }

    3 实现内置函数
        实现数组和字符串函数
        eg: 实现strrev

        function str_rev($str)
        {
            if ( empty($str) ) {
                return $str;
            }
            for ($i=0; true; $i++) {
                if ( !isset($str[$i]) ) {
                    break;
                }
            }
            $len = $i;
            $res = '';
            for ($i=$len-1; $i >= 0; $i--) {
                $res .= $str[$i];
            }
        }

    4 实现array_merge

        //实现array_merge   [1],[1,2,3],5
        function array_mer()
        {
            $args = func_get_args();
            $res = [];
            foreach ($args as $key => $val) {
                if ( is_array($val) ) {
                    foreach ($val as $k => $v) {
                        $res[] = $v;
                    }
                } else {
                    $res[] = $val;
                }
            }
            return $res;
        }

EOF;


$str = <<<'EOF'
            9-1 高并发 大流量
        PHP如何解决高并发大流量问题
        高并发相关概念 解决方案
    1 并发:
        高并发 相同时间点,很多用户同时访问同一个主机
        并发: 多线程 程序交替运行
        并行: 多进程 程序同时运行

    2 高并发
        大流量带来高并发
        QPS: query per second 每秒钟请求或查询的数量(每秒HTTP响应数)
        吞吐量: 单位时间类处理请求的数量(由QPS和并发数觉得) 例如一次get
        PV page view 所有用户所有页面点击量之和 再此访问(刷新)只算一次
        UV unique visitor 独立访客
        带宽 峰值流量 页面平均大小
        一次QPS可以有多次并发请求,get -> response

    3 性能测试工具
        apache benchmark      http_load

        测试机与被测试机分开
        成功率>95%
        QPS > 50  小型
        QPS > 100 中型
        QPS > 500

        QPS 达到100,表示每秒响应100次请求,得保证PHP运行100次且

    前端优化
        防盗链 减少HTTP请求数 js,css,图片 合并
         添加异步请求 浏览器缓存和压缩 cdn节点
         动静分离 lanmp

    服务端优化
        页面静态化
EOF;

$str = <<<'EOF'
            9-2 防盗链
        在自己页面上展示不在自己服务器上的内容
    1 概念:
        小站盗用大站的图片,音乐,视频,文件 减轻服务器负担
    2 方法
        1 $_SERVER['HTTP_REFERER']
            nginx nginx_http_referer_module
                    ->valid_referers ->$invalid_referer

            location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
            {
                valid_referers none blocked *.llqhz.com;
                if ( $invalid_referer ) {
                    # return 403;  #直接返回403
                    rewrite ^/ https://www.baidu.com/img/bg_logo1.png;
                }
            }

            缺点: 用PHP伪造referer
        2 签名
            HttpAccessKeyModule
            accesskey on/off
            accesskey_hashmethod md5/sha-1
            accesskey_arg GET参数名
            accesskey_signature 加密规则(算法字符串参数)

            2-1 nginx
            location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
            {
                accesskey on
                accesskey_hashmethod md5
                accesskey_arg "key"
                accesskey_signature "llqhz$remote_addr"
            }
            2-2 img
                $key = md5('llqhz'.$_SERVER['HTTP_REFERER']);
                <img src="./logo/jpg?key=$key" alt="">

EOF;


$str = <<<'EOF'
            9-3 页面请求优化
        1 DNS缓存         缓存不稳定,不持久
        2 keep-alive      请求只能串行发送

        图片: 1 map   2 position  3 base64 data:image/png

    1 图片地图
        1.1 一张多图标根据 click_position 决定对应图标效果
            <img src="img/planets.jpg" usemap="#planetmap"/>    //对应map的id或name
            <map name="planetmap" id="planetmap">
                <area
                shape="circle"
                coords="180,139,14"
                href ="/example/html/venus.html" />
                <area
                shape="circle"
                coords="129,161,10"
                href ="/example/html/mercur.html" />
            </map>

        1.2 加载多张,根据bg-position决定显示范围

    2 js css 合并
        合并的js,css比独立多个快38%

    3 图片使用base64编码
        3.1 <img src="data:image/gif;CADNCADNCADNMILLM" alt="">
        3.2 background-image: url(data:image/gif;CADNCADNCADNMILLM)

EOF;


$str = <<<'EOF'
            9-4 浏览器缓存和数据压缩
        HTTP缓存机制
        nginx配置缓存策略
        前端代码和资源的压缩
    1 缓存分类
        1 200 from cache    本地缓存
            缓存未过期  直接从本地读取,不请求
        2 304 not modified  协商缓存
            缓存已过期 发送校检头,发现未修改,任然读取本地缓存
            快速 只发送请求头,没有相应体
        3 200 OK 没有任何缓存

    2 缓存实现
        1 200 from cache    本地缓存
                Cache-Control: no-store(禁止缓存)
                               no-cache(协商缓存)
                               max-age=3600   (过期时间,有效缓存时间为3600s)

                Expires:Mon, 15 Nov 2027 03:36:52 GMT  (过期时间)
        HTTP1.1
                Pragma: no-cache(协商缓存)

        2 304 not modified  协商缓存
                Last-Modified:Mon, 23 Oct 2017 01:49:57 GMT

EOF;



$str = <<<'EOF'
            10-1 面试：
    1 注意形象
        穿着得体  注意言行举止
    2 提前了解
        公司情况 多少人 业务内容 发展方向 工作内容

    3 充分准备
        自我介绍
        所学知识的复习 学过，用过
        重点 自己易错点
        充分的休息
    4 注意事项
        遵守时间   提前适当时间
        言行举止   谦虚谨慎 随机应变 扬长避短() 显示潜能
        面试表现   表情自然 面带微笑 不讲脏话  尊重面试官
        面试忌讳   不自信:抬头 声音大 不跑题 不重复 小动作

 自我介绍：高并发：服务器：

EOF;













?>
