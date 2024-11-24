const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// MySQL Database connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '', // Update with your MySQL password
    database: 'college_complaints',
});

db.connect((err) => {
    if (err) {
        console.error('Database connection error:', err);
        return;
    }
    console.log('Connected to MySQL');
});

// Routes
// Login
app.post('/login', (req, res) => {
    const { email, password } = req.body;
    const query = `SELECT * FROM users WHERE email = ? AND password = ?`;
    db.query(query, [email, password], (err, results) => {
        if (err) return res.status(500).send('Error logging in');
        if (results.length === 0) return res.status(401).send('Invalid credentials');
        res.json(results[0]); // Send user data
    });
});

// Register complaint
app.post('/complaints', (req, res) => {
    const { user_id, title, description } = req.body;
    const query = `INSERT INTO complaints (user_id, title, description) VALUES (?, ?, ?)`;
    db.query(query, [user_id, title, description], (err) => {
        if (err) return res.status(500).send('Error submitting complaint');
        res.send('Complaint submitted successfully');
    });
});

// Get all complaints (Admin only)
app.get('/complaints', (req, res) => {
    const query = `SELECT complaints.id, users.email, complaints.title, complaints.description, complaints.status, complaints.created_at 
                   FROM complaints 
                   JOIN users ON complaints.user_id = users.id`;
    db.query(query, (err, results) => {
        if (err) return res.status(500).send('Error fetching complaints');
        res.json(results);
    });
});

// Start server
app.listen(5000, () => {
    console.log('Server running on http://localhost:5000');
});
