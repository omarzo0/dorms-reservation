<?php
session_start();

if (isset($_SESSION["id"])) {
    $mysqli = require __DIR__ . "/connect.php";
    $sql = "SELECT * FROM students_signup WHERE gu_id = ? ";

    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        // Handle case when prepared statement creation fails
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("s", $_SESSION["id"]);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Handle case when no user is found
        $row = null;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="dist/slick.js"></script>
    <script type="text/javascript" src="dist/jquery.scrollUp.js"></script>
  
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">

    <script type="text/javascript" src="dist/demo.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
</head>
    
<body>  
    
    
    <header class="tm-header">
        <img class="tm-logo" src="images/download.png" alt="Galala University logo">
        <nav class="tm-nav">
            <div>
                <ul>
                    <li class="tm-list"><a href="homepage.php">Home</a></li>
                    <li class="tm-list"><a href="rooms.html">Rooms</a></li>
                    <li class="tm-list"><a href="book.html">Booking</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <section class="tm-imgslider">
        <div class="main-heading">
            <h2 style="margin-top: 25px;">Home</h2>
            <p></p>
        </div>
        <div class="slider single">
            <div>
                <div class="tm-slider">
                    <img class="tm-sliderimage" src="images/9btdtu7xovh61.webp" height="400px" alt="">
                    <div class="tm-slidertext"></div>
                </div>
                <img src="images/back.png" class="left">
                <img src="images/next.png" class="right">
            </div>
        </div>
    </section>
    
    <div class="main-heading">
        <h2>rooms</h2>
        <p></p>
    </div>
    
    <section class="tm-roomsection">
        <div class="tm-room1">
            <img class="tm-roomimage" src="images/single_bed.jpeg">
            <p class="s">single room</p>
        </div>
        <div class="tm-room1">
            <img class="tm-roomimage" src="images/double_bed.jpg">
            <p>double room</p>
        </div>
        <div class="tm-room1">
            <img class="tm-roomimage" src="images/study_area.jpeg">
            <p>studying area</p>
        </div>
    </section>
    
    <div class="main-heading6">
        <h2>services</h2>
        <p></p>
    </div>
    
    <section class="tm-servicesection">
        <div class="tm-service">
            <img class="tm-serimage" src="images/bell.png">
            <div>
                <p class="b">Room Service</p>
                <p>Enjoy your stay with excellent and timely room service</p>
            </div>
        </div>
        <div class="tm-service">
            <img class="tm-serimage" src="images/coffee.png">
            <div>
                <p class="b">studying area</p>
                <p>Enjoy Free breakfast every morning</p>
            </div>
        </div>
    </section>
    
    <section class="tm-servicesection">
        <div class="tm-service">
            <img class="tm-serimage" src="images/car-front.png">
            <div>
                <p class="b">Free Parking</p>
                <p>No need to pay any extra charges to park your vehicle</p>
            </div>
        </div>
        <div class="tm-service">
            <img class="tm-serimage" src="images/gym-logo-vector-gym-logo-vector-template-132311313.jpg">
            <div>
                <p class="b">Free Gym</p>
                <p>Relax at the in-house Spa once every day of your stay</p>
            </div>
        </div>
    </section>
    
    <section class="tm-makeres">
        <div class="tm-res">
            <div class="tm-resbutton">
                <a href="book.html"><p>Make Reservation</p></a>
            </div>
        </div>
    </section>
    
    <footer class="tm-footer">
        <div class="tm-us">
            <p class="bold"></p>
            <p>All rights reserved &copy; 2023</p>
        </div>
       
        <div class="tm-address">
            <p>Galala Plateau, Attaka, Suez<br>
            hotline: 15888<br>
            Email: info@gu.edu.eg</p>    
        </div>
        <br/>
        
        <div class="tm-media">
            <a href="#"><img src="images/fb.png"></a>
            <a href="#"><img src="images/G.png"></a>
            <a href="#"><img src="images/twittr.png"></a>
            <a href="#"><img src="images/insta.png"></a>
        </div>        
    </footer>
</body>
</html>