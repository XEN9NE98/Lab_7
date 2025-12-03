<?php
session_start();
include 'database.php';

if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $original_matric = $_POST['matric']; // Read-only field
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$original_matric'";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Update User</h1>
    <form action="" method="post">
        <label for="matric">Matric:</label>
        <input type="text" value="<?php echo $row['matric']; ?>" name="matric" readonly><br>

        <label for="name">Name:</label>
        <input type="text" value="<?php echo $row['name']; ?>" name="name" required><br>

        <label for="role">Access Level:</label>
        <select name="role" required>
            <option value="Student" <?php if ($row['role'] == 'Student') echo 'selected'; ?>>Student</option>
            <option value="Teacher" <?php if ($row['role'] == 'Teacher') echo 'selected'; ?>>Teacher</option>
        </select><br><br>
        <button type="submit" name="update">Update</button>
        <a href="display.php">Cancel</a>
    </form>
    </div>
</body>
</html>