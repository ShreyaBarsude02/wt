const express = require('express');
const path = require('path');
const app = express();
const port = 3000;

app.use(express.static(path.join(__dirname, 'public')));

app.use(express.urlencoded({ extended: true }));

app.post('/calculate', (req, res) => {
    const units = parseFloat(req.body.units);
    let bill = 0;

    if (isNaN(units) || units < 0) {
        return res.send('Please enter a valid number of units.');
    }

    if (units <= 50) {
        bill = units * 3.50;
    } else if (units <= 150) {
        bill = 50 * 3.50 + (units - 50) * 4.00;
    } else if (units <= 250) {
        bill = 50 * 3.50 + 100 * 4.00 + (units - 150) * 5.20;
    } else {
        bill = 50 * 3.50 + 100 * 4.00 + 100 * 5.20 + (units - 250) * 6.50;
    }

    res.send(`
        <h1>Electricity Bill Calculation</h1>
        <p>Total Units: ${units}</p>
        <p>Bill Amount: Rs. ${bill.toFixed(2)}</p>
        <a href="/">Back to Calculator</a>
    `);
});

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
