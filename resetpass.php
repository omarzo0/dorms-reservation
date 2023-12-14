<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "droms_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];

$query = "SELECT * FROM users WHERE email = '$email'";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Email exists.";
} else {
    echo "Email does not exist.";
}

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    $stmt = $db->prepare("UPDATE users SET password = :password WHERE email = :email");
    $stmt->bindParam(':password', $newPassword);
    $stmt->bindParam(':email', $email);

    try {
        $stmt->execute();
        echo "Password updated successfully.";
    } catch (PDOException $e) {
        echo "Error updating password: " . $e->getMessage();
    }
}
mysqli_close($connection);
?>
