package com.example.demo.controller;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
 
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.student;
import com.example.demo.service.stuService;


@RestController
@CrossOrigin(origins = "http://localhost:3000")
public class stuController {
    @Autowired
    private stuService stuService;

    @PostMapping("/")
    public student addStudent(@RequestBody student stu){
        return stuService.createStudent(stu);
    }

    @GetMapping("/")
    public List<student> getData(){
        return stuService.getStudents();
    }

    @GetMapping("/name/{roll}")
    public String name(@PathVariable("roll") int roll){
        Optional<student> stu = stuService.getStudent(roll);
        return stu.get().getName();
    }

    @DeleteMapping("/{roll}")
    public void deleteStudent(@PathVariable("roll") int roll){
        stuService.deleteStudent(roll);
    }
}
