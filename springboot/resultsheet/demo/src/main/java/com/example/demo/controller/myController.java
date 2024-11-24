package com.example.demo.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.data;
import com.example.demo.entity.marks2;
import com.example.demo.service.service;

@RestController
@CrossOrigin(origins = "http://localhost:3000")
public class myController {
    
    @Autowired
    private service service;

    @PostMapping("/")
    public marks2 getResult(@RequestBody data d){
        
        float s1 = (float) (d.getS1m1() * 0.3 + d.getS1m2() * 0.7);
        float s2 = (float) (d.getS2m1() * 0.3 + d.getS2m2() * 0.7);
        float s3 = (float) (d.getS3m1() * 0.3 + d.getS3m2() * 0.7);
        float s4 = (float) (d.getS4m1() * 0.3 + d.getS4m2() * 0.7);

        float total = (s1+s2+s3+s4) / 4;

        marks2 m = new marks2();
        m.setName(d.getName());
        m.setS1m1(d.getS1m1());
        m.setS1m2(d.getS1m2());
        m.setS2m1(d.getS2m1());
        m.setS2m2(d.getS2m2());
        m.setS3m1(d.getS3m1());
        m.setS3m2(d.getS3m2());
        m.setS4m1(d.getS4m1());
        m.setS4m2(d.getS4m2());
        m.setResult(total);

        return service.addResult(m);
    }

    @GetMapping("/")
    public List<marks2> getAll(){
        return service.getResults();
    }
}
