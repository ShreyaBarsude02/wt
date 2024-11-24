const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

// Initialize express app
const app = express();

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Database connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'vit_results',
});

db.connect((err) => {
    if (err) {
        console.error('Database connection error:', err);
        process.exit(1);
    } else {
        console.log('Connected to MySQL');
    }
});

// API Routes
// Add student result
app.post('/students/add', (req, res) => {
    console.log(req.body)
    const { name, reg_no, subject1_mse, subject1_ese, subject2_mse, subject2_ese, subject3_mse, subject3_ese, subject4_mse, subject4_ese } = req.body;
    const query = `INSERT INTO students (name, reg_no, subject1_mse, subject1_ese, subject2_mse, subject2_ese, subject3_mse, subject3_ese, subject4_mse, subject4_ese) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;
    db.query(query, [name, reg_no, subject1_mse, subject1_ese, subject2_mse, subject2_ese, subject3_mse, subject3_ese, subject4_mse, subject4_ese], (err) => {
        if (err) {
            console.log(err.message)
            return res.status(500).send(err);
        }
        res.send({ message: 'Student added successfully' });
    });
});

// Fetch all student results
app.get('/students/results', (req, res) => {
    db.query('SELECT * FROM students', (err, results) => {
        if (err) {
            return res.status(500).send(err);
        }
        res.json(results);
    });
});

// Start the server
app.listen(5000, () => {
    console.log('Server running on http://localhost:5000');
});
