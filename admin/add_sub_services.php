<?php
include("includes/functions.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the selected main service ID from the form
    $main_service_id = $_POST['main_service'];

    // Loop through the submitted sub services data
    for ($i = 0; $i < count($_POST['name']); $i++) {
        // Get the name and cost of each sub service
        $name = $_POST['name'][$i];
        $cost = $_POST['cost'][$i];

        // Construct the SQL query to insert the current sub service
        $sql = "INSERT INTO sub_services (main_service_id, name, cost) VALUES ('$main_service_id', '$name', '$cost')";

        // Execute the SQL query
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    echo '<script>alert("New sub services inserted successfully"); window.location.href = "display_services.php";</script>';
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_sub_services.css">
    <title>Document</title>
</head>

<body>
    <div class="add-sub-services-container">
        <form method="post">
            <div id="sub-services-container" class="parent-form">
                <!-- Initial row for sub service details -->
                <div class="sub-service-row">
                    <div class="form">
                        <label for="name">Name: </label>
                        <input type="text" name="name[]" autocomplete="off" required>
                    </div>
                    <div class="form">
                        <label for="cost">Cost (RM): </label>
                        <input type="text" name="cost[]" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <!-- Button to add new sub service row -->
            <button type="button" id="add-sub-service">Add Sub Service</button>
            <button type="submit" name="submit">Create</button>
        </form>
    </div>


    <script src="js/add_sub_services.js"></script>

</body>

</html>