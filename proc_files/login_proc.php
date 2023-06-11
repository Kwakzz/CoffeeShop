<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to database
// Obtain access to secure input function
include("../helper_functions/db_connect.php");
include("../helper_functions/secure_input.php");

// check if user has clicked the login button
if (isset($_POST['login'])) {
    
        // get user input
        $email_address = secure_input($_POST['email_address']);
        $password = secure_input($_POST['password']);
    
        // query to check if email address exists
        $sql = "SELECT * FROM Subscribers WHERE email_address = '$email_address'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($result) {
    
            // if email address exists, check if password is correct
            if ($count == 1) {
                $row = mysqli_fetch_assoc($result);
                $subscriber_id = $row['subscriber_id'];
                $hashed_password = $row['subscriber_password'];
        
                // if password is correct, log user in
                if (password_verify($password, $hashed_password)) {
                    session_start();
                    $_SESSION['subscriber_id'] = $subscriber_id;
                    header("Location: ../home.php");
                    exit();
                }
        
                // if password is incorrect, redirect to login page
                else {
                    echo "Incorrect details";
                }
            }

            else {
                echo "Account doesn't exist";
            }
        }

        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    
}

?>