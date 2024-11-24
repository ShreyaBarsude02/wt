// package com.example.demo.controller;

// import org.springframework.web.bind.annotation.CrossOrigin;
// import org.springframework.web.bind.annotation.GetMapping;
// import org.springframework.web.bind.annotation.PathVariable;
// import org.springframework.web.bind.annotation.RestController;


// @RestController
// @CrossOrigin(origins = "http://localhost:3000")
// public class myController {

//     @GetMapping("/{units}")
//     public double createBill(@PathVariable("units") int units){
//         double bill = 0.0;  
//         if(units <= 50){
//             bill += units * 3.5;
//         }else if(units <= 150){
//             bill += (50 * 3.5) + ((units - 50) * 4.0);
//         }else if(units<= 250){
//             bill += (50 * 3.5)+(100 * 4.0) + ((units - 150) * 5.20);
//         }else if(units > 250){
//             bill += (50 * 3.5)+(100 * 4.0) +(100 * 5.20) + ((units - 250) * 6.50);
//         }
//         return bill;
//     }
// }


package com.example.demo.controller;

import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin(origins = "http://localhost:3000")
public class myController{

    @GetMapping("/{units}")
    public double createBill(@PathVariable("units") int units){
        double bill = 0.0;
        if(units <= 50){
            bill += units * 3.5;
        }else if(units <= 150){
            bill += (50 * 3.5) + ((units - 50) * 4.0);
        }else if(units <= 250){
            bill += (50 * 3.5)+(100 * 4.0) + ((units - 150 )* 5.20);
        }else{
            bill += (50 * 3.5)+(100 * 4.0) +(100 * 5.20) + ((units - 250) * 6.50);
        }
        return bill;
    }
}












