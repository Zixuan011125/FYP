<?php
include("includes/functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view_invoices.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>View Invoices</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
        <h2>Generated Invoices</h2>
            <div class="view-invoices-container">
                <form action="view_invoices.php" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" class="search" value="<?php if (isset($_GET['search'])) {
                            echo $_GET['search'];
                        } ?>" placeholder="Search invoices">
                        <button type="submit" class="search-button">Search</button>
                    </div>
                </form>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Customer Name</th>
                            <th>Total Cost</th>
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
                        $records = "SELECT * FROM invoices";
                        $recordsResult = mysqli_query($conn, $records);
                        $num_of_rows = $recordsResult->num_rows;

                        // Calculating the number of rows of a page
                        $pages = ceil($num_of_rows / $rows_per_page);

                        // If the user clicks on the pagination buttins we set a new starting point
                        if (isset($_GET['page-num'])) {
                            // subtract 1 as we count index at 0
                            $page = $_GET['page-num'] - 1;
                            $start = $page * $rows_per_page;
                        }

                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $sql = "SELECT * FROM invoices WHERE invoices_number LIKE '%$search%' ORDER BY date LIMIT $start, $rows_per_page";
                        } else {
                            $sql = "SELECT * FROM invoices ORDER BY date LIMIT $start, $rows_per_page";
                        }

                        $result = mysqli_query($conn, $sql);

                        /* 
                            To fetch the name of the customer from the database table instead of customer Id (foreign key),
                            need to perform an additional query within the loop to retrieve the customer's name based on 
                            their respective ID
                        */
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $customer_sql = "SELECT name FROM customers WHERE id = " . $row['customer_id'];
                                $customer_result = mysqli_query($conn, $customer_sql);
                                $customer_row = mysqli_fetch_assoc($customer_result);
                                $customer_name = $customer_row['name'];
                                echo '<tr>
                            <td>' . $row['invoices_number'] . '</td>
                            <td>' . $customer_name . '</td>
                            <td>RM ' . $row['total_cost'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td class="actions-container"><a href="view_invoices_details.php?invoice_id=' . $row['id'] . '">View Details</a></td>
                        </tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No invoices found.</td></tr>';
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