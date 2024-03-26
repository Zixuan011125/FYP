<?php
include("includes/functions.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sub_services.css">
    <title>Sub Services</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div class="sub-services-container">
                <form method="post" action="add_sub_services.php">
                    <label for="main_service">Select Main Service:</label>
                    <select name="main_service" required>
                        <?php
                        // Fetch all main services
                        $sql = "SELECT * FROM services";
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any main services
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through each main service and add it to the dropdown list
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option disabled>No main services available</option>";
                        }
                        ?>
                    </select>

                    <div class="sub-service-row">
                        <div class="form">
                            <label for="name">Name:</label>
                            <input type="text" name="name[]" autocomplete="off" required>
                        </div>
                        <div class="form">
                            <label for="cost">Cost:</label>
                            <input type="text" name="cost[]" autocomplete="off" required>
                        </div>
                    </div>

                    <button type="submit" name="submit">Add Sub Service</button>
                </form>

            </div>
        </section>
    </main>

</body>

</html>