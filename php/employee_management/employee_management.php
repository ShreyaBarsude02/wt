<?php
$conn = new mysqli('localhost', 'root', '', 'employee_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $position = $conn->real_escape_string($_POST['position']);
    $salary = $conn->real_escape_string($_POST['salary']);

    $sql = "INSERT INTO employees (name, email, position, salary) VALUES ('$name', '$email', '$position', '$salary')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employee added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>
<body>
    <h1>Employee Management</h1>

    <h2>Add New Employee</h2>
    <form action="employee_management.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br><br>

        <label for="salary">Salary:</label>
        <input type="number" step="0.01" id="salary" name="salary" required><br><br>

        <button type="submit">Add Employee</button>
    </form>

    <h2>Employee List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Salary</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['position']}</td>
                    <td>{$row['salary']}</td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>