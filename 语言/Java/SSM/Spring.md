# 核心概念

## 系统架构图

![image-20231118230317996](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/Mavenimage-20231118230317996.png)

(1)核心层

* Core Container:核心容器，这个模块是Spring最核心的模块，其他的都需要依赖该模块

(2)AOP层

* AOP:面向切面编程，它依赖核心层容器，目的是==在不改变原有代码的前提下对其进行功能增强==
* Aspects:AOP是思想,Aspects是对AOP思想的具体实现

(3)数据层

* Data Access:数据访问，Spring全家桶中有对数据访问的具体实现技术
* Data Integration:数据集成，Spring支持整合其他的数据层解决方案，比如Mybatis
* Transactions:事务，Spring中事务管理是Spring AOP的一个具体实现，也是后期学习的重点内容

(4)Web层

* 这一层的内容将在SpringMVC框架具体学习

(5)Test层

* Spring主要整合了Junit来完成单元测试和集成测试

## IOC、IOC容器、Bean、DI

1. IOC（Inversion of Control）控制反转

(1)什么是控制反转呢？

* 使用对象时，由主动new产生对象转换为由外部提供对象，此过程中对象创建控制权由程序转移到外部，此思想称为控制反转。
	* 业务层要用数据层的类对象，以前是自己`new`的
	* 现在自己不new了，交给`别人[外部]`来创建对象
	* `别人[外部]`就反转控制了数据层对象的创建权
	* 这种思想就是控制反转
	* 别人[外部]指定是什么呢?继续往下学

(2)Spring和IOC之间的关系是什么呢?

* Spring技术对IOC思想进行了实现
* Spring提供了一个容器，称为==IOC容器==，用来充当IOC思想中的"外部"
* IOC思想中的`别人[外部]`指的就是Spring的IOC容器

(3)IOC容器的作用以及内部存放的是什么?

* IOC容器负责对象的创建、初始化等一系列工作，其中包含了数据层和业务层的类对象
* 被创建或被管理的对象在IOC容器中统称为==Bean==
* IOC容器中放的就是一个个的Bean对象

(4)当IOC容器中创建好service和dao对象后，程序能正确执行么?

* 不行，因为service运行需要依赖dao对象
* IOC容器中虽然有service和dao对象
* 但是service对象和dao对象没有任何关系
* 需要把dao对象交给service,也就是说要绑定service和dao对象之间的关系

像这种在容器中建立对象与对象之间的绑定关系就要用到DI:

2. ==DI（Dependency Injection）依赖注入==

![1629735078619](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/Maven1629735078619.png)

(1)什么是依赖注入呢?

* 在容器中建立bean与bean之间的依赖关系的整个过程，称为依赖注入
	* 业务层要用数据层的类对象，以前是自己`new`的
	* 现在自己不new了，靠`别人[外部其实指的就是IOC容器]`来给注入进来
	* 这种思想就是依赖注入

(2)IOC容器中哪些bean之间要建立依赖关系呢?

* 这个需要程序员根据业务需求提前建立好关系，如业务层需要依赖数据层，service就要和dao建立依赖关系

介绍完Spring的IOC和DI的概念后，我们会发现这两个概念的最终目标就是:==充分解耦==，具体实现靠:

* 使用IOC容器管理bean（IOC)
* 在IOC容器内将有依赖关系的bean进行关系绑定（DI）
* 最终结果为:使用对象时不仅可以直接从IOC容器中获取，并且获取到的bean已经绑定了所有的依赖关系.

## 项目结构

![image-20231210153917212](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/Mavenimage-20231210153917212.png)

- **mvnw**和**mvnw.cmd**——这些是Maven包装器脚本。即使您的计算机上没有安装Maven，也可以使用这些脚本构建项目。
- pom.xml——这是Maven构建规范。
- TacocloudApplication.java——这是引导项目的Spring Boot 主类。
- application.properties——该文件最初为空，但提供了一个可以指定配置属性的地方。
- static——在此文件夹中，可以放置要提供给浏览器的任何静态内容(图像、样式表、JavaScript等），最初为空。
- templates—在此文件夹中，放置用于向浏览器呈现内容的模板文件。
- TacocloudApplicationTests.java——这是一个简单的测试类，可确保成功加载Spring应用程序上下文。开发应用程序时，将添加更多的测试。

![image-20231210154051794](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/Mavenimage-20231210154051794.png)

starter依赖提供的三个主要好处：

- 构建的文件将会小得多，也更容易管理，因为不需要对每一个可能需要的库都声明一个依赖项。
- 可以根据它们提供的功能来考虑需要的依赖关系，而不是根据库名来考虑。如果正在开发一个web应用程序，那么将添加web starter依赖项，而不是一个编写web应用程序的各个库的清单。
- 不用担心 library版本问题。可以相信的是，对于给定版本的Spring Boot,可间接地引入的库的版本将是兼容的，只需要考虑使用的是哪个版本的 Spring Boot。

# 注解

| 注解                         | 描述                       |
| ---------------------------- | -------------------------- |
| @DeleteMapping               | 处理HTTP DELETE请求        |
| @EnableAsync                 | 开启Spring的异步功能       |
| @EnableScheduling            | 启用了Spring的任务调度功能 |
| @EnableTransactionManagement | 开启Spring的事务支持       |
| @GetMapping                  | 处理HTTP GET请求           |
| @PatchMapping                | 处理 HTTP PATCH            |
| @PostMapping                 | 处理HTTP POST请求          |
| @PutMapping                  | 处理HTTP PUT请求           |
| @RequestMapping              | 通用请求处理               |
| @SpringBootApplication       | 标注一个Spring应用         |
|                              |                            |
|                              |                            |
|                              |                            |
