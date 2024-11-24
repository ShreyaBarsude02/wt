package com.example.demo.service;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.user;
import com.example.demo.repository.userRepo;

@Service
public class userService {
    @Autowired
    private userRepo userRepo;

    public user register(user u){
        return userRepo.save(u);
    }

    public Optional<user> getUser(String username){
        return userRepo.findById(username);
    }
}
