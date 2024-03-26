<?php include("includes/functions.php");

//Need to create $id variable
$id = $_GET['updateid'];

//to display the data into the form, not blank and update all information again
$sql = "SELECT * FROM employees WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$age = $row['age'];
$phone = $row['phone'];
$salary = $row['salary'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];

    //need condition of id = $id
    $sql = "UPDATE employees SET id=$id, name='$name', age='$age', phone='$phone', salary='$salary' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Update employee successfully"); window.location.href = "employees.php";</script>';
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
    <link rel="stylesheet" href="css/update_employees.css">
    <title>Update Employees</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div class="update-employees-container">
                <form method="post">
                    <div class="parent-form">
                        <div class="form">
                            <label for="name" class="form-label">Name: </label>
                            <input type="text" class="form-control" name="name" autocomplete="off" required value=<?php echo $name; ?>>
                        </div>
                        <div class="form">
                            <label for="age" class="form-label">Age: </label>
                            <input type="number" class="form-control" name="age" autocomplete="off" min="1" max="99"
                                required value=<?php echo $age; ?>>
                        </div>
                        <div class="form">
                            <label for="phone" class="form-label">Phone Number: </label>
                            <input type="text" class="form-control" name="phone" autocomplete="off"
                                pattern="^0\d{2}-\d{7}$|^0\d{2}-\d{8}$"
                                title="Please enter a valid phone number in the format 0xx-xxxxxxx or 0xx-xxxxxxxx"
                                required value=<?php echo $phone; ?>>
                        </div>
                        <div class="form">
                            <label for="salary" class="form-label">Salary (RM): </label>
                            <input type="number" class="form-control" name="salary" autocomplete="off" required
                                value=<?php echo $salary; ?>>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>

                    </div>
                </form>
            </div>
        </section>
    </main>

</body>

</html>