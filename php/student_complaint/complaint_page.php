<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaint_text = $_POST['complaint_text'];
    $student_id = $_SESSION['student_id'];

    $conn = new mysqli('localhost', 'root', '', 'college_complaints');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO complaints (student_id, complaint_text) VALUES ('$student_id', '$complaint_text')";

    if ($conn->query($sql) === TRUE) {
        echo "Complaint registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<form method="POST">
    Complaint: <textarea name="complaint_text" required></textarea><br>
    <button type="submit">Submit Complaint</button>
</form>
