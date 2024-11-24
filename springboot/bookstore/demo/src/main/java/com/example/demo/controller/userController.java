package com.example.demo.controller;

import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.user;
import com.example.demo.service.userService;

@RestController
@CrossOrigin(origins = "http://localhost:3000")
public class userController {
    @Autowired
    private userService userService;

    @PostMapping("/signup")
    public user signup(@RequestBody user u){
        return userService.register(u);
    }

    @PostMapping("/login")
    public boolean login(@RequestBody user uu){

        Optional<user> u = userService.getUser(uu.getUsername());

        try {
            if (u.isPresent() && u.get().getPassword().equals(uu.getPassword())) {
                return true;
            }
        } catch (Exception e) {
          return false;
        }

        return false;
    }
}
