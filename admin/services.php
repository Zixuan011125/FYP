<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>Services</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <main>
                <div class="services-container">
                    <button class="add-services-button"><a href="add_services.php">Add Services</a></button>
                    <form action="services.php" method="GET">
                        <div class="search-container">
                            <input type="text" name="search" class="search" value="<?php if (isset($_GET['search'])) {
                                echo $_GET['search'];
                            } ?>" placeholder="Search services">
                            <button type="submit" class="search-button">Search</button>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Creation Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Setting the start from value
                            $start = 0;

                            // Setting the number of rows to display in a page
                            $rows_per_page = 4;

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

                            if (isset($_GET['search'])) {
                                $search = $_GET['search'];
                                // $sql = "SELECT * FROM services LIMIT $start, $rows_per_page";
                                $sql = "SELECT * FROM services WHERE name LIKE '%$search%' LIMIT $start, $rows_per_page";
                            } else {
                                // If no search parameter is provided, use the regular SQL query
                                $sql = "SELECT * FROM services LIMIT $start, $rows_per_page";
                            }

                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                //fetch the data from the database
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $date = $row['date'];
                                    echo '<tr>
                                            <td data-label="ID">' . $id . '</td>
                                            <td data-label="Name">' . $name . '</td>
                                            <td data-label="Creation Date">' . $date . '</td>
                                            <td data-label="Actions">
                                                <button class="btn btn-primary"><a href="update_services.php?updateid=' . $id . '" class="text-light" style="text-decoration: none; color: white;">Update</a></button>
                                                <button class="btn btn-danger"><a href="delete_services.php?deleteid=' . $id . '" class="text-light" style="text-decoration: none; color: white;">Delete</a></button>
                                            </td>
                                        </tr>';
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
                        Showing <?php echo $page ?> of <?php echo $pages ?> pages
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

    <script src="includes/sidebar.js"></script>
</body>

</html>