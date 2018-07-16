<php
/**
 * @Author: Marte
 * @Date:   2018-05-15 10:50:11
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-05-15 11:26:34
 */
composer

查看包版本信息
 composer show -i  已经安装

phpexcel/phpexcel        v1.7.7  PHPExcel - OpenXML - Create Excel2007 documents in PHP - Spreadsh...
phpmailer/phpmailer      v5.2.26 PHPMailer is a full-featured email creation and transfer class fo...
topthink/framework       v5.0.20 the new thinkphp framework
topthink/think-captcha   v1.0.7  captcha package for thinkphp5
topthink/think-installer v1.0.12

composer show -a|--all  packagename   查看包详情,包括所有版本

     
配置php版本:
"config": {
        "preferred-install": "dist",
        "platform": {
            "php": "5.4.16"
        }
    }
     
     
windows 安装多版本composer
找到composer.phar 所在目录 =>  C:\ProgramData\ComposerSetup\bin
复制composer composer.bat
改名为composer5 composer5.bat
 
 
 安装类库的坑:
 (1) 没有注意目录拼写 vendor 而不是 vender
 (2) path_info 配置中: input('') => $_GET 只有input才能获取path_info变量
     当框架可以正常解析模块控制器方法时,path_info就已经配置成功了
 (3) 注意需要更改和编写的文件 , 不可以编写这个而实际上运行的是另一个文件
 (4) phpqrcode内类库需要自己vendor('path/to/qrlib','.php') 起始目录为'vendor/'
 (5) composer.json中 autoload => { 'classmap'=> [],'files'=>[] } 的起始目录为 'ROOT_PATH',需要自己加vendor => eg: 'vendor/phpqrcode/phpqrcode';
 (6) phpqrcode 没有创建cache文件夹的权限,需要自己在src文件夹建好cache文件夹
 (7) think_captcha 只要加载成功就会正常运行
 
 
 
 发布自己的 composer 类库
 (1) 创建自己的GitHub仓库,获取git链接
 (2) git pull origin master
 (3) composer init 并 根据 prs-4创建类库文件结构 "llqhz\\": "src"
 (4) git add ,commit, -a tag, push origin master, push origin v1.0.0
 (5) packagist submit, add hook
 (6) use: composer config -g repo.packagist composer https://packagist.org (国内镜像更新不及时)
          composer require llqhz/wechat dev-master
 注意点: 
 (1) (国内镜像更新不及时) composer config -g repo.packagist composer https://packagist.org
 (2) package 需要在github上加上tag,这样才能直接require而不用dev-master 
 
 
 
 
