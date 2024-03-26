<?php include("includes/functions.php");

//Need to create $id variable
$id = $_GET['updateid'];

//to display the data into the form, not blank and update all information again
$sql = "SELECT * FROM services WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
//$cost = $row['cost'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    //$cost = $_POST['cost'];

    //need condition of id = $id
    $sql = "UPDATE services SET id=$id, name='$name' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("New service updated successfully"); window.location.href = "services.php";</script>';
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update_services.css">
    <title>Update Services</title>
</head>

<body>
    <?php include("sidebar.php");?>
    <main class="main">
        <section id="content">
            <div class="service-container">
                <form method="post">
                    <div class="parent-form">
                        <div class="form">
                            <label for="name">Name: </label>
                            <input type="text" name="name" autocomplete="off" required value="<?php echo $name; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>