<?php
session_start();
if (isset($_SESSION["id"])) {
    $conn = require __DIR__ . "/connect.php";
    $semester = $_POST['semester'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $Room_Type = $_POST['Room_Type'];
    $car = $_POST['car'];
    $personal_license = $_FILES['personal_license']['name'];
    $car_license = $_FILES['car_license']['name'];
    $Payment_Method = $_POST['Payment_Method'];
    $studentId = $_SESSION["id"];

    $target_dir = "uploads/";
    $target_files = array();
    for ($i = 0; $i < count($personal_license); $i++) {
        $target_file = $target_dir . basename($personal_license[$i]);
        move_uploaded_file($_FILES["personal_license"]["tmp_name"][$i], $target_file);
        array_push($target_files, $target_file);
    }
    $personal_license = implode(",", $target_files);

    $target_files2 = array();
    for ($i = 0; $i < count($car_license); $i++) {
        $target_file2 = $target_dir . basename($car_license[$i]);
        move_uploaded_file($_FILES["car_license"]["tmp_name"][$i], $target_file2);
        array_push($target_files2, $target_file2);
    }
    $car_license = implode(",", $target_files2);

    $sql = "INSERT INTO studnets_booking (studentId, semester, start_date, end_date, Room_Type, car, personal_license, car_license, Payment_Method)
            SELECT ?, ?, ?, ?, ?, ?, ?, ?, ?
            FROM DUAL
            WHERE NOT EXISTS (SELECT * FROM studnets_booking WHERE studentId = ? )";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssssssss",
        $studentId,
        $semester,
        $start_date,
        $end_date,
        $Room_Type,
        $car,
        $personal_license,
        $car_license,
        $Payment_Method,
        $studentId
    );

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('Location: homepage.php');
    exit;
}
?>
