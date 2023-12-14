<?php

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Student_Id = $_POST['Student_Id'];
$Gender = $_POST['Gender'];
$Room_Type = $_POST['Room_Type'];
$National_Id_Photo = $_FILES['National_Id_Photo']['name'];
$GU_Id_Photo = $_FILES['GU_Id_Photo']['name'];
$Card_number = $_POST['Card_number'];
$Card_type = $_POST['Card_type'];
$Expiry_date = $_POST['Expiry_date'];
$Cvv = $_POST['Cvv'];


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
for($i=0; $i<count($National_Id_Photo); $i++) {
    $target_file = $target_dir . basename($National_Id_Photo[$i]);
    move_uploaded_file($_FILES["National_Id_Photo"]["tmp_name"][$i], $target_file);
    array_push($target_files, $target_file);
}
$National_Id_Photo = implode(",", $target_files);

$target_files2 = array();
for($i=0; $i<count($GU_Id_Photo); $i++) {
    $target_file2 = $target_dir . basename($GU_Id_Photo[$i]);
    move_uploaded_file($_FILES["GU_Id_Photo"]["tmp_name"][$i], $target_file2);
    array_push($target_files2, $target_file2);
}
$GU_Id_Photo = implode(",", $target_files2);

$sql = "INSERT INTO students (Name, Student_Id, Email, Gender, Room_Type, National_Id_Photo, GU_Id_Photo)
VALUES (?,?,?,?,?,?,?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql))
{
    die (mysqli_error ($conn));
}

mysqli_stmt_bind_param($stmt, "sisssss",
$Name,
$Student_Id,
$Email,
$Gender,
$Room_Type,
$National_Id_Photo,
$GU_Id_Photo,
);
mysqli_stmt_execute($stmt);

header('Location: payment.html');

exit;
?>