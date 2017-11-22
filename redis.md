# Redis 全程笔记

标签（空格分隔）： redis

---
# 目标 / 大纲
> 
 1. 介绍和安装
 2. 键值操作
 3. 数据类型
 4. 事务
 5. 消息订阅
 6. 持久化
 7. 集群
 8. php-redis
 9. 运维
 10. 实战(仿微博)

## 1. redis介绍和安装
### **1.1 redis介绍**
  > **redis与memcache的区别** 
  > 
  1. redis主存储( store 持久化）, memcache 只缓存 (cache)
  2. redis数据有结构 :  字符串 链表 hash 集合
     memcache 只有字符串 string+标识符(序列化)

### **1.2 redis安装 ( linxu => centos )**
* 官网下载解压
```linux
mkdir /usr/local/src/redic -p  # 创建下载目录
cd /usr/local/src/redis         # 进入下载目录
wget http://download.redis.io/releases/redis-4.0.2.tar.gz  # 下载
tar xfzv redis-4.0.2.tar.gz
```
* 编译安装
```linux
# 如果遇到时间问题 date -s 修改
cd redis-4.0.2
make  #官网已经configure了,直接make
yum install tcl # 安装测试工具用于make test
make test # 测试所有redis命令 可不测试
make PREFIX=/usr/local/redis install # 安装到指定目录
```
* 配置 / 启动 / 连接
```linux
cd /usr/local/redis
------安装完成工具说明-------
redis-benchmark    =>  性能测试工具
redis-check-aof    =>  检查aof日志
redis-check-dump   =>  检查rbd日志
redis-cli          =>  客户端client
redis-server       =>  服务端

------配置文件------
# 从src源文件夹复制redis.conf到安装根目录
cp /usr/local/src/redis/redis-4.0.2/redis.conf /usr/local/redis/redis.conf
vim redis.conf # => daemonize yes   #后台启动
------启动------
./bin/redis ./redis.conf

------连接------
cd /usr/local/redis
./bin/redis-cli   #client连接客户端

------存取------
set name xiaoguai   # 存
get name            # => xiaoguai
set age 20          # 存
get age             # => 20
```
  
## 2. 键值操作
### 2.1 键查询
```linux
------精确查询------
keys name   #   name
keys age    #   age

------模糊查询------
#  通配符 []取一个 *一或多  ?一个
keys *          => name age     # 匹配一个或多个
keys na[mabc]e  => name         # 匹配取一个
keys ag?        => age          # 匹配一个
keys a[fgh]*    => age          # 组合
```
### 2.2 键操作
```linux
---删除---
del name
del name age

---改名---
rename   name mingzi      # 覆盖同名
renamenx age  nianling    # 不覆盖同名

---移动---
# tips: redis默认有16个数据库 索引为[0->15] 用'select N'选库 
# move操作就是在不同数据库间移动数据 默认库为0
move name 1
move age  2
select 1   get name => nmingzi   get age => null
select 2   get name => null      get age => 20
```
### 2.3 有效期
```linux
---查---
ttl  name        =>  -1    # 永久有效
ttl  age         =>  10    # 十秒内有效
pttl name        =>  9000  # 9000 毫秒

---设---
expire  name xg    =>  20秒
pexpire age  3000  =>  3000毫秒

---永久有效---
persist name    persist age
```

## 3. 数据类型
### 3.1 字符串 str
```linux
---清空当前数据库---
flushdb

---存---
set key val [ex 秒数]/[px 毫秒数] [nx 不存在时]/[xx 存在时]

set name xiaoguai ex 20
set site baidu    px 3000 
set name xg  nx
set name ll  xx

---多存取---
mset key1 val1 key2 val2 key3 val3
mget key1 key2 key3

---增减---
incr   age     =>  age++
decr   age     =>  age--
incrby age 5   =>  age+5
decrby age 3   =>  age-3
incrbyfloat age -3.2     =>  age-3.2

---位操作(bit)---
[][][][][][][][] [][][][][][][][]
 0 1 2 3 4 5 6 7 8 9 10 ...  
     1字节             1字节
set char A  # => A
setbit lower 2 1    # 将lower的2 bit处设置为 1
bitop or  res char lower  # => a 将char与lower的or的结果放入res中
setbit upper 2 0    # 再用相同命令设其他位为1
bitop and res char upper  # => A 将char与upper的and的结果放入res中

setbit char (2^32)   1 => error
setbit char (2^32-1) 1 => ok  
# 由以上行推出redis单个字符串值上限为 2^32bit 即 512M
```

### 3.2 链表 link
```linux
---链表结构---
lpush =>                                 <= rpush
    l:  0     1     2     3     4     5
       【】->【】->【】->【】->【】->【】
    r:  -6    -5    -4    -3    -2    -1
lpop <=                                  => rpop
# tips: 下标： l [0 -> n-1]  r [-n -> -1]  总: [-n -> n-1]

---存---
lpush arr a             # 存一个
rpush arr a b c d       # 存多个

---弹---
lpop arr        # 左弹出
rpop arr        # 右弹出

---取---
lrange arr 1 3    # => a[1]->a[3]
lrange arr 0 -1   # 取所有

---删中间---
lrem arr 3 b      # 删除左起3个值为b的元素
lrem arr -2 c     # 删除右起2个值为c的元素

---取中间---(剪去)
ltrim arr 2 5     # 取出a[2->5]的元素 (其余丢掉)
ltrim arr 3 -2    # 取出a[3 -> -2]元素

---取一个---
lindex arr 0      # => a[0]
lindex arr -2     # => a[-2]

---求长度---
llen arr         # => 5 5个元素

---值插入---
linsert after/before search val
linsert before c 3    # 在第一个值为c的元素前加入3

---安全队列---  (原子性)
    []->[]->[]->[]  =>【*】=>   []->[]->[]->[]
rpoplpush larr rarr     => *    #  右边弹出到另一个队列的左边
rpoplpush leftArr rightArr   =>  返回rpop 并同时插入到rightArr头部

---等待弹出---
#blpop/blpop 若有直接弹出一个,若没有,等待再弹出一个结束
blpop link 20  # 尝试弹出link,若空,则等20秒,有立刻弹出结束,无返回null
```
> * redis应用实例:统计活跃用户
> 1. 一亿个用户,记录频繁和不频繁
2. 记录用户登录信息
3. 查询活跃用户 一周登录3次

> * 解决方案:
> 思路: 1/0 登录/不登录
    优点: 1.节省空间；  2.计算方便 
```linux
        [] [] [] [] [] [] [] [] [] [] []
  str: [0  1  1  0  1  0  0  1] [1  0  1 ...]  字节=>位图
  uid:  0  1  2  3  4  5  6  7  8  9  10         uid
Mond:   0  1  1  0  1  0  0  1  1  0  1 ... 
Tues:   1  1  0  1  0  0  1  1  0  1  0 ...
Thur:   1  0  1  0  0  1  1  0  1  0  1 ...
setbit str 28 1   # 操作bit位
setbit Mond 45 1  # 用户id=45登录 设置为1
  
---统计---
bitop and Mond Tues Thur    # => 统计出三天都登录的人 

```
 


### 3.3 集合 set
```linux
---增---
sadd gender male female  # => 2 添加男女两个性别

---删---
srem gend male           # => 删除male,没有返回0

---查---
smembers gender          # => 返回所有值

---弹---
spop gender              # =>  随机弹出一个值  (抽签)

---存在---
sismember gender Q       # => 返回0 , Q不是里面的元素

--计数---
scard gender             # => 3   集合里面有三个元素

------集合间操作------
---移动---
sadd arr1 A B C
sadd arr2 a b c
smove arr1 arr2 A        # => 将arr1的A移入到arr2中
smove arr2 arr1 A        # => 将arr1的A移入到arr1中

---交集---
sinter arr1 arr2         # => 求arr1与arr2的交集元素
sinterstore res arr1 arr2   # => arr1 ∩ arr2 => res

---并集---
sunion arr1 arr2 arr3    # => 三个集合的并集

---差集---
A - B = A - A∩B
sdiff arr1 arr2          # => 输出arr1-arr2 
```

### 3.4 有序集合 order-set
```linux
------概念------
score 排序权重
申明每个val时需要给其权重

---添加---
zadd arr score1 val1 score2 val2 ...
zadd 20 user lisi 18 wang 3 xg 25 qian  # => 添加元素

---查询---
zrange arr 0 3     # => 取出arr[0->3]
zrange arr 0 -1    # => 取出所有
zrangebyscore arr 0 20    # => 查询[0->20]分数内的元素 
zrangebyscore arr 0 20 limit 2,3    # => 查询[0->20]分数内的元素 用limit分页 (跳过2条取3条)
zrangebyscore arr 0 20 withscores    # => 将分数一同取出

---排名---
zrank arr lili      # => 返回lili排名 [0->N]
zrevrank arr lisi   # => 返回lisi排名(由大到小排名) 

---删除---
zremrangebyscore arr 10 20  # => 删除分数在区间[10,20]的元素
zremrangebyrank  arr  2 5   # => 删除排名2->5的元素(含)
---删一个---
zrem arr lisi wang          # => 删除lisi wang 

---计数---
zcard arr                   # => 查询多少个
zcount arr 25 30            # => 计数分数在25->30之间的

---交集---
# lisi: 3 cat 5 dog 6 horse
# wang: 2 cat 6 dog 8 horse 1 donkey
zinterstore res arrNum arr1 arr2 arr3 aggregate max|sum|min
zinterstore res 2 lisi wang aggregate sum  # => 将lisi wang 求交集并且求score的 最大/和/最小 
zinterstore res arrNum arr1 arr2 1 2 aggregate max|sum|min  # => 将arr2的权重设为2

---并集---
zunionstore res arrNum arr1 arr2 arr3 aggregate max|sum|min
```

### 3.4 哈希 hash (关联数组)
```linux
---设/取---
hset arr k v
hmset user name lisi age 20 height 175  # => 多个域和值
hget arr k
hmget user name age
hgetall
hkeys
hvals

---删/长/增---
hdel user age
hlen user
hexists user age          # => key 
hincrby user age
hincrbyfloat user age -0.5



```

## 4. Redis事务
### 4.1 事务对比
|操作|mysql|Redis|
|:--:|:--:|:--:|
|开启|start transaction|muitl|
|语句|普通语句(建表会直接生效)|普通命令|
|回滚|rollback|discard|
|提交|commit|exec|

### 4.2 事务实现
```linux
------redis事务------
multi            # 开启事务
# watch ticket ticket2  # 设置ticket监控点 unwatch 取消监视
decrby zhao 100       # 语句1
incrby wang 100       # 语句2
discard/exec          # 取消/执行

---说明---
将事务的一条条命令放入一个队列,当语法出错时,立即discard (原子性)
当没有语法错误时,都加入队列,当exec时,若某一句出错,则后面不再执行,前面也不取消;(不够完善)

---悲观锁---
世界上充满危险,所有人都在和我一起抢,所以得给ticket上锁,只有我能操作[悲观锁] 
如 : 表锁,行锁,读锁,写锁
---乐观锁---
没有人和我抢,我只需要监控ticket的值有没有改变过就可以了.
若是exec时ticket被修改过了,则拒绝执行exec
watch lisi wang  # 设置监视对比值
unwatch          # 取消所有监视

```

## 5. 消息订阅
### 5.1 消息发布与订阅
```linux
------实现消息订阅-------
publish news 'this is the contents'     # 发布消息
subscribe news                          # 订阅消息 一直等待 有就立即输出该条消息
publish news 'this is new news'         # 新消息

------消息订阅-------
psubscribe new*       # 订阅news开头的频道
pubsub *              # 列出活动频道
```
  
## 5. 持久化
> 把数据存储于断电后不会丢失的硬盘设备中

常见的持久化方式:
主从: 通过从服务器保存和持久化,如mongoDB的replication sets配置 主(内存)-从(磁盘)
日志: 操作生成相关日志,通过日志恢复数据
couchDB文件本身就是日志,只增加,不修改
  
  
  
  
