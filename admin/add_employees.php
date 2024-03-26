<?php include("includes/functions.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (name, age, phone, salary) VALUES ('$name', '$age', '$phone', '$salary')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        //echo "New employee inserted successfully";
        echo '<script>alert("New employee inserted successfully"); window.location.href = "employees.php";</script>';
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/add_employees.css">
    <title>Add Employees</title>
</head>

<body>
    <?php include("sidebar.php");?>
    <main class="main">
        <section id="content">
            <div class="add-employees-container">
                <!-- enctype specifies how the form data should be encoded -->
                <form action="add_employees.php" method="post" enctype="multipart/form-data">
                    <div class="parent-form">
                        <div class="form">
                            <label for="name" class="form-label">Name: </label>
                            <input type="text" class="form-control" name="name" autocomplete="off" required>
                        </div>
                        <div class="form">
                            <label for="age" class="form-label">Age: </label>
                            <input type="number" class="form-control" name="age" autocomplete="off" min="1" max="99"
                                required>
                        </div>
                        <div class="form">
                            <label for="phone" class="form-label">Phone Number: </label>
                            <input type="text" class="form-control" name="phone" autocomplete="off"
                                pattern="^0\d{2}-\d{7}$|^0\d{2}-\d{8}$"
                                title="Please enter a valid phone number in the format 0xx-xxxxxxx or 0xx-xxxxxxxx"
                                required>
                        </div>
                        <div class="form">
                            <label for="salary" class="form-label">Salary (RM): </label>
                            <input type="number" class="form-control" name="salary" autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Add</button>

                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>