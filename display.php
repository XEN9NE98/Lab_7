<?php
session_start();
include 'database.php';

if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>User List</h1>

        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th colspan="2">Action</th>
            </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['matric'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['role'] . "</td>
                        <td>
                            <a href='update.php?matric=" . $row['matric'] . "'>Update</a>
                        </td>
                        <td>
                            <a href='delete.php?matric=" . $row['matric'] . "'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
    </table>
        <div style="text-align: center; margin-top: 20px;">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>