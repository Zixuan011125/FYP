<?php
$conn = mysqli_connect("localhost", "root", "", "forever18");
if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>
<!-- Security: Strong Password Policy, maybe can used PDO (for sql injection), 
user authentication and authorization-->