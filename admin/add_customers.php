<?php include("includes/functions.php");

if (isset($_POST['submit'])) {
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
            $subServiceRow = mysqli_fetch_array($result);
            $selectedServicesNames[] = $subServiceRow['name'];
        }
    }

    // Convert the array of the selected services into a comma-separated string
    $selectedServices = implode(', ', $selectedServicesNames);

    $sql = "INSERT INTO customers (name, email, phone, services, date) VALUES ('$name', '$email', '$phone', '$selectedServices', NOW())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("New customer inserted successfully"); window.location.href = "customers.php";</script>';
    } else {
        echo "Error adding customer: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_customers.css">
    <title>Add Customer</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <form method="post">
                <div class="parent-form">
                    <div class="form">
                        <label for="name">Name: </label>
                        <input type="text" name="name" autocomplete="off" required>
                    </div>
                    <div class="form">
                        <label for="email">Email: </label>
                        <input type="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form">
                        <label for="phone">Phone: </label>
                        <input type="text" name="phone" autocomplete="off" required>
                    </div>

                    <br>
                    
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
                                        echo "<input type='checkbox' name='services[]' value='" . $subServiceRow['id'] . "'>";
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
                    <button type="submit" name="submit">Add Customer</button>
                </div>
            </form>
        </section>
    </main>

</body>

</html>