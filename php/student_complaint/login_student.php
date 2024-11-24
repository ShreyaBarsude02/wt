<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'college_complaints');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        if (password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['student_id'];
            header("Location: complaint_page.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No student found with this email.";
    }

    $conn->close();
}
?>

<form method="POST">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register_student.php">Go to Register</a></p>
