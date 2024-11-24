package com.example.demo.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.marks2;
import com.example.demo.repository.repo;

@Service
public class service {
    
    @Autowired
    private repo repo;

    public marks2 addResult(marks2 m){
        return repo.save(m);
    }

    public List<marks2> getResults(){
        return repo.findAll();
    }

}
