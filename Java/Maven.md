# 简介

## 本质

​	Maven是一个项目管理工具，将项目开发和管理过程抽象成一个项目对象模型（POM）

> POM（Project Object Model）：项目对象模型

![Snipaste_2023-11-13_01-17-08](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/MavenSnipaste_2023-11-13_01-17-08.png)

## 作用

- 项目构建
	- 提供标准的，跨平台的自动化项目构建方式
- 依赖管理
	- 方便快捷的管理项目依赖的资源(jar包)，避免资源间的版本冲突问题
- 统一开发结构
	- 提供标准的，统一的项目结构

# 基础概念

## 仓库

- 仓库

	> - 用户存储资源，包含各种jar包。

- 仓库分类

	- 本地仓库
		- 自己电脑上存储资源的仓库，连接远程仓库获取资源。

	- 远程仓库

		非本机电脑上的仓库，为本地仓库提供资源的仓库

		- 中央仓库 
			- Maven团队维护，存储所有资源的仓库
		- 私服
			- 部门/公司范围内存储资源的仓库，从中央仓库获取资源

- 私服的作用

	- 保存具有版权的资源，包含购买或自主研发的jar
		- 中央仓库中的jar都是开源的，不能存储具有版权的资源
	- 一定范围内共享资源，仅对内部开放，不对外共享。 

## 坐标

> Maven中的坐标用于描述仓库中资源的位置

- 主要组成
	- groupld
		- 定义当前Maven项目隶属组织名称（通常是域名反写，例如org.mybatis）
	- artifactld
		- 定义当前Maven项目名称（通常是模块名称，例如CRM，SMS)
	- version
		- 定义当前项目版本号
	- packaging
		- 定义该项目的打包 方式
- 作用
	- 使用唯一标识，唯一性定位资源位置，通过该标识可以将资源的识别与下载工作交由机器完成

# 项目

## 构建命令

```cmd
mvn compile		#编译
mvn clean		#清理
mvn test		#测试
mvn package		#打包
mvn install		#安装到本地仓库
```

## 插件创建工程

- 创建工程

	```cmd
	mvn archetype:generate
	    -DgroupId={project-packaging}
	    -DartifactId={project-name}
	    -DarchetypeArtifactId=maven-archetype-quickstart
	    -DinteractiveMode=false
	```

- 创建java工程

	```cmd
	mvn archetype:generate -DgroupId=com.itheima -DartifactId=java-project -
	DarchetypeArtifactId=maven-archetype-quickstart -Dversion=0.0.1-snapshot -
	DinteractiveMode=false
	```

- 创建web工程

	```cmd
	mvn archetype:generate -DgroupId=com.itheima -DartifactId=web-project -
	DarchetypeArtifactId=maven-archetype-webapp -Dversion=0.0.1-snapshot -
	DinteractiveMode=false
	```


#  依赖管理

## 依赖配置

- 依赖当前项目运行所需的jar，一个项目可以设置多个依赖
- 格式：

```java
<!-- jar-->
<dependencies>
<!— -->
<dependency>
<!— id-->
<groupId>junit</groupId>
<!— id-->
<artifactId>junit</artifactId>
<!— -->
<version>4.12</version>
</dependency>
</dependencies
```

- 依赖具有传递性

	- 直接依赖：
		- 在当前项目中通过依赖配置建立的依赖关系
	- 间接衣赖：
		- 被资源的资源如果依赖其他资源，当前项目间接依赖其他资源

- 依赖传递冲突问题

	- 路径优先：
		- 当依赖中出现相同的资源时，层级越深，优先级越低，层级越浅，优先级越高
	- 声明优先：
		- 当资源在相同层级被依赖时，配置顺序靠前的覆盖配置顺序靠后的
	- 特殊优先：
		- 当同级配置了相同资源的不同版本，后配置的覆盖先配置的

- 可选依赖

	- 可选依赖指对外隐藏当前所依赖的资源——不透明

	- ```java
		<dependency>
		    <groupId>junit</groupId>
		    <artifactId>junit</artifactId>
		    <version>4.12</version>
		    <optional>true</optional>
		</dependency>
		```

- 排除依赖

	- 排除依赖指主动断开依赖的资源，被排除的资源无需指定版本——不需要

	- ```java
		<dependency>
		    <groupId>junit</groupId>
		    <artifactId>junit</artifactId>
		    <version>4.12</version>
		    <exclusions>
		        <exclusion>
		        <groupId>org.hamcrest</groupId>
		        <artifactId>hamcrest-core</artifactId>
		        </exclusion>
		    </exclusions>
		</dependency>
		```

- 依赖的jar默认情况可以在任何地方使用，可以通过scope标签设定其作用范围

- 作用范围

	- 主程序范围有效（main文件夹范围内）

	- 测试程序范围有效（test文件夹范围内）

	- 是否参与打包（package指令范围 内）

		![Snipaste_2023-11-16_05-52-11](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/MavenSnipaste_2023-11-16_05-52-11.png)

- 依赖范围传递性

	- 带有范围依赖的资源在进行传递时，作用范围将受到影响

![Snipaste_2023-11-16_05-56-56](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/MavenSnipaste_2023-11-16_05-56-56.png)
