<?php include("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customers.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>Customer List</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div class="customers-container">
                <!-- Button to add a new customer -->
                <button class="add-customers-button"><a href="add_customers.php">Add Customers</a></button>
                <form action="customers.php" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" class="search" value="<?php if (isset($_GET['search'])) {
                            echo $_GET['search'];
                        } ?>" placeholder="Search customers">
                        <button type="submit" class="search-button">Search</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Services</th>
                            <th>Date</th>
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
                        $records = "SELECT * FROM customers";
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
                            $sql = "SELECT * FROM customers WHERE CONCAT(name, email, phone) LIKE '%$search%' ORDER BY date LIMIT $start, $rows_per_page";
                        } else {
                            $sql = "SELECT * FROM customers ORDER BY date LIMIT $start, $rows_per_page";
                        }

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            // Fetch the data from the database
                            while ($row = mysqli_fetch_assoc($result)) {
                                $customerId = $row['id']; // Customer ID
                                $name = $row['name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $services = $row['services'];
                                $date = $row['date'];

                                // Split the services string into an array
                                $serviceArray = explode(', ', $services);
                                // Join the array elements into a string with comma separation
                                $serviceString = implode(', ', $serviceArray);

                                echo '<tr>
                            <td>' . $name . '</td>
                            <td>' . $email . '</td>
                            <td>' . $phone . '</td>
                            <td>' . $serviceString . '</td>
                            <td>' . $date . '</td>
                            <td class="actions-container">
                            <a href="update_customers.php?id=' . $customerId . '">Update</a> |
                            <a href="delete_customers.php?id=' . $customerId . '" onclick="return confirm(\'Are you sure you want to delete this customer?\')">Delete</a> | 
                            <a href="invoices.php?customer_id=' . $customerId . '">Generate Invoice</a>
                            </td>
                        </tr>';
                            }
                        } else {
                            echo '<tr><td>No customers found.</td></tr>';
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