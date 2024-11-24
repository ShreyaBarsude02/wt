<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'restaurant';
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->query("
    CREATE TABLE IF NOT EXISTS food_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price FLOAT NOT NULL
    )
");

$conn->query("
    CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(255) NOT NULL,
        food_id INT NOT NULL,
        quantity INT NOT NULL,
        total_price FLOAT NOT NULL,
        FOREIGN KEY (food_id) REFERENCES food_items(id)
    )
");

$conn->query("
    INSERT INTO food_items (name, price) VALUES
    ('Pizza', 12.5),
    ('Burger', 8.0),
    ('Pasta', 10.0),
    ('Salad', 5.5)
    ON DUPLICATE KEY UPDATE id=id
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    $result = $conn->query("SELECT price FROM food_items WHERE id = $food_id");
    $food = $result->fetch_assoc();
    $total_price = $food['price'] * $quantity;

    $conn->query("
        INSERT INTO orders (customer_name, food_id, quantity, total_price)
        VALUES ('$customer_name', $food_id, $quantity, $total_price)
    ");
}

$food_items = $conn->query("SELECT * FROM food_items");
$orders = $conn->query("
    SELECT o.id, o.customer_name, f.name AS food_name, o.quantity, o.total_price
    FROM orders o
    JOIN food_items f ON o.food_id = f.id
");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Order Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .form-section, .list-section {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>Restaurant Food Order Management</h1>
</header>
<div class="container">
    <div class="form-section">
        <h2>Add New Order</h2>
        <form method="POST">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <label for="food_id">Food Item:</label>
            <select id="food_id" name="food_id" required>
                <?php while ($row = $food_items->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?> - $<?= $row['price'] ?></option>
                <?php endwhile; ?>
            </select>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
            <button type="submit" class="button">Add Order</button>
        </form>
    </div>
    <div class="list-section">
        <h2>Order List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Food Item</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['customer_name'] ?></td>
                        <td><?= $order['food_name'] ?></td>
                        <td><?= $order['quantity'] ?></td>
                        <td>$<?= $order['total_price'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
