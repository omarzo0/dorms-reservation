<?php

$student_name = $_POST['student_name'];
$student_gu_id = $_POST['student_gu_id'];
$student_program = $_POST['student_program'];
$studnet_gpa = $_POST['studnet_gpa'];
$Gender = $_POST['Gender'];
$current_city = $_POST['current_city'];
$current_address = $_POST['current_address'];
$National_Id_Photo = $_FILES['National_Id_Photo']['name'];
$GU_Id_Photo = $_FILES['GU_Id_Photo']['name'];
$Excuse_Checkbox = filter_input(INPUT_POST, "Excuse_Checkbox", FILTER_VALIDATE_BOOLEAN);
$Excuse_Input =  filter_input(INPUT_POST, "Excuse_Input", FILTER_VALIDATE_BOOLEAN);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "droms_reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$target_dir = "uploads/";
$target_files = array();
foreach ($_FILES["National_Id_Photo"]["tmp_name"] as $key => $tmp_name) {
    $target_file = $target_dir . basename($_FILES["National_Id_Photo"]["name"][$key]);
    move_uploaded_file($tmp_name, $target_file);
    array_push($target_files, $target_file);
}
$National_Id_Photo = implode(",", $target_files);

$target_files2 = array();
foreach ($_FILES["GU_Id_Photo"]["tmp_name"] as $key => $tmp_name) {
    $target_file2 = $target_dir . basename($_FILES["GU_Id_Photo"]["name"][$key]);
    move_uploaded_file($tmp_name, $target_file2);
    array_push($target_files2, $target_file2);
}
$GU_Id_Photo = implode(",", $target_files2);

$sql = "INSERT INTO students_info (student_name, student_gu_id, student_program, studnet_gpa, Gender, current_city, current_address , National_Id_Photo , GU_Id_Photo ,  Excuse_Checkbox ,Excuse_Input )
VALUES (?,?,?,?,?,?,?,?,?,?,?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sssssssssss",
    $student_name,
    $student_gu_id,
    $student_program,
    $studnet_gpa,
    $Gender,
    $current_city,
    $current_address,
    $National_Id_Photo,
    $GU_Id_Photo,
    $Excuse_Checkbox,
    $Excuse_Input
);

if (mysqli_stmt_execute($stmt)) {
    header('Location: login.html');
    exit;
} else {
    echo "Error inserting data: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
$conn->close();

?>