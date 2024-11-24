package com.example.demo.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.student;
import com.example.demo.repository.stuRepository;

@Service
public class stuService {
    @Autowired
    private stuRepository stuRepository;

    public student createStudent(student stu){
        return stuRepository.save(stu);
    }

    public List<student> getStudents(){
        return stuRepository.findAll();
    }
    
    public Optional<student> getStudent(int roll){
        return stuRepository.findById(roll);
    }

    public void deleteStudent(int roll){
        stuRepository.deleteById(roll);
    }
}
