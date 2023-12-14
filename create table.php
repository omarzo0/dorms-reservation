<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "droms_reservation";

// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//////////////////////////////////////////////////
$sql = "CREATE TABLE studnets_booking (
semester VARCHAR(250),
start_date VARCHAR(250) ,
end_date VARCHAR (250) ,
Room_Type VARCHAR (250) NOT NULL,
car VARCHAR (250) ,
personal_license TEXT,
car_license TEXT,
Payment_Method VARCHAR (250) NOT NULL,
studentId VARCHAR(250) NOT NULL PRIMARY KEY,
student_username VARCHAR (250),
FOREIGN KEY (studentId) REFERENCES students_info (student_gu_id)
)";


if ($conn->query($sql) === TRUE) {
    echo "Table studnets_booking created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
//////////////////////////////////////////////////
$conn->close();
?>
