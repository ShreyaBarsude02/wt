const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

// Initialize Express app
const app = express();
app.use(cors());
app.use(bodyParser.json());

// Database connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Update with your MySQL username
    password: '', // Update with your MySQL password
    database: 'book_store',
});

// Check database connection
db.connect((err) => {
    if (err) {
        console.error('Database connection error:', err);
        return;
    }
    console.log('Connected to MySQL');
});

// Routes
// User Registration
app.post('/register', (req, res) => {
    const { name, email, password } = req.body;
    const query = `INSERT INTO users (name, email, password) VALUES (?, ?, ?)`;
    db.query(query, [name, email, password], (err) => {
        if (err) {
            console.error(err);
            return res.status(500).send('Error registering user');
        }
        res.send('User registered successfully');
    });
});

// User Login
app.post('/login', (req, res) => {
    const { email, password } = req.body;
    const query = `SELECT * FROM users WHERE email = ? AND password = ?`;
    db.query(query, [email, password], (err, results) => {
        if (err) {
            console.error(err);
            return res.status(500).send('Error logging in');
        }
        if (results.length === 0) {
            return res.status(401).send('Invalid credentials');
        }
        res.send('Login successful');
    });
});

// Get Catalogue
app.get('/catalogue', (req, res) => {
    const query = `SELECT * FROM books`;
    db.query(query, (err, results) => {
        if (err) {
            console.error(err);
            return res.status(500).send('Error fetching books');
        }
        res.json(results);
    });
});

// Start server
app.listen(5000, () => {
    console.log('Server running on http://localhost:5000');
});
