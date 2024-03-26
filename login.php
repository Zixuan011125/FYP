<?php
include("includes/header.php");
session_start();
//if login will be direct to the home.php
if(isset($_SESSION["user"])){
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            include "includes/functions.php";

            $sql = "SELECT * FROM users WHERE username = '$username'";

            $result = mysqli_query($conn, $sql);

            //Convert the object in array
            $user = mysqli_fetch_assoc($result);
            if($user){
                if(password_verify($password, $user["password"])){
                    //allow only logged in user to access the pages by using the session functions
                    session_start();
                    $_SESSION["user"] = "yes";
                    echo "<script>alert('Logged In successfully');</script>";

                    //perform a delay redirect after displaying the success message
                    echo '<meta http-equiv="refresh" content="0;url=login.php">';

                    header("Location: home.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not exist</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Username does not exist</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label type="username" id="username">Username: </label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label type="password" id="password">Password: </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
            </div>
        </form>
        <div><p>Not Registered yet?<a href="registration.php">Register Here</a></p></div>
        <div><p>Forgot Password?<a href="forgot_password.php">Reset Password</a></p></div>
    </div>
</body>

</html>