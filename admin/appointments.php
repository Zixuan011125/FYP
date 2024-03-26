<?php
// Connect to the database
include("includes/functions.php");

// Fetch all booked appointments from the database
// $sql = "SELECT * FROM appointments";
// $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointments.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>Booked Appointments</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <h2>Booked Appointments List</h2>
            <div class="appointments-container">
                <form action="appointments.php" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" class="search" value="<?php if (isset($_GET['search'])) {
                            echo $_GET['search'];
                        } ?>" placeholder="Search appointments">
                        <button type="submit" class="search-button">Search</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Services</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Setting the start from value
                        $start = 0;

                        // Setting the number of rows to display in a page
                        $rows_per_page = 4;

                        // Get the total number of rows
                        $records = "SELECT * FROM appointments";
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

                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $sql = "SELECT * FROM appointments WHERE CONCAT(name, email, phone) LIKE '%$search%' ORDER BY date, time LIMIT $start, $rows_per_page";
                        } else {
                            // If no search parameter is provided, use the regular SQl query
                            // Use order by to sort the list based on date and time
                            $sql = "SELECT * FROM appointments ORDER BY date, time LIMIT $start, $rows_per_page";
                        }

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            // Loop through each booked appointment and display in table rows
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['services'] . "</td>"; // Assuming services are stored as a comma-separated string
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
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
        </section>
    </main>
</body>

</html>