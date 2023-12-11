实验一：

use master
select * from  spt_values

实验二：

 

 第二章附加题目

       1、创建一个Ch数据库，该数据库的主数据文件逻辑名称为Ch_data，
    物理文件名为Ch.mdf，初始大小为10MB，最大尺寸为20MB，增长速度为10%；
    数据库的日志文件逻辑名称为Ch_log，物理文件名为Ch.ldf，初始大小为1MB，
    最大尺寸为5MB，增长速度为1MB。

       create  database  ch
       on  
       (  name='Ch_data',
          filename='d:\data\Ch.mdf',
          size=10mb,
          maxsize=20mb,
         filegrowth=10%
       )
       log on
      (  name='Ch_log',
          filename='d:\data\Ch.ldf',
          size=1mb,
          maxsize=5mb,
         filegrowth=1mb
       )

      2、将一个数据文件Ch1(初始大小为10MB，最大尺寸为25MB，
       增长速度为5MB)和一个事务日志文件Ch2(初始大小为2MB，
         最大尺寸为5MB，增长速度为1MB)添加到Ch数据库中。
        
          alter database ch
           add file
          (  name='Ch1',
          filename='d:\data\Ch1.mdf',
          size=10mb,
          maxsize=25mb,
         filegrowth=5mb
         )

       go


         alter database ch
           add log file
       
         (  name='Ch2',
          filename='d:\data\Ch2.ldf',
          size=2mb,
          maxsize=5mb,
         filegrowth=1mb
         )



3、利用语句查看系统数据库和Ch数据库。

         exec  sp_helpdb  
         exec  sp_helpdb  ch
4、修改ch2的名字为ch2_log。
        alter database ch
           modify file
            ( name=ch2,
               newname=ch2_log)
 名称 'ch2_log' 已设置。
5、将ch1的大小改为30mb。
         alter database ch
           modify file

        (  name='Ch1',
            size=30mb
         )
6、移除ch1。
        alter database ch
           remove file  ch1

		   文件'ch1' 已删除。
7、添加文件组ch3。

        alter database ch
           add  filegroup  ch3
        
8、删除文件组ch3。
           alter database ch
           remove   filegroup  ch3
		   --文件组'ch3' 已删除。
9、删除创建的数据库Ch。
          drop database ch

----------------------------
P234  
c.
create table salary1
(
  employeeid  char(6)  primary key,
  income  float  not null,
  outcome  float  not null,
  actincome as income-outcome persisted
)

d.
alter table employees
 add constraint  def_1  default  0  for sex
 
 e.
 create table #test
 (
  id  char(4)  not null,
  name  char(10)
  )
  
  select * from #test


  第三章  
  实验题目：

USE test1
GO
1、创建T表（教师基本情况表）
(TNO,TN,SEX,AGE,PROF,SAL,DEPT)分别表示教师的编号，姓名，性别，年龄，职称，工资，系别。TC表（教师授课表）的结构为TC(TNO,CNO)分别表示教师的编号，课程编号



CREATE TABLE t
(
	TNO char(10) NOT NULL PRIMARY KEY,/*教师编号字段*/
	TN char(10) NULL,/*教师姓名字段*/
	SEX char(2) NULL,/*教师性别字段*/
	AGE int NULL,/*教师年龄字段*/
	PROF char(20) NULL,/*教师职称字段*/
	SAL int NULL,/*教师工资字段*/
	DEPT char(10) NULL,/*教师所在系别字段*/ 
)
GO
INSERT INTO t VALUES('0001','张老师','男',41,'副教授',2200,'电力系')
GO
INSERT INTO t VALUES('0002','张益琳','女',32,'讲师',1500,'动力系')
GO

CREATE TABLE TC
(
	TNO char(10) NOT NULL,/*教师编号字段*/
	CNO char(10) NULL,/*教师执教课程字段*/ 
)
GO
INSERT INTO tc VALUES('0001','C5')
GO
2、把所有教师的工资提高到原工资的1.2倍。
 update t
 set sal=sal*1.2
 select * from t

3、 删除张益琳教师的记录。
delete 
from t
where tn='张益琳'

4.增加一个tel char(20)列。
alter table t
add tel char(20)

5.将工资字段属性改为float型。
alter table t
alter column sal float


6.删除tel字段。
alter table t
drop column tel
7.将张老师的年龄改为50岁。
 update t
 set AGE=50
 where tn='张老师'



8.将张老师的执教课程字段改为C10.
select * from tc

update tc
set cno='c10'     ----字符串的大小写
 where tno=
  (select tno
  from t
  where   tn='张老师')

  select * from tc
  where cno='C10'-------字符串比对不区分大小写

9.将TC表改为TC_01表。

exec sp_rename  'tc','TC_01'  

10.将系别字段命名为sdept.
exec sp_rename  't.dept','sdept'


alter table
modify
(
  name='',
  newname=

)




11.删除TC_01表.
-------------------------------
实验4

into

select * into  cjb2
from cjb
where 1>2


(3)
  use YGGL
  select name,address
  from employees
  where birthday>'1971-1-1'
  
 select employeeid,name
 from employees
 where department in
 (select departmentid
  from departments
 where departmentname='财务部')
 
 (5)
   select name,address,收入水平=
   case 
     when income<2000 then  '低收入'
     when income>3000 then  '高收入'
     else  '中等收入'
    end
   from employees,salary
   where employees.employeeid=salary.employeeid
   
  (7)
    select MAX(income-outcome),MIN(income-outcome)
    from salary
    where employeeid in
     (select employeeid
       from employees
        where department in
          (select departmentid
            from departments
             where departmentname='财务部'))
             
   (10)
    select employeeid,name into  男员工表1
    from employees
    where sex='男'
    
    
    select MAX(cj),AVG(cj)
    from cjb
    where xh='081101'
    
    select xh,cj
    from cjb
    where xh='081101'
    compute MAX(cj),AVG(cj)
    
    
    select xh,cj
    from cjb
    order by xh
    compute MAX(cj),AVG(cj) by xh
    
    
    
    2.子查询
   (1) 
     select *
     from employees
     where  employeeid in
        (select employeeid
          from salary
            where income<2500)    
    
    (2)
      select name
      from employees,salary,departments
      where employees.employeeid=salary.employeeid
      and employees.department=departments.departmentid
      and departmentname='研发部' 
      and income>
     ( select MAX(income)
      from salary
      where employeeid in
         (select employeeid
           from employees
            where department in
              (select departmentid
               from departments
                where departmentname='财务部')))
    
    ------------------------
      select name
      from employees
      where employeeid in
      (select employeeid
      from salary
      where employeeid in
         (select employeeid
          from employees
          where department in
            (select departmentid
              from departments
              where departmentname ='研发部'))
      and income>
     ( select MAX(income)
      from salary
      where employeeid in
         (select employeeid
           from employees
            where department in
              (select departmentid
               from departments
                where departmentname='财务部'))))
    
    (3)
    select name
    from employees
    where birthday<all
     (select birthday
     from employees
     where department in
       (select departmentid
       from departments
       where departmentname='研发部') )      
    
    
    
    5.(1)
    按照硕士  本科  大专 排序
    
    select *
    from employees
    order by 
    (case  education
      when '硕士' then '3'
      when '本科' then '2'
      else '1'
     end) desc
    
  (3)
  select name,sex,[work year]
  from employees a
  order by 
   (select income-outcome
    from salary
    where salary.employeeid=a.employeeid) desc
    
   select  name,sex,[work year],income-outcome
   from employees,salary
   where salary.employeeid=employees.employeeid
   order by income-outcome desc
    
    
    
    
    
    
    
    
    
    
    
    
    