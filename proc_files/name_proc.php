<?php

// Connect to database
include("../helper_functions/db_connect.php");

session_start();

// email address from subscribe page
$email_address = $_SESSION['email_address'];

// get user input
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$bio = $_POST['bio'];

// query to update database
$sql = "UPDATE Subscribers SET fname = '$fname', lname = '$lname', bio = '$bio' WHERE email_address = '$email_address'";
$result = mysqli_query($conn, $sql);

// finish subscription process in name.php
if ($result == TRUE) {
    session_destroy();
    // redirect user to login page
    header("Location: ../login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



?>