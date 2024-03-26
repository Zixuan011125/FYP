<?php include("includes/functions.php");

// Retrieve the date from the URL parameter
$date = $_GET['date'] ?? date('Y-m-d');

// Get all booked time slots for the specified date
$sql = "SELECT time FROM appointments WHERE date = '$date'";
$result = mysqli_query($conn, $sql);

// Create an array to store booked time slots
$bookedTimeSlots = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Append each booked time slot to the array
    $bookedTimeSlots[] = $row['time'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/timeSlot.css">
    <title>Time Slot</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <h1>Please choose an available time slot</h1>
        <div class="time-slots">
            <?php
            // Start from 11:00 am
            $startTime = strtotime('11:00');
            // End at 7:00 pm
            $endTime = strtotime('19:00');
            // Loop through each time slot (30-minute intervals)
            while ($startTime < $endTime) {
                // The first 2 line is for the purpose for determining the booked and available time slot
                $timeSlot = date('h:i A', $startTime);
                $timeSlotClass = in_array($timeSlot, $bookedTimeSlots) ? 'booked' : 'available';
                // add an <a> tag to direct the user when click for the time slot
                // echo '<a href="appointments.php?time=' . date('h:i A', $startTime) . '" class="time-slot">' . date('h:i A', $startTime) . '</a>';
                // echo '<a href="appointments.php?date=' . $date . '&time=' . date('h:i A', $startTime) . '" class="time-slot">' . date('h:i A', $startTime) . '</a>';
                
                // Check if the time slot is booked
                if ($timeSlotClass === 'available') {
                    // Generate a link for booking only if the time slot is available
                    echo '<a href="appointments.php?date=' . $date . '&time=' . date('h:i A', $startTime) . '" class="time-slot">' . date('h:i A', $startTime) . '</a>';
                } else {
                    // If the time slot is booked, display it as unclickable
                    echo '<span class="time-slot booked">' . date('h:i A', $startTime) . '</span>';
                }
                
                $startTime = strtotime('+30 minutes', $startTime);
            }
            ?>
        </div>
    </div>
</body>

</html>