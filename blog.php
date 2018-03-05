<?php

第一讲：001
独立开发blog
第二讲：
    需求分析：
        （1）需求明确，
        （2）签字确认
        （3）动态修改（尽量少）
        原则：需求越精确，开发越迅速，原型（自制+参照）

    需求分析步骤：
        （1）文字采访，与客户对话
        （2）引导需求，
                是否允许评论 是否验证码 是否的问题 不要开放
                常用功能向用户确认，不常用的不需要问
第三讲：功能结构图
        （3）功能结构图（visio）


$a 未定义： isset: X    is_null: √    empty: √
$a = null： isset: X    is_null: √    empty: √
$a =  "" ： isset: X    is_null: √    empty: X

isset 检测是否定义或者为null 没有set的情况有两种：1：没有定义  2：为null
is_null 检测是否为null 未定义也是null 若isnull 则：1：没有定义  2：为null
empty 检测是否为空

当a未定义或为null时，未定义，为null，更为空
当a=空或0时，已定义，不为null，但为空


gettype();获取变量类型

$a % $b 取模,余数的正负取决于被除数的正负

函数内通过 $GLOBALS['var1'] = 5 访问全局变量
通过 global $val 来引用外部变量

mkTime()将字符串转换为时间戳

大段双引号  <<<double
大段单引号  <<<'double'
double


字符串查找：i:代表
strpos($str,'a');   //查找第一次出现的位置
stripos($str,'a');
strrpos($str,'a');  //查找最后一次出现的位置

字符串截取：
strchr($str,'a');   //截取第一次出现的位置到结束
strrchr($str,'a');  //截取最后一次出现的位置到结束(包括a)
substr($str,$start,$length);


字符串替换：
str_replace('old','new',$str);
strtr($str,'old','new');

$replaceRull = array('old' => 'new');
strtr($str,$replaceRull);

字符串去除：
trim();                 替换指定字符
ltrim($str,$left_prfix);    去除前缀
rteim($str,$r_prfix);       去除后缀



$arr = explode(',',$str);   字符串拆分为数组
$str = implode(',',$arr);   数组合并为字符串

str_split($str,$len);       字符串按长度拆分为数组


单引号不解析，双引号解析

list()+each() 代替 foreach()
foreach ($arr as $key => $value)
while( list($k,$v) = each($arr))

array的栈与队列
array [0->n] 可以看作一个从栈底到栈顶的栈 a[0]是栈底 a[n]是栈顶
array_push() 入栈(从末尾插入)
array_pop() 出栈(从末尾取出)
array_unshift() 入队(从开头插入)
array_shift() 反入队(从开头取出)

array_push() array_pop() 组成从0到n的栈 stack
array_unshift() array_pop() 组成从0到n的队列 queue

加不加once 限定是否只加引入一次
require 必须引入正确才能继续执行
include 包含就可以，忽略错误


---  虚拟主机配置： ---
虚拟主机配置：
1：  设置域名解析到ip 域名重定向
    C:\Windows\System32\drivers\etc\host

    #127.0.0.1       localhost
    127.0.0.1       llqhz.cn
    127.0.0.1       bool.cn

2:   开启vhost 允许自定义解析目录 域名解析到ip后再解析到对应的目录
    D:\wamp\bin\apache\apache2.4.9\conf\extra\httpd-vhosts.conf

    # Virtual hosts 目录解析访问开关
    Include conf/extra/httpd-vhosts.conf


3：  域名解析到ip后再解析到对应的目录
    D:\wamp\bin\apache\apache2.4.9\conf\httpd.conf

    <VirtualHost *:80>
        DocumentRoot "D:/wamp/www/bool"
        ServerName bool.cn
    </VirtualHost>

---  PHP进制： ---
    0b  二进制
    0   八进制
    0x  十六进制

    比如在 mysql 中,
    int 则理解为-1,  [ 1111 1111 ]
    unsigned int (无符号类型全是正数)理解为 255


---  PHP逻辑运算： ---
    &   |    !   ^异或 (不一样就为真)  <<左移(空位补0)

---  PHP浮点不准： ---
    0.1 + 0.3 == 0.3 ? => false
    银行一般都存整数,精确到分

使用array_push一次压入多个元素，比多次使用$arr[]=$value压入快。array_push一次压入的元素越多，则效率越高。
$arr[]=$value 单个压入
array_push() 多个压入

is_numeric() 检测是否为数字及数字字符串

函数注释插件user DocBlockr：
{
    "jsdocs_extra_tags":[
        "@Author llqhz",
        "@DateTime {{date}}",
        "@copyright ${1:[copyright]}",
        "@license ${1:[license]}",
        "@version ${1:[version]}"
    ],
    "jsdocs_function_description": false
}

---  PHP this指针 ---
    在php类中，函数和变量相互调用必须加this指针指定当前对象的属性和方法
    若为静态数据，需要使用 self::
    若为父类对象状态须使用 parent->
    静态方法中实例化自身 self()


---  PHP 预定义常量 ---
    __DIR__  当前脚本目录
    __LINE__ 当前行


---  PHP GET参数自动追加 ---
    http_build_query($data);
    (1) 解析$data生成&a=1&b=2...的形式
    (2) 将解析后的$data参数自动加到当前get请求的后面


---  PHP 文件上传 ---
    创建目录
    mkdir($dir='blog/upload',0777='权限',true="是否递归创建子目录");
    获取文件后缀（包括后缀名）
    $ext = strrchr($this->filename,'.');
    pathinfo($filename);
    保存上传文件
     move_uploaded_file($_FILES['name']['tmp_name'],$newDir);


---  PHP 文件上传配置- ---
    (1) file_uploads -> 是否允许 HTTP 文件上传
    (2) upload_max_filesize -> 所上传的单个文件的最大大小(字节)
    (3) post_max_size -> 设定 POST 数据所允许的最大大小(字节)
    upload_tmp_dir -> 文件上传时存放文件的临时目录
    (4) max_execution_time->脚本最大执行时间
    通过_FILES限制文件的上传类型和大小



---  PHP 图片上传 ---
    数据库中保存相对路径 /upload/...
    图片处理函数中使用绝对路径



---  PHP cookie函数 ---
    setcookie('name','value',time()+validity,'/ 对根目录域有效','llqhz.cn 所有一级域名下有效');



---  PHP html内容解析 ---
                            向数据库编码
    //将零次->一次  一次->二次  二次->三次  < $lt; $amp;lt  &amp;amp;lt
    htmlspecialchars()  编码&lt和&gt 为&amp;lt和&amp;gt 显示&lt和&gt

    //将三次->二次 二次->一次 一次->零次(终) &amp;amp;lt $amp;lt $lt; <
    htmlspecialchars_decode() 向html解析





---  ThinkPHP 魔术方法 ---
    __DIR__  当前脚本目录
    U()         获取url路径
    C()         读取配置及自定义文件
    D()         初始化Model并验证
    M()         初始化Model空模型
    I()         获取Get和Post数据
    S()         缓存     chache(true) 缓存sql语句


---  ThinkPHP 缓存 ---
    数据缓存    S()     支持设置有效期  缓存短期数据(数组)
    数据缓存    F()     不能设置有效期  长期缓存数据(数组)
    查询缓存 cache(key) 根据当前静态where缓存当前结果集 可用S(key)来取



    如果使用了cache(true) ，则在查询的同时会根据当前的查询条件等信息生成一个带有唯一标识的查询缓存，如果指定了key的话，则直接生成名称为key的查询缓存 ，例如：()
        $Model->cache('cache_name')->where('status=1')->select();
        指定key的方式会让查询缓存更加高效。

---  PHP 预定义常量 ---
    __DIR__  当前脚本目录
    __LINE__ 当前行
