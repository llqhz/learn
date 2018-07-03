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
