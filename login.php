<?php

// Create connection
$conn = require __DIR__ . "/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    // Prepare and execute the database query for students
    $query = "SELECT * FROM students_signup WHERE gu_id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['student_password'];
        
        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Student login successful
            session_start();
            $_SESSION['id'] = $id;
           header('Location: homepage.php');
           exit();
        }
    }

    $id = $_POST["id"];
    // Prepare and execute the database query for admins
    $query = "SELECT * FROM Admin WHERE admin_id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['admin_password'];
        
        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Student login successful
            $_SESSION['id'] = $id;
            header("Location: admindashboard.php");
            exit();
        }
    }
       
    echo "Invalid email or password.";
}

mysqli_close($conn);
?>