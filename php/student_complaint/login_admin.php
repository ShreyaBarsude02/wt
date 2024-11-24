<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'college_complaints');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            header("Location: view_complaints.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No admin found with this username.";
    }

    $conn->close();
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register_admin.php">Go to Register</a></p>
