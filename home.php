<?php include("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="includes/footer.css">
    <title>Home Page</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="images/bg1.png">
        </div>
        <div class="mySlides fade">
            <img src="images/bg2.png">
        </div>
        <div class="mySlides fade">
            <img src="images/bg3.jpg">
        </div>
    </div>

    <div class="container-booked-images">
        <img src="images/bg6.jpg">
        <div class="container-booked">  
            <h1>FOREVER18 Hair Salon</h1>
            <p>Book your appointments here</p>
            <a href="booking.php" class="button">Book Appointment</a>
        </div>
    </div>

    <div class="container-home">
        <h1>IT'S ALL ABOUT PASSION</h1>
        <h2>Fundamentally, Forever18 Hair Salon embodies a relentless pursuit of excellence and a commitment to
            achieving the highest standards.</h2>
    </div>

    <script src="js/home.js"></script>

    <?php include("includes/footer.php"); ?>

</body>

</html>