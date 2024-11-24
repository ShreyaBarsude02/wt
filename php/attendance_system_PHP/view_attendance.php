<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT attendance.attendance_date, students.roll_number, students.name, attendance.status 
        FROM attendance 
        JOIN students ON attendance.student_id = students.id 
        ORDER BY attendance.attendance_date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
</head>
<body>
    <h2>Attendance Records</h2>
    <table border="1">
        <tr>
            <th>Date</th>
            <th>Roll Number</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['attendance_date']; ?></td>
                    <td><?php echo $row['roll_number']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No records found</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
