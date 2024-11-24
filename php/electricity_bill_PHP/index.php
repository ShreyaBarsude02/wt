<?php
$bill = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $units = $_POST['units'];

    if ($units <= 50) {
        $bill = $units * 3.50;
    } elseif ($units <= 150) {
        $bill = (50 * 3.50) + (($units - 50) * 4.00);
    } elseif ($units <= 250) {
        $bill = (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
    } else {
        $bill = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Electricity Bill Calculator</h1>
        <form method="POST" action="index.php">
            <label for="units">Enter Units Consumed:</label>
            <input type="number" id="units" name="units" required>
            <button type="submit">Calculate Bill</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result">
                <h2>Bill Details:</h2>
                <p>Total Units Consumed: <?php echo $units; ?> units</p>
                <p>Total Bill: Rs. <?php echo number_format($bill, 2); ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
