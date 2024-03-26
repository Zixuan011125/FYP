<?php include("includes/functions.php");

session_start();

// Check if the user is logged in or not
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/bookingCss.css">
    <link rel="stylesheet" href="includes/footer.css">
    <title>Booking</title>
</head>

<body>
    <?php include("includes/header.php");?>
    <div class="container">
        <div class="calendar">
            <div class="header">
                <div class="month">Calendar</div>
                <div class="btns">
                    <!-- today -->
                    <div class="btn today">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <!-- previous month -->
                    <div class="btn prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <!-- next month -->
                    <div class="btn next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div class="weekdays">
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
                <div class="day">Sat</div>
            </div>
            <div class="days">
                <!-- render days with js -->
            </div>
        </div>
    </div>

    <?php include("includes/footer.php");?>

    <script src="js/bookingJs.js"></script>
</body>

</html>