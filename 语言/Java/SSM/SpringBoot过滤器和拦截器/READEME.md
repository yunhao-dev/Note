# 【SpringBoot中实现过滤器和拦械器】

1. 过滤器和拦截器简述
   过滤器Filter和拦截器Interceptor，在功能方面很类似，但在具体实现方面差距还是比较大的。

2. 过滤器的配置

   1. 自定义过滤器，实现Filter接凸（SpringBoot3开始，jakarta.servlet.Filter）
   2. 重写doFilter，实现过滤逻辑，酌情放行
   3. 创建注解，实现过滤的范围配置

3. 挡截器的配置

   1. 自定义拦截器，实现HandlerInterceptor接口
   2. 实现接口中的拦截方法（preHandle-请求执行前、postHandler-请求执行后、afterCompletion-视图染后）
   3. 创建配置类，实现webMvcconfigurer接口，重写addInterceptors方法

4. 总结

   1. Filter依赖于Servlet容器，属于Servlet规范的一部分，而Interceptor依赖于SpringMvc框架；

   2. Filter的生命周期由Servlet容器管理，而Interceptor通过Ioc容器来管理，可通过注入等方式来获取其Bean的实例

   3. Filter可拦截所有web资源（包括Jsp，Servlet，静态资源），而Interceptor则只拦截controller。