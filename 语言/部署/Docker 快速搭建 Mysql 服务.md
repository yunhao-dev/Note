> 本文由 [简悦 SimpRead](http://ksria.com/simpread/) 转码， 原文地址 [blog.csdn.net](https://blog.csdn.net/m0_37613503/article/details/119109878)

Docker 快速搭建 Mysql 服务
--------------------

### 1. 前置环境

1.  CentOS7.8

### 2. 安装 docker

```
yum install -y docker

```

### 3. 设置镜像加速

修改 `/etc/docker/daemon.json` 文件并添加上 registry-mirrors 键值

```
{
  "registry-mirrors": ["https://nz5uykfk.mirror.aliyuncs.com"]
}

```

### 4. 搭建 Mysql 服务

1.  拉取 Mysql 镜像
    
    ```
    docker pull mysql:5.7
    
    ```
    
2.  运行镜像
    
    ```
    docker run \
    -p 3306:3306 \
    --name mysql5.7 \
    -v ~/mysql/data:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=123456 \
    --privileged=true \
    docker.io/mysql:5.7
    
    ```
    
3.  测试