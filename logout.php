<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION["user"])) {
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // User has confirmed logout, destroy session and redirect to login page
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        // Display confirmation dialog to the user
        echo '<script>
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = "logout.php?confirm=true";
                } else {
                    // Redirect to home.php only when the user clicks "Cancel"
                    window.location.href = "home.php";
                }
              </script>';
    }
} else {
    // If the user is not logged in, redirect them to the home page
    header("Location: home.php");
    exit;
}
?>
