<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farmer_id = 1; // Assuming farmer ID is 1
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (farmer_id, product_name, description, price, quantity) VALUES ('$farmer_id', '$product_name', '$description', '$price', '$quantity')";
    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Product Description" required></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
