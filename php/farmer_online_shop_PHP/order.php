<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $product_sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $product_result = mysqli_query($conn, $product_sql);
    $product = mysqli_fetch_assoc($product_result);

    $total_price = $product['price'] * $quantity;

    $customer_id = 1; 
    $order_sql = "INSERT INTO orders (customer_id, total_price) VALUES ('$customer_id', '$total_price')";
    if (mysqli_query($conn, $order_sql)) {
        $order_id = mysqli_insert_id($conn);

        $order_item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$product[price]')";
        if (mysqli_query($conn, $order_item_sql)) {
            echo "<h2>Order placed successfully!</h2>";
            echo "<h3>Order Summary:</h3>";
            echo "<p>Order ID: " . $order_id . "</p>";
            echo "<p>Product: " . $product['product_name'] . "</p>";
            echo "<p>Quantity: " . $quantity . "</p>";
            echo "<p>Total Price: $" . $total_price . "</p>";
        } else {
            echo "Error adding order items!";
        }
    } else {
        echo "Error placing order!";
    }
}
?>
