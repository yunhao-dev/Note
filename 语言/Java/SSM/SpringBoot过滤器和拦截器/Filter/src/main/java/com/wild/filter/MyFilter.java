package com.wild.filter;


import javax.servlet.*;
import javax.servlet.annotation.WebFilter;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.util.Objects;

/**
 * @description: 自定义过滤器，实现根据IP统计访问次数
 * @Author: wild
 * @Date: 2024/4/29 0:00
 */
@WebFilter(urlPatterns = "/*")
public class MyFilter implements Filter {
    @Override
    public void doFilter(ServletRequest servletRequest, ServletResponse servletResponse, FilterChain filterChain) throws IOException, ServletException, ServletException {
        // 访问的IP
        HttpServletRequest request = (HttpServletRequest) servletRequest;
        String ip = request.getRemoteAddr();
        // 统计访问次数
        HttpSession session = request.getSession();
        Integer count = (Integer) session.getAttribute("count");
        count = Objects.isNull(count) ? 1 : ++count;
        System.out.println("ip:"+ip+"\tcount:"+count);
        session.setAttribute("count",count);
        // 放行
        filterChain.doFilter(servletRequest,servletResponse);
    }
}
