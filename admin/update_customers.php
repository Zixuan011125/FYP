<?php
include("includes/functions.php");

// Get the customer ID from the URL parameter
if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Fetch customer details from the database based on the ID
    $sql = "SELECT * FROM customers WHERE id=$customerId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Retrieve customer details
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $selectedServices = $row['services']; // Fetch selected services

        // Check if the form is submitted for updating
        if (isset($_POST['submit'])) {
            // Retrieve updated form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $services = isset($_POST['services']) ? $_POST['services'] : [];

            // Initialize an empty array to store the name of the selected services
            $selectedServicesNames = [];

            // Fetch the name of the selected services
            foreach ($services as $serviceId) {
                $sql = "SELECT name FROM sub_services WHERE id = '$serviceId'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $subServiceRow = mysqli_fetch_assoc($result);
                    $selectedServicesNames[] = $subServiceRow['name'];
                }
            }

            // Convert the array of the selected services into a comma-separated string
            $selectedServices = implode(', ', $selectedServicesNames);

            // Update customer details in the database
            $updateSql = "UPDATE customers SET name='$name', email='$email', phone='$phone', services='$selectedServices' WHERE id=$customerId";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                // Redirect to the customers.php page after successful update
                echo '<script>alert("Customer updated successfully!"); window.location.href = "customers.php";</script>';
                exit(); // Stop script execution
            } else {
                // Display error message if update fails
                echo "Error updating customer: " . mysqli_error($conn);
            }
        }
    } else {
        // If no customer found with the provided ID, display an error message
        echo "No customer found with the ID: $customerId";
    }
} else {
    // If the ID parameter is not provided in the URL, redirect to the customers.php page
    header("Location: customers.php");
    exit(); // Stop script execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update_customers.css">
    <title>Update Customer</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <br>
            <h2>Update Customer</h2>
            <form method="post">
                <div class="form">
                    <label for="name">Name: </label>
                    <input type="text" name="name" autocomplete="off" required value="<?php echo $name; ?>">
                </div>
                <div class="form">
                    <label for="email">Email: </label>
                    <input type="email" name="email" autocomplete="off" required value="<?php echo $email; ?>">
                </div>
                <div class="form">
                    <label for="phone">Phone: </label>
                    <input type="text" name="phone" autocomplete="off" required value="<?php echo $phone; ?>">
                </div>
                <div class="form">
                    <label for="services">Services: </label><br>
                    <?php
                    // Fetch all main services
                    $mainServiceSql = "SELECT * FROM services";
                    $mainServiceResult = mysqli_query($conn, $mainServiceSql);

                    // Check if there are any main services
                    if (mysqli_num_rows($mainServiceResult) > 0) {
                        while ($mainServiceRow = mysqli_fetch_assoc($mainServiceResult)) {
                            $mainServiceId = $mainServiceRow['id'];
                            echo "<div>";
                            echo "<strong>" . htmlspecialchars($mainServiceRow['name']) . "</strong><br>";

                            // Fetch sub services for the current main service
                            $subServiceSql = "SELECT * FROM sub_services WHERE main_service_id = '$mainServiceId'";
                            $subServiceResult = mysqli_query($conn, $subServiceSql);

                            // Check if there are any sub services
                            if (mysqli_num_rows($subServiceResult) > 0) {
                                while ($subServiceRow = mysqli_fetch_assoc($subServiceResult)) {
                                    // Check if the sub service is selected
                                    $isChecked = strpos($selectedServices, $subServiceRow['name']) !== false ? 'checked' : '';
                                    echo "<input type='checkbox' name='services[]' value='" . $subServiceRow['id'] . "' $isChecked>";
                                    echo htmlspecialchars($subServiceRow['name']) . "<br>";
                                }
                            } else {
                                echo "No sub services found for this main service.<br>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "No services found.";
                    }
                    ?>
                </div>
                <button type="submit" name="submit">Update Customer</button>
            </form>
        </section>
    </main>

</body>

</html>