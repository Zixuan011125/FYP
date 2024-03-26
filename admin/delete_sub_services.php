<?php include("includes/functions.php");

// Check if the sub service ID is proviced in the URL
if (isset($_GET['id'])) {
    // $_GET['id'] will retrieve the ID values from the URL parameter named 'id'
    // $sub_services_id will contain the ID of the sub services that we want to delete
    $sub_service_id = $_GET['id'];

    $sql = "DELETE FROM sub_services WHERE id = '$sub_service_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: display_services.php");
        exit();
    } else {
        echo "Error: Unable to delete the hair services";
    }
} else {
    // If sub service ID is not provided in the URL, redirect to the page where sub services are displayed
    header("Location: display_services.php");
    exit();
}

?>