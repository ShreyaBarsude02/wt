<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 50px;
        }
        form {
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input[type="number"], input[type="submit"] {
            margin: 10px 0;
            padding: 10px;
            width: 90%;
        }
    </style>
</head>
<body>
    <h1>Currency Converter</h1>
    <form method="POST">
        <label for="dollar">Enter amount in USD:</label><br>
        <input type="number" name="dollar" id="dollar" placeholder="Enter dollars" step="0.01" required><br>
        <input type="submit" value="Convert to INR">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dollar = $_POST["dollar"];
        $exchangeRate = 82.50;
        $rupees = $dollar * $exchangeRate;

        echo "<h2>Conversion Result:</h2>";
        echo "<p>\$$dollar USD = ₹" . number_format($rupees, 2) . " INR</p>";
    }
    ?>
</body>
</html>
