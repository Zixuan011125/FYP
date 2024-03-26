<?php include("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/employees.css">
    <link rel="stylesheet" href="css/pagination.css">
    <title>Employees List</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div class="employees-container">
                <button class="add-employees-button"><a href="add_employees.php">Add Employee</a></button>
                <form action="employees.php" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" class="search" value="<?php if (isset($_GET['search'])) {
                            echo $_GET['search'];
                        } ?>" placeholder="Search employees">
                        <button type="submit" class="search-button">Search</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Phone Number</th>
                            <th>Salary</th>
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
                        $records = "SELECT * FROM employees";
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
                            $sql = "SELECT * FROM employees WHERE name LIKE '%$search%' LIMIT $start, $rows_per_page";
                        } else {
                            $sql = "SELECT * FROM employees LIMIT $start, $rows_per_page";
                        }

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            //fetch the data from the database
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $age = $row['age'];
                                $phone = $row['phone'];
                                $salary = $row['salary'];
                                echo
                                    '<tr>
                            <td>' . $id . '</td>
                            <td>' . $name . '</td>
                            <td>' . $age . '</td>
                            <td>' . $phone . '</td>
                            <td>' . $salary . '</td>
                            <td>
                                <button class="btn btn-primary"><a href="update_employees.php?updateid=' . $id . '" style="text-decoration: none;">Update</a></button>
                                <button class="btn btn-danger"><a href="delete_employees.php?deleteid=' . $id . '" style="text-decoration: none;">Delete</a></button>
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