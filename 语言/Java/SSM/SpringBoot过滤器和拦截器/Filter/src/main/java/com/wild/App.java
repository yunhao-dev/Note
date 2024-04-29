package com.wild;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.web.servlet.ServletComponentScan;

/**
 * @description:
 * @Author: wild
 * @Date: 2024/4/28 23:57
 */
@SpringBootApplication
@ServletComponentScan(basePackages = "com.wild.filter")
public class App {
    public static void main(String[] args) {
        SpringApplication.run(App.class,args);
    }
}
