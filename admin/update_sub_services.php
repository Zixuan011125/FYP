<?php
include("includes/functions.php");

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $subServiceId = $_GET['id'];

    // Fetch sub-service data from the database
    $sql = "SELECT * FROM sub_services WHERE id = '$subServiceId'";
    $result = mysqli_query($conn, $sql);

    // Check if sub-service exists
    if (mysqli_num_rows($result) == 1) {
        $subServiceData = mysqli_fetch_assoc($result);

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $cost = $_POST['cost'];

            // Update sub-service data in the database
            $sql = "UPDATE sub_services SET name='$name', cost='$cost' WHERE id='$subServiceId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<script>alert("Sub hair service updated successfully"); window.location.href = "display_services.php";</script>';
            } else {
                echo "Error updating sub hair service: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Sub hair service not found.";
    }
} else {
    echo "Sub hair service ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/update_sub_services.css">
    <title>Update Sub Service</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div class="update-sub-services-conotainer">
                <form method="post">
                    <div class="parent-form">
                        <div class="form">
                            <label for="name" class="form-label">Name: </label>
                            <input type="text" class="form-control" name="name" autocomplete="off" required
                                value="<?php echo isset($subServiceData['name']) ? htmlspecialchars($subServiceData['name']) : ''; ?>">
                        </div>
                        <div class="form">
                            <label for="cost" class="form-label">Cost: </label>
                            <input type="text" class="form-control" name="cost" autocomplete="off" required
                                value="<?php echo isset($subServiceData['cost']) ? htmlspecialchars($subServiceData['cost']) : ''; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>