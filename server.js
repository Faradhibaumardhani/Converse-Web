const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Connect to MySQL
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'password',  // Ganti dengan password MySQL Anda
    database: 'converse_shop'
});

db.connect(err => {
    if (err) {
        console.error('Database connection failed:', err.stack);
        return;
    }
    console.log('Connected to the database.');
});

// Endpoint untuk menerima data form dan menyimpannya ke database
app.post('/submit-form', (req, res) => {
    const { name, address, city, number, size, color, notes } = req.body;
    const query = 'INSERT INTO orders (name, address, city, number, size, color, notes) VALUES (?, ?, ?, ?, ?, ?, ?)';

    db.query(query, [name, address, city, number, size, color, notes], (err, result) => {
        if (err) {
            res.status(500).send('Error saving to database');
            return;
        }
        res.send('Order submitted successfully!');
    });
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
