<?php
require_once('connect.php');

// Check if the form is submitted
if(isset($_POST['search'])) {
    $id = $_POST['id'];

    // Query the students_booking table
    $query = "SELECT *
    FROM studnets_booking
    INNER JOIN students_info 
    ON studnets_booking.studentId = students_info.student_gu_id
    INNER JOIN students_signup
    ON students_info.student_gu_id = students_signup.gu_id
     WHERE studentId = '$id'";
    $result_booking = mysqli_query($conn, $query);

    // Check if the query was executed successfully
    if (!$result_booking) {
        echo "No matching records found in Students Booking.<br><br>";
    } else {
        // Count the number of output students
        $num_students = mysqli_num_rows($result_booking);
    }
}

// Close the database connection
mysqli_close($conn);
?>