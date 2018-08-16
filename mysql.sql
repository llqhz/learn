mysql

安装:
1.源码 2.二进制 3.安装包

# 查看数据库
show databases;
select database();  # 当前正在使用的
# 查看数据表
show tables;

SELECT category_name.name  FROM category_name INNER JOIN list_desc on list_desc.list_name= category_name.name_link ORDER BY list_desc.play_times DESC



INSERT INTO `tpl_shinfo` (`id` , `name` , `sname` , `slogo` , `building_no` , `door_no` , `stype` , `smobile` , `door_logo` , `sdesc` , `sdetail` , `is_top` , `status` , `sorder` , `ctime`) VALUES (0 , 'asdasd' , 'dasdasd' , '{\"code\":1,\"origin\":\"http://tpl.llqhz.cn/upload/com/20180806/66228bad81ecdbd791dfc59c61078614.png\",\"path\":\"http://tpl.llqhz.cn/index.php/api/getfile?path=com/20180806/66228bad81ecdbd791dfc59c61078614.png\"}' , 1 , 'asdasd' , 'asd' , 'asdas' , '[{\"code\":1,\"origin\":\"http://tpl.llqhz.cn/upload/com/20180806/2daabe6b6a1e0b34c013575dfabdd3ef.jpg\",\"path\":\"http://tpl.llqhz.cn/index.php/api/getfile?path=com/20180806/2daabe6b6a1e0b34c013575dfabdd3ef.jpg\",\"order\":1}]' , 'asdasd' , 'asdsad' , 1 , 1 , 23 , 2018)











