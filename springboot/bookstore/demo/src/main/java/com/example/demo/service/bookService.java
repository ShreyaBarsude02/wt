package com.example.demo.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowire;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.books;
import com.example.demo.repository.bookRepo;

@Service
public class bookService {
    @Autowired
    private bookRepo bookRepo;

    public List<books> getAllBooks(){
        return bookRepo.findAll();
    }

    public books addBook(books b){
        return bookRepo.save(b);
    }

    public void deteleBook (int id){
        bookRepo.deleteById(id);
    }
}
