<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
    <h1>Login Page</h1>
    <form action="" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register_form.php">Register here</a></p>
    </div>
</body>
</html>

<?php
session_start();
include 'database.php';

if (isset($_POST['login'])) {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['matric'] = $row['matric'];
            $_SESSION['role'] = $row['role'];
            header("Location: display.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that matric number.";
    }
    $conn->close();
}
?>