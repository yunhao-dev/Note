# HashMap 和 HashSet 区别

`HashSet` 底层就是基于 `HashMap` 实现的。（`HashSet` 的源码非常非常少，因为除了 `clone()`、`writeObject()`、`readObject()`是 `HashSet` 自己不得不实现之外，其他方法都是直接调用 `HashMap` 中的方法。

|                           HashMap                            |           HashSet            |
| :----------------------------------------------------------: | :--------------------------: |
|                        实现了Map接口                         |         实现Set接口          |
|                          存储键值对                          |          仅存储对象          |
|                   调用put()向map中添加元素                   | 调用add()方法向Set中添加元素 |
| HashMap`使用键（Key）计算 hashcode | `HashSet` 使用成员对象来计算 `hashcode` 值，对于两个对象来说 `hashcode` 可能相同，所以`equals()`方法用来判断对象的相等性 |                              |

