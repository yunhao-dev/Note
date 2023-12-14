# 活动的生存期

- onCreate()

  这个方法你已经看到过很多次了，每个活动中我们都重写了这个方法，它会在活动第一次被创建的时候调用。你应该在这个方法中完成活动的初始化操作，比如说加载布局、绑定事件等。

- onStart()

  这个方法在活动由不可见变为可见的时候调用。

- onResume()

​		这个方法在活动准备好和用户进行交互的时候调用。此时的活动一定位于返回栈的栈顶，并且处于运行		状态。

- onPause()

  这个方法在系统准备去启动或者恢复另一个活动的时候调用。我们通常会在这个方法中将一些消耗CPU的资源释放掉，以及保存一些关键数据，但这个方法的执行速度一定要快，不然会影响到新的栈顶活动的使用。

- onStop()

  这个方法在活动完全不可见的时候调用。它和onPause（方法的主要区别在于，如果启动的新活动是一个对话框式的活动，那么onPause()方法会得到执行，而onStop（方法并不会执行。

- onDestroy()

  这个方法在活动被销毁之前调用，之后活动的状态将变为销毁状态。

- onRestart()

  这个方法在活动由停止状态变为运行状态之前调用，也就是活动被重新启动了。以上七个方法中除了onRestart（)方法，其他都是两两相对的，从而又可以将活动分为三种生存期。

------

1. 完整生存期

   活动在onCreate（)方法和onDestroy（方法之间所经历的，就是完整生存期。一般情况下，一个活动会在onCreate0方法中完成各种初始化操作，而在onDestroyO方法中完成释放内存的操作。

2. 可见生存期

   活动在onStart（)方法和onStopO方法之间所经历的，就是可见生存期。在可见生存期内，活动对于用户总是可见的，即便有可能无法和用户进行交互。我们可以通过这两个方法，合理地管理那些对用户可见的资源。比如在onStartO方法中对资源进行加载，而在onStopO方法中对资源进行释放，从而保证处于停止状态的活动不会占用过多内存。

3. 前台生存期

   活动在onResume（方法和onPauseO方法之间所经历的，就是前台生存期。在前台生存期内，活动总是处于运行状态的，此时的活动是可以和用户进行相互的，我们平时看到和接触最多的也这个状态下的活动。

![image-20230604213623074](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/image-20230604213623074.png)

# Service

### 概念

- Service意为：服务，是一种运行时用户不可见的活动机制
	- Service不同与子线程，Service是运行在主线程中的，不能进行耗时操作。

## 前台Service

### 概念

- 运行在前台可以和用户打交道的Service
- 优先级相比另外两个运行在后台的Service要高，几乎不会被系统回收

## 使用场景

- 音乐App播控通知栏
- 前台服务必须显示通知(Notification)
- 该通知是不可去除的，除非服务停止或者从前台移除

### 启动

- 一般是在一个普通Service的onCreate方法中将这个Service提升为前台Service
	- 创建通知(Notification)
	- 调用方法startForegound(notificationld,notification)
	- 在Manifest文件中申请权限：android.permission.FOREGROUND_SERVICE

![image-20231214034933186](https://noclose-image.oss-cn-hangzhou.aliyuncs.com/img/java/Mavenimage-20231214034933186.png)