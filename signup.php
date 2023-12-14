<?php
$student_username = $_POST['student_username'];
$gu_id = $_POST['gu_id'];
$student_email = $_POST['student_email'];
$student_password = $_POST['student_password'];
$confirm_password = $_POST['confirm_password'];

// Create connection
$conn = require __DIR__ . "/connect.php";

// Check for existing student ID
$query = "SELECT * FROM students_signup WHERE gu_id = '$gu_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<script type="text/javascript">';
    echo 'alert("Student ID already taken")';
    echo '</script>';
    exit;
}

// Hash the password
$hashedPassword = password_hash($student_password, PASSWORD_DEFAULT);
$confirmhashedPassword = password_hash($confirm_password, PASSWORD_DEFAULT);

// Insert the student data into the table
$sql = "INSERT INTO students_signup (student_username, gu_id, student_email, student_password, confirm_password)
VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssss",
    $student_username,
    $gu_id,
    $student_email,
    $hashedPassword,
    $confirmhashedPassword
);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('Location: student_info.html');
    exit;
} else {
    echo "Error occurred while inserting the student data.";
}

mysqli_stmt_close($stmt);
$conn->close();
?>