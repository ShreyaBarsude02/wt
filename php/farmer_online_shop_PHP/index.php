<?php
include('config.php');
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Shopping</title>
</head>
<body>
    <h1>Welcome to Online Shopping</h1>
    <h2>Products</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <?php echo $row['product_name']; ?> - $<?php echo $row['price']; ?>
                <form method="POST" action="order.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="number" name="quantity" placeholder="Quantity" required>
                    <button type="submit">Order</button>
                </form>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
