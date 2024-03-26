<?php
include("includes/header.php");
session_start();
//if login will be direct to the home.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="includes/headerCss.css">
</head>

<body>
    <div class="container">
        <?php
        //Check if the form is submitted
        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            //Validation of the form
            $errors = array();

            //Validate all field
            if (empty($username) || empty($email) || empty($password)) {
                array_push($errors, "All fields are required");
            }

            //Validate the email address
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }

            //Validate password
            if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
                array_push($errors, "Password must be at least 8 characters long and contain at least one uppercase letter, one number, and one special character");
            }

            include("includes/functions.php");

            //To avoid same username being registered
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $rowCountUsername = mysqli_num_rows($result);
            if ($rowCountUsername > 0) {
                array_push($errors, "Username already exist!");
            }

            //To avoid same email being registered
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCountEmail = mysqli_num_rows($result);
            if ($rowCountEmail > 0) {
                array_push($errors, "Email already exist!");
            }

            //No error when submit the form
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$passwordHash')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Registered successfully');</script>";

                    //perform a delay redirect after displaying the success message
                    echo '<meta http-equiv="refresh" content="0;url=login.php">';
                    die();
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            }

            mysqli_close($conn);
            
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <label type="username" id="username">Username: </label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label type="email" id="email">Email: </label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label type="password" id="password">Password: </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <p>Already Registered?<a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>

</html>