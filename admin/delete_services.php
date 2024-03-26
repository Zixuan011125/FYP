<?php include("includes/functions.php");
//Get the parameters named deleteid from the URL
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    //first id is the name of id in the database
    $sql = "DELETE FROM services WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Delete service successfully!"); window.location.href = "services.php";</script>';
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
    <title>Delete Employees</title>
</head>

<body>

</body>

</html>
