<?php
$Name = $_POST['Name'];
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

$sql = "INSERT INTO payment (Name,Card_number,Card_type,Expiry_date,Cvv )
VALUES (?,?,?,?,?)";

$stmt = mysqli_stmt_init($conn);
if ( ! mysqli_stmt_prepare($stmt, $sql))
{
    die (mysqli_error ($conn));
}
mysqli_stmt_bind_param($stmt, "sssis",
$Name,
$Card_number,
$Card_type,
$Expiry_date,
$Cvv,
);
mysqli_stmt_execute($stmt);
// Display the alert box 
echo '<script>alert("Your Recordes Had Been Saved Successfully")</script>';
header('Location: homepage.html');
exit;
?>