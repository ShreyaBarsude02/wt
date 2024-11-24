package com.example.demo.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.demo.entity.books;

@Repository
public interface bookRepo extends JpaRepository<books , Integer>{
    
}
