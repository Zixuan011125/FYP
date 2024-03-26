<?php include("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/display_services.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>Display Services</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <main>
                <div class="display-services-container">
                    <button class="add-button" onclick="window.location.href='sub_services.php'">Add Sub
                        Service</button>
                    <?php
                    // Setting the start from value
                    $start = 0;

                    // Setting the number of rows to display in a page
                    $rows_per_page = 2;

                    // Get the total number of rows
                    $records = "SELECT * FROM services";
                    $recordsResult = mysqli_query($conn, $records);
                    $num_of_rows = $recordsResult->num_rows;

                    // Calculating the number of rows of a page
                    $pages = ceil($num_of_rows / $rows_per_page);

                    // If the user clicks on the pagination buttons we set a new starting point
                    if (isset($_GET['page-num'])) {
                        // subtract 1 as we count index at 0
                        $page = $_GET['page-num'] - 1;
                        $start = $page * $rows_per_page;
                    }

                    // Fetch all main services
                    $mainServiceSql = "SELECT * FROM services LIMIT $start, $rows_per_page";
                    $mainServiceResult = mysqli_query($conn, $mainServiceSql);

                    // Check if there are any main services
                    if ($mainServiceResult) {
                        while ($mainServiceRow = mysqli_fetch_assoc($mainServiceResult)) {
                            echo "<h3>Main Service: " . htmlspecialchars($mainServiceRow['name']) . "</h3>";

                            // Fetch sub services for the current main service
                            $mainServiceId = $mainServiceRow['id'];
                            $subServiceSql = "SELECT * FROM sub_services WHERE main_service_id = '$mainServiceId'";
                            $subServiceResult = mysqli_query($conn, $subServiceSql);

                            // Check if there are any sub services
                            if ($subServiceResult) {
                                echo "<table>";
                                echo "<tr><th>Sub Service</th><th>Cost</th><th>Action</th></tr>";
                                // Loop through each sub service
                                while ($subServiceRow = mysqli_fetch_assoc($subServiceResult)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($subServiceRow['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($subServiceRow['cost']) . "</td>";
                                    echo "<td>";
                                    echo "<button onclick=\"window.location.href='update_sub_services.php?id=" . $subServiceRow['id'] . "'\">Update</button>";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; // Non-breaking spaces for spacing
                                    echo "<button class='delete-button' onclick=\"deleteSubService(" . $subServiceRow['id'] . ")\">Delete</button>";
                                    echo "</td>";
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

                    <br>

                    <!-- Displaying the page info text -->
                    <div class="page-info">
                        <?php
                        if (!isset($_GET['page-num'])) {
                            $page = 1;
                        } else {
                            $page = $_GET['page-num'];
                        }
                        ?>
                        Showing
                        <?php echo $page ?> of
                        <?php echo $pages ?> pages
                    </div>

                    <br>

                    <!-- Displaying the pagination button -->
                    <div class="pagination">

                        <!-- Go to the first page -->
                        <a href="?page-num=1">First</a>

                        <!-- Go to the previous page -->
                        <?php
                        if (isset($_GET['page-num']) && $_GET['page-num'] > 1) {

                            ?>
                            <a href="?page-num=<?php echo $_GET['page-num'] - 1 ?>">Previous</a>
                            <?php
                        } else {
                            ?>
                            <a>Previous</a>
                            <?php
                        }

                        ?>

                        <!-- Output the page numbers -->
                        <div class="page-numbers">
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) {
                                ?>
                                <a href="?page-num=<?php echo $counter ?>">
                                    <?php echo $counter ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>

                        <!-- Go to the next page -->
                        <?php
                        if (!isset($_GET['page-num'])) {
                            ?>
                            <a href="?page-num=2">Next</a>
                            <?php
                        } elseif ($_GET['page-num'] >= $pages) {
                            ?>
                            <a>Next</a>
                            <?php
                        } else {
                            ?>
                            <a href="?page-num=<?php echo $_GET['page-num'] + 1 ?>">Next</a>
                            <?php
                        }
                        ?>

                        <!-- Go to the last page-->
                        <a href="?page-num=<?php echo $pages ?>">Last</a>

                    </div>
                </div>
            </main>

        </section>
    </main>

    <script src="js/display_services.js"></script>

</body>

</html>