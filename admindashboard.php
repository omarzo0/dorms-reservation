<?php
require_once('connect.php');

// Perform the database query
$query = "SELECT student_name, student_email ,studentId, semester, start_date , end_date , Room_Type ,car , personal_license , car_license ,Payment_Method
              FROM studnets_booking
              INNER JOIN students_info 
              ON studnets_booking.studentId = students_info.student_gu_id
              INNER JOIN students_signup
              ON students_info.student_gu_id = students_signup.gu_id";
$result = mysqli_query($conn, $query);

// Check if the query was executed successfully
if (!$result) {
    echo "No matching records found in Students Booking.<br><br>";
} else {
    // Count the number of output students
    $num_students = mysqli_num_rows($result);
}


// Export data to Excel
if (isset($_POST['export_excel'])) {
    // Function to clean data for Excel export
    function cleanData($str) {
        // Escape tab characters
        $str = str_replace("\t", "\\t", $str);
        // Escape newline characters
        $str = str_replace("\n", "\\n", $str);
        // Enclose data in double quotes
        $str = '"' . $str . '"';
        return $str;
    }

    // Set headers for Excel file download
    header("Content-Disposition: attachment; filename=Booked_Students.csv");
    header("Content-Type: text/csv");

    // Create a file pointer connected to the output stream
    $output = fopen("php://output", "w");

    // Write the column headers to the CSV file
    fputcsv($output, array('Student Name', 'Student Email','Student GU ID', 'Semester', 'Start Date' , 'End Date' ,'Room Type' ,'Car' ,'Personal License' , 'Car License' ,'Payment Method'));

    // Fetch and clean each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $clean_row = array_map('cleanData', $row);
        // Write the cleaned data to the CSV file
        fputcsv($output, $clean_row);
    }

    // Close the file pointer
    fclose($output);

    // Exit the script to prevent further output
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Students</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/framework.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="/logo.png">
</head>
<body>
    <div class="page d-flex">
        <div class="sidebar bg-white p-20 p-relative">
            <h3 class="p-relative txt-c mt-0"><img width="200px" src="download.png"></h3>
            <ul>
                <li>
                    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="admindashboard.php">
                        <i class="fa-regular fa-chart-bar fa-fw"></i>
                        <span>Booked Students</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="fullinfo.php">
                        <i class="fa-solid fa-gear fa-fw"></i>
                        <span>Students Full Information</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="signup_info.php">
                        <i class="fa-solid fa-gear fa-fw"></i>
                        <span>Student Signup Information</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="settings.html">
                        <i class="fa-solid fa-gear fa-fw"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="logout.php">
                        <i class="fa-solid fa-gear fa-fw"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content w-full">
            <!-- Start Head -->
            <div class="head bg-white p-15 between-flex">
            <div class="search p-relative">
                    <form method="post">
                        <button><a href="search_name.php">Search By Student's Name</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="search_id.php">Search By Student ID</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="search_semester.php">Search By Semester</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="search_date.php">Search By Date</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="search_car.php">Search By Car </a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="search_room.php">Search By Room Type </a></button>
                    </form>
                </div>
                <div class="search p-relative">
                <form method="post">
                    <input type="submit" name="export_excel" value="Print Excel Sheet">
                </form>
            </div>
            </div>
            <!-- End Head -->
            <h1 class="p-relative">Booked Students</h1>
            <div class="wrapper d-grid gap-20">
                <!-- Start End Media Stats Widget -->
            </div>
            <!-- Start Projects Table -->
            <div class="projects p-20 bg-white rad-10 m-20">
            <?php
            // Print out the total number of students
            if (isset($num_students)) {
                echo "<div class='total-students'>Total Students: " . $num_students . "</div>";
            }
            ?> <br><br>
                <div class="responsive-table">
                    <table class="fs-15 w-full">
                        <thead>
                            <tr>
                            <th>Student Name</th>
                            <th>Student Email</th>
                                <th>Student Id</th>
                                <th>Semester</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Room Type</th>
                                <th>Car</th>
                                <th>Personal License</th>
                                <th>Car License</th>
                                <th>Payment Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                <td><?php echo $row['student_name']; ?></td>
                                <td><?php echo $row['student_email']; ?></td>
                                    <td><?php echo $row['studentId']; ?></td>
                                    <td><?php echo $row['semester']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['Room_Type']; ?></td>
                                    <td><?php echo $row['car']; ?></td>
                                    <td>
                                        <?php
                                           $personal_license_images = explode(",", $row['personal_license']);
                                           foreach ($personal_license_images as $image) {
                                           echo "<a href='" . $image . "' target='_blank'><img src='" . $image . "' width='100' height='100' /></a>";
                                           }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                           $car_license_images = explode(",", $row['car_license']);
                                           foreach ($car_license_images as $image) {
                                           echo "<a href='" . $image . "' target='_blank'><img src='" . $image . "' width='780' height='500' /></a>";
                                           }
                                        ?>
                                    </td>

                                    <td><?php echo $row['Payment_Method']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
// Close the database connection
mysqli_close($conn);
?>
