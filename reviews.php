<?php
include("includes/functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reviews.css">
    <title>Review and Rating</title>
</head>

<body>
    <div class="review-container">
        <h2>Customer Reviews</h2>
        <?php

        // Retrieve data from the database
        $sql = "SELECT * FROM reviews";
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
                    <!-- Display submission time -->
                    <p class="timestamp">Submitted on:
                        <?php echo $row["time"]; ?>
                    </p>
                </div>

                <?php if(!empty($row['reply_review'])) : ?>
                    <div class="reply_review">
                        <h4>Our Reply: </h4>
                        <p><?php  echo $row['reply_review'] ?></p>
                    </div>
                <?php endif; ?>
                
                <?php
            }
        } else {
            echo "No reviews yet.";
        }
        ?>
    </div>
</body>

</html>