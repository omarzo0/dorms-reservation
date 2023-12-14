<?php
require_once('search temp/temp_id.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Full Information</title>
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
                        <label for="search">Search student ID</label>
                        <input class="p-10" type="search" placeholder="search student 'ID'" name="id" id="search">
                        <input type="submit" name="search" value="Search">
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
                                 
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>student Program</th>
                                <th>studnet GPA</th>
                                <th>Gender</th>
                                <th>Student's Current City</th>
                                <th>Student's Current Address</th>
                                <th>Student's National Id Photo</th>
                                <th>Student's GU Id Photo</th>
                                <th>Student's Excuse Checkbox</th>
                                <th>Student's Excuse Input</th>
                                <th>Student's Regester Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             if (isset($result_booking) && mysqli_num_rows($result_booking) > 0) {
                            while ($row = mysqli_fetch_assoc($result_booking)) {
                                ?>
                                <tr>
                                    
                                    <td><?php echo $row['student_gu_id']; ?></td>
                                    <td><?php echo $row['student_name']; ?></td>
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
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='11'>No matching records found.</td></tr>";
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