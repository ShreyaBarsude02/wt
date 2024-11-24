package com.example.demo.entity;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Data;

@Data
@Entity
@Table(name = "marks2")
public class marks2 {
    @Id
    String name;
    int s1m1 , s1m2 ,  s2m1, s2m2, s3m1, s3m2, s4m1, s4m2;
    float result;
 
}
