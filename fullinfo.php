<?php
require_once('connect.php');

// Perform the database query
$query = "SELECT * FROM students_info";
$result = mysqli_query($conn, $query);

// Check if the query was executed successfully
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
    header("Content-Disposition: attachment; filename=student_full_information.csv");
    header("Content-Type: text/csv");

    // Create a file pointer connected to the output stream
    $output = fopen("php://output", "w");


    fputcsv($output, array('Student Name', 'Student GU ID', 'Student Program', 'Student GPA', 'Gender ', 'Current City','Current Address','National ID Photo','GU ID Photo' ,'Excuse Checkbox', 'Excuse Input' ,'Register Time'));


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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Students Full Information</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/framework.css" />
    <link rel="stylesheet" href="css/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&#038;display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="x-icon" href="/logo.png">
</head>
<body>
<div class="page d-flex">
    <div class="sidebar bg-white p-20 p-relative">
        <h3 class="p-relative txt-c mt-0"><img width="200px" src="download.png"></h3>
        <ul>
            <li>
                <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="admindashboard.php">
                    <i class="fa-regular fa-chart-bar fa-fw"></i>
                    <span>Booked Students</span>
                </a>
            </li>
            <li>
                <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="fullinfo.php">
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
                        <button><a href="fullinfo_name.php">Search By Student's Name</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="fullinfo_id.php">Search By Student ID</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="fullinfo_program.php">Search By Program</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="fullinfo_gpa.php">Search By GPA</a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="fullinfo_gender.php">Search By Gender </a></button>
                    </form>
                </div>
                <div class="search p-relative">
                    <form method="post">
                        <button><a href="fullinfo_city.php">Search By City </a></button>
                    </form>
                </div>
                <div class="search p-relative">
                <form method="post">
                    <input type="submit" name="export_excel" value="Print Excel Sheet">
                </form>
            </div>
            </div>
        <!-- End Head -->
        <h1 class="p-relative">Students Full Information</h1>
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
                        <th>Student GU ID</th>
                        <th>Student Program</th>
                        <th>Student GPA</th>
                        <th>Gender</th>
                        <th>Current City</th>
                        <th>Current Address</th>
                        <th>National ID Photo</th>
                        <th>GU ID Photo</th>
                        <th>Excuse Checkbox</th>
                        <th>Excuse Input</th>
                        <th>Register Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['student_gu_id']; ?></td>
                            <td><?php echo $row['student_program']; ?></td>
                            <td><?php echo $row['studnet_gpa']; ?></td>
                            <td><?php echo $row['Gender']; ?></td>
                            <td><?php echo $row['current_city']; ?></td>
                            <td><?php echo $row['current_address']; ?></td>
                            <td>
                              <?php
                                  $National_Id_Photo = explode(",", $row['National_Id_Photo']);
                                  foreach ($National_Id_Photo as $image) {
                                  echo "<a href='" . $image . "' target='_blank'><img src='" . $image . "' width='100' height='100' /></a>";
                                  }
                                ?>
                            </td>
                            <td>
                               <?php
                                   $GU_Id_Photo = explode(",", $row['GU_Id_Photo']);
                                   foreach ($GU_Id_Photo as $image) {
                                   echo "<a href='" . $image . "' target='_blank'><img src='" . $image . "' width='780' height='500' /></a>";
                                   }
                                ?>
                            </td>
                            <td><?php echo $row['Excuse_Checkbox']; ?></td>
                            <td><?php echo $row['Excuse_Input']; ?></td>
                            <td><?php echo $row['Regester_time']; ?></td>
                        </tr>
                    <?php } ?>
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