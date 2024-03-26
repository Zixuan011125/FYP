<?php include("includes/functions.php");

// Get the parameter named id from the URL
if(isset($_GET['id'])){

     // Sanitize the input to prevent SQL injection
    // $customerId = mysqli_real_escape_string($conn, $_GET['id']);

    $customerId = $_GET['id'];

    $sql = "DELETE FROM customers WHERE id=$customerId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("Delete customers successfully!"); window.location.href = "customers.php";</script>';
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
    <title>Delete Customer</title>
</head>
<body>
    
</body>
</html>