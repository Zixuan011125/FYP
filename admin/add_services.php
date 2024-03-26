<?php include("includes/functions.php");

session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    //$cost = $_POST['cost'];

    //NOW() functions is used to directly insert the current date and time automatically without manually input
    $sql = "INSERT INTO services (name, date) VALUES ('$name', NOW())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // obtain the id
        $main_service_id = mysqli_insert_id($conn);

        // Set the main service id in session
        $_SESSION['main_service_id'] = $main_service_id;

        header("Location: services.php");
        exit();
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
    <link rel="stylesheet" href="css/add_services.css">
    <title>Add Services</title>
</head>

<body>
    <?php include("sidebar.php"); ?>

    <main class="main">
        <section id="content">
            <div class="container">
                <form method="post">
                    <div class="parent-form">
                        <div class="form">
                            <label for="name">Name: </label>
                            <input type="text" name="name" autocomplete="off" required>
                        </div>
                        <button type="submit" name="submit">Create</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>