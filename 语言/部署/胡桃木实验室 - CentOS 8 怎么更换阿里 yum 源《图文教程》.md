> 本文由 [简悦 SimpRead](http://ksria.com/simpread/) 转码， 原文地址 [www.htmacg.cn](https://www.htmacg.cn/centos-8%e6%80%8e%e4%b9%88%e6%9b%b4%e6%8d%a2%e9%98%bf%e9%87%8cyum%e6%ba%90%e3%80%8a%e5%9b%be%e6%96%87%e6%95%99%e7%a8%8b%e3%80%8b/.html)

> 1. 备份 yum 配置文件 ll /etc/yum.repos.d/ 运行结果： 提示：不同的系统配置文件可能个数不一样，请与实际运行结果为准   2. 新建一个备份的文件夹 “bac……

1. 备份 yum 配置文件
--------------

```
ll /etc/yum.repos.d/


```

运行结果：

[![][img-0]

提示：不同的系统配置文件可能个数不一样，请与实际运行结果为准

2. 新建一个备份的文件夹 “backup”
----------------------

```
mkdir /etc/yum.repos.d/backup

mv /etc/yum.repos.d/*.repo /etc/yum.repos.d/backup


```

3. 下载 yum 源配置文件
---------------

提示：通过以下命令下载阿里云的 yum 源配置文件到 /etc/yum.repos.d/CentOS-Base.repo，如果没有 wget 也可以去安装或者使用其他的方式。

```
wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-8.repo


```

运行结果：

[![][img-1]

这个时候我们的目录下就有一个新的文件 / etc/yum.repos.d/CentOS-Base.repo

4. 修改 yum 源配置文件
---------------

```
vim /etc/yum.repos.d/CentOS-Base.repo

```

在命令模式下执行（按 Esc 键后，再按冒号键进入命令模式）：

```
%s/mirrors.cloud.aliyuncs.com/mirrors.aliyun.com/g


```

运行结果：

[![][img-2]

替换完后，再次进入命令模式执行：

```
%s/$releasever/$releasever-stream/g


```

运行结果：

[![][img-3]最后保存修改后的内容（按 Esc 键后，再按冒号键，输入 wq ，按回车键即可。）

5. 更新 yum 源配置文件
---------------

执行以下两个命令即可：

```
yum clean all

yum makecache


```

[![][img-4]

测试一下
----

[![][img-5]

至此，yum 源就配置好了，需要注意的是，一个是把所有的源都备份，避免冲突，第二个是替换对应阿里云的地址，这样你生成缓存才不会报错。
