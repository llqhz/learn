# centos7 minimal with virtual box

## 配置网络使用ssh
(1) 关闭防火墙
    sudo service firewalld stop  禁止开机启动:sudo chkconfig firewalld off
(2) 配置网络连接
    ip add => 看第2条记名字(enp0s3)
    cd /etc/sysconfig/network-scripts/
    ls 找到刚才的名字 ifcfg-enp0s3 并用vi编辑 最底下修改ONBOOT = yes 并重启

(3) 更换软件源
    curl -o /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-7.repo
    ## yum --enablerepo=updates clean metadata
    yum install applydeltarpm => yum makecache => yum -y update

## 配置网络使用开始安装lnmp
    1 安装依赖
        sudo yum install gcc gcc-c++ cmake kernel-devel openssl-devel git ncurses-devel bison wget vim




