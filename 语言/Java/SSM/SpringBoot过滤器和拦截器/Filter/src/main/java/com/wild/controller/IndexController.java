package com.wild.controller;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

/**
 * @description:
 * @Author: wild
 * @Date: 2024/4/29 0:18
 */
@RestController
public class IndexController {
    @GetMapping("/filter")
    public String index(){
        return "hello,Filter!";
    }
}
