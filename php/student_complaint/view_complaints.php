<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php"); // Redirect to admin login if not logged in
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'college_complaints');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get complaints along with student names
$sql = "SELECT complaints.complaint_text, students.name AS student_name 
        FROM complaints 
        JOIN students ON complaints.student_id = students.student_id";
$result = $conn->query($sql);

echo "<h2>All Complaints</h2>";
if ($result->num_rows > 0) {
    while ($complaint = $result->fetch_assoc()) {
        echo "<p><strong>" . $complaint['student_name'] . ":</strong> " . $complaint['complaint_text'] . "</p>";
    }
} else {
    echo "No complaints found.";
}

$conn->close();
?>
