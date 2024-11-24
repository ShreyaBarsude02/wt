<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_number = $_POST['roll_number'];
    $name = $_POST['name'];

    $sql = "INSERT INTO students (roll_number, name) VALUES ('$roll_number', '$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration</h2>
    <form method="POST">
        <label for="roll_number">Roll Number:</label><br>
        <input type="text" name="roll_number" required><br><br>

        <label for="name">Name:</label><br>
        <input type="text" name="name" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
