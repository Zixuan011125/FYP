<?php include("includes/functions.php");

// Retrieve the date and time from the URL parameters

/* If $_GET['date'] is set and the date parameter is provided in the URL, 
    then it will return true and assigned to the variable $date
    If $_GET['date'] is not set and the date parameter is not provided in the URL,
    then it will return false and assigned to the empty string : '' */

$date = isset($_GET['date']) ? $_GET['date'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';

// If date and time are not set, retrieve them from the form submission
if (empty($date) && isset($_POST['date'])) {
    $date = $_POST['date'];
}
if (empty($time) && isset($_POST['time'])) {
    $time = $_POST['time'];
}

// Ensure date and time are in the correct format for database insertion
$date = date("Y-m-d", strtotime($date));

// 'H" for 24-hour format and 'h' for 12-hour format
$time = date("h:i A", strtotime($time));

// Print out the values to ensure they are correctly retrieved
/* echo "Date: " . $date . "<br>";
echo "Time: " . $time . "<br>"; */

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Array to store selected services
    $selectedServices = array();

    // Check if any services are selected
    if (!empty($_POST['services'])) {
        //Loop each services which are selected by the users
        foreach ($_POST['services'] as $service) {
            // Assign the services to the array (adding the service to the array)
            $selectedServices[] = $service;
        }
    }

    // For checking can display the output or not before insert the data into the database
    /*
    echo "Name: $name<br>";
    echo "Selected Services: <br>";
    foreach($selectedServices as $service){
        echo "- $service<br>";
    }
    */

    // Removed the $service outside the foreach loop
    // implode() function is used to concatenate selected services into a single string separated by 
    // commas before insert it into the database

    $sql = "INSERT INTO appointments (name, email, services, phone, date, time) VALUES ('$name', '$email', '" . implode(", ", $selectedServices) . "', '$phone', '$date', '$time')";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("Booked appointment successfully"); window.location.href = "home.php";</script>';
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointments.css">
    <title>Booking Time</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <h1>Please filled up this form for booking appointments</h1>
    <div class="container">
        <form action="appointments.php" method="post">
            <!-- Include hidden fields to pass date and time 
            <input type="hidden" name="date" value="<?php echo $date ?>">
            <input type="hidden" name="time" value="<?php echo $time ?>">-->
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" name="email" required>
            </div>

            <div class="form-group">
                <label>Services:</label>
                <?php
                // Fetch services from the database
                $sql = "SELECT * FROM services";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    // Output checkbox options for each service
                    while ($row = mysqli_fetch_assoc($result)) {
                        // need to add array for the services (services[] for storing multiple values)
                        echo '<div>
                            <label for="services' . $row['id'] . '">' . $row['name'] . '</label>
                            <input type="checkbox" name="services[]" value="' . $row['name'] . '">
                        </div>';
                    }
                }
                ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number: </label>
                <input type="text" name="phone" pattern="^0\d{2}-\d{7}$|^0\d{2}-\d{8}$"
                    title="Please enter a valid phone number in the format 0xx-xxxxxxx or 0xx-xxxxxxxx" required>
            </div>
            <div class="form-group">
                <label for="date">Date: </label>
                <input type="text" name="date" value="<?php echo $date ?>" readonly>
            </div>
            <div class="form-group">
                <label for="time">Time: </label>
                <input type="text" name="time" value="<?php echo $time ?>" readonly>
            </div>
            <div class="form-group">
                <input type="submit" value="Book Appointments" name="submit">
            </div>
        </form>
    </div>
</body>

</html>