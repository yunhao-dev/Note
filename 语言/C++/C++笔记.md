# C++笔记

# C++与C的区别(一)

## **头文件与命名空间**

+ 创建源文件是.cpp 文件，头文件不变，依旧是.h文件
+ 包含头文件的方式

  + 包含自己的头文件没有任何区别 #include "myHead.h"
  + 包含库目录
    + C语言中的: 采用原来方式包含可以，可以用C++包含方式，去掉.h 加个c
    + iostream C++标准输入输出流的头文件
+ 命名空间的引入

  + 命名语法

    ```c++
    //1.基本创建空间方法
    namespace 空间名
    {
    	int a;
        void print(){}
    }
    //2.学会访问命名空间中的东西
    //2.1 用空间名限定去访问
    int main()
    {
    	空间名::a=1001;
        空间名::print();
        return 0;
    }
    ```
  + 可以增加标识符的使用率，C语言同一个作用域下不允许定义相同的标识符
  + 作用域分辨符::

    + 空间名限定，类名限定(后面讲)
    + 用来标识全局变量
  + using语法 ，可以省略前缀的写法

    ```c++
    using namespace 空间名;   //就可以省略当前的空间名
    //只在当前作用域下有效
    ```
  + 空间名的嵌套与空间内容访问

  ```c++
  namespace A
  {
      int aa=1;
  	namespace B
      {
          int bb=1;
      }    
  }
  A::B::bb=1001;		//剥洋葱
  using namespace A::B;
  bb=1002;
  ```

## **基本输入和输出**

+ #include 
  <iostream>
+ 一般情况都会包含命名空间  using namespace std;
+ 输出: cout<< 做输出
  + C++支持C语言的格式控制字符
+ 输入: cin>>做输入

```c++
#include <iostream>
#include <string>
//using namespace std;  一般都是写在这里，避免std的前缀使用
void testCinCout() 
{
	using namespace std;
	//1.基本变量打印不需要格式控制
	cout << "ILoveyou\n";
	char str[] = "ILoveyou\n";
	cout << str;
	int a = 1;
	float b = 1.1;
	cout << a;
	cout << b;
	cout << "\n";
	//2.如何一次性打印多个数据
	cout << a << "\t" << (int)b << "\n";
	cout << a << "\t" << int(b) << "\n";
	//C语言运算符的隐式转换都是一样的
	int aa = 1.111;
	//3.C++换行  endl替换\n的作用
	cout << "姓名" << endl;
	cout << "年龄" << endl;

	int iNum = 0;
	float fNum = 0.0f;  //默认小数是double
	//unsigned int uNum = 1u;
	//long int lNum = 1L;
	cout << "请输入一个整数，一个浮点数，一个字符串：";
	//一个一个处理
	//cin >> iNum;
	//cin >> fNum;
	//cin >> str;
	//一次处理多个
	cin >> iNum >> fNum >> str;
	cout << iNum << "\t" << fNum << "\t" << str << endl;
}

//输入的几个问题
//1.字符串输入空格问题
void  testStr() 
{
	using namespace std;
	char str[10] = "";
	cin >> str;			//不带空格的输入
	cout << str;
	//fflush(stdin)					//已被淘汰
	//setbuf(stdin,NULL);
	while (getchar() != '\n');		//字符和字符串输入前，做了输入
	char c;
	cin >> c;
	cout << c;
	//接受空格的输入--->了解
	cin.getline(str, 10);		//gets_s(str, 10);
	cout.write(str, 10);
}
//2.关于命名空间std
void testNamespace()
{
	//当不加using namespace  std;
	std::cout << "没有写using namespace std" << std::endl;
	std::string str = "ILoveyou";
}

int main() 
{
	testStr();

	return 0;
}
```

## **新数据类型**

+ bool类型

  + 占用内存是一个字节
  + 计算机非零表示成立，只有0或者指针空表示不成立
  + 一般充当函数返回值，或者开关
  + 正常输出是0和1
  + C++专有的赋值方式，false和true
+ 指针的NULL C++种改为 nullptr
+ 引用类型

  + 理解为起别名
  + 基本引用

  ```c++
  类型名& 别名=要起别名的东西;
  int a=1;
  int& b=a;  //a有另一个名字叫b ，a就是b，b就是a
  ```

  + 常引用(右值引用)

  ```c++
  类型名&& 别名=右值
  int&& a=1;   //1就是a ，a就是1
  ```
+ 引用一般用在那些地方

  + 函数参数(防止拷贝产生)
  + 函数返回值(增加左值使用)
    + 不能返回局部变量引用

  ```c++
  #include <iostream>
  using namespace std;
  void  testBool() 
  {
  	bool bNum = 1234;
  	cout << bNum << endl;
  	bNum = false;
  	bNum = true;
  	cout << bNum << endl;
  	//boolalpha 用true和false方式打印bool类型
  	cout << boolalpha << bNum << endl;
  }
  void testnullptr() 
  {
  	int* p = nullptr;   //NULL
  	char* pc = NULL;
  }
  void printStr(const char* str) 
  {
  	cout << str << endl;
  }

  void testQuote() 
  {
  	//1.什么是起别名
  	int 女朋友 = 1;
  	//类型 & 别名=要起别名的东西
  	int& 小可爱 = 女朋友;  //小可爱就是女朋友的别名
  	小可爱 = 777;
  	cout << 女朋友 << endl;
  	//2.C++种常量要求更严格
  	//想要变量和常量，就必须用const修饰
  	printStr("ILoveyou"); //形参必须要有const 
  	char str[] = "ILoveyou";
  	printStr(str);
  	//3.常引用
  	//int& x = 1;		//直接报错，C++对const要求更严格
  	int aa = 1;
  	const int& x = 1;	//第一种写法:const修饰
  	const int& x2 = aa;
  	//右值引用,只能给右值起别名
  	int&& xx = 1;		//常量是右值(运算符的右边)
  	//int&& xx2 = aa;   //右值引用只能给右值起别名
  }
  void modifyA(int a)
  {
  	a = 1001;
  }
  void modifyB(int& a)     //int& a=实参;
  {
  	a = 1001;
  }
  void swap(int& a, int& b) 
  {
  	int temp = a;
  	a = b;
  	b = temp;
  }
  int g_num = 1001;
  void modifyPointA(int* p) 
  {
  	p = &g_num;
  }
  void modifyPointB(int*& p)  //int*& p=实参
  {
  	p = &g_num;
  }

  //右值引用
  void printRightValue(int&& a) 
  {
  	a += 11;     //可以增加一个可以修改的功能
  	cout << a << endl;
  }
  void printRight(const int& a) 
  {
  	//a += 11;   //常饮用不能修改
  	cout << a << endl;
  }
  int getData() 
  {
  	return g_num;
  }

  int& getValue() 
  {
  	return g_num;
  }


  void useQuote() 
  {
  	int aa = 1;
  	modifyA(aa);		//拷贝本
  	cout << aa << endl;
  	modifyB(aa);		//任何传参都是赋值的方式传参
  	cout << aa << endl;
  	int bb = 22;
  	swap(aa, bb);
  	cout << aa << "\t" << bb << endl;
  	int pa = 1008;
  	int* p = &pa;
  	cout << "当作函数参数" << endl;
  	modifyPointA(p);
  	cout << *p << endl;
  	modifyPointB(p);
  	cout << *p << endl;
  	printRightValue(11);
  	printRight(11);
  	//返回值就是一个值，这个值只能是右值
  	//getData() = 1001;  错误
  	getValue() = 0;		//返回引用表示返回变量本身
  	cout << g_num << endl;
  }




  int main() 
  {
  	//testBool();
  	testQuote();
  	useQuote();
  	return 0;
  }
  ```
+ 自动推断类型auto类型： 必须根据赋值的数据推断类型，不能直接推断

## **函数思想**

+ 内敛思想 inline关键字
  + 什么样的函数可以成为inline，短小精悍
  + 在结构体中或者类种实现的函数默认内敛(知道即可)
+ 函数重载： C++允许同名不同参数函数存在
  + 参数数目不同
  + 参数类型不同
  + 参数顺序不同（一定建立在不同类型的基础上）
+ 函数缺省： C++中允许给函数形参初始化
  + 缺省顺序 必须从右往左缺省，缺省的参数中间不能存在没有缺省的
  + 没有参入参数，使用的是默认值

```c++
#include <iostream>
using namespace std;
inline int  Max(int a, int b) 
{
	return a > b ? a : b;
}
void print(int a) 
{
	cout << a << endl;
}
void print(int a, int b) 
{
	cout << a + b << endl;
}
//和上面不是顺序不同
//void print(int b, int a) 
//{
//	cout << a + b << endl;
//}
void print(int a, char b) 
{
	cout << "int,char" << endl;
	cout << a + b << endl;
}
void print(char a, int b)
{
	cout << a + b << endl;
}
//函数缺省
void printData(int a=1, int b=2, int c=3, int d=4) 
{
	cout << a + b + c + d << endl;
}
int main() 
{
	print(1, 'A');		//重载调用，优先调用类型一致
	//老师的理解: 缺省其实是重载的一种综合写法
	printData();			  //a=1 b=2 c=3 d=4
	printData(10);			  //a=10 b=2 c=3 d=4
	printData(10, 20);		  //a=10 b=20 c=3 d=4
	printData(10, 20, 30);	  //a=10 b=20 c=30 d=4	
	printData(10, 20, 30, 40);//a=10 b=20 c=3 d=40
	return 0;
}
```

## **作业**

注册一个CSDN  ，把今天学的内容，总结好，分析好，发布一篇博客即可，发完连接发给即可

## **答疑环节**

+ auto与C语言auto区别

  + C++中淘汰了C语言用法，只有自动推断用法
+ void text(float b=0.0,int a=0,char c='a')
  然后传的时候，只传int类型和char类型，它给哪个形参传参。。
+ 博客切入代码格式

  ![image-20211112221401867](image-20211112221401867.png)

# C++与C的区别(二)

## 结构体区别

+ 类型上不再需要struct关键字，直接用结构体名即可
+ C++结构体中允许函数存在

  + 在结构体中声明，在结构体外实现，当然可以直接在结构体中实现
  + 结构体中函数访问数据，是可以直接访问
  + 学会调用，和数据成员方式时一样的

    + 对象(结构体变量).成员
    + 对象指针->成员
    + (*对象指针).成员
  + C++在没有写构造函数和权限限定的时候，用法和C语言的用法是一样

```c++
#include <iostream>
#include <string>
using namespace std;
struct MM 
{
	//protected:  不需要深究后续会讲
	//MM() {}     不需要深究后续会讲
	//属性，特征
	//数据成员
	char name[20];
	int age;
	//.....
	//行为(方法)
	//成员函数
	void print() 
	{
		cout << name << "\t" << age << endl;
	}
	void printData();		//在结构体中声明，在外面实现
	//通过外部函数修改数据
	int& getAge() 
	{
		return age;
	}

};
//结构体名限定，就是告诉别人这个函数来自哪里
void MM::printData() 
{
	cout << name << "\t" << age << endl;
}
//结构体中的变量必须要通过结构体变量(结构体指针)访问
//C++结构体中的函数访问属性，可以直接访问

int main()
{
	struct MM girl = { "小芳",28 };
	MM mm = {"小丽",24};
	girl.print();
	(&mm)->printData();
	MM* p = &mm;
	p->printData();
	p->getAge() = 84;
	p->printData();
	p->age = 1991;
	p->printData();
	MM array[3];
	return 0;
}
```

## 动态内存申请

+ C语言的动态内存申请

  + malloc  不带初始化 ，calloc  带初始化,realloc   重新申请
  + free 释放
+ C++的动态申请

  + new(申请)和delete(释放)
  + 单个变量内存申请
  + 数组的动态申请
  + 结构体内存申请

```c++
#include <iostream>
#include <cstring>
using namespace std;
void testOneMemory() 
{
	//申请不做初始化
	int* pInt = new int;
	*pInt = 123;
	cout << *pInt << endl;
	char* pChar = new char;
	*pChar = 'A';
	cout << *pChar << endl;
	//申请内存做初始化  ()给单个数据初始化
	int* pNum = new int(134);
	cout << *pNum << endl;
	delete pInt;
	pInt = nullptr;
	pInt = new int;
	*pInt = 332;
	cout << *pInt << endl;
	delete pInt;
	pInt = nullptr;

	delete pChar;
	pChar = nullptr;
	delete pNum;
	pNum = nullptr;
}
void testArrayMemory()
{
	//一维数组
	//1.不带初始化
	//长度可以是变量，只要值就可以
	int* pInt = new int[3];		//等效产生了int pInt[3]的数组
	//const char* pstr = new char[15];  //你 --->大老婆
	//const char* pstr1 = pstr;         //朋友--->大老婆
	//pstr = "ILoveyou";				  //你-->二老婆
	char* pstr = new char[15];
	strcpy_s(pstr, 15, "ILoveyou");
	cout << pstr << endl;
	//cout << pstr1 << endl;
	//带初始化的  一堆数据用 {}
	int* pNum = new int[3]{ 1,2,3 };
	for (int i = 0; i < 3; i++) 
	{
		cout << pNum[i] << " ";
	}
	cout << endl;
	delete[] pNum;
	char* str = new char[20]{ 'A','B','\0' };
	cout << str << endl;
	delete[] str;
	str = nullptr;
	str = new char[20]{ "ILoveyou" };
	cout << str << endl;
	delete[] str;
	str = nullptr;
	delete [] pInt;   //数组的释放 不需要大小
	//释放只有两种形式 delete 指针   delete [] 指针
	//delete [][] p 没有这种写法
	pInt = nullptr;
}
struct MM 
{
	char* name;
	int age;
	//成员函数
	void printMM() 
	{
		cout << name << "\t" << age << endl;
	}
};
void testStructMemory()
{
	//new一个对象
	int* p = new int(23);
	//结构体只能用大括号
	MM* pMM = new MM;
	//结构体中指针，要做二次申请，才能strcpy，或者赋值
	pMM->name = new char[20];
	strcpy_s(pMM->name,20, "丽丝");
	pMM->age = 188;
	pMM->printMM();
	//申请顺序和释放顺序是相反
	delete[] pMM->name;
	delete pMM;
}

int main() 
{
	//testOneMemory();
	//testArrayMemory();
	testStructMemory();
	return 0;
}
```

## 内存池

+ 允许大家申请一段内存，共给程序使用，综合管理内存

```c++
#include <iostream>
using namespace std;
//允许大家申请一段内存，共给程序使用，综合管理内存
//malloc 内存是在堆区
//new 内存是自由存储区
void testMemory() 
{
	char* memorySum = new char[1024];
	//.......事情的处理，需要内存，所有内存源自于memorySum
	//int* pNum = new(申请内存的开始位置) int[3]
	int* pNum = new(memorySum) int[3]{ 1,2,3 };
	//char* pstr = new(pNum + 3) char[20]{ "ILoveyou" };
	//和下面这句话是等效的
	char* pstr = new(memorySum + 12) char[20]{ "ILoveyou" };
	for (int i = 0; i < 3; i++) 
	{
		cout << pNum[i] << " ";
	}
	cout << endl;
	for (int i = 0; i < 3; i++)
	{
		cout << ((int *)memorySum)[i] << " ";
	}
	cout << endl << pstr << endl;
	cout << (memorySum + 12) << endl;
	delete[] memorySum;
	memorySum = nullptr;
}
int main() 
{
	testMemory();
	return 0;
}
```

## string类型

只需要知道有这种用法即可，不需要大家深究为什么，因为string本身是一个类，需要讲完类的大部分知识，才能追究为什么这样做。自己也可以封装一个string 类型

+ string创建

  + 带初始化
  + 不带初始化
  + 通过另一个字符串创建
+ string基本操作

  + 拷贝
  + 赋值
  + 连接
  + 比较
+ C++string与C语言string.h
+ string 其他函数操作

  [basic_string 类 | Microsoft Docs](https://docs.microsoft.com/zh-cn/cpp/standard-library/basic-string-class?view=msvc-170)

```c++
#include <string>   //注意和string.h区别
#include <iostream>
#include <cstring>	//string.h和cstring是一样
#include <stdio.h>
using namespace std;
void createString() 
{
	//std::string  str;
	string str1;
	str1 = "ILoveyou";  //所以一般用string不会加const
	cout << "First:" << str1 << endl;
	const string cstr;
	//cstr = "IMissyou";  错误，常属性不能修改

	string str2("ILoveyou");
	cout << str2 << endl;
	string str3 = "IMissyou";   //喜欢这种方式
	cout << str3 << endl;

	string str4(str3);
	cout << str4 << endl;

	string str5 = str4;
	cout << str5 << endl;
	//一般没有长度限定，在你使用范围下
	string str = "2333333333333333333333333333333333333333333333333333333333333";
}

void  operatorString() 
{
	string str1 = "one";
	string str2 = "two";

	string str3 = str2;
	cout << str3 << endl;

	//没有减法
	string str4 = str1 + str2;
	//等效: string str4=str1.append(str2);
	//C++中尽量用string 不要用char*  ，可以用
	//比较直接比较即可
	//>  < != ==
	//str1.compare(str2)  0 -1 1
	if (str1 > str2)    //比较依旧按照char* 去比较
	{
		cout <<"大的 "<< str1 << endl;
	}
	else 
	{
		cout << "大的 " << str2 << endl;
	}
}
void compareCAndCpp() 
{
	//C++中是一个自定义类型(类)，目前当作结构体即可
	//C++string 不能用到C语言的字符串处理函数
	//C++如何转换为C语言的char* 
	//c_str()  data()函数
	string str1 = "ILoveyou";
	//printf("%s", str1);
	printf("%s\n", str1.c_str());
	printf("%s\n", str1.data());
	//outtextxy(int x,int y,char* str);

	//直接把数字转换为相应的字符串
	string str2 = to_string(1234);
	//atoi
	cout << str2 << endl;
}
void exOperator() 
{
	//采用下表法打印string
	string str = "IMissyou";
	//C++string中没有记录\0 
	for (int i = 0; i < 8; i++) 
	{
		cout << str[i];
	}
	cout << endl;
	//其他函数操作
	//万金油函数
	//empty()
	//size();
	string mystring = "IMissyou";
	//cout << sizeof(mystring) << endl;   //28
	//cout <<"容量：" <<mystring.capacity() << endl;
	cout <<"mystring:"<< mystring.size() << endl;
	string strEmpty;		
	if (strEmpty.empty())				  //return length==0;
	{
		cout << "string为空" << endl;
	}
}
void initString() 
{
	char* str = new char[15];
	//做了自动扩增处理
}
int main() 
{
	//createString();
	//operatorString();
	//compareCAndCpp();
	exOperator();
	return 0;
}
```

## **作业**

编程题:

二维数组的动态内存申请，采用子函数的方式  为二级指针申请内存，和释放内存

把今天学的内容，总结好，分析好，加上编程题，发布一篇博客即可，发完连接发给即可

## **答疑环节**

+ 结构体内 char *  为啥下面复制字符串的时候要用 const

  这个跟赋值的值有关系，因为C++对const要求更严格，=两边类型必须一致
+ 所以c语言申请内存空间calloc，realloc可以讲一下吗

```C
#include <string>
#include <iostream>
#include <stdio.h>
using namespace std;
void testConst() 
{
	//指针变量=常量地址
	const char* str = "ILoveyou";
	char str2[] = "ILoveyou";
	char* str3 = str2;
}
void print(int array[], int arrayNum) 
{
	for (int i = 0; i < arrayNum; i++) 
	{
		cout << array[i] << " ";
	}
	cout << endl;
}

void testCalloc() 
{
	//int pMnum[3]
	//申请内存不做初始化
	int* pMNum = (int*)malloc(sizeof(int) * 3);
	if (pMNum == nullptr)
		return;
	memset(pMNum, 0, sizeof(int) * 3);  //内存初始化
	print(pMNum, 3);

	int* pCNum = (int*)calloc(3, sizeof(int));
	print(pCNum, 3);

	int* pint = (int*)malloc(sizeof(int));
	if (pint == NULL) 
	{
		return;
	}
	*pint = 1999;
	pint = (int *)realloc(pint, sizeof(int) * 3);
	pint[1] = 123;
	pint[2] = 134;
	print(pint, 3);
	free(pint);
}

int main() 
{
	testCalloc();


	return 0;
}
```

+ auto p=new int[3] 没问题
+ 内存池代码理解

![image-20211115221306199](image-20211115221306199.png)

+ 作业指导C语言版本

```c++
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
int** createArray2D(int row, int cols) 
{
	//int *pArray=(int*)malloc(sizeof(int)*3)
	int** pArray = (int**)malloc(sizeof(int*) * row);
	if (pArray == NULL)
		return NULL;
	for (int i = 0; i < row; i++) 
	{
		//一级指针
		pArray[i] = (int*)malloc(sizeof(int) * cols);
	}
	return pArray;
}
//有兴趣的可以用传参的方式
void mallocArray2D(int*** pArray, int row, int cols)
{

}
int main() 
{
	int** p = createArray2D(4, 3);
	for (int i = 0; i < 4; i++) 
	{
		for (int j = 0; j < 3; j++) 
		{
			p[i][j] = i * j;
			printf("%d\t", p[i][j]);
		}
		printf("\n");
	}
	return 0;
}
```

# C++类和对象

## 类和对象的基本概念

+ 什么是类，一系列事物的抽象，万物皆可为类
  + 类是有两部分组成： 属性  行为
  + 属性: 事物的特征--->数据类型描述
  + 行为: 事物的操作--->函数描述
+ 什么是对象： 类的具体化，类的实例化.
+ 类的特点: 封装，继承/派生，多态

## 类的定义

+ 创建语法

```c++
class 类名
{
    //权限限定词
    public:
    protected:
    private:
};			//一定有一个；
```

+ 权限限定 作用

  + 类外只能访问public属性下面的 东西，习惯把 public属性 叫做类外的接口

    + 类外访问 类中的数据，只能通过对象访问，当然static成员除外
  + protected和private 类外都不可以访问 ，但是可以提供共有接口间接访问
  + 默认属性(没有写在权限限定词下的属性)是 私有属性
  + 权限限定词，只是用来限定类外的访问，并不是限定中的访问
  + protected和private 有区别 ，继承有 区别，对类外 都是不可以访问
+ C++结构体 在一定程序可以直接 当作是类

  + 默认属性是公有属性

```c++
#include <iostream>
#include <string>
using namespace std;
class GirlFriend
{
	void print() 
	{
		cout << "不在限定词下的属性" << endl;
		cout << "默认为私有属性" << endl;
	}
public:
	//共有属性
	//成员函数
	//类中实现函数
	void  printData() 
	{
		cout << m_name << "\t" << m_age << endl;
	}
	//为了访问不能访问的部分，通常提供一些接口
	void  initData(string name, int age);
protected:
	//保护属性
	//数据成员
	string m_name;
private:
	//当前类不做继承处理，数据成员写成私有属性
	int m_age;
};
//类外实现类中函数，需要类名限定，告诉别人这个函数是哪里来的
void GirlFriend::initData(string name,int age)  
{
	//Lisa.initData("Lisa", 19);  name="Lisa" age=19
	m_name = name;    //Lisa.m_name=Lisa
	m_age = age;	  //Lisa.m_age=19;
	//mm.initData("MM", 29);   name="MM" age=29
	//mm.m_name=MM;
	//mm.age=29
}
struct MM 
{
	int num;   //默认属性是公有属性
protected:
	string name;
private:
	int age;
};
void testMM() 
{
	//MM mm = { 1001,"name",28 };
	MM mm;
	mm.num = 103;
	//mm.name = "Ilove";
	//mm.age = 13;
}
int main()
{
	GirlFriend  Lisa;
	Lisa.initData("Lisa", 19);
	Lisa.printData();
	//类外只能访问public
	//Lisa.m_name = "Lisa";
	//Lisa.m_age = 18;
	GirlFriend mm;
	mm.initData("MM", 29);
	mm.printData();
	//mm.print();  --->不能访问私有属性

	return 0;
}
```

## 对象创建

+ 普通对象
+ 对象数组
+ new 一个对象

```c++
#include <iostream>
#include <string>
using namespace std;
class MM 
{
public:
	void print() 
	{
		cout << name << "\t" << age << endl;
	}
	void initData(string nname,int nage) 
	{
		name = nname;
		age = nage;
	}
protected:
	//新标准，可以在类中给数据直接初始化
	string name="默认值";
	int age=0;
};
int main() 
{
	//没有写构造函数的情况下,和C语言的创建方式是一样的
	MM  mm;
	mm.print();			//没有初始化数据
	MM mmArray[4];		//一般很少用对象数组
	//mmArray[0]----mmArray[3]
	//数组: 多个变量名有规律，内存连续的变量的集合
	for (int i = 0; i < 4; i++) 
	{
		mmArray[i].initData(string("name") + to_string(i), i + 19);
		mmArray[i].print();
	}
	MM* p = new MM;
	p->initData("张三", 18);
	p->print();
	delete p;
	p = nullptr;
	return 0;
}
```

## 成员访问（初始化）

+ 通过提供 公有接口传参的方式初始化数据
+ 通过提供 公有接口返回值的方式初始化数据
+ 默认初始化

```c++
#include <iostream>
#include <string>
using namespace std;
class MM
{
public:
	//传参
	void initData(string name, int age)
	{
		m_name = name;
		m_age = age;
	}
	//返回引用
	string& getName() 
	{
		return m_name;
	}
	int& getAge() 
	{
		return m_age;
	}
	void print() 
	{
		cout << m_name << "\t" << m_age << endl;
	}
protected:
	//默认初始化
	string m_name="默认值";
	int m_age=0;
	//不做初始化是一个垃圾值
};

int main() 
{
	MM girl;
	girl.initData("girl", 19);
	girl.print();

	MM mm;
	mm.getName() = "mm";
	mm.getAge() = 18;
	mm.print();

	MM boy;
	boy.print();

	return 0;
}
```

## 面向对象的编程方式

```c++
#include <iostream>
#include <string>
using namespace std;
#if 0
struct Node
{
	int data;
	struct Node* next;
};
struct Node* createList() 
{
	Node* headNode = new Node;
	headNode->next = nullptr;
	return headNode;
}
struct Node* createNode(int data) 
{
	Node* newNode = new Node;
	newNode->data = data;
	newNode->next = nullptr;
	return newNode;
}
void insertData(Node* headNode, int data) 
{
	Node* newNode = createNode(data);
	newNode->next = headNode->next;
	headNode->next = newNode;
}
void printList(Node* headNode) 
{
	Node* pMove = headNode->next;
	while (pMove != nullptr) 
	{
		cout << pMove->data<<" ";
		pMove = pMove->next;
	}
	cout << endl;
}
void testListC() 
{
	Node* list = createList();
	insertData(list, 10);
	insertData(list, 20);
	printList(list);
}
#endif

#if 0
struct Node 
{
	int data;
	Node* next;
};
class List  
{
public:
	void createList() 
	{
		headNode = new Node;
		headNode->next = nullptr;
	}
	void insertData(int data) 
	{
		Node* newNode = new Node;
		newNode->data = data;
		newNode->next = nullptr;

		newNode->next = headNode->next;
		headNode->next = newNode;
	}
	void printList() 
	{
		Node* pMove = headNode->next;
		while (pMove != nullptr) 
		{
			cout << pMove->data << " ";
			pMove = pMove->next;
		}
		cout << endl;
	}
protected:
	Node* headNode;		//用一个指针表示整个表头
};
void testList1()
{
	List* pList = new List;		//C++第一步:创建对象
	pList->insertData(10);
	pList->insertData(20);
	pList->printList();
}
#endif 
class Node 
{
public:
	Node*& getNext() 
	{
		return next;
	}
	int& getData() 
	{
		return data;
	}
protected:
	int data;
	Node* next;
};
class List 
{
public:
	void createList() 
	{
		headNode = new Node;
		headNode->getNext() = nullptr;
	}
	void insertData(int data) 
	{
		Node* newNode = new Node;
		newNode->getNext() = nullptr;
		newNode->getData() = data;

		newNode->getNext() = headNode->getNext();
		headNode->getNext() = newNode;
	}
	void printList() 
	{
		Node* pMove = headNode->getNext();
		while (pMove != nullptr) 
		{
			cout << pMove->getData() << "\t";
			pMove = pMove->getNext();
		}
		cout << endl;
	}
protected:
	Node* headNode;
};
void testList2()
{
	List* pList = new List;		//C++第一步:创建对象
	pList->createList();
	pList->insertData(10);
	pList->insertData(20);
	pList->printList();
}
int main() 
{
	//testListC();
	testList2();
	return 0;
}
```

## 上节课作业

```c++
#include <iostream>
using namespace std;
void createArray2D(int**& p, int row, int cols) 
{
	p = new int* [row];
	for (int i = 0; i < row; i++) 
	{
		p[i] = new int[cols];
	}
}
void deletePoint(int**& p,int row) 
{
	for (int i = 0; i < row; i++)
	{
		delete [] p[i];
	}
	delete[] p;
}
void testArray(int** p, int row, int cols) 
{
	for (int i = 0; i < row; i++) 
	{
		for (int j = 0; j < cols; j++) 
		{
			p[i][j] = i * j;
			cout << p[i][j] << "\t";
		}
		cout << endl;
	}
}
void modify(int a) 
{
	a = 1001;
}
//C语言
//修改(0级)普通变量  传入一级指针(普通变量地址)
//修改该一级指针，传入二级指针
//修改该二级指针，传入三级指针
void modify2(int& a) //int& a=实参
{
	a = 1001;
}

void createArray(int*** p, int row, int cols) 
{
	*p = new int* [row];
	for (int i = 0; i < row; i++) 
	{
		(*p)[i] = new int[cols];
	}
}

int main() 
{
	int a = 1;
	modify(a);
	cout << a << endl;
	modify2(a);
	cout << a << endl;
	int** p = nullptr;
	createArray2D(p, 3, 4);
	testArray(p, 3, 4);
	deletePoint(p, 3);
	int** array = nullptr;
	createArray(&array, 3, 4);
	testArray(array, 3, 4);
	deletePoint(array, 3);
	return 0;
}
```

## 本节课作业

自己整理笔记，带观点，和代码，代码用来验证观点

## 答疑环节

+ 数据放在protected是为了后续的友元访问吗

  是为了 在继承 当作子 类的访问父类属性，父类的私有 属性子类不能访问
+ 就是string 类型没有\0

  后面 自己可以尝试写 string 知道 原理，目前只需要知道 string记算长度 不算\0
+ 申请内存应该是为了合理分配内存吧用完就释放了

  + 合理使用内存,用户需要多少内存，可以让用户决定，避免内存浪费
  + 保存数据数据的效果
+ 链表用--->容器  ，用来装数据的   类似一个内存不是连续的数组，

  怎么选择容器，方便操作解决问题容器容易度选择

# C++构造和析构

## 构造函数

+ 构造函数长什么样子

  + 函数名和类名相同
  + 没有返回值
  + 如果不写构造函数，任何类中都存在一个默认的构造函数

    + 默认的构造函数是无参的。
    + 当我们自己写了构造函数，默认的构造函数就不存在
  + 构造函数在构造对象的时候调用
  + delete可以用来删掉默认的函数
  + 指定使用默认的无参构造函数，用default说明
  + 允许构造函数调用另一个构造函数，只是要用初始化参数列表的写法
  + 初始化参数列表 ： 只有构造函数有

    构造函数名(参数1，参数2,...):成员1(参数1)，成员2(参数2),...{}

    + 避免形参名和数据成员名相同的导致问题
+ 构造函数干嘛的

  + 构造函数用来构造对象
  + 构造函数更多是用来初始化数据成员
+ 思考题?

  + 为什么不写构造函数可以构造对象? 是因为存在一个默认的无参构造函数，所以可以构造无参对象
  + 构造函数重载为了什么? 为了构造不同长相的对象。

```c++
#include <iostream>
using namespace std;
class MM 
{
public:
	//MM() = delete;     删掉默认的构造函数
	MM(string mmName, int mmAge) 
	{
		name = mmName;
		age = mmAge;
		cout << "带参构造函数" << endl;
	}
	//MM() 
	//{
	//	cout << "无参构造函数" << endl;
	//}
	MM() = default;  //使用的是默认无参构造函数
	void print() 
	{
		cout << name << " " << age << endl;
	}
protected:
	string name="Lisa";
	int age=18;
};
//为了能够构造不同长相的对象，我们会给构造函数缺省处理
class Boy
{
public:
	//Boy(string mname="", int mage=19) 
	//{
	//	name = mname;
	//	age = mage;
	//}
	//上面函数 等效可以实现下面三个函数的功能
	Boy() {}
	Boy(string mName) { name = mName; }
	//出错：没有与之匹配的构造函数
	Boy(string mName, int mage) { name = mName; age = mage; }
protected:
	string name;
	int age;
};
//初始化参数列表的写法
string girlName = "Baby";
class  Student 
{
public:
	Student(string mname="", int mage=18) :name(mname), age(mage) 
	{
		cout << "初始化参数列表" << endl;
		//继承和类的组合必须采用初始化参数列表写法
	}
	Student(int mage) :name(girlName), age(mage) {}

protected:
	string name;
	int age;
};
//构造函数可以调用另一个构造函数初始化数据
class TT 
{
public:
	TT(string name, int age) :name(name), age(age) {}
	//委托构造：允许构造函数调用另一个构造函数
	TT():TT("默认",18) {}     //没有给数据初始化
	void print() 
	{
		cout << name << "\t" << age << endl;
	}
protected:
	string name;
	int age;
};

int main() 
{
	//MM mm;     构造无参的对象，需要无参构造函数
	MM mm("mm", 28);
	mm.print();
	MM girl;
	girl.print();
	Boy boy1;
	Boy boy2("流浪之子");
	Boy boy3("王子", 18);

	TT  tt;
	tt.print();
	return 0;
}
```

## 析构函数

+ 析构函数长什么样子?
  + 无返回值
  + 无参数
  + 函数名: ~类名
  + 不写的话会存在默认的析构函数
  + 析构函数不需要自己 调用，对象死亡的之前会调用析构函数
+ 析构函数用来干嘛?（什么时候需要自己手动写析构函数）
  + 当类中的数据成员是指针，并且动态申请内存就需要手写析构
  + 析构函数用来释放数据成员申请动态内存

```c++
#include <iostream>
#include <string>
#include <cstring>
using namespace std;
class MM 
{
public:
	MM(const char* pstr, int age) :age(age) 
	{
		str = new char[strlen(pstr) + 1];
		strcpy_s(str,strlen(pstr)+1, pstr);
	}
	void print() 
	{
		cout << str << "\t" << age << endl;
	}
	//void freeMemory() 
	//{
	//	delete[] str;
	//}
	~MM();
protected:
	char* str;
	int age;
};
MM::~MM()   
{
	cout << "我叫做析构函数" << endl;
	delete[] str;
}
int main() 
{
	{
	
		MM mm("张三", 18);
		//mm.~MM();				//手动调用会导致二次释放问题
		mm.print();
		//mm.freeMemory();
		//mm.print();
	}
	cout << "主函数" << endl;
	//new一个对象的时候，只有delete 才会调用析构函数
	{
		MM* pObject = new MM("baby", 12);
		delete pObject;
		pObject = nullptr;
		//delete [] p -----  delete p
	}
	return 0;
}
```

## 拷贝构造函数

+ 拷贝构造函数也是构造函数，长相和构造函数一样的，只是参数是固定

  + 拷贝构造函数唯一的参数是对对象引用
+ 不写拷贝构造函数，也存在一个默认的拷贝构造函数
+ 拷贝构造函数作用: 通过一个对象去初始化另一个对象
+ 问题?

  + 什么时候调用拷贝构造?

    + 当通过一个对象去创建出来另一个新的对象时候需要调用拷贝
  + 拷贝构造什么时候需要加const修饰参数？

    + 当存在匿名对象赋值操作的时候，必须要const修饰

```c++
#include <iostream>
#include <string>
using namespace std;
class MM 
{
public:
	MM() = default;
	MM(string name, int age) :name(name), age(age) {}
	void print() 
	{
		cout << name << "\t" << age << endl;
	}
	//拷贝构造
	MM(const MM& mm)			 //MM girl(mm);
	{
		name = mm.name;  //girl.name=mm.name
		age = mm.age;	 //girl.age=mm.age
		cout << "拷贝构造" << endl;
	}


protected:
	string name;
	int age;
};

void printData(MM mm)   //MM mm=实参;
{ 
	mm.print();
}
void printData2(MM& mm) //不存在拷贝本
{
	mm.print();
}
int main() 
{
	MM mm("mm", 18);
	mm.print();
	//显示调用调用
	cout << "显示调用调用" << endl;
	MM girl(mm);        //通过一个对象创建另一个对象
	girl.print();
	//隐式调用
	cout << "隐式调用" << endl;
	MM girl2 = mm;		//拷贝构造
	girl2.print();

	MM girl3;
	girl3 = mm;			//运算符重载
	girl3.print();		

	//函数传参
	cout << "第一种调用形态" << endl;
	printData(mm);
	cout << "第二种调用形态" << endl;
	printData2(mm);

	//无名对象 匿名对象
	MM temp;
	temp = MM("匿名", 18);
	temp.print();

	//匿名对象创建对象时候，拷贝构造一定要用const修饰
	MM temp2 = MM("匿名", 199);
	return 0;
}
```

## 深浅拷贝

浅拷贝: 默认的拷贝构造叫做浅拷贝

深拷贝: 拷贝构造函数中做了new内存操作，并且做拷贝赋值的操作

```c++
#include<iostream>
#include <cstring>
#include <string>
using namespace std;
class MM 
{
public:
	MM(const char* mname, int age) :age(age)
	{
		name = new char[strlen(mname) + 1];
		strcpy_s(name, strlen(mname) + 1, mname);
	}
	void print() 
	{
		cout << name << "\t" << age << endl;
	}
	MM(const MM& object) 
	{
		//name = object.name;
		name = new char[strlen(object.name) + 1];
		strcpy_s(name, strlen(object.name) + 1, object.name);
		//name = object.name;
		age = object.age;
	}
	~MM() 
	{
		delete[] name;
	}
protected:
	char* name;
	int age;
};

int main() 
{
	{
		MM mm("baby", 19);
		MM girl(mm);
		MM gm = mm;
		mm.print();
		girl.print();
		gm.print();
	}
	return 0;
}
```

## 构造和析构顺序问题

+ 普通对象，构造顺序和析构顺序是相反
+ new出来的对象，delete会直接调用析构函数
+ static对象，当程序关闭的时候，生命周期才结束，所以是最后释放

```c++
#include <iostream>
#include <string>
using namespace std;
class MM 
{
public:
	MM(string name="x") :name(name) {
		cout << name;
	}
	~MM(){
		cout << name;
	}
protected:
	string name;
};
int main() 
{
	{
		MM mm1("A");			//A
		static MM mm2("B");		//B   程序关闭时候才死亡，最后析构
		MM* p3 = new MM("C");	//C
		MM mm4[4];				//xxxx
		delete p3;				//C  delete 直接调用析构
		p3 = nullptr;
								//xxxxAB
	}
	//ABCxxxxCxxxxAB
	return 0;
}
```

## C++结构体

```c++
#include <iostream>
#include <string>
using namespace std;
struct MM 
{
	//默认为公有属性
	//类中默认属性是私有属性
//protected:
	string name;
	int age;
public:
	MM(string name) :name(name) 
	{
		cout << "构造函数" << endl;
	}
	MM(const MM& object) 
	{
		name = object.name;
		age = object.age;	
		cout << "拷贝构造" << endl;
	}
	~MM() 
	{

	}
};
int main() 
{
	//采用创建时候赋值的方式，也是调用构造函数
	//MM object = { "lisa",19 };  错误，因为没有两个参数的构造函数
	MM  object = { "lisa" };
	cout << object.name << "\t" << object.age << endl;
	//C++结构体一旦写了构造函数，就必须按照C++类的方式的去用
	MM mm(object);
	cout << mm.name << "\t" << mm.age << endl;
	return 0;
}
```

## 本节课作业

1.自己整理笔记，带观点，和代码，代码用来验证观点

2.在博客加上一个代码：(简单写个自己的myString类，实现以下string功能)

```c++
//1.实现string中创建方式
	string str1;
	string str2("ILoveyou");
	string str3(str1);
	string str4 = str2;
//2.通过实现data和c_str函数 打印字符串
	cout << str2.c_str() << endl;  //打印ILoveyou
	cout << str2.data() << endl;   //打印ILoveyou
//3.实现append 实现字符串的链接
	string strOne="one";
	string strTwo="two";
	string strThree=strOne.append(strTwo);
	cout<<strThree.data()<<endl;	    //onetwo
//4.实现字符串比较
	cout<<strOne.compare(strOne)<<endl;	//0
//5.手写析构函数释放内存
```

## 答疑时间

+ 为什么要手动写析构函数?  因为默认的不会释放数据成员动态申请的内存
+ 函数名和类型相同函数叫做构造函数
+ 函数名字是~类名的无参函数叫做析构函数
+ 以对象的引用为参数的构造函数叫做拷贝构造函数(复制构造函数)
+ 怎莫写出来，默认的构造函数，就是那种在没有传参的时候，的那一串垃圾值

```c++
class Boy
{
public:
	Boy() {}
	void print() 
	{
		cout << a << "\t" << b << "\t" << c << endl;
	}
protected:
	int a;
	int b;
	int c;
};
int main()
{

    return 0;
}
```

# C++特殊成员

## const成员

+ const数据成员
  + const类型变量是不可以修改，只读模式
  + 必须采用初始化参数列表方式进行初始化
+ const成员函数
  + 写法上, const写在函数后面
  + 常成员函数是不能够修改数据成员，只读数据成员
  + 常成员函数可以与普通函数同时存在
    + 普通函数和常成员函数相同时,普通对象优先调用普通函数
    + 普通对象可以调用常成员函数
+ const对象： const修饰的对象
  + 常对象只能调用常成员函数

```c++
#include <iostream>
#include <string>
using namespace std;
class MM 
{
public:
	MM(string name, int num) :num(num)
	{
		MM::name = name;  //可以用，也可以不用初始化列表
		//MM::num = 1001;  必须要用初始化参数列表方式初始化
	}
	void print() 
	{
		//不能修改
		//num = 1001;   错误，只读模式
		cout << name << " " << num << endl;
	}
	//常成员函数
	void print()const 
	{
		//name = "修改";   错误，常成员函数不能修改数据
		//num = 199;
		cout << "常成员函数" << endl;
	}
	void printData() 
	{
		cout << "普通函数" << endl;
	}
protected:
	string name;
	const int num;		//const数据成员
};
int main() 
{
	MM mm("对象", 18);
	mm.print();				//普通对象调用普通函数
	const MM cmm("常对象", 20);
	cmm.print();			//常对象调用常成员函数
	//cmm.printData();		//错误!,常对象只能调用普通函数
	return 0;
}
```

## static成员

static成员是不属于对象，是属于类的，意味着是所有对象共有的，调用可以不需要对象，当然你可以用对象调用

static成员依旧受权限限定。

+ static数据成员
  + 必须在类外初始化，不再需要static修饰，但是需要类名限定
  + 类中初始化是错误的，不能采用初始化参数列表方式初始化
+ static成员函数
  + static写在函数前面即可
  + 调用非静态成员 必须要指定对象
+ static对象
  + 释放是最后释放的

```c++
#include <iostream>
using namespace std;
class MM 
{
public:
	MM(string name=""):name(name) 
	{
		num++;
	}
	static void printMM();
	static void printData(MM& mm) 
	{
		cout << mm.name <<" "<<num <<endl;
	}
protected:
	string name;
public:
	static int num;
};
//类外初始化，不再需要static修饰，但是需要类名限定
int MM::num = 1;
//类外初始化，不再需要static修饰
void MM::printMM() 
{
	//调用非静态数据成员，必须要指定对象
	//cout << name << endl;  当这个函数不采用对象去调用，name没有来源
	//静态调用静态，没什么要求
	cout << num << endl;
	cout << "静态成员函数" << endl;
}
int main() 
{
	//静态数据成员访问，可以不需要对象
	cout << MM::num << endl;
	//什么叫做共有的
	MM mm("mm");
	//静态数据成员可以通过对象去访问
	cout << mm.num << endl;      //此时num等于2
	MM array[3];			     //5
	MM* p = new MM("newMM");	 //6
	cout << MM::num << endl;
	cout << p->num << endl;
	cout << mm.num << endl;
	delete p;
	p = nullptr;
	//静态成员函数
	MM::printMM();
	mm.printMM();
	MM::printData(mm);
	return 0;
}
```

## 友元

友元? friend描述的关系。友元只是提供一个场所，赋予对象具有打破类的权限定(无视权限)

+ 友元函数

  + 普通友元函数
  + 以另一个类的成员函数充当友元函数，顺序如下：
    + B 类
    + A类
    + A类的友元函数(B类的成员函数)
+ 友元类

```c++
#include <iostream>
using namespace std;
class MM 
{
	friend class GG;
public:
	MM(string name, int age) :name(name), age(age) {}
protected:
	string name;
	int age;
};
class GG 
{
public:
	void print() 
	{
		MM mm("mm", 18);
		cout << mm.name << "\t" << mm.age << endl;
	}
	void printMM(MM& mm) 
	{
		cout << mm.name << "\t" << mm.age << endl;
	}
	MM& returnMM(MM& mm) 
	{
		return mm;
	}
protected:
};
//互为友元类的写法
class A 
{
	friend class B;
public:
	void printData();
protected:
	string data="A";
};
class B 
{
public:
	friend class A;
	void printData() 
	{
		A a;
		cout << a.data << endl;
	}
protected:
	string data = "B";
};
void A::printData() 
{
	B b;
	cout << b.data << endl;
}
int main() 
{
	MM mm("mm", 18);
	GG gg;
	gg.print();
	gg.printMM(mm);
	//cout << gg.returnMM(mm).name << endl;  错误，出了友元类，没有权限

	//互为友元
	B b;
	b.printData();
	A a;
	a.printData();
	return 0;
}
```

## this指针与explicit

+ explicit修饰构造函数使用，不让隐式转换构造
+ this指针

  + 避免形参名和数据成员同名，通指对象的地址
  + 充当函数返回值，返回对象自身，用*this表示对象本身
  + 静态成员函数中是不能使用this指针

```c++
#include <iostream>
using namespace std;
class MM 
{
public:
	explicit MM(int age) :age(age) {}
	void print() 
	{
		cout << age << endl;
	}
protected:
	int age;
};
class GG 
{
public:
	GG(string name, int age) :name(name), age(age) {}
	//普通函数不存在初始化参数列表
	void initData(string name, int age)
	{
		//类名限定 帮助计算机去识别
		GG::name = name;
		this->age = age;
	}
	void print() 
	{
		cout << this->name << " " << this->age << endl;
	}
	void printThis() 
	{
		cout << this << endl;
	}
	GG& returnGG() 
	{
		return *this;
	}
	void printGG2(GG& gg) {}
	static void printStatic() 
	{
		GG gg("this", 19);
		cout << gg.name << "\t" << gg.age << endl;
	}
protected:
	string name;
	int age;
};
int main() 
{
	//explicit 不让隐式转换构造
	//MM mm = 12;
	//MM temp = 1.33;
	MM temp(12);
	temp.print();

	GG gg("长沙吴彦祖", 28);
	gg.print();

	gg.initData("顿开吴彦祖", 38);
	gg.print();

	cout << &gg << endl;
	gg.printThis();

	GG boy("哥哥吴彦祖", 38);
	cout << &boy << endl;
	boy.printThis();

	gg.returnGG().returnGG().returnGG().returnGG().returnGG().returnGG().print();
		

	GG::printStatic();
	return 0;
}
```

## 上节课作业

```c++
#include <iostream>
#include <cstring>
using namespace std;
class mystring
{
public:
	//mystring() 
	//{
	//	strSize = 1;
	//	str = new char;
	//	*str='\0';
	//};
	mystring(const char* str="") 
	{
		strSize = strlen(str) + 1;
		mystring::str = new char[strSize];
		strcpy_s(mystring::str,strSize,str);
	}
	mystring(const mystring& object)
	{
		strSize = object.strSize;
		str = new char[strSize];
		strcpy_s(str, strSize, object.str);
	}
	char* c_str() 
	{
		return str;
	}
	char* data() 
	{
		return str;
	}
	mystring append(const mystring& object)
	{
		mystring temp;
		temp.strSize = mystring::strSize + object.strSize-1;
		temp.str = new char[temp.strSize];
		memset(temp.str, 0, temp.strSize);
		strcat_s(temp.str, temp.strSize, str);
		strcat_s(temp.str, temp.strSize, object.str);
		return temp;
	}
	int compare(const mystring& object) 
	{
		return strcmp(str, object.str);
	}
	~mystring()
	{
		delete[] str;
		str = nullptr;
	}
protected:
	char* str;			//需要存储
	int  strSize;		
};
int main()
{
	{
		//1.实现string中创建方式
		mystring str1;
		mystring str2("ILoveyou");
		mystring str3(str1);
		mystring str4 = str2;
		//2.通过实现data和c_str函数 打印字符串
		cout << str2.c_str() << endl;  //打印ILoveyou
		cout << str2.data() << endl;   //打印ILoveyou
		//3.实现append 实现字符串的链接
		mystring strOne = "one";
		mystring strTwo = "two";
		mystring strThree = strOne.append(strTwo);
		cout << strThree.data() << endl;	    //onetwo
		//4.实现字符串比较
		cout << strOne.compare(strOne) << endl;	//0
	}
	//5.手写析构函数释放内存
	return 0;
}


```

## 本节课作业

自己整理笔记，带观点，和代码，代码用来验证观点

# C++运算符重载

## 什么是运算符重载

赋予运算符具有操作自定义类型数据功能

## 友元函数重载运算符

## 类成员函数重载运算符

```c++
#include <iostream>
using namespace std;
/*
	什么是运算符重载?
		赋予运算符具有操作自定义类型数据功能
	运算符重载的实质是什么? 
		运算符重载的实质本身就是函数调用
	运算符重载函数的写法
		函数返回值   函数名(函数参数)
	函数返回值 :运算完成后的值决定的				Complex
	函数名    : operator 加上重载运算符组成函数名  operator+ 
	参数      ：看运算符的操作数,具体参数个数是要看你重载函数形式是什么
	函数体    : 写运算符具体想要的操作
*/
class Complex 
{
public:
	Complex(int a=0, int b=0) :a(a), b(b) {}
	void print() 
	{
		cout << a << endl;
		cout << b << endl;
	}
	friend Complex  operator+ (Complex one, Complex two);
	//类成员函数重载，参数个数等于操作减一
	bool operator> (Complex  object) 
	{
		if (this->a > object.a) 
		{
			return true;
		}
		else if (this->a == object.a && this->b > object.b) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
protected:
	int a;
	int b;
};
//友元重载： 参数个数就是操作数据
Complex  operator+ (Complex one, Complex two) 
{
	return Complex(one.a + two.a, one.b + two.b);
}

int main() 
{
	Complex one(1, 1);
	Complex two(2, 0);
	Complex three;
	three = one + two;    //Complex  重载函数的隐式调用
	three.print();
	//显式调用
	Complex result;
	result = operator+(one, two);
	if (one > two)	//one > two  是bool
	{
		cout << "one 比较大" << endl;
	}
	//对象可以表示一个数据，所以参数应该少一个
	if (one.operator>(two)) 
	{
		cout << "one比较大" << endl;
	}
	return 0;
}
```

## 特殊运算符重载

+ 流运算符重载
  + cin类型 ： istream类的对象
  + cout类型:ostream类的对象
  + 流运算符  >>  <<
  + 必须采用友元函数形式重载

```c++
#include <iostream>
#include <string>
using namespace std;
class MM 
{
public:
	MM(string name = "", int age = 18) :name(name), age(age) {}
	friend istream&  operator>>(istream& in, MM& mm);
	friend ostream&  operator<<(ostream& out, MM& mm);
protected:
	string name;
	int age;
};
//其他运算符
//= () -> [] 只能采用类的成员函数形式重载
//流重载采用友元方式
//.  .*  ?:   :: 不能重载

istream& operator>>(istream& in, MM& mm)
{
	in >> mm.name >> mm.age;
	return in;
}
ostream&  operator<<(ostream& out, MM& mm) 
{
	out << mm.name << "\t" << mm.age << endl;
	return out;
}

int main() 
{
	string str;
	cin >> str;
	cout << str << endl;
	MM mm;
	cin >> mm;   	//void  operator>>(istream& in,MM& mm)
	cout << mm;		//void  operator<<(ostream& out,MM& mm)
	cin >> str >> mm;
	cout << str << endl << mm;
	return 0;
}
```

+ ++ --运算符重载

  解决问题:前置和后置的问题:增加无用参数  int去表示当前运算符重载是后置操作
+ 文本重载   （新标准中的，稍微落后一点开发工具不适用）
+ 其他运算符

  + = () -> [] 只能采用类的成员函数形式重载
  + 流重载采用友元方式
  + .  .*  ?:   :: 不能重载
+ 对象隐式转换

```c++
#include <iostream>
#include <string>
#include <chrono>
#include <thread>
using namespace std;
class MM 
{
public:
	MM(string name ,int age):name(name),age(age){}
	friend ostream& operator<<(ostream& out, MM& object) 
	{
		out << object.name << "\t" << object.age << endl;
		return out;
	}
	MM operator++(int)	//需要一个无用参数 充当标记
	{
		int num = age;
		age++;
		return MM(name, num);
		//上面三行等效下面一行
		//return MM(name,age++);
	}
	MM operator++()
	{
		return MM(name, ++age);
	}
	//类的对象的隐式转换  operator
	operator int() 
	{
		return age;
	}
protected:
	string name;
	int age;
};
//文本重载
unsigned long long  operator"" _h(unsigned long long num) 
{
	return 60 * 60*num;
}
unsigned long long  operator"" _min(unsigned long long num)
{
	return 60 * num;
}
int main() 
{
	MM mm("小芳", 18);
	cout << mm << endl;
	int num = 1;
	int result = num++;   //result=1  num=2
	cout << result << "\t" << num << endl;
	result = ++num;       //result=3  num=3
	cout << result << "\t" << num << endl;

	MM object = mm++;	  
	cout << object<<mm;   //age=18   mm: 19
	object = ++mm;        //age:20   mm: 20
	cout << object<<mm;
	//this_thread::sleep_for(3s);
	cout << "3s结束" << endl;

	int second = 1_h;
	cout << second << "s" << endl;

	int sum = 1_h + 18_min + 30;
	cout << sum << "s" << endl;

	MM girl("girl", 18);
	int girlAge = girl;
	cout << girlAge << endl;

	return 0;
}
```

## 重载综合案例

```C
#include <iostream>
#include <string>
#include <functional>
#include <memory>
using namespace std;
class Int
{
public:
	Int(int num) :num(num) {}
	int& data() 
	{
		return num;
	}
	string tostr() 
	{
		return to_string(num);
	}
	//算术运算符重载
	Int operator+(const Int& value) 
	{
		return Int(this->num + value.num);
	}
	//友元重载 ：操作数-1 等于重载函数的参数个数
	friend Int operator-(const Int& one, const Int& two) 
	{
		//operator-(one,two);
		return Int(one.num - two.num);
	}
	Int operator+=(const int& value) 
	{
		return Int(this->num + value);
	}
	Int operator+=(const Int& value)
	{
		return Int(this->num + value.num);
	}

	Int operator++(int) 
	{
		return Int(this->num++);
	}
	Int operator++() 
	{
		return Int(++this->num);
	}

	Int operator&(const Int& value) 
	{
		return Int(this->num & value.num);
	}
	bool operator!() 
	{
		return !this->num;
	}
	Int operator-() 
	{
		return Int(-this->num);
	}

	friend ostream& operator<<(ostream& out, const Int& object) 
	{
		out << object.num << endl;
		return out;
	}
	friend  istream& operator>>(istream& in, Int& object) 
	{
		in >> object.num;
		return in;
	}
	int* operator&() 
	{
		return &this->num;
	}
	bool operator>(const Int& object) 
	{
		return this->num > object.num;
	}

protected:
	int num;
};
void print(const int& num) 
{
	cout << num << endl;
}

//重载[]
class myvector 
{
public:
	myvector(int size) 
	{
		base = new int[size] {0};
	}
	int& operator[](int index) 
	{
		return base[index];
	}
protected:
	int *base;
};
//重载()运算符
class Function 
{
	typedef void(*PF)();
public:
	Function(PF pf) :pf(pf) {}
	void operator()() 
	{
		pf();
	}
protected:
	PF pf;
};

//->
struct MM
{
	string name;
	int age;
	MM(string name, int age) :name(name), age(age) {}
};
class Auto_ptr 
{
public:
	Auto_ptr(int* ptr) :ptr(ptr) {}
	Auto_ptr(MM* ptr) :ptrMM(ptr) {}
	int& operator*() 
	{
		return *ptr;
	}
	MM* operator->() 
	{
		return ptrMM;
	}

	~Auto_ptr() 
	{
		if (ptrMM) 
		{
			delete ptr;
			ptr = nullptr;
		}
		if (ptrMM)
		{
			delete ptrMM;
			ptrMM = nullptr;
		}
	}
protected:
	int* ptr;
	MM* ptrMM;
};
void testAuto_ptr() 
{
	//int* pInt = new int(18);
	//Auto_ptr ptr(pInt);
	//上面两行等效下面一行
	Auto_ptr ptr(new int(18));
	cout << *ptr << endl;
	Auto_ptr ptrMM(new MM("mm", 19));
	cout << ptrMM->name<< endl;
	cout << ptrMM->age << endl;
#if 0
	auto_ptr<int> autoPtr(new int(18));
	cout << *autoPtr << endl;
	auto_ptr<MM> autoPtrMM(new MM("mm", 19));
	cout << autoPtrMM->name << endl;
	cout << autoPtrMM->age << endl;
#endif
}
void print() 
{
	cout << "测试函数" << endl;
}
int max(int a, int b) 
{
	return a + b;
}
int main() 
{
	print(1);
	int a = 1;
	print(a);
	Int num(10);
	cout << num;
	cout << -num;

	myvector vec(5);
#if 0
	for (int i = 0; i < 5; i++) 
	{
		cin >> vec[i];
	}
	for (int i = 0; i < 5; i++) 
	{
		cout << vec[i];
	}
#endif
	Function p(print);
	p();
	//function<int(int,int)> pf(max);
	//cout << pf(1, 2) << endl;
	testAuto_ptr();
	return 0;
}
```

## 本节课作业

1.自己整理笔记，带观点，和代码，代码用来验证观点

2.重载实战： 封装一个Array类，实现定长数组的操作

```c++
//以下测试代码要能够成功运行
Array array(4);
for(int i=0;i<array.size();i++)
{
    cin>>array[i];
}
for(int i=0;i<array.size();i++)
{
    cout<<array[i];
}
//实现数组的连接
Array one(3);   //输入1 2 3 
cin>>one;
Array two(4);   //输入2 3 4
cin>>two;
Array  sum=one+two;
cout<<sum<<endl;  //打印1 2 3 2 3 4
Array num;
num=sum;
cout<<num<<endl;
```

# C++类的组合

+ 以另一个类的对象为数据成员

  + 构造函数的写法，必须采用初始化参数列表的写法

  ```c++
  #include <iostream>
  using namespace std;
  class Boy
  {
  public:
  	Boy(string name, int age) :name(name), age(age) {}
  	void print() 
  	{
  		cout << name << "\t" << age << endl;
  	}
  protected:
  	void printData()
  	{
  		cout << name << "\t" << age << endl;
  	}
  	string name;
  	int age;
  };
  class MM 
  {
  public:
  	MM(string boyName, int boyAge, string mmName) :boy(boyName, boyAge) 
  	{
  		this->mmName = mmName;
  	}
  	MM(string mmName) :mmName(mmName), boy("默认", 18) 
  	{}
  	void print() 
  	{
  		boy.print();
  		//boy.printData();  不可访问，boy对于Boy是类外，不可直接访问保护属性
  		cout << mmName << endl;
  	}
  protected:
  	string mmName;
  	Boy boy;
  };
  int main() 
  {

  	MM mm("boy", 18, "mm");
  	mm.print();
  	return 0;
  }
  ```

  + 类的组合构造顺序问题: 构造顺序只和定义对象顺序的有关，和初始化参数列表无参

  ```c++
  #include <iostream>
  using namespace std;
  class A 
  {
  public:
  	A(string str) :str(str) 
  	{
  		cout << str;
  	}
  	string str;
  };
  class B 
  {
  public:
  	B(string str) :str(str)
  	{
  		cout << str;
  	}
  	string str;
  };
  class C
  {
  public:
  	C(string str) :str(str)
  	{
  		cout << str;
  	}
  	string str;
  };
  class D 
  {
  public:
  	D(string stra, string strb, string strc) :b(strb), c(strc), a(stra) 
  	{
  		cout << "D" << endl;
  	}
  	A a;
  	B b;
  	C c;
  };


  int main() 
  {

  	D d("A", "B", "C");
  	return 0;
  }
  ```
+ 类中类

  + 依旧受权限限定
  + 访问方式，需要类名限定

```C
#include <iostream>
using namespace std;
struct Node 
{
	int data;
	Node* next;
	Node()
	{
		this->next = nullptr;
	}
	Node(int data) 
	{
		this->next = nullptr;
		this->data = data;
	}
};
class List 
{
public:
	List() 
	{
		headNode = new Node;
	}
	void push_front(int data) 
	{
		Node* newNode = new Node(data);
		newNode->next = headNode->next;
		headNode->next = newNode;
	}
protected:
	Node* headNode;
public:
	//迭代器-->类模仿指针行为
	class iterator 
	{
	public:
		iterator(Node* pMove=nullptr) :pMove(pMove) {}	
		void operator=(Node* pMove) 
		{
			this->pMove = pMove;
		}
		bool operator!=(Node* pMove) 
		{
			return this->pMove != pMove;
		}
		iterator operator++()
		{
			pMove = pMove->next;
			return iterator(pMove);
		}
		Node*& operator*() 
		{
			return pMove;
		}
	protected:
		Node* pMove;
	};
	Node* begin()
	{
		return headNode->next;
	}
	Node* end() 
	{
		return nullptr;
	}
};
//类中枚举类型
class  A 
{
public:
	enum time {first,second};
protected:
	enum date {mon,sur,tus};
	//类中的枚举类型受权限限定
};

int main() 
{
	List list;
	for (int i = 0; i < 3; i++) 
	{
		list.push_front(i);
	}
	List::iterator iter;
	for (iter = list.begin(); iter != list.end(); ++iter)
	{
		cout << (*iter)->data;
	}
	//cout << A::date::mon << endl; 不可访问
	cout << A::time::first << endl;
	return 0;
}
```

# C++类中默认的函数

+ 默认构造函数
+ 默认拷贝构造函数
+ 默认析构函数
+ 默认赋值运算

```c++
#include <iostream>
using namespace std;
class A 
{
public:
	A() = default;
	A(A& object) = default;
	//void print() = default;
	A& operator=(A& object) = default;
	~A() = default;
};
int main() 
{
	A a;
	A b = a;
	A c;
	c = a;
	return 0;
}
```

C++ 封装Array

```C++
//以下测试代码要能够成功运行
Array array(4);
for(int i=0;i<array.size();i++)
{
    cin>>array[i];
}
for(int i=0;i<array.size();i++)
{
    cout<<array[i];
}
//实现数组的连接
Array one(3);   //输入1 2 3 
cin>>one;
Array two(4);   //输入2 3 4
cin>>two;
Array  sum=one+two;
cout<<sum<<endl;  //打印1 2 3 2 3 4
Array num;
num=sum;
cout<<num<<endl;
```

## 答疑时间

+ 运算符重载()

```c++
#include <iostream>
#include <algorithm>
class Function 
{
public:
	void operator()()
	{
		cout << "重载括号" << endl;
	}
	bool operator()(int a, int b)  const
	{
		return a > b;
	}

protected:

};
class Compare 
{
public:
	bool operator()(int a, int b)  const
	{
		return a > b;
	}
};
int main() 
{	
	Function object;
	object.operator()();
	//让对象模仿函数的行为-->仿函数
	object();			//括号运算符的隐式调用
	cout << object(1, 2) << endl;
	object.operator()(1, 2);
	 
	int array[4] = { 1,2,3,4};
	sort(array, array + 4, Compare());
	for (int i = 0; i < 4; i++) 
	{
		cout << array[i] << "\t";
	}
	cout << endl;
	return 0;
}
```

+ 类重载不太懂

```c++
#include <iostream>
using namespace std;
class MM 
{
public:
	MM(string name="", int score=0) :name(name), score(score) {}
	friend MM operator+(MM& one, MM& two) // operator+(mm, girl)
	{
		return MM(one.name, one.score + two.score);
	}
protected:
	string name;
	int score;
};
/*
	类的成员函数重载: 重载函数参数个数=操作数-1
	友元函数重载: 参数个数=操作
*/

int main() 
{	
	MM mm("baby", 49);
	MM girl("baby", 49);
	MM lisa = mm + girl;  //隐式调用
	//显示调用-->基本的函数调用  函数名(函数参数)
	MM anni = operator+(mm, girl);
	return 0;
}
```

+ new也可以重载

​      建议不要重载，用原生态的即可。

# C++继承和派生

## 继承方式与权限问题

+ 继承的写法

```c++
//父类   基类
class parent
{
    
};
//子类   派生类
//公有继承
class son1:public parent
{
	public:
    protected:
};
//保护继承
class son2:protected parent
{
	public:
    protected:
};
//私有继承
class son3:private parent
{
	public:
    protected:
};
//继承和派生
//继承: 子类中没有产生新的属性或者行为
//派生: 派生类中有新的属性和行为产生
class 子类名:继承方式 父类名
{

    
};
//继承方式 就是权限限定词
```

+ 继承实质与权限问题
  + 继承的实质： 父类的数据和成员子类中有一份
  + 权限问题: 继承方式只会增强父类属性在子类中的权限显示

||public|protected|private|
| -------------| ---------| ---------| ------------|
|protected继承|protected|protected|不可直接访问|
|public继承|public|protected|不可直接访问|
|private继承|private|private|不可直接访问|

```c++
#include <iostream>
using namespace std;
class parent 
{
public:
	void print() 
	{
		cout << name << "\t" << money << endl;
	}
	string& getWide() 
	{
		return wife;
	}
protected:
	string name;
	int money;
private:
	string wife;
};
//子类
class son :public parent 
{
public:
	void printSon() 
	{
		print();
		cout << name << "\t" << money << endl;
		//cout << wife << endl;			父类中私有属性不能直接访问
		cout << getWide() << endl;		//间接通过父类的函数访问
	}
protected:
};
class A 
{
public:
	int a1;
protected:
	int a2;
private:
	int a3;
};
class B :public A 
{
public:
	//int a1;
protected:
	//int a2;
private:
	//int a3;  不能直接访问
};
class C :protected A
{
public:
	
protected:
	//int a1;   //public 显示protected
	//int a2;
private:
	//int a3;  不能直接访问
};

class D :private A
{
public:
	void print() 
	{
		cout << a1 << endl;
		cout << a2 << endl;
		//cout << a3 << endl;		//父类的私有属性不能直接访问
	}
protected:
	
private:
	//int a1;  
	//int a2;
	//int a3;   //父类的私有属性不能直接访问
};

//私有继承会导致当前父类 无法在孙子类有任何作用
class F :public D 
{
public:

};

int main() 
{
	son boy;
	boy.printSon();
	B b;
	b.a1 = 123;
	C c;
	//c.a1 = 12;
	return 0;
}
```

## 继承中的构造函数

+ 父类的属性通过父类的构造函数初始化
+ 子类中的构造函数，必须要调用父类构造函数，必须采用初始化参数列表的方式
+ 单继承和多继承

  + 单继承: 只有一个父类
  + 多继承: 两个或者两个以上的父类
+ 继承的属性，无论被继承多少次，所以类一般不会被继承很多层，会导致类的臃肿

```C++
#include <iostream>
#include <string>
using namespace std;
class Parent 
{
public:
	Parent() { cout << "父类无参构造函数" << endl; }
	Parent(string FName, string SName):FName(FName), SName(SName){}
protected:
	string FName;
	string SName;
};
//单继承
class Son :public Parent
{
public:
	//这种写法，父类必须存在无参的构造函数，当然缺省也可以
	Son() { cout << "子类无参构造函数" << endl; }    
	Son(string FName, string SName, string sonSName) :Parent(FName,SName)
	{
		//自己的属性用什么办法初始化都行
		this->sonFName = FName;
		this->sonSName = sonSName;
	}
	void print() 
	{
		cout << "父:" << FName + SName << endl;
		cout << "子:" << sonFName + sonSName << endl;
	}
protected:
	string sonFName;
	string sonSName;
	//string FName;
	//string SName;
};

//多继承
//欧田
//阳子
//欧阳 田子
class MM
{
public:
	//MM() = default;
	MM(string mmFName, string mmSName) 
	{
		this->mmFName = mmFName;
		this->mmSName = mmSName;
	}
protected:
	string mmFName;
	string mmSName;
};
class GG 
{
public:
	//GG() = default;
	GG(string ggFName, string ggSName)
	{
		this->ggFName = ggFName;
		this->ggSName = ggSName;
	}

protected:
	string ggFName;
	string ggSName;
};
class Girl :public GG,public MM
{
public:
	//子类想要这种构造函数，每个父类都要有一个无参的构造函数
	//Girl() {}
	Girl(string mmFName, string mmSName, string ggFName, string ggSName) 
		:MM(mmFName,mmSName),GG(ggFName,ggSName)
	{
		girlFName = ggFName + mmFName;
		girlSName = ggSName + mmSName;
	}
	void print() 
	{
		cout << "父:" << ggFName + ggSName << endl;
		cout << "母:" << mmFName + mmSName << endl;
		cout << "女:" << girlFName + girlSName << endl;
	}
protected:
	string girlFName;
	string girlSName;
};
//继承的属性一致都存在
class A 
{
public:
	A(int a) :a(a) {}
	int a;
};

class B:public A
{
public:
	B(int a,int b) :A(a),b(b) {}
	int b;
};
class C :public B
{
public:
	C(int a, int b,int c) :B(a,b),c(c) {}
	int c;
};

class D :public C
{
public:
	D(int a, int b, int c,int d) :C(a,b,c), d(d) {}
	int d;
};

int main() 
{
	Son son;				//子类构造对象，优先调用父类构造函数
	Son son1("白", "老鬼", "日天");
	son1.print();
	Girl girl("阳", "子", "欧", "田");
	girl.print();
	return 0;
}
```

## 继承中同名问题

+ 数据成员同名
+ 成员函数名同名
+ 正常赋值调用
+ 非正常赋值调用

```c++
#include <iostream>
using namespace std;
class MM
{
public:
	MM(string name, int age) :name(name), age(age) {}
	void print() 
	{
		cout << "MM:";
		cout << name << "\t" << age << endl;
	}
protected:
	string name;
	int age;
};
class Girl :public MM 
{
public:
	Girl(string name, int age) :MM("父类", 28), name(name), age(age) {}
	void print() 
	{
		//不做特别处理，就近原则
		cout << name<<"\t" << age << endl;
		//类名限定
		cout << MM::name << "\t" << MM::age << endl;
		//不做特别处理，就近原则
		MM::print();
	}
protected:
	string name;
	int age;
};

//虚继承 --->菱形继承
class A
{
public:
	A(int a) :a(a) {}
protected:
	int a;
};
class B :virtual public A
{
public:
	B(int a, int b) :A(a), b(b) {}
protected:
	int b;
};
class C :virtual public A
{
public:
	C(int a, int c) :A(a),c(c) {}
	void printC() 
	{
		cout << a << endl;
	}
protected:
	int c;
};
class D :public C, public B 
{
public:
	//菱形继承，必须调用祖父的构造函数
	D() :B(1, 2), C(3, 4) ,A(999)
	{

	}
	void print() 
	{
		//只有一个a 只有一份
		cout << a << endl;
		cout << B::a << endl;
		cout << C::a << endl;
		printC();
	}
protected:

};
int main() 
{


	//不做特别处理，就近原则
	//正常对象调用
	Girl  girl("girl", 18);
	girl.print();
	MM mm("mm", 28);
	mm.print();

	//正常的指针调用
	//就近原则
	Girl* pG = new Girl("newGirl", 19);
	pG->print();
	pG->MM::print();
	MM* pM = new MM("newMM", 29);
	pM->print();

	//非正常的指针
	//1.允许子类对象初始化父类指针
	MM* pMM = new Girl("newGirl", 49);
	pMM->print();		//父类的
	//在没有virtual情况下，看指针类型
	//在有virtual情况，看赋值对象
	//2.父类对象初始化子类指针，不安全
	//Girl* pGirl = new MM("newMM", 29); 错误
	//Girl* pGirl = (Girl*)pM;
	//pGirl->print();  引发

	D d;
	d.print();

	 0;
}
```

## 构造顺序问题

+ 单继承中的构造顺序问题
  + 先构造父类的在构造子类的，析构顺序相反
+ 多继承中构造顺序问题
  + 任何构造顺序问题都和初始化参数列表无关
  + 构造顺序和继承顺序一致
+ 多继承中构造顺序问题

```c++
#include <iostream>
using namespace std;
class A 
{
public:
	A() { cout << "A"; }
	~A() { cout << "A" ; }
protected:
};
class B :public A 
{
public:
	B() { cout << "B"; }
	~B() { cout << "B" ; }
};

class C 
{
public:
	C() { cout << "C"; }
	~C() { cout << "C"; }
};
class D
{
public:
	D() { cout << "D"; }
	~D() {cout << "D";}
};
//构造顺序和继承顺序一致
class F :public C, public A, public D
{
public:
	//任何构造顺序问题，都和初始化参数列表无关
	F() { cout << "F";}
	~F() { cout << "F";}
};
//CADF FDAC
int main() 
{
	{

		B b;   //ABBA 
	}
	cout << endl;
	F f;
	return 0;
}
```

## 本节课作业

1.自己整理笔记，带观点，和代码，代码用来验证观点

2.设计一个类父类 Shape类  设计多个子类：Rect类 Circle类   分别求出并打印相应形状的周长和面积

3.设计类老师类，设计一个学生类，多继承产生一个研究生类，打印相关研究生的信息

## 答疑时间

+ 子类对象初始化父类指针还有点不清楚

  没有什么太多说法，C++允许这样做，你只需要知道会调用谁的方法即可
+ 虚继承

  满足菱形关系，才会有虚继承，只适用于菱形继承
+ 欧阳田子的MMGG类在子类中的初始化
+ 正常情况 同名问题处理
+ 类中就近原则
+ 在没有virtual情况下 ，类外看类型，有virtual看赋值对象

# C++虚函数和多态

## 虚函数和虚函数表

+ 什么是虚函数?  用virtual 修饰的成员函数叫做虚函数
+ 虚函数对于类的影响
  + 增加一个指针的内存，32位4个字节 ，64位就是8个字节
+ 虚函数表(了解一下): 就是一个指针存储所有虚函数的首地址

```c++
#include <iostream>
using namespace std;
class MM
{
public:
	virtual void print1() 
	{
		cout << "虚函数1"<< endl;
	}
	virtual void print2()
	{
		cout << "虚函数2" << endl;
	}
	virtual void print3();

protected:
};
void MM::print3() 
{
	cout << "虚函数3" << endl;
}

class A 
{
	int age;
};
void testVirtual()
{
	//C语言不允许存在空的结构体
	cout << sizeof(MM) << endl;		//空的类或者而结构体 占用1字节
	cout << sizeof(A) << endl;
	MM mm;
	//虚函数表 
	int** vptr = (int **)&mm;
	typedef void(*PF)();
	PF func = (PF)vptr[0][0];
	func();		//调用第一个虚函数
	func = (PF)vptr[0][1];
	func();		//调用第二个虚函数
}
int main() 
{
	testVirtual();
	return 0;
}
```

## 虚函数和多态

+ 多态定义: 同一种行为(调用)导致的不同的结果
+ 多态的必要性原则
  + 必须父类存在虚函数
  + 子类必须采用public继承
  + 必须存在指针的引用(使用)

```c++
#include <iostream>
using namespace std;
class Man 
{
public:
	void WC1() 
	{
		cout << "男人上厕所" << endl;
	}
	virtual void WC2()   //父类必须要有virtual
	{
		cout << "龌龊男人上厕所" << endl;
	}
protected:
};
class Woman:public Man
{
public:
	void WC1()
	{
		cout << "女人上厕所" << endl;
	}
	void WC2()
	{
		cout << "女人上厕所" << endl;
	}
protected:

};
void testVirtual() 
{
	//正常访问不存在多态
	cout << "正常访问，就近原则" << endl;
	Man  man;
	man.WC1();
	man.WC2();
	Woman woman;
	woman.WC1();
	woman.WC2();
	cout << "指针访问,正常赋值" << endl;
	Man* pm = new Man;
	pm->WC1();
	pm->WC2();
	Woman* pw = new Woman;
	pw->WC1();
	pw->WC2();
	cout << "指针非正常赋值:子类对象初始化父类指针" << endl;
	Man* parent = new Woman;
	//有virtual看对象类型，没有virutal看指针
	parent->WC1();			//不是虚函数
	parent->WC2();			//是虚函数
	parent = new Man;
	parent->WC2();
}


//统一接口功能呢
void printInfo(Man* parent) 
{
	parent->WC2();
}

class Shape 
{
public:
	virtual void Draw() 
	{
		cout << "绘制过程" << endl;
	}
protected:
};
class Rect :public Shape 
{
public:
	void Draw()
	{
		cout << "画矩形" << endl;
	}
protected:

};
class Circle :public Shape 
{
public:
	void Draw()
	{
		cout << "画圆" << endl;
	}
protected:

};
class Triangle :public Shape
{
public:
	void Draw()
	{
		cout << "绘制三角形" << endl;
	}
};
class Ellipse :public Shape 
{
public:
	void Draw()
	{
		cout << "绘制椭圆" << endl;
	}
};
//降低因为变化而要修改代码
//采用增加代码方式满足新需求
//统一接口
class Tool 
{
public:
	void draw(Shape* parent) 
	{
		parent->Draw();
	}
};
int main() 
{
	testVirtual();
	printInfo(new Woman);
	Tool* pTool = new Tool;
	pTool->draw(new Circle);
	pTool->draw(new Rect);
	pTool->draw(new Triangle);
	pTool->draw(new Ellipse);
	return 0;
}
```

## 纯虚函数和ADT

+ 纯虚函数也是虚函数只是纯虚函数是没有函数体的

  ```c++
  virutal void print()=0;     //在类中函数 这样写法
  ```
+ 抽象类： 具有至少一个纯虚函数的类，叫做抽象类

  + 抽象类不能构建对象
  + 抽象类可以构建对象指针
+ 纯虚函数没有被重写，无论被继承多少次 都是纯虚函数，虚函数无论被继承多少次都是虚函数

```c++
#include <iostream>
using namespace std;
//抽象类
class Parent 
{
public:
	virtual void print()= 0;		//纯虚函数
protected:
};
void testAbstract() 
{
	//Parent object;  不能构建对象
	Parent* parent = nullptr;
}

//纯虚函数就是做ADT(abstract data type 抽象数据类型)过程
//stack  栈
class stack 
{
public:
	//父类中所有的操作描述好
	virtual void push(int data) = 0;
	virtual void pop() = 0;
	virtual int top() const = 0;
	virtual bool empty() const = 0;
	virtual int size() const = 0;
};
//子类想要创建对象，必须重写父类的纯虚函数
//ADT: 具有强迫性,所有子类重写函数必须和父类的一模一样
class arrayStack :public stack 
{
public:
	void push(int data) 
	{
		
	}
	void pop() 
	{

	}
	int top() const 
	{
		return  1;
	}
	bool empty() const 
	{
		return true;
	}
	int size() const 
	{
		return 1;
	}
	//可以增加别的函数
	//可以增加别的成员
protected:
	int* array;
};
struct Node 
{
	int data;
	Node* next;
};
class listStack :public stack 
{
public:
	void push(int data)
	{

	}
	void pop()
	{

	}
	int top() const
	{
		return  1;
	}
	bool empty() const
	{
		return true;
	}
	int size() const
	{
		return 1;
	}
protected:
	Node* headNode;
};
void testStack(stack* pStack)
{
	pStack->push(1);
	while (!pStack->empty()) 
	{
		cout << pStack->top();
		pStack->pop();
	}
}

class A 
{
public:
	virtual void print() = 0;
protected:
};
class B :public A 
{
public:
	void print() 
	{
		cout << "B" << endl;
	}
};
class C :public B 
{
public:
	void print() 
	{
		cout << "C" << endl;
	}
};
void Abtract() 
{
	//B b;
	C c;  //一般抽象类只被继承一次就重写
	B* pc = new C;
	pc->print();
}
int main() 
{
	testStack(new arrayStack);
	testStack(new listStack);
	Abtract();
	return 0;
}
```

## 虚析构函数

```c++
#include <iostream>
using namespace std;
class parent 
{
public:
	//虚析构函数,不存在虚构造函数
	virtual ~parent() 
	{
		cout << "父类析构" << endl;
	}
	void print() {}
protected:
};
class son :public parent 
{
public:
	void print() 
	{

	}
	~son() 
	{
		cout << "子类析构" << endl;
	}
};
int main()
{
	//在用子类对象初始化父类指针，父类需要虚析构函数做内存释放
	parent* p = new son;
	p->print();
	delete p;
	return 0;
}
```

## C++类型转换

C++类型转换，专人做专事，传闻中C++中的更为安全。

+ const_cast
+ static_cast
+ dynamic_cast
+ reinterpret_cast

## 本节课作业

1.自己整理笔记，带观点，和代码，代码用来验证观点

# C++IO流

流: 若干字节数据从一端到另一端我们叫做流

流类体系

+ 流对象
+ 流运算符 >>  <<

## 输出输出流

+ ostream类

  + cout
  + cerr
  + clog
  + cin
  + 字符类的处理

    + 正常的操作
    + 调用成员函数的方式
  + 格式控制字符

    + 包含头文件 iomanip
    + 常用的格式控制，一种是调用成员函数方式，一种流控制字符去做

      + 设置有效位数: setprecision(n)
      + 设置精度: fixed结合setprecision使用
+ istream 类 cin

```c++
#include <iostream>
#include <cstdio>
#include <iomanip>
using namespace std;
void testostream()     //output 
{
	//freopen()
	cout << "标准输出" << endl;		 //重定向
	cerr << "标准错误输出" << endl;	 //不能重定向
	clog << "标准错误输出" << endl;   //重定向为文件
	//字符类的处理
	cout.put('a');
	cout << 'a' << endl;
	char c = 'C';
	cout.put(c);
	cout << c << endl;
	cout.write("ILoveyou",4);  //指定长度，超过长度不做输出
	//输入
	//c=cin.get();
	cout.put(cin.get());
	//字符串
	while (cin.get() != '\n');
	//while(getchar()!='\n');
	char str[20]="";
	cin.getline(str, 20);
	cout.write(str,20);
}
void testiomanip() 
{
	//格式控制  
	//设置格式
	double pi = 34.12343;
	cout << "设置有效位数是:" << setprecision(4) << pi << endl;
	cout << "有效小数位:" << fixed << setprecision(4) << pi << endl;
	//cout.precision(4); 所有的流控制符都会对应一个成员函数的方式
	//进制输出
	cout << hex << 32 << endl;  //十六进制
	cout << oct << 15 << endl;  //8进制输出
	cout << setbase(10) << 15 << endl; //8-16
	//默认右对齐
	//cout.with(8);
	//cout << resetiosflags << endl;
	cout << setiosflags(ios::left);	//ios::right
	cout << setw(8) << "123" << setw(8) << "12344" << setw(8) << "3444" << endl;
	cout << setw(8) << "123" << setw(8) << "12344" << setw(8) << "3444" << endl;
}
void freopeniostream() 
{
	freopen("1.txt", "r", stdin);
	int a, b;
	scanf("%d%d", &a, &b);   //输入由文件完成
	//1 2 回车
	freopen("2.txt", "w", stdout);
	printf("%d", a + b);
}
int main() 
{
	//testostream();
	testiomanip();
	return 0;
}
```

## 字符流

+ 用的头文件是:sstream类

  + istringstream类
  + ostringstream类
  + 一般用时stringstream类对象即可
+ 获取字符流对象中的数据

  + string  str()  //获取string
  + void str(const string& str); 重新设置字符流对象的数据
+ 一般字符流对象做字符串处理

  + 字符串分割
  + 字符串转换问题

```c++
#include <iostream>
#include <sstream>
#include <cstdio>
using namespace std;
//23,132,3443,54,54,65
void teststringstream()
{
	//构建字符流对象 ，以及获取字符流对象中数据
	stringstream sso(string("ILoveyou"));
	cout << sso.str() << endl;
	stringstream ssnull;
	ssnull << "我爱你!";
	cout << ssnull.str() << endl;
	//错误
	//stringstream ss = string("IMissyou");
	string  data;
	ssnull >> data;
	cout << data << endl;
	ssnull.str("ILoveyou");
	//ssnull.clear();  
	cout << ssnull.str() << endl;
	//字符串与数字之间转换
	int num = 1234;
	char input[20] = "";
	stringstream transs(input);
	transs << num;
	transs >> input;
	cout << input << endl;
	stringstream snum("12345");
	int temp = 0;
	snum >> temp;
	cout << temp << endl;
	//分割
	stringstream sData("23,132,3443,54,54,65");
	int numData[6];
	char cData[5];
	for (int i = 0; i < 6; i++) 
	{
		if (i == 5)
			sData >> numData[i];
		else
			sData >> numData[i] >> cData[i];
	}
	for (int i = 0; i < 6; i++) 
	{
		cout << numData[i] << " ";
	}
	cout << endl;
	//多次同一个流做数据转换操作，一定做clear操作
	transs.clear();
	transs << num;
	transs >> input;
	cout << input << endl;
}
int main() 
{
	teststringstream();
	//char str[20] = "";
	//int num;
	//scanf_s("%d%s", &num, str,20);
	//cout << num << " " << str << endl;
	return 0;
}

```

## 文件流

+ 流类体系

  + ofstream 类  写操作   output输出到文件
  + ifstream 类   读操作
  + fstream类  可读可写  用的时候包含头文件  #include 
    <fstream>
+ 打开关闭文件

  + 打开文件: void open(const char* URL,ios::openmode mode);

    + 读写方法是

      + ios::in  读的方式打开文件
      + ios::out  写方式打开文件  具有创建功能
      + ios::app  追加模式 具有创建功能呢
      + ios::ate 追加模式，文件指针指向末尾
      + ios::trunc  具备创建功能
      + ios::nocreate  不具备创建
      + ios::noreplace 不替换  (想想C语言 w方式)
      + ios::binary 二进制的形式
    + 读写的组合方式用的是 |

      + 可读可写可创建: ios::in|ios::out|ios::trunc
      + 二进制的可读可写课创建： ios::in|ios::out|ios::trunc|ios::binary
    + 判断打开文件是否成功

      + 用文件流对象重载的运算!
      + is_open成员函数判断
        + 返回true 打开成功
        + 返回false打开失败
  + 关闭文件: void close()
+ 读写文件

  + 流的方式读写
  + 二进制的方式读写
  + 把string写到文件
    + 需要先转换为char*  再写进去
+ 文件指针定位

  + ifstream类的对象

    + istream& seekg(long int pos);
    + istream& seekg(long int pos,ios_base::seekdir position);
  + ofstream类的对象

    + ostream& seekp(long int pos);
    + ostream& seekp(long int pos,ios_base::seekdir position);
  + ios_base::seekdir

    + ios::beg   文件开始位置   //SEEK_SET
    + ios::end   文件结束位置
    + ios::cur  文件当前位置

```c++
#include <iostream>
#include <fstream>
#include <cstring>
using namespace std;
void testOpenFile() 
{
	fstream file;
	file.open("2.txt", ios::out);
	if (!file.is_open())
	{
		cerr << "文件打开失败" << endl;
		return;
	}
	if (!file) 
	{
		cout << "文件打开失败" << endl;
		return;
	}
	file.close();
}
void asciiRWFile(const char* readFileName, const char* writeFileName) 
{
	fstream read(readFileName, ios::in);
	fstream write(writeFileName, ios::out);
	//成员函数 eof() 再文件末尾
	//1.流的方式读写
	//1.1 流运算符读写  空格和换行会被忽略
	//while (1) 
	//{
	//	char key;
	//	read >> key;
	//	if (read.eof())
	//	{
	//		break;
	//	}
	//	write << key;
	//}
	//1.2 成员函数
	//while (1) 
	//{
	//	char key;
	//	read.get(key);
	//	if (read.eof())
	//		break;
	//	write.put(key);
	//}
	while (!read.eof())
	{
		char str[1024] = "";
		read.getline(str, 1024);
		write.fstream::write(str, strlen(str));
		write.put('\n');
	}
	read.close();
	write.close();
}
void binaryRWFile(const char* readFileName, const char* writeFileName)
{
	fstream readFile(readFileName, ios::in | ios::binary);
	fstream writeFile(writeFileName, ios::out | ios::binary);
	while (!readFile.eof())
	{
		char str[1024] = "";
		readFile.read(str, 1024);
		writeFile.write(str, 1024);
	}
	readFile.close();
	writeFile.close();
}
void testSeekRead(const char* fileName) 
{
	fstream fread(fileName, ios::in);
	if (!fread) 
	{
		cout << "打开文件失败!" << endl;
	}
	char key = fread.get();
	cout << key;
	fread.seekg(4,ios::beg);
	key = fread.get();
	cout << key;
	fread.seekg(-4, ios::end);
	key = fread.get();
	cout << key << endl;
	fread.close();
}
int main() 
{
	//testOpenFile();
	//asciiRWFile("read.txt","write.txt");
	//binaryRWFile("br.txt", "bw.txt");
	testSeekRead("test.txt");
	return 0;
}
```

## 本节课作业

1.自己整理笔记，带观点，和代码，代码用来验证观点 第一篇博客

2.C++类封装的形式写一个链式管理管理系统，带文件操作的，第二篇博客

# C++异常处理

## 基本的异常处理

+ 异常处理机制：暂缓问题处理，不在当前函数中处理，在他调用者中处理
+ 什么是异常，任何东西都可以认为是异常，错误只是异常的一种
+ 异常一旦被抛出，不做处理，如果引发异常，会调用默认abort终止程序
+ 捕获和处理异常
  + throw 抛出异常，(可以理解为返回值，值是任何类型都可以，使我们处理异常一个参照)
  + try(检查，捕获)和catch(处理异常)

```c++
//try 与catch必须是一起出现，并且他们{}不能省略
try
{
	//正常需要检查是否存在异常代码   
}
catch(类型)     //理解为switch中case语句
{
    //处理是根据抛出数据类型决定如何处理
}
//一个try可以对应多个catch
try
{
	//...    
}
catch(int)
{
	    
}
catch(double)
{
    
}
catch(string)
{
	    
}
//catch和if else_if 执行机制是一样的，只能执行一个匹配项
//删减符 ...  任何类型异常都捕获
//catch(...)

```

+ 不存在异常的描述
  + throw ()
  + noexcept

```c++
void  print() throw() 
{
	cout << "当前函数不存在抛出异常操作" << endl;
}
void printData() noexcept 
{
	cout << "新的描述：不存在抛出异常" << endl;
	//throw 0;  编译不过，一旦说明没有异常操作，就不能抛出
}
```

## 异常处理中的传参

+ catch(int a)   //隐藏一个传参操作
+ 想要处理抛出字符串的异常处理，注意一下string类型与const char*  类型的区别
+ 也可以抛出自己类的对象

```c++
#include <iostream>
#include <string>
using namespace std;
class Error 
{
public:
	Error(const char* str = "未知错误") :str(str) {}
	const char* what()const 
	{
		return str.c_str();
	}
protected:
	string str;
};
int divisor(int a, int b) 
{
	if (b == 0)
		throw "除数不能为0";
	if(b==1)
		throw "除数不能为1";
	if(b==2)
		throw string("除数不能为2");
	return a / b;
}
void insertArray(int array[], int* curNum, int posData,int maxLength) 
{
	if (*curNum >= maxLength)  //3>=3
	{
		throw  Error("数组下标溢出！");
	}
	//0 1 2
	array[*curNum] = posData;  //array[3]=3
	(*curNum)++;
}

int main()
{
	try
	{
		divisor(1, 0);
	}
	catch (const char* str)  //str=	"除数不能为零";
	{
		cout << str << endl;
	}
	try
	{
		divisor(1, 2);
	}
	catch (string str)
	{
		cout << str << endl;
	}
	try
	{
		int array[3] = { 0,0,0 };
		int curNum = 0;
		for (int i = 0; i < 4; i++) 
		{
			insertArray(array, &curNum, i, 3);
		}
	}
	catch (Error str) 
	{
		cout << str.what() << endl;
	}

	return 0;
}
```

## 自定义异常类

+ 写一个类描述异常
+ 继承标准库中的类描述异常

```c++
#include <iostream>
#include <string>
using namespace std;
//自己写的异常描述类
class Error
{
public:
	Error(const char* str = "未知错误") :str(str) {}
	const char* what()const
	{
		return str.c_str();
	}
protected:
	string str;
};
void insertArray(int array[], int* curNum, int posData, int maxLength)
{
	if (*curNum >= maxLength)  //3>=3
	{
		throw  Error("数组下标溢出！");
	}
	//0 1 2
	array[*curNum] = posData;  //array[3]=3
	(*curNum)++;
}
void testOne() 
{
	try
	{
		int array[3] = { 0,0,0 };
		int curNum = 0;
		for (int i = 0; i < 4; i++)
		{
			insertArray(array, &curNum, i, 3);
		}
	}
	catch (Error str)
	{
		cout << str.what() << endl;
	}
}

//继承标准库中的异常类
//通过重写what方法

class myException :public exception 
{
public:
	myException(string str) :exception(str.c_str()) {}
};
void insertArray(int a) 
{
	if (a >= 4)
		throw myException("数组满了!");
	cout << "插入成功" << endl;
}
void deleteArray(int a)
{
	if (a <= 0)
		throw myException("数组为空，无法删除");
	cout << "删除成功" << endl;
}
void testTwo() 
{
	try
	{
		insertArray(1);
		insertArray(4);
	}
	catch (myException& object)
	{
		cout << object.what() << endl;
	}
	try
	{
		deleteArray(1);
		deleteArray(0);
	}
	catch (myException& object)
	{
		cout << object.what() << endl;
	}
}

int main() 
{
	testOne();
	testTwo();
	return 0;
}
```

## 标注库中的异常

```C++
#include <exception>
#include <iostream>
using namespace std;
class Exception 
{
public:
	Exception(const char* ptr="UNKNOW") :ptr(const_cast<char*>(ptr)){}
	virtual const char* what() const
	{
		return ptr;
	}
protected:
	char* ptr;
};
class Bad_alloc :public Exception
{
public:
	Bad_alloc(const char* _Message = "bad exception") :Exception(_Message) {}
protected:
};
class Run_time :public Exception
{
public:
	Run_time(const char* _Message = "run_time error") :Exception(_Message) {}
protected:
};
int main() 
{
	try 
	{
		while (1) 
		{
			int* p = new int[1024*1024*10];
		}
	}
	catch (bad_alloc& object) 
	{
		cout << object.what() << endl;
	}
	return 0;
}
```

## 上节课管理系统的作业

详细见代码

## 本节课作业

自己整理笔记，带观点，和代码，代码用来验证观点 第一篇博客

# C++模板

## 函数模板

+ 什么是模板 ： 把类型当做未知量，可以忽略类型影响
+ 声明模板的语法

```c++
//单个未知类型
template <typename _Ty>	   //_Ty 随便改 ，就是类型代号
_Ty Max(_Ty a, _Ty b)
{
	return a > b ? a : b;
}
//可以多个未知类型
template <typename _Ty1,typename _Ty2 >
void print(_Ty1 one,_Ty2 two)
{
	cout<<one<<endl;
    cout<<two<<endl;
}
//typename 可以换成class
template  <class T>
void print(T a)
{
	cout<<a<<endl;    
}
```

+ 调用函数模板

  + 隐式调用  : 正常的函数传参即可调用
  + 显示调用:  函数名<类型名>(参数)
+ 函数模板的两种形态

  + 普通函数当做函数模板
  + 类的成员函数是函数模板
+ 函数模板特殊的写法

  + 缺省写法
  + 存在常量类型

```c++
#include <iostream>
using namespace std;
//int Max(int a, int b) 
//{
//	return a > b ? a : b;
//}
//string Max(string a, string b) 
//{
//	return a > b ? a : b;
//}
//引入模板这个东西
template <typename _Ty>		//告诉编译器 下面代码用到一个位置类型叫做_Ty
_Ty Max(_Ty a, _Ty b)
{
	return a > b ? a : b;
}
//_Ty= string  a="abc" b="abc"

//普通函数
template <class _Ty1, class _Ty2>
void print(_Ty1 one,_Ty2 two) 
{
	cout << one << endl;
	cout << two << endl;
}

class MM 
{
public:
	template <class _Ty>
	void print(_Ty data) 
	{
		cout << data << endl;
	}
	template <class _Ty>
	void printData(_Ty data);
protected:
	string name;
	int age;
};
//在类外实现不能省略template这一块
template <class _Ty>
void MM::printData(_Ty data) 
{
	cout << data << endl;
}

//缺省写法
template <class _Ty1, class _Ty2 = int>
void printData(_Ty1 one, _Ty2 two) 
{
	cout << one<<"\t" << two << endl;
}
//存在传常量写法
//size_t: unsigned int 的别名
template <class _Ty1 ,size_t size=3>
void printArray(_Ty1 array)		//_Ty1=int *  ,size=3
{
	for (int i = 0; i < size; i++) 
	{
		cout << array[i];
	}
	cout << endl;
}

void testFunc() 
{
	printData("string", 1234);
	//函数模板的缺省，显示调用，可以不用传类型，但是参数不能少
	printData<string>("ILoveyou", 12344);
	int array[3] = { 1,2,3 };
	//没有做缺省必须显示调用
	printArray<int*,3>(array);
	//做了缺省可以隐式调用
	printArray(array);
	//不能传入变量，只能传入常量，函数模板如果存在变量的情况下
	//int size = 3;
	//printArray<int*, size>(array);
}

int main() 
{
	//隐式调用
	cout << Max(1, 2) << endl;
	cout << Max("string", "string1") << endl;
	cout << Max(1.1, 2.3) << endl;
	//显示调用
	cout << Max<string>("abc", "abd") << endl;
	print<string, string>("string1", "string2");
	print<string, int>("string1", 1234);
	//类中的成员函数是函数模板
	MM mm;
	mm.print(123);
	mm.print<string>("ILoveyou");
	mm.printData(12344);
	//模板函数可不可以缺省


	return 0;
}
```

## 类模板

+ 生成一个类模板

```c++
template<class _Ty>
class MM
{
	public:
    protected:
}
//只要被template修饰就是一个模板类，用没用未知类型没关系 
```

+ 类模板调用

  + 必须采用显式调用
  + 类模板不是一个实际类型，所以所有用到类名的地方都需要使用: 类名<未知类型> 方式使用
+ 多文件中，类模板 中的声明和实现一定在一起的，不能分开写。

````c++
#include <iostream>
using namespace std;

template <class _Ty>
class MM 
{
public:
	MM() {}
	MM(string name):name(name) {}
	void print();
protected:
	string name;
};
//在类实现
template <class _Ty>
void MM<_Ty>::print() 
{
	cout << "类模板" << endl;
}
template<class _Ty>
class Girl :public MM<_Ty> 
{
public:
	Girl(string name) :MM<_Ty>(name) 
	{

	}
protected:

};

class Boy 
{
public:

};

template <class _Ty1, class _Ty2>
class Data 
{
public:
	Data(_Ty1 one, _Ty2 two) :one(one), two(two) {}
	void print();
protected:
	_Ty1 one;
	_Ty2 two;
};
template <class _Ty1, class _Ty2>
void Data<_Ty1, _Ty2>::print() 
{
	cout << one << endl;
	cout << two << endl;
}
int main() 
{
	//必须采用显式调用
	MM<int> mm1;
	MM<string> mm2;
	MM<double> mm3;
	//MM mm;  错误的
	Girl<int> girl("Loveyuou");
	girl.print();

	Boy boy;

	Data<string, int> mmInfo("小芳", 19);
	mmInfo.print();
	Data<int, int> data(12, 11);
	data.print();
	return 0;
}
````

## 自定义类型当做模板参数

+ 基本自定义类型
+ 自定义类型也是一个模板
+ 模板传入自定义类型，关键点就在于重载运算符

```c++
#include <iostream>
using namespace std;

class MM
{
public:
	MM(string name, int age) :name(name), age(age) {}
	friend ostream& operator<<(ostream& out, const MM& mm)
	{
		out << mm.name << " " << mm.age;
		return out;
	}
	bool operator>(MM& mm) const 
	{
		return this->age > mm.age;
	}
protected:
	string name;
	int age;
};
template <class _Ty>
void print(_Ty one) 
{
	//error C2679: 二进制“<<”: 没有找到接受“_Ty”类型的右操作数的运算符(或没有可接受的转换)
	cout << one << endl;
}
template <class _Ty>
_Ty Max(_Ty a, _Ty b) 
{
	//rror C2676: 二进制“>”:“_Ty”不定义该运算符或到预定义运算符可接收的类型的转换
	return a > b ? a : b;
}

template <class _Ty>
class Node
{
public:
	Node(_Ty data, Node<_Ty>* next) :data(data), next(next) {}
	_Ty getData() 
	{
		return data;
	}
	Node<_Ty>* getNext()
	{
		return next;
	}
protected:
	_Ty data;
	Node<_Ty>* next;
	//正常写法:Node* next;
};
template <class _Ty>
class List 
{
public:
	List() 
	{
		headNode = nullptr;
	}
	void insertList(_Ty data) 
	{
		headNode = new Node<_Ty>(data, headNode);
	}
	void printList()
	{
		Node<_Ty>* pmove = headNode;
		while (pmove != nullptr) 
		{
			//error C2679: 二进制“<<”: 没有找到接受“_Ty”类型的右操作数的运算符(或没有可接受的转换)
			cout << pmove->getData() << endl;
			pmove = pmove->getNext();
		}
		cout << endl;
	}
protected:
	Node<_Ty>* headNode;
};
void testList() 
{
	List<int> list;
	list.insertList(1);
	list.insertList(2);
	list.insertList(3);
	list.printList();
	List<MM> mmList;
	mmList.insertList(MM("小芳", 18));
	mmList.insertList(MM("小丽", 28));
	mmList.insertList(MM("小美", 38));
	mmList.printList();
}

int main() 
{
	//函数模板传入自定义类型
	print(12);
	print<string>("string");
	print(MM("mm", 19));

	MM xiaoF("小芳", 18);
	MM xiaoL("小丽", 28);
	MM result = Max<MM>(xiaoF, xiaoL);
	//MM result = Max(xiaoF, xiaoL);  函数模板可以隐式调用
	cout << result << endl;
	testList();


	return 0;
}
```

## 模板嵌套

+ 明白类型是什么即可，适当可以借用using语法起别名 简化代码

```c++
#include <iostream>
using namespace std;
template <class _Ty1,class _Ty2>
class MM 
{
public:
	MM(_Ty1 one, _Ty2 two) :one(one), two(two) {}
	friend ostream& operator<<(ostream& out, const MM& mm) 
	{
		out << mm.one << " " << mm.two;
		return out;
	}
protected:
	_Ty1 one;
	_Ty2 two;
};

template <class _Ty1,class _Ty2>
class Data 
{
public:
	Data(_Ty1 one, _Ty2 two) :one(one), two(two) {}
	void print() 
	{
		cout << one <<" "<< two << endl;
	}
protected:
	_Ty1 one;
	_Ty2 two;
};
void testFunc() 
{
	//_Ty1类型是:MM<string,int>
	//_Ty2类型是:MM<double,double>
	Data<MM<string, int>, MM<double, double>> 
		data(MM<string, int>("小芳",18), MM<double, double>(89,56));
	data.print();
	//上面两行 等效下面四行代码
	MM<string, int> mmData("小芳", 18);
	MM<double, double> mmScore(89, 56);
	Data<MM<string, int>, MM<double, double>> mData(mmData, mmScore);
	mData.print();
}


template <class _Ty>
void print(_Ty data) 
{
	cout << data << endl;
}
int main() 
{
	//隐式调用
	print(MM<string, int>("小芳", 32));
	//显示调用
	//类型：MM<string, int>
	print<MM<string, int>>(MM<string, int>("小美", 238));
	//起别名简化代码
	using MMType = MM<string, int>;
	print<MMType>(MMType("小美", 238));

	testFunc();
	return 0;
}
```

## 函数模板重载

+ 模板和普通函数 ，调用函数函数类型一致情况 优先调用普通函数
+ 两个模板同时成立，优先调用类型相似度搞的那个

```c++
#include <iostream>
using namespace std;

void print(int a, string b) 
{
	cout << "普通函数" << endl;
}
template <class _Ty1,class _Ty2>
void print(_Ty1 a, _Ty2 b) 
{
	cout << "两个类型" << endl;
}

template <class _Ty>
void print(_Ty a, _Ty b) 
{
	cout << "一个类型" << endl;
}

int main() 
{
	print<int, string>(12, "显示调用百分调用模板");
	print(12, string("优先调用适应的普通函数"));
	//两个模板同时成立，优先调用类型相似度搞的那个
	print(12, 12); // 
	return 0;
}
```

## 类模板特化

+ 局部特化
+ 完全特化

```c++
#include <iostream>
#include<string>
#include <tuple>
using namespace std;
//两未知类型
template <class _Ty1,class _Ty2>
class MM 
{
public:
	MM(_Ty1 one, _Ty2 two) :one(one), two(two) {}
	void print() 
	{
		cout << one << " " << two << endl;
	}
protected:
	_Ty1 one;
	_Ty2 two;
};
class Data 
{
public:
	Data(int a, int b) :a(a), b(b) {}
	void print() 
	{
		cout << a << " " << b << endl;
	}
protected:
	int a;
	int b;
};

//局部特化，特殊化
template <class _Ty>
class MM<_Ty,_Ty>     //特化产生类，类名要用: 类名<类型> 方式使用
{
public:
	MM(_Ty one, _Ty two) :one(one), two(two) {}
	void print()
	{
		//cout << one << " " << two << endl;
		one.print();
		two.print();
		cout << "特殊化" << endl;
	}
protected:
	_Ty one;
	_Ty two;
};

//完全特化
template <>
class MM<string, string> 
{
public:
	MM(string one, string two) :one(one), two(two) {}
	void print()
	{
		cout << "完全特化" << endl;
		cout << one << " " << two << endl;
	}
protected:
	string one;
	string two;
};

int main() 
{
	//原生模板
	MM<string, int> mm1("小芳", 18);
	mm1.print();

	//局部特化模板
	MM<Data, Data> dMM(Data(1,2),Data(3,4));
	dMM.print();

	//完全特化的模板
	//折叠参数 后续讲元组容器的时候讲
	MM<string, string>  mm2("小丽", "小美");
	mm2.print();

	tuple<string, string> tp("张三", "李四");

	return 0;
}
```

## 本节课作业

自己整理笔记，带观点，和代码，代码用来验证观点 第一篇博客

# C++STL容器篇(一)

## 定长数组

+ array

```c++
#include <array>
#include <iostream>
#include <string>
using namespace std;
//size_t unsigned int 
template <class _Ty,size_t size>
class MyArray 
{
public:
	MyArray() 
	{
		memroy = new _Ty[size];
		//new MM[size]
		
	}
	_Ty& operator[](int index)
	{
		return memroy[index];
	}
	~MyArray() 
	{
		delete[] memroy;
	}
public:
	_Ty* begin() 
	{
		return memroy + 0;
	}
	_Ty* end() 
	{
		return memroy + size;
	}
	//类的对象模仿指针的行为
	class iterator 
	{
	public:
		iterator(_Ty* pmove = nullptr) :pmove(pmove) {}
		void operator=(_Ty* pmove) 
		{
			this->pmove = pmove;
		}
		bool operator!=(_Ty* pmove) 
		{
			return this->pmove != pmove;
		}
		iterator operator++(int) 
		{
			this->pmove++;
			return *this;
		}
		_Ty operator*() 
		{
			return pmove[0];
		}
	protected:
		_Ty* pmove;
	};

protected:
	_Ty* memroy;	//MM
};
void testMyArray() 
{
	MyArray<int, 3> array1D;
	for (int i = 0; i < 3; i++) 
	{
		array1D[i] = i;
	}
	MyArray<int, 3>::iterator iter;
	for (iter = array1D.begin(); iter != array1D.end(); iter++) 
	{
		cout << *iter << "\t";
	}
	cout << endl;
}
void testArray() 
{
	//存储数据的类型是:int  
//数组长度:3
//用模板的时候用的都是对象，而不是new一个对象
	array<int, 3> array1D;
	array<string, 3>* p = new array<string, 3>;
	delete p;
#define MAX 5
	array<double, 5> dAarray1D;
	//创建并初始化
	array<int, 3>  num = { 1,2,3 };
	for (int i = 0; i < array1D.size(); i++) 
	{
		array1D[i] = i;
	}
	//迭代器
}
void testExOperator() 
{
	//使用： 和数组一样的用法
	//一些函数
	array<int, 3> test = { 1,2,3 };
	cout << test.empty() << endl;
	cout << test.size() << endl;
	test.fill(5);		//填充所有的元素 ，填充为5
	for (int v : test)		
	{
		cout << v << "\t";
	}
	cout << endl;
	//交换  长度一定是要一样常
	array<int, 3> test1 = { 0,0,0};
	test.swap(test1);
	int cData[3] = { 1,2,3 };   //映射：一种对应关系，数组下标对应元素
	for (auto v : cData) 
	{
		cout << v << "\t";
	}
	cout << endl;
}
//定长数组处理自定义类型的数据
class MM
{
public:
	MM() {}
	MM(string name, int age) :name(name), age(age) {}
	void print() 
	{
		cout << name << "\t" << age << endl;
	}
protected:
	string name;
	int age;
};
void testUserData() 
{
	array<MM, 3> mmData;	//	MM array[3];
	for (int i = 0; i < mmData.size(); i++) 
	{
		string name = "name";
		mmData[i] = MM(name + to_string(i), 16 + i);
	}

	for (auto v : mmData) 
	{
		//v:就是MM的对象
		v.print();
		//cout<<v;			//想要这样输出，重载<<运算符
	}
	//迭代器访问
	//对象模仿指针，*迭代器 就是取值运算
	array<MM, 3>::iterator iter;
	//begin()
	//end(): 最后一个位置，不是最后元素的位置
	(*mmData.begin()).print();
	//(*mmData.end()).print();  越界访问
	(*(mmData.end() - 1)).print();
	for (iter = mmData.begin(); iter != mmData.end(); iter++) 
	{
		//(*iter).print();
		iter->print();
		//cout<<*iter;		//重载<<
	}
}
//array当做函数参数，返回值都可以
array<int, 3>&  returnArray(array<int, 3>& temp) 
{
	for (int i = 0; i < temp.size(); i++)
	{
		temp[i] = i;
	}
	return temp;
}

int main() 
{
	testArray();
	testExOperator();
	testUserData();
	cout << "自己写的模板" << endl;
	testMyArray();

	return 0;
}
```

## 动态数组

+ vector

```c++
#include <vector>
#include <iostream>
#include <string>
using namespace std;
//辅助函数:遍历容器
template <class _Ty>
void printVector(vector<_Ty>& temp) 
{
	for (auto v : temp) 
	{
		cout << v << "\t ";
	}
	cout << endl;
}
//基本用法
void testCreateVector() 
{
	//模板类型:存储数据类型
	//1.不带长度的创建方式
	vector<int> vecData;
	//只能用成员函数做插入
	for (int i = 0; i < 3; i++) 
	{
		vecData.push_back(i);	//尾插法  0   0 1  0 1 2
	}
	printVector(vecData);
	//2.带长度
	vector<string> strData(3);		//当前动态数组的长度是3
	//确定长度，可以直接使用数组法插入
	for (int i = 0; i < 3; i++) 
	{
		string name = "name";
		//只有在确定长度范围以内的可以直接采用数组法插入
		strData[i] = name + to_string(i);
	}
	printVector(strData);
	//超过的必须用成员函数插入
	//strData[3] = "name3";    vector subscript out of range  错误
	strData.push_back("name3");	//在这个函数中做了自动扩增
	printVector(strData);
		

	//3.带初始化
	vector<double> dData = { 1.1,1.23,1.44 };  //自动算出长度为3
	printVector(dData);

	//猜谜
	vector<int> intData(3);   
	intData.push_back(1111);  //在原来内存的后面扩增
	printVector(intData);	  //0 0 0 1111

	//迭代器遍历
	vector<string>::iterator iter;
	for (iter = strData.begin(); iter != strData.end(); iter++) 
	{
		cout << *iter << "\t";
	}
	cout << endl;

}
//自定义类型数据
class MM 
{
public:
	MM(string name, int age) :name(name), age(age) {}
	friend ostream& operator<<(ostream& out, const MM& temp) 
	{
		out << temp.name << "\t" << temp.age;
		return out;
	}
protected:
	string name;
	int age;
};
void testUserData() 
{
	vector<MM> mmData;
	for (int i = 0; i < 3; i++) 
	{
		string name = "name";
		mmData.push_back(MM(name + to_string(i), 18 + i));
	}
	//二进制“<<”: 没有找到接受“MM”类型的右操作数的运算符(或没有可接受的转换)
	printVector(mmData);
}

void testExOperator() 
{
	vector<int> iData = { 1,2,3,4 };
	cout << iData.size() << endl;		//当前容器中的元素个数
	cout << iData.empty() << endl;		//判断是否为空   return size==0; 有元素返回false
	cout << iData.front() << endl;		//访问第一个元素
	cout << iData.back() << endl;		//访问最后一个元素
	cout << iData.at(2) << endl;		//下标访问
	cout << iData[2] << endl;			//和at(2)一样的效果 表示
	//修改
	iData.emplace(iData.begin() + 2, 100); //修改下标是2位置的元素为100
	printVector(iData);
	iData.emplace_back(999);			//和push_back一样的功能
	iData.emplace(iData.begin(), 1111);	//修改第一个元素
										//删除函数
	//iData.erase(iData.begin() + 2);   //数组只有伪删除，没有删除操作
	printVector(iData);

	//批量复制
	int array[] = { 1,2,3 };
	vector<int> vecData;
	vecData.assign(array, array + 3);   //不需要起始长度
	printVector(vecData);
}
int main() 
{
	testCreateVector();
	testUserData();
	testExOperator();
	return 0;
}
```

## array与vector嵌套

```c++
#include <iostream>
#include <array>
#include <vector>
#include <string>
#include <ctime>
#include <cstdlib>
using namespace std;
void testArrayVsArray() 
{
	array<array<int, 3>, 4> arrData;  //int arrData[4][3]
	for (int i = 0; i < 4; i++) 
	{
		for (int j = 0; j < 3; j++) 
		{
			arrData[i][j] = i * j;
			cout << arrData[i][j] << "\t";
		}
		cout << endl;
	}
}
void testVectorVsVector() 
{
	srand((unsigned int)time(nullptr));
	vector<vector<int>> vecData;
	//一般vecotor 采用的是push_back插入
	for (int i = 0; i < 4; i++) 
	{
		vector<int> temp;
		//rand()%3 [0,2]  [2,4]
		for (int j = 0; j < rand()%3+2; j++) 
		{
			temp.push_back(i * j);
		}
		vecData.push_back(temp);
	}
	//不等列数的二位数组
	for (int i = 0; i < vecData.size(); i++) 
	{
		for (int j = 0; j < vecData[i].size(); j++) 
		{
			cout << vecData[i][j] << "\t";
		}
		cout << endl;
	}
}
void testArrayVsVector()
{
	array<vector<int>, 3> vecArr;
	vector<int> vec1[3] = { { 1,2,3 } , {1,2,3,4}, {1,2}};
	for (int i = 0; i < vecArr.size(); i++) 
	{
		vecArr[i] = vec1[i];
	}
	//不等列数的二位数组
	for (int i = 0; i < vecArr.size(); i++)
	{
		for (int j = 0; j < vecArr[i].size(); j++)
		{
			cout << vecArr[i][j] << "\t";
		}
		cout << endl;
	}
	vector<array<array<vector<int>, 3>, 3>> vec;
	//慢慢剥洋葱即可
	array<array<vector<int>, 3>, 3> test;
	for (int i = 0; i < 3; i++) 
	{
		test[i] = vecArr;		//vecArr: array<vector<int>, 3>
	}
	vec.push_back(test);
	
	vector<array<array<vector<int>, 3>, 3>> test;
	//上面一行 等效下面两行
	using Data = array<array<vector<int>, 3>, 3>;
	vector<Data> test2;

	array<array<vector<int>, 3>, 3> test3;
	//上面一行 等效下面两行
	using Data2 = array<vector<int>, 3>;
	array<Data2, 3>  test3;
}

void testVectorVsArray() 
{
	vector<array<int, 3>> arrVec;
	array<int, 3>  arr[3] = { { 1,2,3 } , {1,2,3}, {1,2,3}};
	for (int i = 0; i < 3; i++) 
	{
		arrVec.push_back(arr[i]);
	}
	for (int i = 0; i < arrVec.size(); i++)
	{
		for (int j = 0; j < arrVec[i].size(); j++)
		{
			cout << arrVec[i][j] << "\t";
		}
		cout << endl;
	}
}

int main() 
{
	testArrayVsArray();
	testVectorVsVector();
	testArrayVsVector();
	testVectorVsArray();
	return 0;
}
```

## 本节课作业

1.整理笔记，写好博客

# C++STL容器篇(二)

## 双向链表

+ list

```c++
#include <list>
#include <iostream>
#include <string>
#include <functional>  //less和greator头文件
using namespace std;
list<int>::iterator myFind(list<int>& iNum,int data) 
{
	for (list<int>::iterator iter = iNum.begin(); iter != iNum.end(); iter++) 
	{
		if (*iter == data) 
		{
			return iter;
		}
	}
	return iNum.end();
}
//基本操作: 操作基本数据类型
void testList() 
{
	list<int> iNum;
	list<string> strNum;
	//插入
	strNum.push_back("string1");	//尾插发
	strNum.push_back("string2");
	strNum.push_front("string3");
	//string3 string1  string2
	//遍历
	//不删除方式遍历
	list<string>::iterator iter;
	for (iter = strNum.begin(); iter != strNum.end(); iter++) 
	{
		cout << *iter << " ";
	}
	cout << endl;
	cout << "是否为空:" <<boolalpha<< !strNum.empty() << endl;
	cout << "元素个数:" << strNum.size() << endl;
	//删除方式遍历
	//string3 string1  string2
	while (!strNum.empty()) 
	{
		cout << strNum.front() << " ";	//back()
		strNum.pop_front();				//头部删除  pop_front();
	}
	cout << endl;
	cout << "元素个数:" << strNum.size() << endl;
	//指定位置操作
	//iterator find(iterator begin,iterator end,data);
	for (int i = 0; i < 3; i++) 
	{
		iNum.push_back(i);
	}
	auto result = find(iNum.begin(), iNum.end(), 2);
	//没找到返回是end结束的位置
	if (result == iNum.end()) 
	{
		cout << "未找到指定位置" << endl;
	}	//insert
	iNum.insert(result, 100);
	for (auto v : iNum) 
	{
		cout << v << "\t";
	}
	cout << endl;
	//删除函数
	iNum.erase(result);
	for (auto v : iNum)
	{
		cout << v << "\t";
	}
	cout << endl;
	//其他操作
	iNum.reverse();				//反转链表
	for (auto v : iNum)
	{
		cout << v << "\t";
	}
	cout << endl;
	iNum.sort(less<int>());				//排序
	for (auto v : iNum)
	{
		cout << v << "\t";
	}
	cout << endl;
}
void testDelete() 
{
	int array[4] = { 1,2,2,3 };
	list<int> data;
	data.assign(array, array + 4);
	//相同元素的删除
	for (list<int>::iterator iter = data.begin(); iter != data.end(); )
	{
		if (*iter == 2)
		{
			iter = data.erase(iter);
		}
		else
		{
			iter++;
		}
	}
	for (auto v : data)
	{
		cout << v << "\t";
	}
	cout << endl;
}
//操作自定义类型数据
class MM 
{
public:
	MM(string name, int age, int num) :name(name), age(age), num(num) {}
	void print() 
	{
		cout << name << "\t" << age << "\t" << num << endl;
	}
	bool operator==(const string& name) const
	{
		return this->name == name;
	}
	bool operator<(const MM& object) const 
	{
		return this->name < object.name;
	}
	string getName() const
	{
		return name;
	}
	int getAge() const
	{
		return age;
	}
protected:
	string name;
	int age;
	int num;
};
bool compareByName(const MM& object1, const MM& object2) 
{
	return object1.getName() < object2.getName();
}
bool compareByAge(const MM& object1, const MM& object2)
{
	return object1.getAge() < object2.getAge();
}
void testUserData() 
{
	list<MM> mmData;
	string name;
	int age;
	int num;
	while (1) 
	{
		cout << "input MM:" << endl;
		cin >> name >> age >> num;
		mmData.push_back(MM(name, age, num));
		cout << "是否继续输入？" << endl;
		while (cin.get() != '\n');
		if (cin.get() == 'n')
			break;
	}
	cout << "姓名\t年龄\t编号" << endl;
	for (MM v : mmData) 
	{
		v.print();
	}
	//二进制“==”: 没有找到接受“MM”类型的左操作数的运算符(或没有可接受的转换)
	auto result = find(mmData.begin(), mmData.end(), string("name1"));
	//重载方式
	mmData.sort(less<MM>());		//重载<  
	//mmData.sort(greater<MM>());	//重载>
	//不采用重载方式，需要自己写比较准则
	mmData.sort(compareByName);
	mmData.sort(compareByAge);
}
int main() 
{
	//testList();
	//testDelete();
	testUserData();
	return 0;
}
```

## 栈

+ stack

```c++
#include <stack>
#include <iostream>
#include <string>
using namespace std;
void testStack() 
{
	//穿脱原则
	//FILO  
	//1 2 3 
	//3 2 1 
	//push(data)
	//pop()  删除
	//top()  获取栈顶元素
	//size() empty();
	stack<int> intStack;
	for (int i = 0; i < 3; i++) 
	{
		intStack.push(i);
	}
	while (!intStack.empty()) 
	{
		cout << intStack.top() << "\t";
		intStack.pop();
	}
	cout << endl;
}

void NumTobinary(int data) 
{
	stack<int> bin;
	while (data) 
	{
		bin.push(data % 2);
		data = data / 2;
	}
	if (bin.size() < 8) 
	{
		for (int i = bin.size(); i < 8; i++) 
		{
			bin.push(0);
		}
	}
	while (!bin.empty()) 
	{
		cout << bin.top();
		bin.pop();
	}
	cout << endl;
	//中缀和后缀表达式资料看看
	//a+b 中缀
	//ab+
	//a+b*c+d;
}
int main() 
{
	//testStack();
	NumTobinary(512);
	return 0;
}
```

## 队列

+ queue

```c++
#include <queue>
#include <iostream>
#include <string>
using namespace std;
void pop_queue(queue<int> qData) 
{
	while (!qData.empty())
	{
		cout << qData.front() << " ";  //获取队头元素
		qData.pop();	//出队
	}
	cout << endl;
}
void testQueue() 
{
	queue<int> qData;
	for (int i = 0; i < 3; i++) 
	{
		qData.push(i);	//入队
	}
	while (!qData.empty()) 
	{
		cout << qData.front() << " ";  //获取队头元素
		qData.pop();	//出队
	}
	cout << endl;
	cout << qData.size() << endl;
}
int main() 
{
	testQueue();


	return 0;
}
```

+ deque

```c++
#include <deque>
#include <iostream>
#include <string>
using namespace std;
//从头出来
void pop_front_dequeue(deque<int> dData) 
{
	while (!dData.empty()) 
	{
		cout << dData.front()<<" ";
		dData.pop_front();
	}
	cout << endl;
}
//从尾出来
void pop_back_dequeue(deque<int> dData)
{
	while (!dData.empty())
	{
		cout << dData.back() << " ";
		dData.pop_back();
	}
	cout << endl;
}
void testDeque() 
{
	deque<int> deData;
	for (int i = 0; i < 3; i++) 
	{
		deData.push_back(i);		//尾插法入队
		deData.push_front(i);		//头插法入队
	}
	deData.push_back(999);
	//0 0
	//1 0 0 1
	//2 1 0 0 1 2
	pop_front_dequeue(deData);
	pop_back_dequeue(deData);
}
int main() 
{
	testDeque();
	return 0;
}
```

+ priority_queue

```c++
#include <iostream>
#include <queue>
#include <vector>
using namespace std;
template <class _Ty,class _Container = vector<_Ty>,class _Pr = less<_Ty>>
class my_priority_queue
{
public:

protected:

};
void testCreatePriorityQueue() 
{
	//默认的方式，一级下面三种 都一样，大的先出队
	priority_queue<int> pqData;
	priority_queue<int,vector<int>> pqData2;			//默认排序准则
	priority_queue<int,vector<int>,less<int>> pqData3;	//所有参数都完整
	//优先队列，是按照数据的优先权出队,VIP服务
	pqData.push(12);
	pqData.push(0);
	pqData.push(34);
	while (!pqData.empty()) 
	{
		cout << pqData.top()<<" ";
		pqData.pop();		//出队
	}
	cout << endl;
	//贪心算法
	priority_queue<int, vector<int>, greater<int>> pqDataG;	
	pqDataG.push(12);
	pqDataG.push(0);
	pqDataG.push(34);
	while (!pqDataG.empty())
	{
		cout << pqDataG.top() << " ";
		pqDataG.pop();		//出队
	}
	cout << endl;
}
int main() 
{
	testCreatePriorityQueue();
	return 0;
}
```

## 本节课作业

1.整理笔记，写好第一篇博客

2.第二篇把管理系统改为list容器实现的，增加排序功能，按照不同的数据进行排序。

# C++STL容器篇(三)

## 集合

+ set/multiset

```c++
#include <set>
#include <iostream>
#include <ctime>
using namespace std;
/*
	set:集合
	1.数据自带排序
	2.数据唯一性
*/
class MM 
{
public:
	MM(string name, int age) :name(name), age(age) {}
	bool operator<(const MM& object)const 
	{
		return this->name < object.name;
	}
	void print() 
	{
		cout << name << " " << age << endl;
	}
protected:
	string name;
	int age;
};

void testSet() 
{
	srand((unsigned int)time(nullptr));
	set<int> setData;					//默认方式 从小到大
	set<int, less<int>> setData2;		//和默认方式一样
	set<int, greater<int>> setData3;	//从大到小
	int array[10] = { 0 };
	for (int i = 0; i < 10; i++)
	{
		int temp = rand() % 10;
		array[i] = temp;
		setData.insert(temp);
	}
	for (auto v : array) 
	{
		cout << v << " ";
	}
	cout << endl;
	for (set<int>::iterator iter = setData.begin(); iter != setData.end(); iter++) 
	{
		cout << *iter << " ";
	}
	cout << endl;
}
void testUserData() 
{
	set<MM> mmData;   //less<int> <
	mmData.insert(MM("name3", 19));
	mmData.insert(MM("name2", 28));
	mmData.insert(MM("name3", 188));
	for (auto v : mmData) 
	{
		v.print();
	}

	set<char> cData;
	set<string> strData;
}
//多重集合: 只具有排序功能，不具有去重功能
void testmultiset()
{
	multiset<int> mulData;
	for (int i = 0; i < 10; i++) 
	{
		mulData.insert(rand() % 10);
		//rand()%26+'A';
		//rand()%26+'a';
	}
	for (auto v : mulData) 
	{
		cout << v << " ";
	}
	cout << endl;
}
int main() 
{
	testSet();
	testUserData();
	testmultiset();


	return 0;
}
```

+ bitset

```c++
#include <iostream>
#include <bitset>
using namespace std;
template <class _Ty,size_t size>
class MyArray 
{

};
int main() 
{
	//多个二进制位
	bitset<8> bData("11110000");
	cout << bData << endl;
	bData.flip();
	cout << bData << endl;
	cout << bData.all() << endl;
	cout << bData.any() << endl;
	cout << bData.size() << endl;
	cout <<bData.none() << endl;
	bitset<8> num(7);
	cout << num << endl;
	return 0;
}
```

## 映射

+ map/multiset

```c++
#include <map>
#include <iostream>
#include <graphics.h>
using namespace std;
template <class _Ty1, class _Ty2>
struct MyPair 
{
	_Ty1 first;
	_Ty2 second;
	MyPair(_Ty1 first, _Ty2 second) :first(first), second(second) {}
};
//map存储的数据是一个数对类型
void testPair() 
{
	pair<int, string> pData(1, "string");
	MyPair<int, string> myPData(1, "string");
	cout << pData.first << " " << pData.second << endl;
}
//map
//1.自带排序，默认是从小到大
//2.数据唯一性
void testMap() 
{
	map<int, string> mapData;
	map<int, string, less<int>> mapData1; //和上面创建方式一样，从小到大
	map<int, string, greater<int>> mapData2; //从大到小
	//1.insert插入
	mapData.insert(pair<int, string>(1, "string"));
	//2.make_pair构建数对插入
	mapData.insert(make_pair<int, string>(3, "string3"));
	//3.单映射，可以直接采用数组下标方式进行插入
	//数组在一定程序上来说或可以说数组
	//map[first]=second;
	//相比数组来说，这个下标是没有任何要求
	mapData[-1] = string("string-1");  //等效插入一个数对类型
	//上面代码等效：mapData.insert(pair<int,string>(-1,"string-1"))
	mapData[1] = "string1";		//相同键 采用的是覆盖方式
	//遍历:
	for (auto iter = mapData.begin(); iter != mapData.end(); iter++) 
	{
		//*iter指的是pair类型
		cout << iter->first << " " << iter->second<<endl;
	}
	for (auto v : mapData) 
	{
		cout << v.first << "\t" << v.second << endl;
	}
	//map<string, IMAGE*> img;
	//img["墙"] = new IMAGE;
	//img["路"] = new IMAGE;
	//putimage(0, 0, img["墙"]);
	//putimage(0, 0, img["路"]);
	cout << mapData[1] << endl;    //用的时候直接使用即可
	mapData.erase(1);
	for (auto v : mapData)
	{
		cout << v.first << "\t" << v.second << endl;
	}
	cout << endl;
}
class MM
{
public:
	MM() = default;
	MM(string name, int age) :name(name), age(age) {}
	void print() const
	{
		cout << name << "\t" << age << endl;
	}
	bool operator<(const MM& object)const 
	{
		return this->name < object.name;
	}
protected:
	string name;
	int age;
};
class Boy
{
public:
	Boy() = default;
	Boy(string name, int age) :name(name), age(age) {}
	void print() const
	{
		cout << name << "\t" << age << endl;
	}
protected:
	string name;
	int age;
};
void testUserData() 
{
	map<MM, Boy> mbData;
	mbData[MM("小美", 19)] = Boy("小张", 29);
	mbData[MM("小美", 19)].print();
	mbData[MM("小丽", 20)] = Boy("小明", 18);
	cout << "配对信息：" << endl;
	for (auto v : mbData) 
	{
		//容器管理自定义类型数据
		//v:pair<MM,Boy>
		//v.frist:MM
		//v.second:Boy
		v.first.print();
		v.second.print();
	}
}
void testmultimap() 
{
	//多重映射，没有什么限制，什么样对应关系都可以插入到映射中
	//因为存在相同的键，所以不能采用下标法
	multimap<int, string>  mulData;
	mulData.insert(pair<int, string>(1, "string"));
	mulData.insert(pair<int, string>(1, "string1"));
	mulData.insert(pair<int, string>(2, "string"));
	mulData.insert(pair<int, string>(3, "string"));
	mulData.insert(make_pair<int, string>(3, "string"));
	for (auto v : mulData) 
	{
		cout << v.first << "\t" << v.second << endl;
	}
}
int main() 
{
	testMap();
	testUserData();
	testmultimap();
	return 0;
}
```

## 列表

+ initializer_list

```c++
#include <array>
#include <list>
#include <vector>
#include <iostream>
#include <initializer_list>
using namespace std;
class MM 
{
public:
	MM(string a, string b, string c) :a(a), b(b), c(c) {}
	MM(const initializer_list<string>& list) 
	{
		for (auto iter = list.begin(); iter != list.end(); iter++) 
		{
			cout << *iter << endl;
		}
	}
protected:
	string a;
	string b;
	string c;
};
void print(initializer_list<int> list) 
{
	for (auto iter = list.begin(); iter != list.end(); iter++)
	{
		cout << *iter << " ";
	}
	cout << endl;
}

int main()
{
	array<int, 3> arrData = { 1,2,3 };
	vector<int> vecData1 = { 1,2,3,4 };
	vector<int> vecData2 = { 1,2,3,4,5 };
	MM mm1 = { "string1","string2","string3" };
	MM mm2 = { "string1" };
	MM mm3 = { "string1","string2" };
	initializer_list<int> listOne = { 1,2,3,4,5 };
	initializer_list<int> listTwo = { 1,2,3};
	print({ 1 });
	print({ 1,2 });
	print({ 1,2,3,4 });
	print({ 1,2,3,4,5 });
	return 0;
}
```

## 元组

+ tuple

```c++
#include <tuple>
#include <iostream>
using namespace std;
void testTuple()
{
	//把任何类型的一系列数据当做一组处理
	tuple<string, int, int, string> mmInfo = {"MM",18,1001,"123445"};
	tuple<double, double, double> mmscore = make_tuple(98, 98, 88);
	tuple<string, string> value = forward_as_tuple("小张", "小美");
	tuple<string, int, int, string> array[3];
}
void visitedData() 
{
	tuple<string, int, int, string> mmInfo = { "MM",18,1001,"123445" };
	//get方法,不能用for循环
	cout << get<0>(mmInfo) << "\t";
	cout << get<1>(mmInfo) << "\t";
	cout << get<2>(mmInfo) << "\t";
	cout << get<3>(mmInfo) << endl;
	//tie的方式访问数据
	string name;
	int age;
	int num;
	string tel;
	tie(name, age, num, tel) = mmInfo;
	cout << name << "\t" << age << "\t" << num << "\t" << tel << endl;
}
void Exoperator() 
{
	tuple<string, int, int, string> mmInfo = { "MM",18,1001,"123445" };
	tuple<double, double, double> mmscore = make_tuple(98, 98, 88);
	auto result = tuple_cat(mmInfo, mmscore);
}
int main() 
{

	visitedData();
	return 0;
}
```

## 折叠参数(拓展)

+ 折叠参数:  ...
+ 可增长模板参数 模板函数
+ 可增长模板参数 类模板

## 本节课作业

1.整理笔记，写好第一篇博客

# C++STL迭代器

## 迭代器

+ 迭代器： 就是一个类中类，通过运算符重载通过类中类的对象去遍历容器
+ 迭代器的分类

  + 正向迭代器: iterator

    + begin();
    + end();
  + 反向迭代器: reverse_iterator

    + rbegin();
    + rend();
  + 常正向迭代器: const_iterator

    + cbegin();
    + cend();
  + 常反向迭代器:const_reverse_iterator

    + crbegin();
    + crend();
+ 按功能分类

  + 正向迭代
  + 双向迭代
  + 随机访问迭代器
+ 容器中迭代器分类

  |容器名|迭代器类型|
  | ----------------------------------------| ----------|
  |array|随机访问|
  |vector|随机访问|
  |deque|随机访问|
  |stack/queue/priority_queue(特定顺序存取)|不支持|
  |list|双向|
  |set/multiset|双向|
  |map/multimap|双向|
+ 迭代器辅助函数

  + 移动:advance(iterator iter,n);
  + 间距:distance(iterator begin,iterator end);
  + 交换:iter_swap(iterato first,iterator end);
+ 拓展内容:特殊迭代器 流型迭代器-->一般用在辅助打印

  + 输出流型
    + ostream_iterator<_Ty>  iter(ostream& out);
    + ostream_iterator<_Ty>  iter(ostream& out,char* str);
    + 输出流型迭代做赋值运算，意味着就是打印数据到屏幕上
  + 输入流型
    + istream_iterator<_Ty>  iter； //构造无参对象，是一个错误流 end_of_ostream
    + istream_iterator<_Ty>  iter(istream& in);
    + *iter   等效cin>>操作

## Lambda表达式

+ Lambda: 就是一个返回函数指针的表达式，它定义和返回值函数指针在一起的
+ Lambda表达式的组成部分

```c++
// [捕获方式](函数参数)mutable exception->函数返回值类型{函数体;}
int Max(int a,int b)
{
    return a>b?a:b;
}
void print()
{
    //Max的Lambda表达式写法
	int(*pMax)(int,int)=[](int a,int b)mutable noexcept->int{ return a>b?a:b;};  
    //省略写法: 中间描述此都可以省略
    auto ppMax=[](int a,int b){reutrn a>b?a:b;};
}
//捕获方式-->函数使用外部的变量的方式
/*
	[=]   //值的方式捕获
	[&]	  //引用的方式捕获
	[this]//this指针方式捕获
	[]    //不捕获任何变量
	[=,&x];//x用引用方式捕获，其他变量用值的方式捕获
*/
```

```C++
#include <iostream>
using namespace std;
int Max(int a, int b) 
{
	return a > b ? a : b;
}
void print(int(*pMax)(int, int), int a, int b) 
{
	cout << pMax(a, b) << endl;
}
class MM 
{
public:
	void print() 
	{
		[this] {cout << name << "\t" << age << endl; }();		//定义和调用一步到位
	}
protected:
	string name="默认";
	int age=100;
};
int main() 
{
	int(*pMax)(int, int) = nullptr;
	//完整版:Lambad 表达式
	//final override
	pMax = [](int a, int b)mutable noexcept->int {return a > b ? a : b; };
	cout << pMax(1, 3) << endl;
	//省略版本的，写代码越简单越好
	auto  pp = [](int a, int b) {return a > b ? a : b; };
	cout << pp(1, 3) << endl;
	//实际使用可以一步到位--->短暂性局部使用的的函数
	cout << [](int a, int b)mutable noexcept->int {return a > b ? a : b; }(1, 3) << endl;
	print([](int a, int b) {return a > b ? a : b; }, 1, 3);
	print([](int a, int b) {return a > b ? b : a; }, 1, 3);
	print([](int a, int b) {return a+b; }, 1, 3);
	//捕获方式的区别
	//用值的捕获: 在Lambad中不能把值当做左值使用,函数调用不会因为值的改变而改变
	int data = 101010;
	auto pFunc = [=] {  cout << data << endl; };  //无参() 可以省略
	auto pFunc2 = [&] { cout << data << endl; };
	pFunc();
	pFunc2();
	data = 808080;
	pFunc();
	pFunc2();
	MM  mm;
	mm.print();
	//特殊的东西-->结合auto使用
	auto pAuto = [](auto a, auto b) ->auto{return a > b ? a : b; };
	cout << pAuto(1, 3) << endl;				//[](auto a, auto b) ->auto{return a > b ? a : b; }(1,3)
	cout << pAuto("stringa", "stringb") << endl;
	//[] (auto a, auto b) ->auto{return a > b ? a : b; }("stringa", "stringb");
	return 0;
}
```

## 仿函数

+ 什么仿函数? 类模仿函数调用行为，实质是无名对象调用重载的()函数
  + 所以仿函数的关键点在于重载()
+ 一般情况仿函数是做排序准则，或者一些算法的计算准则
+ 标准库中的仿函数
  + 算术类
  + 关系类
  + 逻辑类
  + 选择，证同，投射

```c++
#include <iostream>
#include <string>
#include <functional>		//仿函数所在头文件
#include <map>
using namespace std;
class Sum 
{
public:
	int  operator()(int a, int b) const 
	{
		return a + b;
	}
};
int main()
{
	//重载的()的调用方式
	Sum s;
	cout << "显式调用:" << s.operator()(1, 3) << endl;		//显式调用重载函数
	cout << "隐式调用:" << s(1, 3) << endl;
	//用{}和()帮助编译器去做解析
	cout << "无名调用:" << Sum{}(1, 3) << endl;			//类模仿函数调用行为--->仿函数
	cout << "无名调用:" << Sum()(1, 3) << endl;			//类模仿函数调用行为--->仿函数
	//算术
	cout << plus<int>{}(1, 3) << endl;
	//关系
	cout << equal_to<int>{}(1, 3) << endl;
	map<int, less<int>> map1;
	map<int, greater<int>> map3;
	//逻辑类
	cout << logical_and<int>{}(1,0) << endl;
	//求大于3 小于10的数字
	//没必要的做的事情
	int a = 34;
	if (logical_and<int>{}(a > 3, a < 10)) 
	{
		cout << "大于3 小于10的数字" << endl;
	}

	return 0;
}
```

## 函数适配器

+ 什么是函数适配器: 用来绑定函数调用时候的参数，让函数适应其他调用的用法

```c++
#include <iostream>
#include <string>
#include <functional>
#include <vector>
#include <algorithm>
using namespace std;
//老版本bind1st bind2nd
//新版本: bind函数
int Max(int a, int b) 
{
	return a > b ? a : b;
}
void print(int(*pMax)(int,int), int a,int b) 
{
	cout << pMax(a,b) << endl;
}
class Test 
{
public:
	void print(int a, int b, int c) 
	{
		cout << a << " " << b << " " << c << endl;
	}
protected:
};
void testClassFunc()
{
	Test test;
	auto testFunc = bind(&Test::print, &test, std::placeholders::_1, std::placeholders::_2, 99);
	testFunc(1, 3);		//调用，直接调用
}

void printData(int one, Test two, string str) 
{
	cout << "调用成功" << endl;
}
//可以通过占位符，所以调整参数位置，形成不同的调用形态
void testExUser() 
{
	//占位符代表原函数的参数 在调用形态 的第二个位置
	auto testFunc = bind(printData,std::placeholders::_3, std::placeholders::_1, std::placeholders::_2);
	printData(1, Test(), "ILoveyou");
	testFunc(Test(), "ILoveyou", 1);
}

int main() 
{
	cout << Max(1, 3) << endl;
	//基本用法
	//std::placeholders::_1占位符
	auto pMax = bind(Max, std::placeholders::_1, 100);  //把第二个参数置为100
	//只是增加调用行为，并没有真正改变了这个函数指针类型
	cout << pMax(34) << endl;
	cout << pMax(13, 44) << endl;  //绑定后的函数指针，不再支持传参的，第二个参数无效
	//语法上没问题，但是尽量别这样做
	using namespace std::placeholders;
	auto pMax2 = bind(Max, _1, 100);  //把第二个参数置为100
	cout << pMax2(34) << endl;
	vector<int> vecData = { 19,43,89,89,34,54,67,54 };
	cout << count_if(vecData.begin(), vecData.end(),bind(greater<int>(),std::placeholders::_1,60)) << endl;
	cout << count_if(vecData.begin(), vecData.end(), [](int a) {return a > 60; }) << endl;
	testClassFunc();
	testExUser();

	return 0;
}
```

## 函数包装器

+ 函数包装器是什么？就是把函数指针包装成一个对象。通过这个对象调用函数

  + 一旦函数指针被函数包装器包装了，那这个包装器对象可以直接替换函数指针的用法去调用函数
+ 函数包装器类的实力例化传参: function<函数返回值类型(参数类型)>

```c++
#include <iostream>
#include <string>
#include <functional>
using namespace std;
int Max(int a, int b) 
{
	cout << "包装普通函数:" << endl;
	return a > b ? a : b;
}
class MM 
{
public:
	void print(int a)    //void print(int a, MM* mm);
	{
		cout << "包装成员函数" << endl;
	}
	static void printStatic() 
	{
		cout << "包装静态的函数" << endl;
	}
protected:
};
void testMMFunc() 
{
	MM mm;
	function<void(int)> func(bind(&MM::print,&mm,std::placeholders::_1));
	func(12);
}


class Test 
{
public:
	void operator()(string str) 
	{
		cout << str << endl;
	}
};




void printData(int a, MM mm, string str) 
{
	cout << "bind和function" << endl;
}
void TestFuncBind() 
{
	function<void(string, int, MM)> pf = bind(printData,
		std::placeholders::_2, std::placeholders::_3, std::placeholders::_1 );
	pf("string", 1, MM());
	//3  1  2
}

int main() 
{
	function<int(int, int)> funcMax(Max);
	cout << funcMax(1, 3) << endl;

	function<int(int, int)> funcMax2=Max;
	function<void()> funcS(MM::printStatic);
	funcS();

	//仿函数包装
	Test test;
	function<void(string)> func = test;
	func("包装仿函数");
	TestFuncBind();
	//包装成员函数
	testMMFunc();
	return 0;
}
```

1.整理笔记，写好第一篇博客

# C++STL算法篇

## STL查找算法

+ 基本查找

  + find:区间查找
  + find_if:条件查找
  + find_firt_of: 查找区间第一次出现值
  + adjacent_find: 查找第一次重复的数
  + search:子序列查找
  + search_n: 子序列查找出现次数
+ 统计查找

  + count: 区间统计
  + count_if: 条件统计个数
  + equal:比较
+ 有序查找

  + binary_search：二分查找
  + upper_bound: 查找最后一个大于查找的值
  + lower_bound: 大于等于查找的值
  + equal_range:区间比较---有序序列

## STL排序通用算法

- merge: 归并排序，存于新容器
- inplace_merge: 归并排序，覆盖原区间
- sort: 排序，更改原容器顺序
- stable_sort: 排序，保存原容器数据顺序
- nth_element: 关键字排序
- partition:范围排序
- partial_sort:范围排序
- partial_sort_copy:范围排序外加复制操作
- stable_partition: 范围排序，保存原容器顺序
- random_shuffle: 随机排序
- reverse:逆序原容器
- reverse_copy: 逆序容器保存到新容器
- rotate:移动元素到容器末尾
- rotate_copy:移动元素到新容器

## STL删除替换算法

+ copy: 拷贝函数
+ copy_backward: 逆序拷贝
+ iter_swap: 交换
+ remove: 删除
+ remove_copy: 删除元素复制到新容器
+ remove_if:条件删除
+ remove_copy_if:条件删除拷贝到新容器
+ replace:替换
+ replace_copy: 替换，结果放到新容器
+ replace_if: 条件替换
+ replace_copy_if:条件替换，结果另存
+ swap: 交换
+ swap_range:区间交换
+ unique:去重
+ unique_copy:去重，结果另存

## STL排列组合算法

+ next_permutation:下一个排序序列的组合
+ prev_permutation:上一个排序序列的组合

## STL 算术算法

+ accumulate:区间求和
+ partial_sum:相邻元素的和
+ inner_product:序列内积运算
+ adjacent_difference:相邻元素的差

## STL 生成异变算法

+ for_each:迭代访问
+ fill:填充方式初始容器
+ fill_n:指定长度填充容器
+ generate_n:填充前n个位置
+ transform:一元转换和二元转换

## STL 关系算法

+ equal:两容器元素是否都相同
+ includes:是否是包含关系
+ lexicographical_compare:比较两个序列
+ max:求最大值
+ max_element:返回最大值的iterator
+ min:求最小值
+ min_element:求最小值的iterator
+ mismatch:找到第一个不同的位置

## STL 集合算法

+ set_union:差集
+ set_intersection:并集
+ set_difference:保存第一个中有第二个没有的元素
+ set_symmetric_difference:对称差集

## STL堆算法

+ make_heap:生成一个堆
+ pop_heap:出堆
+ push_heap:入堆
+ sort_heap:堆排序

# C++智能指针

## 智能指针

+ 智能指针其实本质是一个模板类，一般使用是用的这个类的对象，而不是指针
+ 智能指针体现在内存释放问题。用智能指针管理new的对象， 将不在需要手动delete

## shared_ptr

+ get() 函数: 返回数据的指针的引用
+ use_count(): 返回的是管理对象的智能指针对象数
+ swap():交换管理对象
+ reset():重置管理对象

## weak_ptr

+ 弱引用指针，不会累计计数
+ weak_ptr只能通过shared_ptr或者weak_ptr来构造
+ 主要应用场景： 为了解决shared_ptr 循环引用内存导致无法释放问题
+ 不可使用* 取值，能使用->取值
+ 通过成员函数lock获取shared_ptr对象 然后再访问数据

## unique_ptr

+ 禁止拷贝和赋值，独占型
+ 任何时候unqiue_ptr操作管理对象，永远都只有一个有效
  + 可以通过move函数转交所有权
  + reset函数结合release函数移交所有权

# C++正则表达式

正则是一种规则，它用来匹配（进而捕获、替换）字符串。这种规则需要“模式”、“字符串”这两样东西，“模式”根据正则规则，来处理“字符串”。这种规则被许多语言支持，C++11以后才支持正则。

## 具有特殊意义的元字符

\：\字符能够改变字符原本的含义

^：^字符指示字符串的头，且要求字符串以字符开头，不占位。^表示一个真正的^符号。

$：$字符指示字符串的尾，且要求字符串以字符结尾，不占位。\$表示一个真正的$符号。

()：分组，大正则中包含小正则。可以改变默认的优先级。在模式中可以使用\1来表示第一组已然捕获到的东西。

\b：指示字符串的边界（头/尾/空格左/空格右），字符\b要求边界的左边是字符，\b字符要求边界的右边是字符。

.：表示一个除了\n以外的任意一个字符。\.表示一个真正的.符号。

|：a|b  a或b之一

[abc]：abc之中的任意一个

[^abc]:  abc之外的

[a-z]:	任意小写字母

[^a-z]:  除了小写字母之外的

\w：任意一个字母数字下划线，等价于[(0-9)(a-z)(A-Z)(_)]

\W：字母数字下划线之外的，等价于[]

\d:	任意一个数子

\D:	除了数字之外的

\s:	空白符（空格、制表符、换页符）

## 量词元字符

*：字符*要求字符出现0到多次   {0,}

+：字符+要求字符出现1到多次     (\w)  {1,}

?：字符?要求字符出现0次或1次    {0,1}

{n}：字符{n}要求字符出现n次

{n,}：字符{n,}要求字符出现n到多次  {0,}

{n,m}：字符{n,m}要求字符出现n到m次、

所以含有`\`的元字符，在C++定义时，都要写成`\\`

## 校验数字的表达式

数字：^ [0 - 9] * $
n位的数字：^ \d{ n }$
至少n位的数字：^ \d{ n, }$
m - n位的数字： ^ \d{ m,n }$
零和非零开头的数字： ^ (0 | [1 - 9][0 - 9]  *)$*​*非零开头的最多带两位小数的数字： ^ ([*​*1 - 9][0 - 9] *​ **) + (.[0 - 9]{ 1,2 }) ? $**​**带1 - 2位小数的正数或负数： ^ (\ - ) ? \d + (.**​ **\d{ 1,2 }) ? $**​**正数、负数、和小数： ^ (\ - | \ + ) ? \d + (.**​ **\d + ) ? $**​**有两位小数的正实数： ^ [0 - 9] + (.[0 - 9]{ 2 }) ? $**​**有1~3位小数的正实数： ^ [0 - 9] + (.[0 - 9]{ 1,3 }) ? $**​**非零的正整数： ^ [1 - 9]\d * **​****​ ** 或^ \ + ? [**​**1 - 9][0 - 9] * $**​**非零的负整数： ^ \ - [**​**1 - 9][]0 - 9&quot;**​**​*非负整数： ^ \d + *​**​*非正整数： ^ -[1 - 9]\d * | 0*​**​*非负浮点数： ^ \d + (.*​ *\d + ) ? *​**​*非正浮点数： ^ ((-\d + (.*​ *\d + ) ? ) | (0 + (.*​*0 + ) ? ))*​**​*正浮点数： ^ [1 - 9]\d * .*​ *\d * | 0.*​ *\d * [1 - 9]\d * *​**​*负浮点数： ^ -([1 - 9]\d * .*​ *\d * | 0.*​ *\d * [1 - 9]\d*)$或 ^ (-(([0 - 9] + \.[0 - 9] * \[1 - 9][0 - 9] *) | ([0 - 9] * \[1 - 9][0 - 9] * \.[0 - 9]) | ([0 - 9] * \[1 - 9][0 - 9] *)))$
浮点数： ^ (-? \d + )(.\d + ) ? $或 ^ -? ([1 - 9]\d * \.\d * | 0\.\d * [1 - 9]\d * | 0 ? \.0 + | 0)$

## 校验字符的表达式

汉字： ^ [\u4e00 - \u9fa5]{ 0, }$
英文和数字： ^ [A - Za - z0 - 9] + $或 ^ [A - Za - z0 - 9]{ 4,40 }$
长度为3 - 20的所有字符： ^ .{3, 20}$
由26个英文字母组成的字符串： ^ [A - Za - z] + $
由26个大写英文字母组成的字符串： ^ [A - Z] + $
由26个小写英文字母组成的字符串： ^ [a - z] + $
由数字和26个英文字母组成的字符串： ^ [A - Za - z0 - 9] + $
由数字、26个英文字母或者下划线组成的字符串： ^ \w + $或 ^ \w{ 3,20 }$
中文、英文、数字包括下划线： ^ [\u4E00 - \u9FA5A - Za - z0 - 9_] + $
中文、英文、数字但不包括下划线等符号： ^ [\u4E00 - \u9FA5A - Za - z0 - 9] + $或 ^ [\u4E00 - \u9FA5A - Za - z0 - 9]{ 2,20 }$
可以输入含有 ^ %&',;=?$\&quot;等字符：\[^%&amp;', ; = ?$\x22] + 12 禁止输入含有~的字符：[^ ~\x22] +

## 特殊需求表达式

Email地址： ^ \w + ([-+.]\w + ) * @\w + ([-.]\w + ) * .\w + ([-.]\w + ) * $
域名：[a - zA - Z0 - 9][-a - zA - Z0 - 9]{ 0,62 }(/ .[a - zA - Z0 - 9][-a - zA - Z0 - 9]{ 0,62 }) + / . ?
InternetURL：[a - zA - z] + ://[^\s]* 或 ^http://([\w-]+.)+[\w-]+(/[\w-./?%&=] *)?$*​*手机号码： ^ (13[0 - 9] | 14[5 | 7] | 15[0 | 1 | 2 | 3 | 5 | 6 | 7 | 8 | 9] | 18[0 | 1 | 2 | 3 | 5 | 6 | 7 | 8 | 9])\d{ 8 }$*​*电话号码(0511 - 4405222、021 - 87888822)：\d{ 3 } - \d{ 8 } | \d{ 4 } - \d{ 7 }*​*身份证号(15位、18位数字)： ^ \d{ 15 } | \d{ 18 }$*​*短身份证号码(数字、字母x结尾)： ^ ([0 - 9]) { 7, 18 }(x | X) ? *​**​*帐号：(字母开头，允许5 - 16字节，允许字母数字下划线)： ^ [*​*a - zA - Z][a - zA - Z0 - 9_]{ 4,15 }$*​*密码:(以字母开头，长度在6~18之间，只能包含字母、数字和下划线)： ^ [a - zA - Z]\w{ 5,17 }$*​*强密码(必须包含大小写字母和数字的组合，不能使用特殊字符，长度在8 - 10之间)：*  ^ (? = . *\d)(? = .* [a - z])(? = . *[A - Z]).{8, 10}$*​*日期格式： ^ \d{ 4 } - \d{ 1,2 } - \d{ 1,2 }*​*一年的12个月(01～09和1～12)： ^ (0 ? [1 - 9] | 1[0 - 2])$*​*一个月的31天(01～09和1～31)： ^ ((0 ? [1 - 9]) | ((1 | 2)[0 - 9]) | 30 | 31)$*​*xml文件： ^ ([a - zA - Z] + -? ) + [a - zA - Z0 - 9] + \*​ *.[*​*x | X][*​*m | M][l | L]$*​*中文字符的正则表达式：[\u4e00 - \u9fa5]*​*双字节字符：[*​ *^ \x00 - \xff](包括汉字在内，可以用来计算字符串的长度(一个双字节字符长度计2，ASCII字符计1))*​*空白行的正则表达式：\n\s * \r(可以用来删除空白行)*​*HTML标记的正则表达式：&lt;(\S* ? )[^ > ]  *&gt;.*  ? < / \1> | <.* ? / > (复杂的嵌套标记依旧无能为力)
首尾空白字符的正则表达式： ^ \s * | \s * $或(^ \s*) | (\s *$) (可以用来删除行首行尾的空白字符(包括空格、制表符、换页符等等))
腾讯QQ号：[1 - 9][0 - 9]{ 4, } (腾讯QQ号从10000开始)
中国邮政编码：[1 - 9]\d{ 5 }(? !\d) (中国邮政编码为6位数字)
IP地址：\d + .\d + .\d + .\d + (提取IP地址时有用)
IP地址：((? : (? : 25[0 - 5] | 2[0 - 4]\d | [01] ? \d ? \d)\.) { 3 }(? : 25[0 - 5] | 2[0 - 4]\d | [01] ? \d ? \d))

# C++时间管理

## 时间段

+ 表示时间间隔，可以是秒，分钟，小时，微妙，毫秒，纳秒

```c++
#include <chrono>
```

using nanoseconds  = duration<long long, nano>;		//纳秒
using microseconds = duration<long long, micro>;	//微妙
using milliseconds = duration<long long, milli>;	//毫秒
using seconds      = duration
<long long>

;			//秒
using minutes      = duration<int, ratio<60>>;		//分钟
using hours        = duration<int, ratio<3600>>;    //小时

## 时钟

+ system_clock  ： 获取时间点，需要转换为tim_t才能显示出来
+ steady_clock: 计时 类似秒数
+ high_resolution_clock: 高精度时钟
+ 时钟类共用的一些函数
  + static time_point now() 获取当前时间点
  + static time64_t to_time_t(const time_point x);
  + time_point from_time_t(time_t x);

## 时间转换

+ duration_cast 不属于duration 类
  + 浮点时长和整数时长之间可以直接隐式转化，其他情况要使用这个函数做转换
+ time_point_cast 不属于time_point
  + 存在精度丢失的ratio转换，就必须使用time_point_cast做转换

# C++随机数

## 种子序列：seed_seq

+ 类似C语言srand函数 ，用来设置范围
  + size()   检测种子个数
  + generate()函数
  + param()函数

```c++
#include <iostream>
#include <random>
#include <functional>
#include <array>
using namespace std;
int main() 
{
	seed_seq seed = { 1,3,4,5,6,7,8 };
	cout <<"size:" << seed.size() << endl;
	array<int, 7> data;
	seed.param(data.begin());
	for (auto v : data) 
	{
		cout << v << "\t";
	}
	cout << endl;
	//array<int, 7> data2;
	//seed.generate(data2.begin(), data2.end());
	//for (auto v : data2) 
	//{
	//	cout << v << "\t";
	//}
	cout << endl;
	return 0;
}
```

## 引擎适配器

+ shuffle_order_engine: 乱序随机数引擎适配器
+ independent_bits_engine: 独立位随机数引擎适配器
+ discard_block_engine: 丢弃块随机数引擎适配器
+ default_random_engine: 默认的随机数引擎

[http://www.cplusplus.com/reference/random/default_random_engine/](http://www.cplusplus.com/reference/random/default_random_engine/)
