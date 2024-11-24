<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance_date = $_POST['attendance_date'];
    $students = $_POST['students'];

    foreach ($students as $student_id) {
        $status = isset($_POST['status'][$student_id]) ? 'Present' : 'Absent';
        $sql = "INSERT INTO attendance (student_id, attendance_date, status) VALUES ('$student_id', '$attendance_date', '$status')";
        $conn->query($sql);
    }

    echo "Attendance marked successfully!";
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Attendance</title>
</head>
<body>
    <h2>Mark Attendance</h2>
    <form method="POST">
        <label for="attendance_date">Attendance Date:</label><br>
        <input type="date" name="attendance_date" required><br><br>

        <h3>Students:</h3>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while($row = $result->fetch_assoc()): ?>
                    <li>
                        <input type="checkbox" name="status[<?php echo $row['id']; ?>]" value="Present">
                        <label><?php echo $row['roll_number'] . " - " . $row['name']; ?></label>
                        <input type="hidden" name="students[]" value="<?php echo $row['id']; ?>">
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No students found.</p>
        <?php endif; ?>

        <button type="submit">Submit Attendance</button>
    </form>
</body>
</html>
