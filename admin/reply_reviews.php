<?php
include("includes/functions.php");

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $review_id = $_POST['review_id'];
    $reply_review = $_POST['reply_review'];

    // Update the review with admin reply
    $sql = "UPDATE reviews SET reply_review='$reply_review' WHERE id='$review_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("Reply added successfully");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reviews.css">
    <link rel="stylesheet" href="css/pagination.css">
    <link rel="stylesheet" href="css/reply_reviews.css">
    <title>Administrator - Reply to Reviews</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div class="reply-container">
                <h2>Reply to Customer Reviews</h2>
                <?php
                // Setting the start from value
                $start = 0;

                // Setting the number of rows to display in a page
                $rows_per_page = 2;

                // Get the total number of rows
                $records = "SELECT * FROM reviews";
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

                // DESC for sort the date from the latest
                $sql = "SELECT * FROM reviews ORDER BY time DESC LIMIT $start, $rows_per_page";
                $result = mysqli_query($conn, $sql);

                // Check if there are reviews in the database
                if ($result) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="review">
                            <h3>
                                <?php echo $row["name"]; ?>
                            </h3>
                            <p>Rating:
                                <?php
                                // Output stars based on the rating value
                                $rating = $row["rating"];
                                for ($i = 0; $i < $rating; $i++) {
                                    // Unicode star character
                                    echo '<span class="stars">&#9733;</span>';
                                }
                                ?>
                            </p>
                            <p>
                                <?php echo $row["review"]; ?>
                            </p>

                            <!-- Display admin reply form -->
                            <form action="reply_reviews.php" method="post">
                                <input type="hidden" name="review_id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <textarea name="reply_review" cols="30" rows="3" placeholder="Reply to this review..."
                                        autocomplete="off" required></textarea>
                                </div>
                                <button type="submit" class="btn submit" name="submit">Submit Reply</button>
                            </form>

                            <!-- Display admin reply if exists -->
                            <?php if (!empty($row["reply_review"])): ?>
                                <div class="reply_review">
                                    <h4>Our Reply:</h4>
                                    <p>
                                        <?php echo $row["reply_review"]; ?>
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                } else {
                    echo "No reviews yet.";
                }
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
        </section>
    </main>

</body>

</html>