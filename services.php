<?php
include("includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services List</title>
    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="includes/footer.css">
    <link rel="stylesheet" href="css/services.css">
</head>

<body>
    <?php
    include("includes/header.php");
    ?>
    <div class="services-bg">
        <img src="images/bg5.jpg">
    </div>
    <div class="container-services">
        <h1>Services List</h1>
        <?php
        // Fetch all main services
        $mainServiceSql = "SELECT * FROM services";
        $mainServiceResult = mysqli_query($conn, $mainServiceSql);

        // Check if there are any main services
        if (mysqli_num_rows($mainServiceResult) > 0) {
            while ($mainServiceRow = mysqli_fetch_assoc($mainServiceResult)) {
                echo "<h3>Main Service: " . htmlspecialchars($mainServiceRow['name']) . "</h3>";

                // Fetch sub services for the current main service
                $mainServiceId = $mainServiceRow['id'];
                $subServiceSql = "SELECT * FROM sub_services WHERE main_service_id = '$mainServiceId'";
                $subServiceResult = mysqli_query($conn, $subServiceSql);

                // Check if there are any sub services
                if (mysqli_num_rows($subServiceResult) > 0) {
                    echo "<table>";
                    echo "<tr><th>Sub Service</th><th>Cost</th></tr>";
                    // Loop through each sub service
                    while ($subServiceRow = mysqli_fetch_assoc($subServiceResult)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($subServiceRow['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($subServiceRow['cost']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No sub services found for this main service.</p>";
                }
            }
        } else {
            echo "<p class='no-data'>No services found.</p>";
        }

        // Free result and close connection
        mysqli_free_result($mainServiceResult);
        mysqli_close($conn);
        ?>
    </div>
    <?php include("includes/footer.php") ?>
</body>

</html>