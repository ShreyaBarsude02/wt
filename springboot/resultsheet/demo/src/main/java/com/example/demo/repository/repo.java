package com.example.demo.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.demo.entity.marks2;

@Repository
public interface repo extends JpaRepository<marks2 , String>{
    
}
