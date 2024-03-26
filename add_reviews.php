<?php include("includes/functions.php");

if (isset($_POST["submit"])) {
	$name = $_POST['name'];
	$rating = $_POST['rating'];
	$review = $_POST['review'];

	$sql = "INSERT INTO reviews (name, rating, review, time) VALUES ('$name', '$rating', '$review', NOW())";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		echo '<script>alert("Review submit successfully");</script>';
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
	<link rel="stylesheet" href="css/add_reviews.css">
	<title>Form Reviews</title>
</head>

<body>

	<div class="wrapper">
		<h3>Write Your Review Here</h3>
		<form action="add_reviews.php" method="POST">
			<div class="rating">
				<input type="hidden" name="rating" id="ratingInput"> <!-- Hidden input field for rating -->
				<i class='bx bx-star star' style="--i: 0;"></i>
				<i class='bx bx-star star' style="--i: 1;"></i>
				<i class='bx bx-star star' style="--i: 2;"></i>
				<i class='bx bx-star star' style="--i: 3;"></i>
				<i class='bx bx-star star' style="--i: 4;"></i>
			</div>
			<div class="form-group">
				<label for="name">Name: </label>
				<input type="text" name="name" autocomplete="off" required>
			</div>
			<br>
			<div class="form-group">
				<textarea name="review" cols="30" rows="5" placeholder="Your review..." autocomplete="off"
					required></textarea>
			</div>
			<br>
			<div class="btn-group">
				<button type="submit" class="btn submit" name="submit">Submit</button>
				<button class="btn cancel">Cancel</button>
			</div>
		</form>
	</div>

	<script src="js/review.js"></script>

</body>

</html>