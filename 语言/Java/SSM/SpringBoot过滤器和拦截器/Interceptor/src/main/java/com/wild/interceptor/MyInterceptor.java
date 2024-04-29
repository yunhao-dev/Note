package com.wild.interceptor;

import org.springframework.web.servlet.HandlerInterceptor;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.util.Objects;

/**
 * @description:
 * @Author: wild
 * @Date: 2024/4/29 0:40
 */

public class MyInterceptor implements HandlerInterceptor {
    @Override
    public boolean preHandle(HttpServletRequest request, HttpServletResponse response, Object handler) throws Exception {
        // 访问的IP
        String ip = request.getRemoteAddr();
        // 统计访问次数
        HttpSession session = request.getSession();
        Integer count = (Integer) session.getAttribute("count");
        count = Objects.isNull(count) ? 1 : ++count;
        System.out.println("ip:"+ip+"\tcount:"+count);
        session.setAttribute("count",count);
        // 放行
        return true;
    }
}
