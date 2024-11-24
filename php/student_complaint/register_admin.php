<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli('localhost', 'root', '', 'college_complaints');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Admin registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register Admin</button>
</form>

<p>Already have an account? <a href="login_admin.php">Go to Login</a></p>
